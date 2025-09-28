<?php

namespace Drupal\excel_sky_architecture\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Frontend Architecture' Block.
 *
 * @Block(
 *   id = "frontend_block",
 *   admin_label = @Translation("Frontend (Client-Side) Block")
 * )
 */
class FrontendBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '
        <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
          <h2 class="text-xl font-bold text-blue-700">Frontend (Client-Side)</h2>
          <p class="text-gray-600 mt-2">
            Built with React, Vue, or Angular. Features: Product catalog, filters, real-time inventory,
            responsive design, WCAG accessibility, secure checkout system.
          </p>
        </div>
      ',
    ];
  }
}
