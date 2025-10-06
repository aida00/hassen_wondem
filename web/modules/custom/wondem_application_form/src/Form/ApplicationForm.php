<?php

namespace Drupal\wondem_application_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApplicationForm extends FormBase {

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

  // To provide additional help details for the questions

  /**
   * Build form with 2 steps: fill form → review & confirm.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $step = $form_state->get('step');
    $values = $form_state->getValues();

    // 🔒 Require login
    if ($this->currentUser->isAnonymous()) {
      $form['message'] = [
        '#markup' => '<div class="p-6 bg-red-100 text-red-800 rounded-lg">' .
          $this->t('You must <a href="/user/login?destination=/application-form" class="underline">log in</a> to apply.') .
          '</div>',
      ];
      return $form;
    }

    $defaults = $form_state->get('saved_values') ?? [];    

    // Define account + username
    $account  = $this->currentUser;
    $username = $account->getDisplayName();
    $email = $account->getEmail();

    // Prevent re-application
    $exists = \Drupal::database()->select('wondem_applications', 'wa')
      ->fields('wa', ['id'])
      ->condition('email', $email)
      ->range(0, 1)
      ->execute()
      ->fetchField();

    if ($exists && $step !== 'review_complete') {
      $form['message'] = [
        '#markup' => '<div class="p-6 bg-yellow-100 text-yellow-800 rounded-lg">' .
          $this->t('You have already submitted an application. View your <a href=":status">application status</a>.', [
            ':status' => '/application/status',
          ]) .
          '</div>',
      ];
      return $form;
    }

    // --- STEP 2: Review Screen ---
    if ($step === 'review') {
      $saved = $form_state->get('saved_values') ?? [];

      // Maps for human-readable review
      $maps = [
        'source' => [
          'recruitment_site' => $this->t('Recruitment Site'),
          'referral'         => $this->t('Referral'),
          'other'            => $this->t('Other (please specify)'),
        ],
        'employment_status' => ['yes' => $this->t('Yes'), 'no' => $this->t('No')],
        'equipment'         => ['yes' => $this->t('Yes'), 'no' => $this->t('No')],
        'role'              => [
          'it' => $this->t('IT Applicant / Developer'),
          'cw' => $this->t('Content Creator and Writer'),
          'cs' => $this->t('Customer Service'),
        ],
        // proficiency levels
        'prof_git'          => ['beginner'=>$this->t('Beginner'),'intermediate'=>$this->t('Intermediate'),
                                'advanced'=>$this->t('Advanced'),'expert'=>$this->t('Expert')],
        'prof_cms'          => ['beginner'=>$this->t('Beginner'),'intermediate'=>$this->t('Intermediate'),
                                'advanced'=>$this->t('Advanced'),'expert'=>$this->t('Expert')],
        'prof_linux'        => ['beginner'=>$this->t('Beginner'),'intermediate'=>$this->t('Intermediate'),
                                'advanced'=>$this->t('Advanced'),'expert'=>$this->t('Expert')],
        'proficiency_writing'=> ['beginner'=>$this->t('Beginner'),'intermediate'=>$this->t('Intermediate'),
                                'advanced'=>$this->t('Advanced'),'expert'=>$this->t('Expert')],
        'proficiency_media'  => ['beginner'=>$this->t('Beginner'),'intermediate'=>$this->t('Intermediate'),
                                'advanced'=>$this->t('Advanced'),'expert'=>$this->t('Expert')],
        'english_written'    => ['basic'=>$this->t('Basic'),'conversational'=>$this->t('Conversational'),
                                'fluent'=>$this->t('Fluent'),'native_like'=>$this->t('Native-like')],
        'english_spoken'     => ['basic'=>$this->t('Basic'),'conversational'=>$this->t('Conversational'),
                                'fluent'=>$this->t('Fluent'),'native_like'=>$this->t('Native-like')],
      ];

      // Helper to pretty-print values
      $display = function(string $key, $val) use ($maps) {
        if ($val === NULL || $val === '') return '';
        if (isset($maps[$key]) && isset($maps[$key][$val])) {
          return (string) $maps[$key][$val];
        }
        if (is_array($val)) return implode(', ', $val);
        return (string) $val;
      };

      $form['summary'] = [
        '#markup' => '<h2 class="text-xl font-bold mb-4 text-blue-800">'.$this->t('Review Your Application').'</h2>'
          . '<p class="mb-6 text-gray-700">'.$this->t('Please review your answers below. If everything looks correct, click “Submit Final Application.” You can go back to make changes if needed.').'</p>',
      ];

      $sections = [
        'personal' => [
          'title'  => $this->t('Personal Information'),
          'fields' => ['full_name','email','phone','address'],
        ],
        'general' => [
          'title'  => $this->t('General Questions'),
          'fields' => ['source','source_details','employment_status','employment_details',
                      'equipment','experience_online','availability','cover_letter',
                      'salary_expectation','job_obstacles'],
        ],
        'role' => [
          'title'  => $this->t('Role-Specific Questions'),
          'fields' => ['role','skills','team_experience','prof_git','prof_cms','prof_linux',
                      'education_experience','proficiency_writing','cw_samples','proficiency_media',
                      'cs_experience','conflict_resolution','crm_tools','typing_speed',
                      'english_written','english_spoken'],
        ],
      ];

      foreach ($sections as $section_key => $section) {
        $rows = [];
        foreach ($section['fields'] as $key) {
          $val = $display($key, $saved[$key] ?? '');
          if ($val === '') continue;

          $nice = ucwords(str_replace('_',' ', $key));
          $rows[] = [
            ['data' => ['#markup' => '<strong>'.$nice.'</strong>'], 'style' => 'width:40%;'],
            ['data' => ['#plain_text' => $val], 'style' => 'width:60%;'],
          ];
        }

        if ($rows) {
          $form[$section_key . '_title'] = ['#markup' => '<h3 class="text-lg font-semibold mt-8 mb-2 text-gray-800">'.$section['title'].'</h3>'];
          $form[$section_key . '_table'] = ['#type'=>'table', '#rows'=>$rows, '#attributes'=>['class'=>['min-w-full','border','border-gray-200']]];
        }
      }

      $form['actions'] = ['#type'=>'actions'];
      $form['actions']['back'] = [
        '#type'=>'submit','#value'=>$this->t('Edit Responses'),
        '#submit'=>['::backToEdit'],'#limit_validation_errors'=>[],
        '#attributes'=>['class'=>['bg-gray-500','text-white','px-4','py-2','rounded']],
      ];
      $form['actions']['confirm'] = [
        '#type'=>'submit','#value'=>$this->t('Submit Final Application'),
        '#submit'=>['::submitFinal'],
        '#attributes'=>['class'=>['bg-green-600','text-white','px-4','py-2','rounded']],
      ];

      return $form;
    }


    // --- STEP 1: Original Application Form ---
    $text_classes = ['w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-blue-500', 'focus:ring-blue-500'];
    $textarea_classes = ['w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-blue-500', 'focus:ring-blue-500', 'h-32'];

    $form['welcome'] = [
      '#markup' => '<div class="p-6 bg-blue-100 text-blue-800 rounded-lg">' .
        $this->t('Welcome @name! Please fill out the application form below.', ['@name' => $username]) .
        '</div>',
    ];

    // Attach the CSS library
    $form['#attached']['library'][] = 'wondem_application_form/form_styles';


    // ✅ Common fields
    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
      '#default_value' => $defaults['full_name'] ?? '',
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
      '#default_value' => $defaults['phone'] ?? '',
      '#description' => $this->t('Use international format, e.g., +251911234567'),
      '#attributes' => [
        'class' => $text_classes,
        'placeholder' => '+251911234567',
        'inputmode' => 'tel',     // better mobile keyboard
        'autocomplete' => 'tel',  // browser autofill
      ],
    ];

    $form['address'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#required' => TRUE,
      '#default_value' => $defaults['address'] ?? NULL,
      '#attributes' => ['class' => $text_classes],
    ];



    // Q1. How did you hear about this job post?
    $form['source'] = [
      '#type' => 'radios',
      '#title' => $this->t('How did you hear about this job post?'),
      '#required' => TRUE,
      '#options' => [
        'recruitment_site' => $this->t('Recruitment Site'),
        'referral'         => $this->t('Referral'),
        'other'            => $this->t('Other (please specify)'),
      ],
      '#default_value' => $defaults['source'] ?? NULL,
      '#attributes' => ['class' => ['space-y-2']],
    ];

    // Only show details field if "other" is selected.
    $form['source_details'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Please specify'),
      '#default_value' => $defaults['source_details'] ?? '',
      '#states' => [
        'visible' => [
          ':input[name="source"]' => ['value' => 'other'],
        ],
        'required' => [
          ':input[name="source"]' => ['value' => 'other'],
        ],
      ],
      '#attributes' => ['class' => $text_classes],
    ];


    // Q2 - Employment status
    $form['employment_status'] = [
      '#type' => 'radios',
      '#title' => $this->t('Are you currently employed?'),
      '#required' => TRUE,
      '#options' => [
        'yes' => $this->t('Yes'),
        'no'  => $this->t('No'),
      ],
      '#default_value' => $defaults['employment_status'] ?? NULL,
      '#attributes' => ['class' => ['space-x-4']],
    ];

    // Extra textbox, shown only if "Yes" is selected
    $form['employment_details'] = [
      '#type' => 'textarea',
      '#title' => $this->t('If yes, please describe your current position, schedule, and how you plan to balance responsibilities.'),
      '#default_value' => $defaults['employment_details'] ?? NULL,
      '#states' => [
        'visible'  => [':input[name="employment_status"]' => ['value' => 'yes']],
        'required' => [':input[name="employment_status"]' => ['value' => 'yes']],
      ],
      '#attributes' => ['class' => $textarea_classes], // was $text_classes
    ];


    // Q3 - Equipment
    $form['equipment'] = [
      '#type' => 'radios',
      '#title' => $this->t('Do you have a reliable personal computer and internet connection?'),
      '#required' => TRUE,
      '#options' => ['yes' => $this->t('Yes'), 'no' => $this->t('No')],
      '#default_value' => $defaults['equipment'] ?? NULL,
      '#attributes' => ['class' => ['space-x-4']],
      // ⓘ inline help just under the label:
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> This role requires daily online communication and task delivery.
            Describe your setup — the type of computer you use, internet speed, and whether you have
            backup options (e.g., mobile hotspot, secondary device) in case of technical issues.
          </div>
        </details>
      ',
      '#description_display' => 'before',
    ];


    // Q4 - Online experience
    $form['experience_online'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about your online work or education experience.'),
      '#required' => TRUE,
      '#default_value' => $defaults['experience_online'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      // ⓘ inline help just under the label:
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Imagine you are reflecting on times you worked or studied remotely. 
            How did you stay disciplined, manage your schedule, and use online tools (like Zoom, Google Docs, Slack, 
            or LMS platforms)? Please provide an example of when this experience helped you succeed.
          </div>
        </details>
      ',
      '#description_display' => 'before',
    ];


    // Q5. Time per day / Availability
    $form['availability'] = [
      '#type' => 'textfield',
      '#title' => $this->t('How much time per day can you allocate if selected (workweek is 5–6 days)?'),
      '#required' => TRUE,
      '#default_value' => $defaults['availability'] ?? '',
      '#attributes' => [
        'class' => $text_classes,
        'placeholder' => 'e.g. 4 hours/day',
      ],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Scenario: Picture yourself in this role. How many hours per day 
            can you realistically dedicate, and during which parts of the day (morning, afternoon, evening)? 
            Share how you would structure your routine to stay consistent across a 5–6 day workweek.
          </div>
        </details>
      ',
      '#description_display' => 'before',
    ];

    // Q6. Cover letter
    $form['cover_letter'] = [
      '#type' => 'textarea',
      '#title' => $this->t('In a few words, tell us about yourself. (Cover Letter)'),
      '#default_value' => $defaults['cover_letter'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      // ⓘ inline help just under the label:
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Imagine writing a short introduction to 
            a team you’re about to join. In 3–5 sentences, summarize your background, strengths, 
            and what excites you about this opportunity.
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // Q7. Salary expectation (numbers only)
    $form['salary_expectation'] = [
      '#type' => 'number',
      '#title' => $this->t('What is your salary expectation in Birr? (numbers only)'),
      '#required' => TRUE,
      '#default_value' => isset($defaults['salary_expectation']) ? $defaults['salary_expectation'] : NULL,
      '#min' => 0,
      '#step' => 1,
      '#attributes' => [
        'class' => $text_classes,
        'inputmode' => 'numeric',
        'pattern' => '\d*',
        'placeholder' => 'e.g. 5000',
      ],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Consider the skills and experience you bring. 
            What is your expected monthly salary for this role? Please provide a numeric value (currency etb).
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // Q8. Obstacles
    $form['job_obstacles'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about a time you faced an obstacle in your job and how you overcame it.'),
      '#default_value' => $defaults['job_obstacles'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Think of a challenge you faced at work, school, or in a project. 
            Describe the situation, what made it difficult, the steps you took to address it, and the result. 
            What did you learn from the experience that could help you in this job?
          </div>
        </details>
      ',
      '#description_display' => 'before',
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
      '#default_value' => $defaults['role'] ?? NULL,
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

    $selected_role = $form_state->getValue('role') ?? ($defaults['role'] ?? NULL);

  if ($selected_role === 'it') {
    $form['role_fields']['it_group'] = [
      '#type'  => 'details',
      '#title' => $this->t('IT Applicant Details'),
      '#open'  => TRUE,
    ];

    // IT 1. Technical skills
    $form['role_fields']['it_group']['skills'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about any IT-related technical skills you have.'),
      '#default_value' => $defaults['skills'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Imagine you’re introducing yourself 
            to a technical team on your first day. What IT-related skills would you highlight 
            (e.g., programming languages, networking, databases, security, cloud platforms)? 
            Describe your strongest areas and how you’ve applied them in real projects.
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // IT 2. Team experience in resolving an IT issue
    $form['role_fields']['it_group']['team_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about a time you worked with a team to resolve an IT issue.'),
      '#default_value' => $defaults['team_experience'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Think of a situation where an IT issue 
            affected a system, team, or customer. How did you and your team diagnose the problem, 
            what role did you play, and what steps did you take together to resolve it?
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

      // IT 3. Proficiency levels
      $levels = [
        'beginner'     => $this->t('Beginner'),
        'intermediate' => $this->t('Intermediate'),
        'advanced'     => $this->t('Advanced'),
        'expert'       => $this->t('Expert'),
      ];

      // Intro + inline (i) help — define the element first
      $form['role_fields']['it_group']['prof_intro'] = [
        '#markup' => '
          <br>
          <p>
            Please select your proficiency level for each technology below. </p>
          <p class="text-sm text-gray-700 mb-2">
            <details class="wa-help inline">
              <summary>ⓘ More info</summary>
              <div>
                <strong>Scenario:</strong> Imagine you are starting a new project. How comfortable would you be
                setting up a Git repository, deploying a Drupal or WordPress site, or configuring a
                Linux server? Describe your hands-on experience, and rate your proficiency
                (Beginner, Intermediate, Advanced, Expert).
              </div>
            </details>
          </p>
        ',
      ];

      // The three selects
      $form['role_fields']['it_group']['prof_git'] = [
        '#type' => 'select',
        '#title' => $this->t('Version control (e.g., Git) proficiency'),
        '#options' => $levels,
        '#required' => TRUE,
        '#default_value' => $defaults['prof_git'] ?? NULL,
      ];

      $form['role_fields']['it_group']['prof_cms'] = [
        '#type' => 'select',
        '#title' => $this->t('CMS platforms (Drupal, WordPress) proficiency'),
        '#options' => $levels,
        '#required' => TRUE,
        '#default_value' => $defaults['prof_cms'] ?? NULL,
      ];

      $form['role_fields']['it_group']['prof_linux'] = [
        '#type' => 'select',
        '#title' => $this->t('Linux distributions proficiency'),
        '#options' => $levels,
        '#required' => TRUE,
        '#default_value' => $defaults['prof_linux'] ?? NULL,
      ];


    // IT 4. Relevant education/work/hobbies
    $form['role_fields']['it_group']['education_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about any relevant education, work experience, or hobbies related to programming/development.'),
      '#default_value' => $defaults['education_experience'] ?? NULL,
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Picture yourself explaining to 
            a recruiter why you’re passionate about IT. Share details about your education, 
            training, work experience, or even personal projects 
            (e.g., building apps, contributing to open source, running a server) that show your development skills.
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];
  }


  elseif ($selected_role === 'cw') {
    $form['role_fields']['cw_group'] = [
      '#type'  => 'details',
      '#title' => $this->t('Content Creator & Writer Details'),
      '#open'  => TRUE,
    ];

    // CW 1. Education/work/hobbies
    $form['role_fields']['cw_group']['education_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about any relevant education, work experience, or hobbies related to content creation.'),
      '#required' => TRUE,
      '#default_value' => $defaults['education_experience'] ?? NULL,
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Imagine you’re pitching yourself as a content creator. 
            Which experiences, studies, or personal projects best show your skills in writing, 
            storytelling, or content design?
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // CW 2. Writing proficiency (level)
    $levels = [
      'beginner'     => $this->t('Beginner'),
      'intermediate' => $this->t('Intermediate'),
      'advanced'     => $this->t('Advanced'),
      'expert'       => $this->t('Expert'),
    ];
    $form['role_fields']['cw_group']['proficiency_writing'] = [
      '#type' => 'select',
      '#title' => $this->t('What is your level of proficiency in content writing?'),
      '#options' => $levels,
      '#required' => TRUE,
      '#default_value' => $defaults['proficiency_writing'] ?? NULL,
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Reflect on your writing experience. 
            How confident are you in producing clear, engaging, and professional content? 
            Share the types of content you’ve created (blogs, articles, product descriptions, 
            social posts) and how comfortable you are with each.
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // CW 3. Samples/links (separate field)
    $form['role_fields']['cw_group']['cw_samples'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Share samples of your work or links to content you previously created.'),
      '#default_value' => $defaults['cw_samples'] ?? '',
      '#attributes' => ['class' => $textarea_classes, 'placeholder' => 'URLs or brief descriptions'],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Provide links, documents, or portfolios that show your best work. 
            Think about pieces that demonstrate your writing style, creativity, or ability to explain complex ideas clearly.
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // CW 4. Team experience
    $form['role_fields']['cw_group']['team_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about a time you worked with a team to create content.'),
      '#default_value' => $defaults['team_experience'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Recall a project where you collaborated with 
            designers, editors, or other writers. What was your role, how did the team divide 
            responsibilities, and what was the final outcome?
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];


    // CW 5. Image & video editing proficiency (level)
    $form['role_fields']['cw_group']['proficiency_media'] = [
      '#type' => 'select',
      '#title' => $this->t('How would you describe your proficiency in image and video editing?'),
      '#options' => $levels,
      '#required' => TRUE,
      '#default_value' => $defaults['proficiency_media'] ?? '',
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Imagine being asked to support content with visuals. 
            What tools (e.g., Photoshop, Canva, Premiere Pro) can you use, and how confident are you 
            in creating or editing images and videos to support your writing?
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

  }

  elseif ($selected_role === 'cs') {
    $form['role_fields']['cs_group'] = [
      '#type'  => 'details',
      '#title' => $this->t('Customer Service Details'),
      '#open'  => TRUE,
    ];

    // CS 1. Experience with customers
    $form['role_fields']['cs_group']['cs_experience'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about your experience working with customers.'),
      '#required' => TRUE,
      '#default_value' => $defaults['cs_experience'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Picture yourself describing your 
            customer-facing experience to a new employer. Which industries have you worked in, 
            what type of customers did you handle (B2B, retail, online), and what communication 
            channels did you use (phone, chat, email)?
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // CS 2. Difficult situation
    $form['role_fields']['cs_group']['conflict_resolution'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Tell us about a time you faced a difficult customer situation and how you resolved it.'),
      '#default_value' => $defaults['conflict_resolution'] ?? '',
      '#attributes' => ['class' => $textarea_classes],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Think of a challenging customer case. 
            What made the situation difficult? How did you listen, respond, and solve the issue? 
            What was the customer’s reaction afterward?
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // CS 3. CRM/Helpdesk tools
    $form['role_fields']['cs_group']['crm_tools'] = [
      '#type' => 'textfield',
      '#title' => $this->t('What types of CRM or Helpdesk tools have you used?'),
      '#required' => TRUE,
      '#default_value' => $defaults['crm_tools'] ?? '',
      '#attributes' => ['class' => $text_classes, 'placeholder' => 'e.g., Zendesk, Freshdesk, HubSpot, etc.'],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Imagine you’re joining a new support team. 
            Which tools have you used before (Zendesk, Freshdesk, HubSpot, GA4, phone systems, 
            live chat, etc.)? How did they help you manage customer interactions and track performance?
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // CS 4. Typing speed
    $form['role_fields']['cs_group']['typing_speed'] = [
      '#type' => 'number',
      '#title' => $this->t('What is your average typing speed (WPM)?'),
      '#required' => TRUE,
      '#min' => 0,
      '#step' => 1,
      '#default_value' => $defaults['typing_speed'] ?? '',
      '#attributes' => ['class' => $text_classes, 'inputmode' => 'numeric', 'pattern' => '\d*'],
      '#description' => '
        <details class="wa-help">
          <summary>ⓘ More info</summary>
          <div>
            <strong>Scenario:</strong> Many customer service roles require fast and accurate typing. 
            Please share your average typing speed in words per minute (WPM). 
            If possible, mention how you tested it (typing test platform, internal tool, etc.).
          </div>
        </details>
      ',
      '#description_display' => 'before',
      ];

    // CS 5. English proficiency (written & spoken)
    $levels = [
      'basic'          => $this->t('Basic'),
      'conversational' => $this->t('Conversational'),
      'fluent'         => $this->t('Fluent'),
      'native_like'    => $this->t('Native-like'),
    ];

      $form['role_fields']['cs_group']['english_intro'] = [
        '#markup' => '
          <br>
          <p>
            Tell us about your proficiency level in written and spoken English. </p>
          <p class="text-sm text-gray-700 mb-2">
            <details class="wa-help inline">
              <summary>ⓘ More info</summary>
              <div>
                <strong>Scenario:</strong> Imagine handling a customer query both 
                by email and on a live call. How comfortable are you writing professional messages and 
                speaking fluently in English? Rate your proficiency in both written and spoken English.
              </div>
            </details>
          </p>
        ',
      ];


    $form['role_fields']['cs_group']['english_written'] = [
      '#type' => 'select',
      '#title' => $this->t('English proficiency (Written)'),
      '#options' => $levels,
      '#required' => TRUE,
      '#default_value' => $defaults['english_written'] ?? NULL,
    ];

    $form['role_fields']['cs_group']['english_spoken'] = [
      '#type' => 'select',
      '#title' => $this->t('English proficiency (Spoken)'),
      '#options' => $levels,
      '#required' => TRUE,
      '#default_value' => $defaults['english_spoken'] ?? NULL,
    ];
  }



    // ✅ Submit
    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['next'] = [
      '#type' => 'submit',
      '#value' => $this->t('Continue to Review'),
      '#submit' => ['::goToReview'],    // <— important
      '#attributes' => ['class' => ['px-6','py-3','bg-blue-600','text-white','rounded-lg']],
    ];


    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->get('step') === 'review') {
      return;
    }

    // ✅ Email validation (Drupal service)
    $email = $form_state->getValue('email');
    if (!\Drupal::service('email.validator')->isValid($email)) {
      $form_state->setErrorByName('email', $this->t('Please enter a valid email address.'));
    }

    // ✅ Phone: normalize & validate against E.164 (7–15 digits, optional leading +)
    $phone_raw = trim($form_state->getValue('phone') ?? '');

    // Keep a single leading + if present; strip all other non-digits.
    $phone_normalized = preg_replace('/(?!^\+)\D+/', '', $phone_raw);

    if (!preg_match('/^\+?[1-9]\d{6,14}$/', $phone_normalized)) {
      $form_state->setErrorByName('phone', $this->t('Please enter a valid international phone number (e.g., +251911234567).'));
    } else {
      // Save back the normalized value so we store clean data.
      $form_state->setValue('phone', $phone_normalized);
    }


    // Validate employement status form 
    if ($form_state->getValue('employment_status') === 'yes') {
        $details = trim((string) $form_state->getValue('employment_details'));
        if ($details === '') {
          $form_state->setErrorByName('employment_details', $this->t('Please provide a few employment details.'));
        }
      }

    // Validate the where did you hear about us section
    if ($form_state->getValue('source') === 'other') {
      $details = trim((string) $form_state->getValue('source_details'));
      if ($details === '') {
        $form_state->setErrorByName('source_details', $this->t('Please specify how you heard about us.'));
      }
    }

    // Salary (digits only, >= 0)
    $salary = (string) $form_state->getValue('salary_expectation');
    if (!preg_match('/^\d+$/', $salary)) {
      $form_state->setErrorByName('salary_expectation', $this->t('Salary must be numbers only.'));
    }

    // If CS role, typing speed must be a reasonable integer
    if ($form_state->getValue('role') === 'cs') {
      $wpm = (string) $form_state->getValue('typing_speed');
      if ($wpm === '' || !preg_match('/^\d+$/', $wpm)) {
        $form_state->setErrorByName('typing_speed', $this->t('Typing speed must be a whole number (WPM).'));
      } elseif ((int) $wpm > 300) {
        $form_state->setErrorByName('typing_speed', $this->t('Typing speed seems too high. Please enter a realistic value.'));
      }
    }


      parent::validateForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
      // Not used. We route submits to custom handlers (goToReview, submitFinal, backToEdit).
    }


    /**
     * AJAX callback for role-specific fields.
     */
    public function updateRoleFields(array &$form, FormStateInterface $form_state) {
      return $form['role_fields'];
    }


