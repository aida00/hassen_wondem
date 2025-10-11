<?php

namespace Drupal\registration\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

use Drupal\Core\Url;
use Drupal\Core\Routing\TrustedRedirectResponse; // only if you use a Response redirect
/**
 * Custom Registration Form.
 */
class RegistrationForm extends FormBase {

  /**
   * Form ID.
   */
  public function getFormId() {
    return 'registration_form';
  }

  /**
   * Build the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Use the SAME CSS as login for identical look & feel
    $form['#attached']['library'][] = 'loginpage/auth';   

    $form['#attached']['library'][] = 'registration/registration-styles';

    // Wrap form in a centered dark box
    $form['#prefix'] = '<div class="lp-wrap"><div class="lp-card">';
    $form['#suffix'] = '</div></div>';

    // Form title
    $form['title'] = [
      '#markup' => '<div class="lp-title">'.$this->t('Create Account').'</div>',
    ];

    $label = 'lp-label';
    $input = 'lp-input';


    // Username field
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => '<span class="'.$label.'">'.$this->t('Username').'</span>',
      '#required' => TRUE,
      '#title_display' => 'before',
      '#attributes' => ['class' => [$input], 'placeholder' => $this->t('Choose a username')],
    ];

    // Email field
    $form['email'] = [
      '#type' => 'email',
      '#title' => '<span class="'.$label.'">'.$this->t('Email').'</span>',
      '#required' => TRUE,
      '#title_display' => 'before',
      '#attributes' => ['class' => [$input], 'placeholder' => $this->t('Enter your email')],
    ];

    // Password field
    // Drupal’s password strength meter.
    $form['#attached']['library'][] = 'core/drupal.password';


    $form['password'] = [
      '#type' => 'password',
      '#title' => '<span class="'.$label.'">'.$this->t('Password').'</span>',
      '#required' => TRUE,
      '#title_display' => 'before',
      '#attributes' => ['class' => [$input, 'password-field']],
    ];

    $form['confirm_password'] = [
      '#type' => 'password',
      '#title' => '<span class="'.$label.'">'.$this->t('Confirm Password').'</span>',
      '#required' => TRUE,
      '#title_display' => 'before',
      '#attributes' => ['class' => [$input, 'password-confirm']],
    ];

    $form['pw_meter'] = [
      '#markup' => '<div id="pw-meter"><div id="pw-meter-bar"></div></div><div id="pw-meter-label"></div>',
      '#weight' => 1,
    ];

    // Sign Up button
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Sign up'),
      '#attributes' => ['class' => ['lp-btn']],
    ];

    // Login link
    $form['login_link'] = [
      '#markup' => '<div class="lp-links">'.$this->t('Already have an account?').' <a href="/user/login">'.$this->t('Sign In').'</a></div>',
    ];


    return $form;
  }

  /**
   * Validate form input.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);

    // --- Username rules ---
    $username = trim((string) $form_state->getValue('name'));

    // Only letters, numbers, underscores; must start with a letter; 5–32 chars.
    if (!preg_match('/^[A-Za-z][A-Za-z0-9_]{4,31}$/', $username)) {
      $form_state->setErrorByName('name', $this->t(
        'Username must start with a letter, use only letters, numbers, or underscores, and be 5–32 characters long.'
      ));
      return;
    }

    // Uniqueness.
    $existing = \Drupal::entityTypeManager()
      ->getStorage('user')
      ->loadByProperties(['name' => $username]);
    if (!empty($existing)) {
      $form_state->setErrorByName('name', $this->t('That username is already taken. Please choose a different one.'));
    }

    // --- Email: format + uniqueness (strict) -------------------------------
    $email = strtolower(trim((string) $form_state->getValue('email')));

    // 1) Basic RFC check (Drupal service)
    if (!\Drupal::service('email.validator')->isValid($email)) {
      $form_state->setErrorByName('email', $this->t('Please enter a valid email address.'));
      return;
    }

    // 2) Stricter “has dot in domain and TLD >= 2 letters” rule
    if (!preg_match('/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/', $email)) {
      $form_state->setErrorByName('email', $this->t('Please enter a full email address with a valid domain (e.g. name@example.com).'));
      return;
    }
    
    // 3) Uniqueness: fail if an account already uses this email
    $existing_by_mail = \Drupal::entityTypeManager()
      ->getStorage('user')
      ->loadByProperties(['mail' => $email]);

    if (!empty($existing_by_mail)) {
      $form_state->setErrorByName('email', $this->t('An account already exists with this email address. Please use a different email.'));
      return;
    }
      

    // --- Password rules (server-side strength check) ---
    $password = (string) $form_state->getValue('password');
    $confirm  = (string) $form_state->getValue('confirm_password');

    if ($password !== $confirm) {
      $form_state->setErrorByName('confirm_password', $this->t('Passwords do not match.'));
    }

    // Strength: at least 8 chars, upper, lower, digit (tweak as you like).
    $strong = strlen($password) >= 8
      && preg_match('/[A-Z]/', $password)
      && preg_match('/[a-z]/', $password)
      && preg_match('/\d/',   $password);

    if (!$strong) {
      $form_state->setErrorByName('password', $this->t(
        'Password must be at least 8 characters and include upper and lower case letters and a number.'
      ));
    }
  }

  /**
   * Submit handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    // Username must be letters, numbers, underscores, start with a letter, len 5..32.
    $username = $form_state->getValue('name');
    if (!preg_match('/^[A-Za-z][A-Za-z0-9_]{4,31}$/', $username)) {
      $form_state->setErrorByName('name', $this->t('Username must start with a letter and contain only letters, numbers, and underscores (5–32 chars).'));
      return;
    }

    // Must be unique.
    $existing = \Drupal::entityTypeManager()->getStorage('user')->loadByProperties(['name' => $username]);
    if ($existing) {
      $form_state->setErrorByName('name', $this->t('That username is already taken. Please choose a different one.'));
    }


    $email = strtolower(trim((string) $form_state->getValue('email')));
    $password = $form_state->getValue('password');

    $user = User::create();
    $user->setUsername($username);
    $user->setEmail($email);
    $user->setPassword($password);
    $user->activate();
    $user->save();


    user_login_finalize($user);

    // Show a success message first before redirect.
    $this->messenger()->addStatus($this->t(
      'User %name has been registered successfully.',
      ['%name' => $username]
    ));

    //redirect
    $dest = \Drupal::request()->query->get('destination') ?: '/application-form';
    return $form_state->setRedirectUrl(Url::fromUserInput($dest));

  }

}