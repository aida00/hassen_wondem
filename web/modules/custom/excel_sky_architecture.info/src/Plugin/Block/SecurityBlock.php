<?php

namespace Drupal\excel_sky_architecture\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Security Architecture' Block.
 *
 * @Block(
 *   id = "security_block",
 *   admin_label = @Translation("Security Layer Block")
 * )
 */
class SecurityBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '
        <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
          <h2 class="text-xl font-bold text-red-700">Security Layer</h2>
          <p class="text-gray-600 mt-2">
            SSL/TLS encryption, role-based access control, PCI DSS compliance,
            two-factor authentication, and audit logging.
          </p>
        </div>
      ',
    ];
  }
}
