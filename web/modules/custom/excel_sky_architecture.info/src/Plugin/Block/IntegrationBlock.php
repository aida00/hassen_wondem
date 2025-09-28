<?php

namespace Drupal\excel_sky_architecture\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'Integration Architecture' Block.
 *
 * @Block(
 *   id = "integration_block",
 *   admin_label = @Translation("Integration Layer Block")
 * )
 */
class IntegrationBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '
        <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
          <h2 class="text-xl font-bold text-indigo-700">Integration Layer (APIs)</h2>
          <p class="text-gray-600 mt-2">
            Payment gateways (Stripe, PayPal), logistics APIs (DHL, FedEx),
            ERP synchronization, and healthcare compliance verification.
          </p>
        </div>
      ',
    ];
  }
}
