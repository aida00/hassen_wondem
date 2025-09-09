<?php

namespace Drupal\views_simple_sitemap_export\Plugin\views\display;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\display\DisplayPluginBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * The plugin that handles a Simple XML Sitemap export.
 *
 * @ViewsDisplay(
 *   id = "simple_sitemap_export",
 *   title = @Translation("Simple XML Sitemap Export"),
 *   short_title = @Translation("Sitemap Export"),
 *   admin = @Translation("Simple XML Sitemap Export"),
 *   help = @Translation("Exports views results to one or more sitemaps."),
 *   base = { "node_field_data", "taxonomy_term_field_data" },
 *   uses_menu_links = FALSE,
 *   theme = "views_view",
 *   returns_response = FALSE,
 *   register_theme = FALSE,
 *   simple_sitemap_export = TRUE,
 * )
 */
class SimpleSitemapExport extends DisplayPluginBase {

  /**
   * {@inheritdoc}
   */
  protected $usesAJAX = FALSE;

  /**
   * {@inheritdoc}
   */
  protected $usesMore = FALSE;

  /**
   * {@inheritdoc}
   */
  protected $usesAreas = FALSE;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Creates a SimpleSitemapExport instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    EntityTypeManagerInterface $entity_type_manager
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    // Force the style plugin to 'simple_sitemap_export' disable selection for
    // a row plugin.
    $options['style']['contains']['type'] = ['default' => 'simple_sitemap_export'];
    $options['defaults']['default']['style'] = FALSE;
    $options['defaults']['default']['row'] = FALSE;

    $options['defaults']['default']['pager'] = FALSE;
    $options['pager']['contains']['type']['default'] = 'some';

    // Set the display title to an empty string (not used in this display type).
    $options['title']['default'] = '';
    $options['defaults']['default']['title'] = FALSE;

    $options['defaults']['default']['link_display'] = FALSE;
    $options['defaults']['default']['link_url'] = FALSE;

    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $section = $form_state->get('section');
    switch ($section) {
      case 'style':
        // Force setting an overridden style, always.
        $form['override']['#access'] = FALSE;
        $form['override']['dropdown']['#default_value'] = $this->display['id'];
        break;

      case 'pager':
        // Only allow 'some' pager type; update 'export' wording for UI.
        $form['pager']['type']['#options'] = array_intersect_key($form['pager']['type']['#options'], array_flip(['some']));
        $form['pager']['type']['#options']['some'] = $this->t('Export a specified number of items');
        break;

      case 'pager_options':
        // Use 'export' wording for UI.
        $form['pager_options']['offset']['#description'] = $this->t('For example, set this to 3 and the first 3 items will not be exported.');
        break;
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function optionsSummary(&$categories, &$options) {
    parent::optionsSummary($categories, $options);

    // Use 'export' wording for UI.
    $options['pager']['title'] = $this->t('Items to export');
    $options['pager']['value'] = $this->t('Export a specified number of items');

    unset($categories['exposed']);
    unset($options['exposed_form']);
    unset($options['css_class']);
  }

  /**
   * {@inheritdoc}
   */
  public function getType() {
    return 'simple_sitemap_export';
  }

  /**
   * {@inheritdoc}
   */
  public function usesExposed() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function displaysExposed() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function usesExposedFormInBlock() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function acceptAttachments() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function usesLinkDisplay() {
    return FALSE;
  }

}
