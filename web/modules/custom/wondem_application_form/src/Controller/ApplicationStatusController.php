<?php

namespace Drupal\wondem_application_form\Controller;

use Drupal\Core\Controller\ControllerBase;

class ApplicationStatusController extends ControllerBase {

  /**
   * Show the current user's application status and summary.
   */
  public function status() {
    $account = $this->currentUser();
    if ($account->isAnonymous()) {
      return [
        '#markup' => $this->t('You must <a href=":login">log in</a> to view your application status.', [
          ':login' => '/user/login',
        ]),
      ];
    }

    // Look up the latest application by this user's email.
    $email = $account->getEmail();
    $record = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa', ['id', 'full_name', 'email', 'phone', 'created', 'data'])
      ->condition('email', $email)
      ->orderBy('created', 'DESC')
      ->range(0, 1)
      ->execute()
      ->fetchObject();

    if (!$record) {
      // No application yet — nudge to apply.
      return [
        '#type' => 'container',
        'text' => [
          '#markup' => $this->t('We don’t have an application from you yet. <a href=":apply">Apply now</a>.', [
            ':apply' => '/application-form',
          ]),
        ],
      ];
    }

    // Decode saved values (you saved with serialize()).
    $values = @unserialize($record->data) ?: [];

    $role_labels = [
        'it' => $this->t('IT Applicant / Developer'),
        'cw' => $this->t('Content Creator and Writer'),
        'cs' => $this->t('Customer Service'),
    ];
    $role_label = $values['role_label'] ?? ($role_labels[$values['role'] ?? ''] ?? ($values['role'] ?? '-'));

    $rows = [
      [$this->t('Status'), $this->t('Submitted')], // You can extend with a real workflow later.
      [$this->t('Submitted on'), \Drupal::service('date.formatter')->format($record->created, 'short')],
      [$this->t('Full Name'), $record->full_name],
      [$this->t('Email'), $record->email],
      [$this->t('Phone'), $record->phone],
      [$this->t('Role'), $role_label],
    ];

    return [
      '#type' => 'container',
      'title' => [
        '#markup' => '<h2>'.$this->t('Your Application').'</h2>',
      ],
      'table' => [
        '#theme'  => 'table',
        '#header' => [$this->t('Field'), $this->t('Value')],
        '#rows'   => $rows,
      ],
      'note' => [
        '#markup' => '<p>'.$this->t('Your application has been received.').'</p>',
      ],
    ];
  }
}
