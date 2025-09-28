<?php

namespace Drupal\excel_sky_architecture\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Backend Architecture' Block.
 *
 * @Block(
 *   id = "backend_block",
 *   admin_label = @Translation("Backend (Server-Side) Block")
 * )
 */
class BackendBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '
        <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
          <h2 class="text-xl font-bold text-green-700">Backend (Server-Side)</h2>
          <p class="text-gray-600 mt-2">
            Technologies: Node.js, Django, Spring Boot, .NET Core.
            Features: Inventory management, order tracking, user roles,
            regulatory compliance, secure API layer.
          </p>
        </div>
      ',
    ];
  }
}
