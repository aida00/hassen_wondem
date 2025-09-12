<?php

namespace Drupal\wondem_application_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;

/**
 * Controller for Application admin pages.
 */
class ApplicationAdminController extends ControllerBase {

  /**
   * List applications (compact).
   */
  public function list() {
    $header = [
      'id' => $this->t('ID'),
      'full_name' => $this->t('Full Name'),
      'email' => $this->t('Email'),
      'phone' => $this->t('Phone'),
      'created' => $this->t('Submitted'),
      'operations' => $this->t('Operations'),
    ];

    $rows = [];
    $results = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa', ['id', 'full_name', 'email', 'phone', 'created'])
      ->orderBy('created', 'DESC')
      ->execute();

    foreach ($results as $record) {
      $rows[] = [
        'id' => $record->id,
        'full_name' => $record->full_name,
        'email' => $record->email,
        'phone' => $record->phone,
        'created' => \Drupal::service('date.formatter')->format($record->created, 'short'),
        'operations' => [
          'data' => [
            '#type' => 'link',
            '#title' => $this->t('View'),
            '#url' => Url::fromRoute('wondem_application_form.admin_view', ['id' => $record->id]),
          ],
        ],
      ];
    }

    return [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No applications found.'),
    ];
  }

  /**
   * View a single application (all fields).
   */
  public function view($id) {
    $record = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa')
      ->condition('id', $id)
      ->execute()
      ->fetchObject();

    if (!$record) {
      return ['#markup' => $this->t('Application not found.')];
    }

    $values = unserialize($record->data);

    // Human-readable labels for each field.
    $labels = [
      'full_name' => $this->t('Full Name'),
      'email' => $this->t('Email'),
      'phone' => $this->t('Phone'),
      'employment_status' => $this->t('Employment Status'),
      'equipment' => $this->t('PC & Internet'),
      'online_experience' => $this->t('Online Work/Education Experience'),
      'availability' => $this->t('Availability'),
      'writing_experience' => $this->t('Writing Experience'),
      'team_experience' => $this->t('Teamwork Experience'),
      'writing_proficiency' => $this->t('Writing Proficiency'),
      'media_proficiency' => $this->t('Media Proficiency'),
      'tools_proficiency' => $this->t('Tools & Software Proficiency'),
      'education_experience' => $this->t('Education/Experience'),
      'salary' => $this->t('Salary Expectation'),
      'obstacles' => $this->t('Obstacles/Challenges'),
      'heard_about' => $this->t('How did you hear about us?'),
      'heard_about_other' => $this->t('Other (please specify)'),
    ];

    $rows = [];
    foreach ($labels as $key => $label) {
      if (!empty($values[$key])) {
        $rows[] = [
          'label' => $label,
          'value' => is_array($values[$key]) ? implode(', ', $values[$key]) : $values[$key],
        ];
      }
    }

    return [
      '#theme' => 'table',
      '#header' => [$this->t('Field'), $this->t('Value')],
      '#rows' => array_map(fn($row) => [$row['label'], $row['value']], $rows),
      '#empty' => $this->t('No details available.'),
    ];
  }

}
