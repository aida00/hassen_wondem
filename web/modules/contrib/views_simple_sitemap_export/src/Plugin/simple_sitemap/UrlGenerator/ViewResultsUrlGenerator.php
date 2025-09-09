<?php

namespace Drupal\views_simple_sitemap_export\Plugin\simple_sitemap\UrlGenerator;

use Drupal\simple_sitemap\Plugin\simple_sitemap\UrlGenerator\EntityUrlGenerator;
use Drupal\views\Views;

/**
 * View results URL generator plugin.
 *
 * @UrlGenerator(
 *   id = "view_results",
 *   label = @Translation("View results URL generator"),
 *   description = @Translation("Generates URLs from a View display."),
 * )
 */
class ViewResultsUrlGenerator extends EntityUrlGenerator {

  /**
   * {@inheritdoc}
   */
  public function getDataSets(): array {
    $data_sets = [];

    $view_display_pairs = Views::getApplicableViews('simple_sitemap_export');
    $view_ids = array_column($view_display_pairs, 0);
    $views = $this->entityTypeManager->getStorage('view')->loadMultiple($view_ids);

    // A single display may produce multiple arg sets, which requires unwinding
    // with 2 nested loops. We just flatten params here, to get the main logic
    // in a straightforward loop.
    $flat_params = [];
    foreach ($view_display_pairs as [$view_id, $display_id]) {
      $view_executable = $views[$view_id]->getExecutable();
      if (!$view_executable->setDisplay($display_id)) {
        continue;
      }

      if (($settings = $view_executable->getStyle()->getSitemapSettings($this->sitemap->id())) &&
          !empty($settings['index'])) {

        $args_to_process = array_map(function ($args_row) {
          return explode('/', $args_row);
        }, $settings['arguments']) ?: [[]];

        foreach ($args_to_process as $arg_set) {
          $data_set_settings = array_intersect_key(
            $settings, array_flip([
              'priority',
              'changefreq',
            ])
          );
          $flat_params[] = [
            $view_id,
            $display_id,
            $arg_set,
            $data_set_settings,
          ];
        }
      }

      $view_executable->destroy();
    }

    foreach ($flat_params as [$view_id, $display_id, $arg_set, $settings]) {
      $view_executable = $views[$view_id]->getExecutable();
      // We already know this display is safe to set.
      $view_executable->setDisplay($display_id);

      // Manually build the query, to circumvent ::execute(), which loads *all*
      // entities.
      $view_executable->preExecute($arg_set);
      $view_executable->build();
      $query = $view_executable->query->query();
      $query->addMetaData('view', $view_executable);
      $query->preExecute();
      // 'some' pager seems to only set the query range via ::execute(). Do it
      // manually here.
      $query->range($view_executable->pager->getOffset(), $view_executable->pager->getItemsPerPage());

      $entity_type_id_field = $view_executable->getBaseEntityType()->getKeys()['id'];
      $entity_ids = array_keys($query->execute()->fetchAllAssoc($entity_type_id_field));

      $entity_type_id = $view_executable->getBaseEntityType()->id();
      $new_data_sets = array_map(function ($ids_chunk) use ($entity_type_id, $settings) {
        return [
          'entity_type' => $entity_type_id,
          'id' => $ids_chunk,
          'settings' => $settings,
        ];
      }, array_chunk($entity_ids, $this->entitiesPerDataset));

      $data_sets = array_merge($data_sets, $new_data_sets);

      $view_executable->destroy();
    }

    return $data_sets;
  }

  /**
   * {@inheritdoc}
   */
  protected function processDataSet($data_set): array {
    foreach ($this->entityTypeManager->getStorage($data_set['entity_type'])->loadMultiple((array) $data_set['id']) as $entity) {
      try {
        $settings = $data_set['settings'];
        $url_object = $entity->toUrl()->setAbsolute();

        // Do not include external paths.
        if (!$url_object->isRouted()) {
          throw new SkipElementException();
        }

        $paths[] = [
          'url' => $url_object,
          'lastmod' => method_exists($entity, 'getChangedTime')
          ? date('c', $entity->getChangedTime())
          : NULL,
          'priority' => $settings['priority'] ?? NULL,
          'changefreq' => !empty($settings['changefreq']) ? $settings['changefreq'] : NULL,
          'images' => !empty($settings['include_images'])
          ? $this->getEntityImageData($entity)
          : [],

            // Additional info useful in hooks.
          'meta' => [
            'path' => $url_object->getInternalPath(),
            'entity_info' => [
              'entity_type' => $entity->getEntityTypeId(),
              'id' => $entity->id(),
            ],
          ],
        ];
      }
      catch (SkipElementException $e) {
        continue;
      }
    }

    return $paths ?? [];
  }

}
