<?php

namespace Drupal\excel_sky_architecture\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an 'Analytics Architecture' Block.
 *
 * @Block(
 *   id = "analytics_block",
 *   admin_label = @Translation("Analytics & Monitoring Block")
 * )
 */
class AnalyticsBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '
        <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
          <h2 class="text-xl font-bold text-teal-700">Analytics & Monitoring</h2>
          <p class="text-gray-600 mt-2">
            Customer behavior insights, inventory alerts, system monitoring with
            Prometheus + Grafana, and sales performance dashboards.
          </p>
        </div>
      ',
    ];
  }
}
