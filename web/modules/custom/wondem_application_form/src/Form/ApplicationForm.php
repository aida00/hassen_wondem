<?php

namespace Drupal\wondem_application_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the Application Form with role-based variations.
 */
class ApplicationForm extends FormBase {

  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  public function __construct(AccountProxyInterface $current_user) {
    $this->currentUser = $current_user;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'wondem_application_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // 🔒 Require login
    if ($this->currentUser->isAnonymous()) {
      $form['message'] = [
        '#markup' => '<div class="p-6 bg-red-100 text-red-800 rounded-lg">You must <a href="/user/login" class="underline">log in</a> to apply.</div>',
      ];
      return $form;
    }

    $account = $this->currentUser;

    // Tailwind classes
    $text_classes = ['w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-blue-500', 'focus:ring-blue-500'];
    $textarea_classes = ['w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-blue-500', 'focus:ring-blue-500', 'h-32'];

    // ✅ Common fields (original ones + extras)
    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
      '#default_value' => $account->getDisplayName(),
      '#attributes' => ['readonly' => 'readonly', 'class' => $text_classes],
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
      '#default_value' => $account->getEmail(),
      '#attributes' => ['readonly' => 'readonly', 'class' => $text_classes],
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number'),
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#attributes' => ['class' => $text_classes],
    ];

    $form['experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Work Experience'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['cover_letter'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Cover Letter'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    // ✅ Role selector
    $form['role'] = [
      '#type' => 'radios',
      '#title' => $this->t('Which role are you applying for?'),
      '#options' => [
        'it' => $this->t('IT Applicant'),
        'ba' => $this->t('Business Analyst'),
        'cs' => $this->t('Customer Service'),
      ],
      '#required' => TRUE,
      '#ajax' => [
        'callback' => '::updateRoleFields',
        'wrapper' => 'role-specific-fields',
        'effect' => 'fade',
      ],
    ];

    // ✅ Role-specific container
    $form['role_fields'] = [
      '#type' => 'container',
      '#attributes' => ['id' => 'role-specific-fields'],
    ];

    $selected_role = $form_state->getValue('role');
    if ($selected_role === 'it') {
      $form['role_fields']['skills'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Technical Skills'),
        '#attributes' => ['class' => $textarea_classes],
      ];
    }
    elseif ($selected_role === 'ba') {
      $form['role_fields']['certification'] = [
        '#type' => 'textfield',
        '#title' => $this->t('BA Certification ID'),
        '#attributes' => ['class' => $text_classes],
      ];
    }
    elseif ($selected_role === 'cs') {
      $form['role_fields']['language'] = [
        '#type' => 'select',
        '#title' => $this->t('Language Fluency'),
        '#options' => [
          'en' => $this->t('English'),
          'fr' => $this->t('French'),
          'es' => $this->t('Spanish'),
        ],
      ];
    }

    // ✅ Submit
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Apply Now'),
      '#attributes' => ['class' => ['px-6', 'py-3', 'bg-blue-600', 'text-white', 'rounded-lg']],
    ];

    return $form;
  }

  /**
   * AJAX callback for role-specific fields.
   */
  public function updateRoleFields(array &$form, FormStateInterface $form_state) {
    return $form['role_fields'];
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Gather all common values
    $values = [
      'Full Name' => $form_state->getValue('full_name'),
      'Email' => $form_state->getValue('email'),
      'Phone' => $form_state->getValue('phone'),
      'Address' => $form_state->getValue('address'),
      'Experience' => $form_state->getValue('experience'),
      'Cover Letter' => $form_state->getValue('cover_letter'),
      'Role' => $form_state->getValue('role'),
    ];

    // Add role-specific values
    switch ($form_state->getValue('role')) {
      case 'it':
        $values['Technical Skills'] = $form_state->getValue('skills');
        break;
      case 'ba':
        $values['BA Certification ID'] = $form_state->getValue('certification');
        break;
      case 'cs':
        $values['Language Fluency'] = $form_state->getValue('language');
        break;
    }

    // ✅ Print everything in one confirmation
    $output = '<div class="p-6 bg-green-100 text-green-800 rounded-lg"><h2>Application Submitted</h2><ul>';
    foreach ($values as $label => $value) {
      $output .= '<li><strong>' . $label . ':</strong> ' . ($value ?: '-') . '</li>';
    }
    $output .= '</ul></div>';

    $this->messenger()->addMessage(['#markup' => $output]);
  }

}
