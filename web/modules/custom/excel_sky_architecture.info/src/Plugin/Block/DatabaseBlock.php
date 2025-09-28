<?php

namespace Drupal\excel_sky_architecture\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Database Architecture' Block.
 *
 * @Block(
 *   id = "database_block",
 *   admin_label = @Translation("Database Layer Block")
 * )
 */
class DatabaseBlock extends BlockBase {
  public function build() {
    return [
      '#markup' => '
        <div class="p-6 bg-white rounded-2xl shadow-md hover:shadow-lg transition">
          <h2 class="text-xl font-bold text-purple-700">Database Layer</h2>
          <p class="text-gray-600 mt-2">
            PostgreSQL/MySQL for structured data and MongoDB for metadata.
            Core Entities: Users, Products, Orders, Suppliers.
          </p>
        </div>
      ',
    ];
  }
}
