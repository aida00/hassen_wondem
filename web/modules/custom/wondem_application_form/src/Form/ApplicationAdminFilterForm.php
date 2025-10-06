<?php

namespace Drupal\wondem_application_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class ApplicationAdminFilterForm extends FormBase {
  public function getFormId(): string {
    return 'waf_admin_filters';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    // Read current query values to prefill the form.
    $req = \Drupal::request();
    $q         = $req->query->get('q') ?? '';
    $status    = $req->query->get('status') ?? 'all';
    $min_score = $req->query->get('min_score') ?? '';
    $max_score = $req->query->get('max_score') ?? '';
    $me_only   = (bool) $req->query->get('me_only', FALSE);

    $form['#method'] = 'get';
    $form['#attributes']['class'][] = 'container-inline';

    $form['q'] = [
      '#type' => 'search',
      '#title' => $this->t('Search'),
      '#title_display' => 'invisible',
      '#size' => 24,
      '#placeholder' => $this->t('Name / Email / Phone'),
      '#default_value' => $q,
    ];

    $form['status'] = [
      '#type' => 'select',
      '#title' => $this->t('Status'),
      '#options' => [
        'all' => $this->t('All'),
        'needs_review' => $this->t('Needs review'),
        'accepted' => $this->t('Accepted'),
        'rejected' => $this->t('Rejected'),
      ],
      '#default_value' => $status,
    ];

    $form['min_score'] = [
      '#type' => 'number',
      '#title' => $this->t('Min score'),
      '#min' => 0, '#max' => 100, '#step' => 1,
      '#default_value' => $min_score,
    ];
    $form['max_score'] = [
      '#type' => 'number',
      '#title' => $this->t('Max score'),
      '#min' => 0, '#max' => 100, '#step' => 1,
      '#default_value' => $max_score,
    ];


    $form['actions']['#type'] = 'actions';
    $form['actions']['apply'] = [
      '#type' => 'submit',
      '#value' => $this->t('Filter'),
      '#button_type' => 'primary',
    ];
    $form['actions']['reset'] = [
      '#type' => 'link',
      '#title' => $this->t('Reset'),
      '#url' => Url::fromRoute('waf.admin.list'),
      '#attributes' => ['class' => ['button']],
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    // Redirect to the list route, carrying filters in the query string.
    $vals = $form_state->getValues();
    $params = [];

    foreach (['q','status','min_score','max_score'] as $k) {
      if ($vals[$k] !== '' && $vals[$k] !== NULL) {
        $params[$k] = $vals[$k];
      }
    }


    $form_state->setRedirect('waf.admin.list', [], ['query' => $params]);
  }
}
