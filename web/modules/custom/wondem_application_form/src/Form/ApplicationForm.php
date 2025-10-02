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
        '#markup' => '<div class="p-6 bg-red-100 text-red-800 rounded-lg">' .
          $this->t('You must <a href="/user/login?destination=/application-form" class="underline">log in</a> to apply.') .
          '</div>',
      ];
      return $form;
    }


    // Define account + username
    $account  = $this->currentUser;
    $username = $account->getDisplayName();

    // Deny re-applying if this email already submitted.
    $email = $this->currentUser->getEmail();
    $exists = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa', ['id'])
      ->condition('email', $email)
      ->range(0, 1)
      ->execute()
      ->fetchField();

    if ($exists) {
      $form['message'] = [
        '#markup' => '<div class="p-6 bg-yellow-100 text-yellow-800 rounded-lg">' .
          $this->t('You have already submitted an application. View your <a href=":status">application status</a>.', [
            ':status' => '/application/status',
          ]) .
        '</div>',
      ];
      return $form;
    } else {
      // New user logged in but hasn’t applied yet
      $form['welcome'] = [
        '#markup' => '<div class="p-6 bg-blue-100 text-blue-800 rounded-lg">' .
          $this->t('Welcome @name! Please fill out the application form below.', ['@name' => $username]) .
          '</div>',
      ];
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
      '#attributes' => ['class' => $text_classes],
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
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    // Attach the CSS library to fix formatting of radio buttons and text
    $form['#attached']['library'][] = 'wondem_application_form/form_styles';

    $form['source'] = [
      '#type' => 'radios',
      '#title' => $this->t('How did you hear about us?'),
      '#required' => TRUE,
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
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    $form['equipment'] = [
      '#type' => 'radios',
      '#title' => $this->t('Do you have a reliable PC and internet connection?'),
      '#required' => TRUE,
      '#options' => ['yes' => $this->t('Yes'), 'no' => $this->t('No')],
      '#attributes' => ['class' => ['space-x-4']],
    ];

    $form['experience_online'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Do you have online work/education experience?'),
      '#required' => TRUE,
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['availability'] = [
      '#type' => 'textarea',
      '#title' => $this->t('How much time per day can you allocate? When are you available?'),
      '#required' => TRUE,
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
        'it' => $this->t('IT Applicant / Developer'),
        'cw' => $this->t('Content Creator and Writer'),
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
      
      $form['role_fields']['it_group'] = [
      '#type'  => 'details',
      '#title' => $this->t('IT Applicant Details'),
      '#open'  => TRUE,
      ];

      $form['role_fields']['it_group']['skills'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Describe any technical skills you have.'),
        '#attributes' => ['class' => $textarea_classes],
      ];
      
      $form['role_fields']['it_group']['team_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Describe a time you worked with a team to resolve an IT issue.'),
      '#attributes' => ['class' => $textarea_classes],
      ];

      $form['role_fields']['it_group']['proficiency_tools'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Proficiency with version control, CMS (Drupal, WordPress), Linux?'),
        '#required' => TRUE,
        '#attributes' => ['class' => $text_classes],
      ];

      $form['role_fields']['it_group']['education_experience'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Relevant education, work experience, or hobbies related to programming / Development?'),
        '#attributes' => ['class' => $textarea_classes],
      ];

      $form['role_fields']['it_group']['salary_expectation'] = [
        '#type' => 'textfield',
        '#title' => $this->t('What is your salary expectation?'),
        '#required' => TRUE,
        '#attributes' => ['class' => $text_classes],
      ];

      $form['role_fields']['it_group']['job_obstacles'] = [
        '#type' => 'textarea',
        '#title' => $this->t('What do you think will be an obstacle to your job, or what do you hate in a job?'),
        '#attributes' => ['class' => $textarea_classes],
      ];

    }

    elseif ($selected_role === 'cw') {
    $form['role_fields']['cw_group'] = [
      '#type'  => 'details',
      '#title' => $this->t('Content Creator & Writer Details'),
      '#open'  => TRUE,
    ];

    $form['role_fields']['cw_group']['education_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Relevant education, work experience, or hobbies related to content creation'),
      '#required' => TRUE,
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['role_fields']['cw_group']['experience_content'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What is your experience in content writing? Please share samples or links.'),
      '#required' => TRUE,
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['role_fields']['cw_group']['team_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Describe a time you worked with a team to create content.'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['role_fields']['cw_group']['proficiency_writing'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How do you describe your proficiency in content writing?'),
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    $form['role_fields']['cw_group']['proficiency_media'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How do you describe your proficiency in images & video editing?'),
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    $form['role_fields']['cw_group']['salary_expectation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your salary expectation?'),
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    $form['role_fields']['cw_group']['job_obstacles'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What do you think will be an obstacle to your job, or what do you hate in a job?'),
      '#attributes' => ['class' => $textarea_classes],
    ];
  }
  elseif ($selected_role === 'cs') {
    $form['role_fields']['cs_group'] = [
      '#type'  => 'details',
      '#title' => $this->t('Customer Service Details'),
      '#open'  => TRUE,
    ];

    $form['role_fields']['cs_group']['cs_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about your experience handling customers (channels, typical volume, industries).'),
      '#required' => TRUE,
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['role_fields']['cs_group']['conflict_resolution'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Describe a difficult customer interaction and how you resolved it.'),
      '#attributes' => ['class' => $textarea_classes],
    ];

    $form['role_fields']['cs_group']['crm_tools'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What CRM / Helpdesk Tools can you use? e.g., Zendesk, Freshdesk, HubSpot, GA4 basics, phone systems, live chat, or other'),
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    $form['role_fields']['cs_group']['typing_speed'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your typing Speed (WPM)'),
      '#attributes' => ['class' => $text_classes],
    ];

    
    // Keep your language field and place it here so it lives inside the CS group.
    $form['role_fields']['cs_group']['language'] = [
      '#type' => 'select',
      '#title' => $this->t('Primary Language Fluency'),
      '#required' => TRUE,
      '#options' => [
        'en' => $this->t('English'),
        'am' => $this->t('Amharic'),
        'es' => $this->t('Spanish'),
      ],
    ];

    $form['role_fields']['cs_group']['salary_expectation'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What is your salary expectation?'),
      '#required' => TRUE,
      '#attributes' => ['class' => $text_classes],
    ];

    $form['role_fields']['cs_group']['job_obstacles'] = [
      '#type' => 'textarea',
      '#title' => $this->t('What do you think will be an obstacle to your job, or what do you hate in a job?'),
      '#attributes' => ['class' => $textarea_classes],
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
  // 1) Collect all values from the form_state.
  $values = $form_state->getValues();

  // Remove internal keys we don't want to store.
  foreach ([
    'form_build_id','form_token','form_id','op','submit',
    // containers/details only carry children; keep them out
    'role_fields','it_group','cw_group','cs_group',
  ] as $k) {
    unset($values[$k]);
  }


    // Resolve the human-readable label for the chosen role and save it too.
  $role_options = $form['role']['#options'] ?? [];
  $values['role_label'] = $role_options[$values['role'] ?? ''] ?? ($values['role'] ?? '');



  // 2) Insert into custom table (keep summary columns too).
  \Drupal::database()->insert('wondem_applications')
    ->fields([
      'full_name' => $values['full_name'] ?? '',
      'email'     => $values['email'] ?? '',
      'phone'     => $values['phone'] ?? '',
      'data'      => serialize($values),                   // keep schema as-is
      'created'   => \Drupal::time()->getRequestTime(),
    ])
    ->execute();

  // 3) Nice confirmation (your existing output).
  $pretty = [
    'Full Name'           => $values['full_name'] ?? '',
    'Email'               => $values['email'] ?? '',
    'Phone'               => $values['phone'] ?? '',
    'Address'             => $values['address'] ?? '',
    'Role'                => $values['role_label'] ?? '',
    'Cover Letter'        => $values['cover_letter'] ?? '',
  ];

  // Role-specific echo-back (optional; purely for the message).
  switch ($values['role'] ?? '') {
    case 'it':
      $pretty['Technical Skills']       = $values['skills'] ?? '';
      $pretty['Team Experience']        = $values['team_experience'] ?? '';
      $pretty['Proficiency with Tools'] = $values['proficiency_tools'] ?? '';
      $pretty['Education/Experience']   = $values['education_experience'] ?? '';
      $pretty['Salary Expectation']     = $values['salary_expectation'] ?? '';
      $pretty['Job Obstacles']          = $values['job_obstacles'] ?? '';
      break;

    case 'cw':
      $pretty['Education/Experience']   = $values['education_experience'] ?? '';
      $pretty['Writing Experience']     = $values['experience_content'] ?? '';
      $pretty['Team Experience']        = $values['team_experience'] ?? '';
      $pretty['Writing Proficiency']    = $values['proficiency_writing'] ?? '';
      $pretty['Media Proficiency']      = $values['proficiency_media'] ?? '';
      $pretty['Salary Expectation']     = $values['salary_expectation'] ?? '';
      $pretty['Job Obstacles']          = $values['job_obstacles'] ?? '';
      break;

    case 'cs':
      $pretty['CS Experience']          = $values['cs_experience'] ?? '';
      $pretty['Conflict Resolution']    = $values['conflict_resolution'] ?? '';
      $pretty['CRM/Helpdesk Tools']     = $values['crm_tools'] ?? '';
      $pretty['Typing Speed (WPM)']     = $values['typing_speed'] ?? '';
      $pretty['Language Fluency']       = $values['language'] ?? '';
      $pretty['Salary Expectation']     = $values['salary_expectation'] ?? '';
      $pretty['Job Obstacles']          = $values['job_obstacles'] ?? '';
      break;
  }

  $output = '<div class="p-6 bg-green-100 text-green-800 rounded-lg"><h2>Application Submitted</h2><ul>';
  foreach ($pretty as $label => $value) {
    $output .= '<li><strong>' . $label . ':</strong> ' . ($value !== '' ? $value : '-') . '</li>';
  }
  $output .= '</ul></div>';

  $this->messenger()->addMessage(['#markup' => $output]);

  $form_state->setRedirect('wondem_application_form.status');

}

}
