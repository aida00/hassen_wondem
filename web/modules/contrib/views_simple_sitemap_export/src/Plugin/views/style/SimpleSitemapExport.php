<?php

namespace Drupal\views_simple_sitemap_export\Plugin\views\style;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Form\FormStateInterface;
use Drupal\simple_sitemap\Entity\SimpleSitemap;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Drupal\views\Plugin\views\style\StylePluginBase;
use Drupal\views\ViewExecutable;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * SimpleSitemapExport style plugin.
 *
 * @ViewsStyle(
 *   id = "simple_sitemap_export",
 *   title = @Translation("Simple XML Sitemap Export"),
 *   help = @Translation("Returns results as data sets for indexing in a sitemap."),
 *   theme = "views_view_unformatted",
 *   register_theme = FALSE,
 *   display_types = {"simple_sitemap_export"}
 * )
 */
class SimpleSitemapExport extends StylePluginBase {

  /**
   * {@inheritdoc}
   */
  protected $usesRowPlugin = FALSE;

  /**
   * {@inheritdoc}
   */
  protected $usesFields = FALSE;

  /**
   * {@inheritdoc}
   */
  protected $usesGrouping = FALSE;

  /**
   * The sitemaps.
   *
   * @var \Drupal\simple_sitemap\Entity\SimpleSitemapInterface[]
   */
  protected $sitemaps = [];

  /**
   * Helper class for working with forms.
   *
   * @var \Drupal\simple_sitemap\Form\FormHelper
   */
  protected $formHelper;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = new static($configuration, $plugin_id, $plugin_definition);
    $instance->formHelper = $container->get('simple_sitemap.form_helper');
    $instance->sitemaps = static::getSitemaps();
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['variants'] = ['default' => []];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['variants'] = [
      '#type' => 'container',
      '#tree' => TRUE,
    ];

    foreach ($this->sitemaps as $variant => $sitemap) {
      $settings = $this->getSitemapSettings($variant);
      $variant_form = &$form['variants'][$variant];

      $variant_form = [
        '#type' => 'details',
        '#title' => '<em>' . $sitemap->label() . '</em>',
        '#open' => (bool) $settings['index'],
      ];

      $variant_form = $this->formHelper
        ->settingsForm($variant_form, $settings);

      $variant_form['index']['#title'] = $this->t('Index this display in sitemap <em>@variant_label</em>', ['@variant_label' => $sitemap->label()]);
      $variant_form['priority']['#description'] = $this->t('The priority this display will have in the eyes of search engine bots.');
      $variant_form['changefreq']['#description'] = $this->t('The frequency with which this display changes. Search engine bots may take this as an indication of how often to index it.');

      // Images are not supported.
      unset($variant_form['include_images']);

      $variant_form['arguments'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Contextual filters'),
        '#description' => $this->t('The contextual filters (arguments) to use for the export. Enter a single set of arguments per line, delimited by "/".'),
        '#default_value' => implode("\n", $settings['arguments']),
        '#access' => !empty($this->displayHandler->getHandlers('argument')),
      ];
    }

    $form['uses_fields']['#access'] = FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function submitOptionsForm(&$form, FormStateInterface $form_state) {
    $variants = $form_state->getValue(['style_options', 'variants']);
    $this->options['variants'] = [];

    // Save settings for each sitemap.
    foreach ($this->sitemaps as $variant => $sitemap) {
      $settings = $variants[$variant] + $this->getSitemapSettings($variant);

      if ($settings['index']) {
        $settings['arguments'] = array_values(array_filter(explode("\n", $settings['arguments'])));
        $settings['arguments'] = array_map('trim', $settings['arguments']);
        $this->options['variants'][$variant] = $settings;
      }
      $variants[$variant] = $settings;
    }
    $form_state->setValue(['style_options', 'variants'], $variants);
  }

  /**
   * Builds the view result as a PHP array of entities.
   *
   * For preview, just output an item_list.
   *
   * @return array
   *   Renderable array or array of entities.
   */
  public function render() {
    $entities = array_map(function ($row) {
      return $row->_entity;
    }, $this->view->result);

    if (!empty($this->view->live_preview)) {
      $items = array_map(function ($entity) {
        return $entity->hasLinkTemplate('canonical') ?
          $entity->toUrl()->setAbsolute()->toString() :
          '';
      }, $entities);

      return [
        '#theme' => 'item_list',
        '#items' => $items,
      ];
    }

    return $entities;
  }

  /**
   * {@inheritdoc}
   */
  public function evenEmpty() {
    return FALSE;
  }

  /**
   * Returns an array of correctly configured sitemaps.
   *
   * @return \Drupal\simple_sitemap\Entity\SimpleSitemapInterface[]
   *   An array of sitemap entities.
   */
  private static function getSitemaps(): array {
    $sitemaps = SimpleSitemap::loadMultiple();

    /** @var \Drupal\simple_sitemap\Entity\SimpleSitemapInterface $sitemap */
    foreach ($sitemaps as $variant => $sitemap) {
      if (!$sitemap->getType()->hasUrlGenerator('view_results')) {
        unset($sitemaps[$variant]);
      }
    }

    return $sitemaps;
  }

  /**
   * Gets the sitemap settings.
   *
   * @param string $variant
   *   The ID of the sitemap.
   *
   * @return array
   *   The sitemap settings.
   */
  public function getSitemapSettings(string $variant): array {
    $settings = [
      'index' => FALSE,
      'priority' => 0.5,
      'changefreq' => '',
      'arguments' => [],
    ];

    if (isset($this->options['variants'][$variant])) {
      $settings = $this->options['variants'][$variant] + $settings;
    }

    return $settings;
  }

}
