<?php

namespace Drupal\wondem_application_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\wondem_application_form\Service\ApplicationStorage;

class ApplicationReviewForm extends FormBase {

  public function __construct(private ApplicationStorage $storage) {}

  public static function create(ContainerInterface $container): self {
    return new self($container->get('wondem_application_form.storage'));
  }

  public function getFormId() {
    return 'waf_review_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state, $id = NULL) {
    $app = $this->storage->load((int) $id);
    if (!$app) {
      $form['msg'] = ['#markup' => $this->t('Application not found.')];
      return $form;
    }

    $form['#title'] = $this->t('Review: @name (#@id)', ['@name' => $app['full_name'], '@id' => $app['id']]);

    
    
      // show the applicant's responses ---------------------------------
    $values = @unserialize($app['data']);
    $values = is_array($values) ? $values : [];

    // Normalize a few human-readable fields (same mapping as your view page).
    $values['applied_role']         = $values['role_label'] ?? $values['role'] ?? '';
    $values['employment_status_hr'] = $values['employment_status_label'] ?? $values['employment_status'] ?? '';
    $values['source_hr']            = $values['source_label'] ?? $values['source'] ?? '';

    $labels = [
        'full_name'            => $this->t('Full Name'),
        'email'                => $this->t('Email'),
        'phone'                => $this->t('Phone'),
        'address'              => $this->t('Address'),
        'applied_role'         => $this->t('Applied Role'),
        'employment_status_hr' => $this->t('Currently Employed?'),
        'employment_details'   => $this->t('Employment Details'),
        'source_hr'            => $this->t('How did you hear about us?'),
        'source_details'       => $this->t('Source Details'),
        'equipment'            => $this->t('PC & Internet'),
        'experience_online'    => $this->t('Online Work/Education Experience'),
        'availability'         => $this->t('Availability'),
        'cover_letter'         => $this->t('Cover Letter'),
        'salary_expectation'   => $this->t('Salary Expectation'),
        'job_obstacles'        => $this->t('Obstacles/Challenges'),
        // IT role
        'skills'               => $this->t('Technical Skills'),
        'team_experience'      => $this->t('Team Experience'),
        'education_experience' => $this->t('Education/Experience'),
        'prof_git'             => $this->t('Git Proficiency'),
        'prof_cms'             => $this->t('CMS Proficiency'),
        'prof_linux'           => $this->t('Linux Proficiency'),
        // Writer role
        'experience_content'   => $this->t('Writing Experience'),
        'proficiency_writing'  => $this->t('Writing Proficiency'),
        'proficiency_media'    => $this->t('Media Proficiency'),
        'cw_samples'           => $this->t('Work Samples / Links'),
        // Customer service
        'cs_experience'        => $this->t('Customer Service Experience'),
        'conflict_resolution'  => $this->t('Conflict Resolution'),
        'crm_tools'            => $this->t('CRM/Helpdesk Tools'),
        'typing_speed'         => $this->t('Typing Speed (WPM)'),
        'english_written'      => $this->t('English (Written)'),
        'english_spoken'       => $this->t('English (Spoken)'),
    ];

    $rows = [];
    foreach ($labels as $key => $label) {
        if (isset($values[$key]) && $values[$key] !== '' && $values[$key] !== NULL) {
        $rows[] = [
            ['data' => ['#plain_text' => (string) $label], 'style' => 'width:35%;'],
            ['data' => ['#plain_text' => is_array($values[$key]) ? implode(', ', $values[$key]) : (string) $values[$key]]],
        ];
        }
    }

    $form['applicant'] = [
        '#type' => 'details',
        '#title' => $this->t('Applicant responses'),
        '#open' => TRUE,
    ];
    $form['applicant']['table'] = [
        '#type' => 'table',
        '#header' => [$this->t('Field'), $this->t('Value')],
        '#rows' => $rows,
        '#empty' => $this->t('No details available.'),
    ];
    // -------------------------------------------------------------------------
    
    
    
    
    // Read-only essentials.
    $form['info'] = [
      '#type' => 'item',
      '#markup' => '<div><strong>Email:</strong> '. $app['email'] .'<br><strong>Phone:</strong> '. $app['phone'] .'</div>',
    ];

    $form['status'] = [
      '#type' => 'select',
      '#title' => $this->t('Status'),
      '#options' => [
        'needs_review' => $this->t('Needs review'),
        'accepted' => $this->t('Accepted'),
        'rejected' => $this->t('Rejected'),
      ],
      '#required' => TRUE,
      '#default_value' => $app['status'] ?? 'needs_review',
    ];

    $form['score'] = [
      '#type' => 'number',
      '#title' => $this->t('Score (0–100)'),
      '#min' => 0,
      '#max' => 100,
      '#step' => 1,
      '#default_value' => isset($app['score']) ? (int) $app['score'] : NULL,
      '#description' => $this->t('Optional numeric score for filtering.'),
    ];

    $form['note'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Internal note'),
      '#default_value' => $app['note'] ?? '',
      '#rows' => 6,
    ];

    $form['id'] = ['#type' => 'value', '#value' => (int) $id];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['save'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save review'),
      '#button_type' => 'primary',
    ];
    $form['actions']['back'] = [
      '#type' => 'link',
      '#title' => $this->t('Back to list'),
      '#url' => \Drupal\Core\Url::fromRoute('waf.admin.list'),
      '#attributes' => ['class' => ['button']],
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $score = $form_state->getValue('score');
    if ($score !== '' && $score !== NULL) {
      if (!is_numeric($score) || $score < 0 || $score > 100) {
        $form_state->setErrorByName('score', $this->t('Score must be a number between 0 and 100.'));
      }
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $id = (int) $form_state->getValue('id');
    $status = $form_state->getValue('status');
    $score = $form_state->getValue('score');
    $note = $form_state->getValue('note') ?? '';
    $uid = (int) $this->currentUser()->id();

    $this->storage->saveReview($id, $status, ($score === '' ? NULL : (int) $score), $note, $uid);
    $this->messenger()->addStatus($this->t('Review saved.'));
    $form_state->setRedirect('waf.admin.list');
  }
}
