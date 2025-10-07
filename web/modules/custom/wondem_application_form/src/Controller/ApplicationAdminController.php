<?php

namespace Drupal\wondem_application_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Database\Connection;
use Drupal\Core\Render\Markup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Drupal\wondem_application_form\Service\ApplicationStorage;

/**
 * Controller for Application admin pages + review form.
 */
class ApplicationAdminController extends ControllerBase {

  public function __construct(
    private ApplicationStorage $storage,
    private Connection $db,
  ) {}

  public static function create(ContainerInterface $container): self {
    return new self(
      $container->get('wondem_application_form.storage'),
      $container->get('database'),
    );
  }


    private function colorStatus(string $status): string {
    switch ($status) {
      case 'Accepted':
        $color = '#2e7d32'; // green
        $bg = '#e8f5e9';
        break;
      case 'Rejected':
        $color = '#c62828'; // red
        $bg = '#ffebee';
        break;
      case 'Needs Review':
      default:
        $color = '#2528dfff'; // orange
        $bg = '#e0e0e6ff';
        break;
    }

    return sprintf(
      '<span style="display:inline-block;padding:4px 8px;border-radius:6px;font-weight:600;color:%s;background-color:%s;text-transform:capitalize;">%s</span>',
      $color,
      $bg,
      htmlspecialchars($status)
    );
  }


  /**
   * Compact list of applications.
   */
public function list() {
  $account = $this->currentUser();

  // Read filters from URL.
  $req = \Drupal::request();
  $filters = [
    'q'           => $req->query->get('q') ?? '',
    'status'      => $req->query->get('status') ?? 'all',
    'min_score'   => $req->query->get('min_score') ?? '',
    'max_score'   => $req->query->get('max_score') ?? '',
    'current_uid' => (int) $account->id(),
  ];

  // Pager setup.
  $per_page = (int) ($req->query->get('per_page') ?? 20);
  $allowed = [10, 20, 50];
  $limit = in_array($per_page, $allowed, TRUE) ? $per_page : 20;

  $page   = max(0, (int) $req->query->get('page', 0));
  $offset = $page * $limit;

  // Fetch rows with filters applied.
  $total = $this->storage->count($filters);
  $rowsAssoc = $this->storage->fetch($filters, $limit, $offset);

  // Build table rows.
  $rows = [];
  foreach ($rowsAssoc as $id => $record) {
    $rows[] = [
      'id'        => $record['id'],
      'full_name' => $record['full_name'],
      'email'     => $record['email'],
      'phone'     => $record['phone'],
      'created'   => \Drupal::service('date.formatter')->format($record['created'], 'short'),
      'status' => [
        'data' => [
          '#markup' => Markup::create($this->colorStatus($record['status'] ?? 'needs_review')),
        ],
      ],
      

            // ✅ One "operations" column with both links:
      'operations' => [
        'data' => [
          '#type' => 'operations',
          '#links' => [
            'view' => [
              'title' => $this->t('View'),
              'url' => Url::fromRoute('wondem_application_form.admin_view', ['id' => $record['id']]),
            ],
            'review' => [
              'title' => $this->t('Review'),
              'url' => Url::fromRoute('waf.admin.review', ['id' => $record['id']]),
            ],
          ],
        ],
      ],
    ];
  }


  $build['filters'] = \Drupal::formBuilder()->getForm(\Drupal\wondem_application_form\Form\ApplicationAdminFilterForm::class);

  $build['actions'] = [
    '#type' => 'container',
    '#attributes' => ['class' => ['layout-row', 'mb-3']],
    'export' => [
      '#type' => 'link',
      '#title' => $this->t('Export filtered'),
      '#url' => Url::fromRoute('waf.admin.export', [], ['query' => $filters]),
      '#attributes' => ['class' => ['button', 'button--primary']],
    ],
  ];

  
  $build['table'] = [
    '#type' => 'table',
    '#header' => [
      'id' => $this->t('ID'),
      'full_name' => $this->t('Full Name'),
      'email' => $this->t('Email'),
      'phone' => $this->t('Phone'),
      'created' => $this->t('Submitted'),
      'status'    => $this->t('Status'),
      'operations' => $this->t('Operations'),
    ],
    '#rows' => $rows,
    '#empty' => $this->t('No applications found.'),
  ];

  // Add a pager (needs core pager attached).
  $build['pager'] = [
    '#type' => 'pager',
    '#element' => 0,
  ];

  // Register total for pager.
  // (Drupal's SQL pager usually sets this automatically; since we're doing custom,
  // we can fake it with the pager manager service.)
  $pager = \Drupal::service('pager.manager');
  $pager->createPager($total, $limit);

  $build['pager'] = [
    '#type' => 'pager',
    '#element' => 0,
    '#quantity' => 9, // how many page numbers to show
    '#tags' => [
      $this->t('« first'),
      $this->t('‹ previous'),
      $this->t('next ›'),
      $this->t('last »'),
    ],
  ];

  return $build;
}


