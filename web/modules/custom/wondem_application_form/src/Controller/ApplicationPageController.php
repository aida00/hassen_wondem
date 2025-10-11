<?php

namespace Drupal\wondem_application_form\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ApplicationPageController extends ControllerBase {

  public function page() {
    $account = $this->currentUser();

    if ($account->isAnonymous()) {
      $login = Url::fromRoute('user.login', [], [
        'query' => ['destination' => '/application-form'],
      ])->toString();

      return new RedirectResponse($login);
    }

    // Authenticated: render the form.
    return $this->formBuilder()->getForm('\Drupal\wondem_application_form\Form\ApplicationForm');
  }
}
