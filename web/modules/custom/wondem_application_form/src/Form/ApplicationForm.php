<?php

namespace Drupal\wondem_application_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides the Application Form.
 */
class ApplicationForm extends FormBase {

  public function getFormId() {
    return 'wondem_application_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
      '#attributes' => ['class' => ['block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm']],
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#required' => TRUE,
      '#attributes' => ['class' => ['block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm']],
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone No'),
      '#attributes' => ['class' => ['block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm']],
    ];

    $form['heard_about'] = [
      '#type' => 'radios',
      '#title' => $this->t('How did you hear about us?'),
      '#options' => [
        'recruitment' => $this->t('Recruitment Site'),
        'referral' => $this->t('Referral'),
        'other' => $this->t('Other (please specify)'),
      ],
      '#attributes' => ['class' => ['space-y-2']],
    ];

    $form['heard_about_other'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Other (Please specify)'),
      '#states' => [
        'visible' => [
          ':input[name="heard_about"]' => ['value' => 'other'],
        ],
      ],
      '#attributes' => ['class' => ['block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm']],
    ];

    $form['employment_status'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What is your current employment status?'),
      '#attributes' => ['class' => ['block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm']],
    ];

    $form['equipment'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Do you have a reliable PC and internet connection?'),
    ];

    $form['online_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Do you have online work/education experience?'),
    ];

    $form['availability'] = [
      '#type' => 'textarea',
      '#title' => $this->t('How much time per day can you allocate? When are you available?'),
    ];

    $form['writing_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What is your experience in content writing? Please share samples or links.'),
    ];

    $form['team_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Describe a time you worked with a team to resolve an IT issue.'),
    ];

    $form['writing_proficiency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('How do you describe your proficiency in content writing?'),
    ];

    $form['media_proficiency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('How do you describe your proficiency in images & video editing?'),
    ];

    $form['tools_proficiency'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Proficiency with version control, CMS (Drupal, WordPress), Linux?'),
    ];

    $form['education_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Relevant education, work experience, or hobbies related to digital content?'),
    ];

    $form['salary'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your salary expectation?'),
    ];

    $form['obstacles'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What do you think will be an obstacle to your job, or what do you hate in a job?'),
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit Application'),
      '#button_type' => 'primary',
      '#attributes' => ['class' => ['bg-indigo-600', 'hover:bg-indigo-700', 'text-white', 'px-6', 'py-3', 'rounded-md']],
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage($this->t('Application submitted successfully!'));
    // You can extend this: save to DB, send email, etc.
  }
}
