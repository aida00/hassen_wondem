<?php

namespace Drupal\registration\Controller;

use Drupal\Core\Controller\ControllerBase;

class RegistrationPageController extends ControllerBase {

  public function content() {
    return [
      '#theme' => 'registration_page',
      '#attached' => [
        'library' => [
          'registration/registration-styles',
        ],
      ],
    ];
  }

}