  /**
   * View a single application row with expanded fields.
   */
  public function view($id) {
    $record = $this->db->select('wondem_applications', 'wa')
      ->fields('wa')
      ->condition('id', $id)
      ->execute()
      ->fetchObject();

    if (!$record) {
      return ['#markup' => $this->t('Application not found.')];
    }

    $values = unserialize($record->data);
    $values = is_array($values) ? $values : [];

    // Normalized labels.
    $values['applied_role'] = $values['role_label'] ?? $values['role'] ?? '';
    $values['employment_status_hr'] = $values['employment_status_label'] ?? $values['employment_status'] ?? '';
    $values['source_hr'] = $values['source_label'] ?? $values['source'] ?? '';

    $labels = [
      'full_name'             => $this->t('Full Name'),
      'email'                 => $this->t('Email'),
      'phone'                 => $this->t('Phone'),
      'address'               => $this->t('Address'),
      'applied_role'          => $this->t('Applied Role'),
      'employment_status_hr'  => $this->t('Currently Employed?'),
      'employment_details'    => $this->t('Employment Details'),
      'source_hr'             => $this->t('How did you hear about us?'),
      'source_details'        => $this->t('Source Details'),
      'equipment'             => $this->t('PC & Internet'),
      'experience_online'     => $this->t('Online Work/Education Experience'),
      'availability'          => $this->t('Availability'),
      'cover_letter'          => $this->t('Cover Letter'),
      'salary_expectation'    => $this->t('Salary Expectation'),
      'job_obstacles'         => $this->t('Obstacles/Challenges'),
      // IT role
      'skills'                => $this->t('Technical Skills'),
      'team_experience'       => $this->t('Team Experience'),
      'education_experience'  => $this->t('Education/Experience'),
      'prof_git'              => $this->t('Git Proficiency'),
      'prof_cms'              => $this->t('CMS Proficiency'),
      'prof_linux'            => $this->t('Linux Proficiency'),
      // Writer role
      'experience_content'    => $this->t('Writing Experience'),
      'proficiency_writing'   => $this->t('Writing Proficiency'),
      'proficiency_media'     => $this->t('Media Proficiency'),
      'cw_samples'            => $this->t('Work Samples / Links'),
      // Customer service
      'cs_experience'         => $this->t('Customer Service Experience'),
      'conflict_resolution'   => $this->t('Conflict Resolution'),
      'crm_tools'             => $this->t('CRM/Helpdesk Tools'),
      'typing_speed'          => $this->t('Typing Speed (WPM)'),
      'english_written'       => $this->t('English (Written)'),
      'english_spoken'        => $this->t('English (Spoken)'),
    ];

    $rows = [];
    foreach ($labels as $key => $label) {
      if (!empty($values[$key])) {
        $rows[] = [
          $label,
          is_array($values[$key]) ? implode(', ', $values[$key]) : $values[$key],
        ];
      }
    }

    // --- NEW: review summary under the responses -----------------------------
    $reviewer = '-';
    if (!empty($record->reviewer_uid)) {
      $user = \Drupal::entityTypeManager()->getStorage('user')->load((int) $record->reviewer_uid);
      if ($user) {
        $reviewer = $user->label();
      }
    }
    $updated = !empty($record->updated)
      ? \Drupal::service('date.formatter')->format((int) $record->updated, 'short')
      : '-';

    $review_rows = [
      [$this->t('Status'), $record->status ?? 'needs_review'],
      [$this->t('Score'), isset($record->score) ? (string) (int) $record->score : '-'],
      [$this->t('Reviewed by'), $reviewer],
      [$this->t('Last updated'), $updated],
    ];
    if (!empty($record->note)) {
      $review_rows[] = [$this->t('Internal note'), $record->note];
    }
    // -------------------------------------------------------------------------

    return [
      '#type' => 'container',
      'app_table' => [
        '#theme' => 'table',
        '#header' => [$this->t('Field'), $this->t('Value')],
        '#rows' => $rows,
        '#empty' => $this->t('No details available.'),
      ],
      'review_title' => [
        '#markup' => '<h2 style="margin-top:1.5rem">'.$this->t('Review summary').'</h2>',
      ],
      'review_table' => [
        '#theme' => 'table',
        '#header' => [$this->t('Field'), $this->t('Value')],
        '#rows' => $review_rows,
        '#empty' => $this->t('No review saved yet.'),
      ],
    ];

  }



  /* ----------------------------- CSV Export ------------------------------ */

  /**
   * Streams all applications as a CSV download.
   */
  public function exportCsv(): StreamedResponse {
    $account = $this->currentUser();
    $req = \Drupal::request();
    $filters = [
      'q'           => $req->query->get('q') ?? '',
      'status'      => $req->query->get('status') ?? 'all',
      'min_score'   => $req->query->get('min_score') ?? '',
      'max_score'   => $req->query->get('max_score') ?? '',
      'current_uid' => (int) $account->id(),
    ];

    $response = new StreamedResponse();
    $response->setCallback(function () use ($filters) {
      $handle = fopen('php://output', 'w');

      // Stream in chunks to avoid memory blowups on big tables.
      $limit = 500;
      $offset = 0;
      $wroteHeader = FALSE;

      while (TRUE) {
        $batch = $this->storage->fetch($filters, $limit, $offset);
        if (!$batch) break;

        foreach ($batch as $row) {
          if (!$wroteHeader) {
            fputcsv($handle, array_keys($row));
            $wroteHeader = TRUE;
          }
          fputcsv($handle, $row);
        }

        $offset += $limit;
      }

      fclose($handle);
    });

    $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
    $response->headers->set('Content-Disposition', 'attachment; filename="applications.csv"');

    return $response;
  }

}