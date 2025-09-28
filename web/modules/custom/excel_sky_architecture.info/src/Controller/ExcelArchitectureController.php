<?php

namespace Drupal\excel_sky_architecture\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns the Excel Sky Architecture page.
 */
class ExcelArchitectureController extends ControllerBase {

  /**
   * Build the architecture page render array.
   */
  public function build() {
    return [
      '#theme' => 'page__excel_architecture',
      '#title' => $this->t('Excel Sky Architecture'),
    ];
  }

}
