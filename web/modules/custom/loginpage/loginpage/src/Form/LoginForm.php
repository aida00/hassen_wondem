<?php

namespace Drupal\loginpage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;
use Drupal\Core\Url;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\user\UserAuthInterface;

class LoginForm extends FormBase {

  protected $userAuth;

  public function __construct(UserAuthInterface $user_auth) {
    $this->userAuth = $user_auth;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('user.auth')
    );
  }

  public function getFormId() {
    return 'loginpage_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    //CSS Library
    $form['#attached']['library'][] = 'loginpage/auth';
    
    // Wrap form in a centered dark box
    $form['#prefix'] = '<div class="lp-wrap"><div class="lp-card">';
    $form['#suffix'] = '</div></div>';

    // Heading
    $form['heading'] = ['#markup' => '<div class="lp-title">'.$this->t('Log in').'</div>'];

    // Username / Email
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => '<span class="lp-label">'.$this->t('Username').'</span>',
      '#required' => TRUE,
      '#title_display' => 'before',
      '#attributes' => ['class' => ['lp-input'], 'placeholder' => $this->t('Enter username')],
    ];

    // Password
    $form['pass'] = [
      '#type' => 'password',
      '#title' => '<span class="lp-label">'.$this->t('Password').'</span>',
      '#required' => TRUE,
      '#title_display' => 'before',
      '#attributes' => ['class' => ['lp-input'], 'placeholder' => $this->t('Enter your password')],
    ];

    // Submit button
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Log in'),
      '#attributes' => ['class' => ['lp-btn']],
    ];

    // Optional links
    $form['links'] = [
      '#markup' => '<div class="lp-links">'.$this->t('No account yet?').' <a href="/user/register">'.$this->t('Register').'</a></div>',
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $username = $form_state->getValue('name');
    $password = $form_state->getValue('pass');

    // Authenticate user
    $uid = $this->userAuth->authenticate($username, $password);

    if ($uid) {
      $user = User::load($uid);
      user_login_finalize($user);

      $this->messenger()->addStatus($this->t('Login successful! Welcome @name.', ['@name' => $user->getAccountName()]));

    $request = \Drupal::request();
    $destination = $request->query->get('destination');
    $url = Url::fromRoute('<front>'); // fallback
    if ($destination && \Drupal::service('path.validator')->isValid($destination)) {
      // fromUserInput ensures it’s treated as internal and sanitized
      $url = Url::fromUserInput($destination);
    }

      $form_state->setResponse(new TrustedRedirectResponse(Url::fromRoute('<front>')->toString()));
    }
    else {
      $this->messenger()->addError($this->t('Invalid username or password.'));
    }
  }
}