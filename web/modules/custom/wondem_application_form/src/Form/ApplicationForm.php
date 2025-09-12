<?php

namespace Drupal\wondem_application_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the Application Form.
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

  public function getFormId() {
    return 'wondem_application_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // 🔒 Require login
    if ($this->currentUser->isAnonymous()) {
      $form['message'] = [
        '#markup' => '<div class="p-6 bg-red-100 text-red-800 rounded-lg">You must <a href="/user/login" class="underline">log in</a> to apply.</div>',
      ];
      return $form;
    }

    // ✅ Prefill values
    $account = $this->currentUser;

    $text_classes = ['w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-blue-500', 'focus:ring-blue-500'];
    $textarea_classes = ['w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-blue-500', 'focus:ring-blue-500', 'h-32'];

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
      '#title' => $this->t('Phone No'),
      '#attributes' => ['class' => $text_classes],
    ];

    $form['source'] = [
      '#type' => 'radios',
      '#title' => $this->t('How did you hear about us?'),
      '#options' => [
        'recruitment_site' => $this->t('Recruitment Site'),
        'referral' => $this->t('Referral'),
        'other' => $this->t('Other (please specify)'),
      ],
      '#attributes' => ['class' => ['space-y-2']],
    ];

    $form['employment_status'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your current employment status?'),
      '#attributes' => ['class' => $text_classes],
    ];

    $form['equipment'] = [
      '#type' => 'radios',
      '#title' => $this->t('Do you have a reliable PC and internet connection?'),
      '#options' => ['yes' => $this->t('Yes'), 'no' => $this->t('No')],
      '#attributes' => ['class' => ['space-x-4']],
    ];

    $form['experience_online'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Do you have online work/education experience?'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['availability'] = [
      '#type' => 'textarea',
      '#title' => $this->t('How much time per day can you allocate? When are you available?'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['experience_content'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What is your experience in content writing? Please share samples or links.'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['team_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Describe a time you worked with a team to resolve an IT issue.'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['proficiency_writing'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How do you describe your proficiency in content writing?'),
      '#attributes' => ['class' => $text_classes],
    ];

    $form['proficiency_media'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How do you describe your proficiency in images & video editing?'),
      '#attributes' => ['class' => $text_classes],
    ];

    $form['proficiency_tools'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Proficiency with version control, CMS (Drupal, WordPress), Linux?'),
      '#attributes' => ['class' => $text_classes],
    ];

    $form['education_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Relevant education, work experience, or hobbies related to digital content?'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['salary_expectation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your salary expectation?'),
      '#attributes' => ['class' => $text_classes],
    ];

    $form['job_obstacles'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What do you think will be an obstacle to your job, or what do you hate in a job?'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit Application'),
      '#attributes' => [
        'class' => ['px-6', 'py-3', 'bg-blue-600', 'text-white', 'font-semibold', 'rounded-lg', 'shadow', 'hover:bg-blue-700', 'transition'],
      ],
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();

    \Drupal::database()->insert('wondem_applications')
      ->fields([
        'full_name' => $values['full_name'],
        'email' => $values['email'],
        'phone' => $values['phone'],
        'data' => serialize($values),
        'created' => \Drupal::time()->getRequestTime(),
      ])
      ->execute();

    \Drupal::messenger()->addMessage($this->t('Application submitted successfully!'));
  }
}
