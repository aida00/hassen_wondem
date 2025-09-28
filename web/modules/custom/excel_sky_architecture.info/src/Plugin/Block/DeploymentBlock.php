<?php

namespace Drupal\excel_sky_architecture\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Deployment Architecture' Block.
 *
 * @Block(
 *   id = "deployment_block",
 *   admin_label = @Translation("Deployment & Infrastructure Block")
 * )
 */
class DeploymentBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '
        <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
          <h2 class="text-xl font-bold text-orange-700">Deployment & Infrastructure</h2>
          <p class="text-gray-600 mt-2">
            Cloud hosting (AWS, Azure, GCP), containerization (Docker, Kubernetes),
            CI/CD pipelines, load balancing, and automated backups.
          </p>
        </div>
      ',
    ];
  }
}
