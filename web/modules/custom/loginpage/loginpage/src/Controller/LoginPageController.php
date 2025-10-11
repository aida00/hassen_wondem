<?php

namespace Drupal\loginpage\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Routing\TrustedRedirectResponse;

class LoginPageController extends ControllerBase {

  public function login() {
    // If already logged in, go to the application form (or honor ?destination)
    $account = $this->currentUser();
    if ($account->isAuthenticated()) {
      $destination = \Drupal::request()->query->get('destination') ?: '/application-form';
      $url = Url::fromUserInput($destination);
      return new TrustedRedirectResponse($url->toString());
    }

    // Not logged in: render your custom login form
    return \Drupal::formBuilder()->getForm(\Drupal\loginpage\Form\LoginForm::class);
  }
}
