<?php

namespace Drupal\registration\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Routing\TrustedRedirectResponse;

class RegistrationPageController extends ControllerBase {

  public function register() {
    // If the user is already logged in, honor ?destination=… or default.
    if ($this->currentUser()->isAuthenticated()) {
      $destination = \Drupal::request()->query->get('destination') ?: '/application-form';
      $url = Url::fromUserInput($destination);
      return new TrustedRedirectResponse($url->toString());
    }

    // Otherwise render your custom registration form.
    return \Drupal::formBuilder()->getForm(\Drupal\registration\Form\RegistrationForm::class);
  }
}
