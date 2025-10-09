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

    $form['#attached']['library'][] = 'registration/registration-styles';

    // Light card container
    $form['#prefix'] = '<div class="min-h-[calc(100vh-140px)] flex items-center justify-center bg-slate-50">
      <div class="w-[420px] max-w-[calc(100vw-2rem)] bg-white border border-slate-200 rounded-xl shadow-lg p-6">';
    $form['#suffix'] = '</div></div>';

    // Form title
    $form['title'] = [
      '#markup' => '<h2 class="text-xl font-bold text-slate-900 text-center mb-4">'.$this->t('Create Account').'</h2>',
    ];

    $label = 'text-[13px] text-slate-700 mb-1 block';
    $input = 'w-full px-3 py-2 rounded-lg border border-slate-300 text-[14px] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500';



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
      '#value' => $this->t('SIGN UP'),
      '#attributes' => ['class' => ['w-full mt-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg']],
    ];

    // Login link
    $form['login_link'] = [
      '#markup' => '<div class="text-center mt-3 text-[13px] text-slate-600">'.$this->t('Already have an account?').' <a href="/user/login" class="text-blue-600 hover:underline">'.$this->t('Sign In').'</a></div>',
    ];

    // Attach Tailwind CSS
    $form['#attached']['library'][] = 'registration/registration-styles';

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

    // --- Email: format + uniqueness -----------------------------------------
    $email = trim((string) $form_state->getValue('email'));

    // 1) Basic format
    if (!\Drupal::service('email.validator')->isValid($email)) {
      $form_state->setErrorByName('email', $this->t('Please enter a valid email address.'));
      return;
    }

    // 2) Uniqueness: fail if an account already uses this email
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


    $email = $form_state->getValue('email');
    $password = $form_state->getValue('password');

    $user = User::create();
    $user->setUsername($username);
    $user->setEmail($email);
    $user->setPassword($password);
    $user->activate();
    $user->save();


    user_login_finalize($user);
    $form_state->setRedirectUrl(\Drupal\Core\Url::fromUserInput('/application-form'));



    user_login_finalize($user);
    $dest = \Drupal::request()->query->get('destination') ?: '/application-form';
    return $form_state->setRedirectUrl(Url::fromUserInput($dest));


    $this->messenger()->addMessage($this->t(
      'User %name has been registered successfully.',
      ['%name' => $username]
    ));
  }

}