    public function goToReview(array &$form, FormStateInterface $form_state) {
      $form_state->set('saved_values', $form_state->getValues()); // <— store
      $form_state->set('step', 'review');
      $form_state->setRebuild(TRUE);
    }
    /**
     * Review → Back to Edit
     */
    public function backToEdit(array &$form, FormStateInterface $form_state) {
      $form_state->set('step', NULL);
      $form_state->setRebuild(TRUE);
    }

    /**
     * {@inheritdoc}
     */
    public function submitFinal(array &$form, FormStateInterface $form_state) {
      // Get the saved, validated values from step 1.
      $values = $form_state->get('saved_values') ?? [];

      // Remove internal keys you don’t want to store.
      foreach (['form_build_id','form_token','form_id','op','submit','role_fields','it_group','cw_group','cs_group'] as $k) {
        unset($values[$k]);
      }


    // ✅ Normalize employment fields:
    // - Keep only when status == 'yes'
    // - Convert the stored value to human-readable label for the summary.
    $employment_options = ['yes' => $this->t('Yes'), 'no' => $this->t('No')];
    $source_options = [
      'recruitment_site' => $this->t('Recruitment Site'),
      'referral'         => $this->t('Referral'),
      'other'            => $this->t('Other (please specify)'),
    ];
    $role_options = [
      'it' => $this->t('IT Applicant / Developer'),
      'cw' => $this->t('Content Creator and Writer'),
      'cs' => $this->t('Customer Service'),
    ];

    // Normalize labels
    $employment_status_value = $values['employment_status'] ?? '';
    $values['employment_status_label'] = $employment_options[$employment_status_value] ?? $employment_status_value;
    if (($values['employment_status'] ?? '') !== 'yes') {
      $values['employment_details'] = '';
    }

    $source_value = $values['source'] ?? '';
    $values['source_label'] = $source_options[$source_value] ?? $source_value;
    if ($source_value !== 'other') {
      $values['source_details'] = '';
    }

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


    $this->messenger()->addMessage(['#markup' => $output]);

    $form_state->set('step', 'review_complete');

    $form_state->setRedirect('wondem_application_form.status');

  }

  }
