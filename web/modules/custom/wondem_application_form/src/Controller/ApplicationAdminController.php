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


    if (!empty($values['role_label'])) {
      $rows[] = ['label' => $this->t('Role'), 'value' => $values['role_label']];
    } elseif (!empty($values['role'])) {
      $role_labels = [
        'it' => $this->t('IT Applicant / Developer'),
        'cw' => $this->t('Content Creator and Writer'),
        'cs' => $this->t('Customer Service'),
      ];
      $rows[] = ['label' => $this->t('Role'), 'value' => $role_labels[$values['role']] ?? $values['role']];
    }



    // Human-readable labels for each field.
    $labels = [
      // Common
      'full_name'            => $this->t('Full Name'),
      'email'                => $this->t('Email'),
      'phone'                => $this->t('Phone'),
      'address'              => $this->t('Address'),
      'source'               => $this->t('How did you hear about us?'),
      'employment_status'    => $this->t('Employment Status'),
      'equipment'            => $this->t('PC & Internet'),
      'experience_online'    => $this->t('Online Work/Education Experience'),
      'availability'         => $this->t('Availability'),
      'cover_letter'         => $this->t('Cover Letter'),
      'role'                 => $this->t('Role'),

      // IT
      'skills'               => $this->t('Technical Skills'),
      'team_experience'      => $this->t('Team Experience'),
      'proficiency_tools'    => $this->t('Proficiency with Tools'),
      'education_experience' => $this->t('Education/Experience'),
      'salary_expectation'   => $this->t('Salary Expectation'),
      'job_obstacles'        => $this->t('Job Obstacles'),

      // Content Writer
      'experience_content'   => $this->t('Writing Experience'),
      'proficiency_writing'  => $this->t('Writing Proficiency'),
      'proficiency_media'    => $this->t('Media Proficiency'),

      // Customer Service
      'cs_experience'        => $this->t('Customer Service Experience'),
      'conflict_resolution'  => $this->t('Conflict Resolution Example'),
      'crm_tools'            => $this->t('CRM / Helpdesk Tools'),
      'typing_speed'         => $this->t('Typing Speed (WPM)'),
      'language'             => $this->t('Primary Language Fluency'),
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
