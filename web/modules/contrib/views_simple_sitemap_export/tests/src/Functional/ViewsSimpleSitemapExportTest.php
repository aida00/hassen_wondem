<?php

namespace Drupal\Tests\views_simple_sitemap_export\Functional;

use Drupal\simple_sitemap\Entity\SimpleSitemapType;
use Drupal\views\Views;
use Drupal\Tests\BrowserTestBase;

/**
 * Tests for the views_simple_sitemap_export module.
 *
 * @group views_simple_sitemap_export
 */
class ViewsSimpleSitemapExportTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'node',
    'views_simple_sitemap_export_test',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * The cron service.
   *
   * @var \Drupal\Core\CronInterface
   */
  protected $cron;

  /**
   * Simple sitemap generator.
   *
   * @var \Drupal\simple_sitemap\Manager\Generator
   */
  protected $generator;

  /**
   * A node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $node;

  /**
   * A node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $node2;

  /**
   * Test view.
   *
   * @var \Drupal\views\ViewExecutable
   */
  protected $testView;

  /**
   * The sitemap variant.
   *
   * @var string
   */
  protected $sitemapVariant;

  /**
   * The default sitemap URL.
   *
   * @var string
   */
  protected $defaultSitemapUrl = 'sitemap.xml';

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->generator = $this->container->get('simple_sitemap.generator');

    $this->drupalCreateContentType(['type' => 'page']);
    $this->drupalCreateContentType(['type' => 'post']);
    $this->drupalCreateContentType(['type' => 'event']);
    $this->node = $this->createNode(['title' => 'Node', 'type' => 'page']);
    $this->node2 = $this->createNode(['title' => 'Node2', 'type' => 'post']);
    $this->node3 = $this->createNode(['title' => 'Node3', 'type' => 'event']);

    $this->cron = $this->container->get('cron');
    $this->sitemapVariant = 'default';

    $sitemap_type = SimpleSitemapType::load('default_hreflang');
    $sitemap_type->set('url_generators', array_merge($sitemap_type->get('url_generators'), ['view_results']))->save();

    //$this->testView = Views::getView('views_simple_sitemap_export_test');
    //$this->testView->setDisplay('sitemap_export_page');
  }

  /**
   * Helper: sets the status for a display.
   */
  protected function setDisplayStatus($display_id, $enabled = TRUE) {
    $view_executable = Views::getView('views_simple_sitemap_export_test');
    $view_executable->setDisplay($display_id);
    $view_executable->display_handler->setOption('enabled', $enabled);
    $view_executable->save();
  }

  /**
   * Tests the process of generating view display URLs.
   */
  public function testViewResultsUrlGenerator() {
    $this->assertArrayHasKey('view_results', SimpleSitemapType::load('default_hreflang')->getUrlGenerators());

    $this->generator->generate('backend');

    $node_url = $this->node->toUrl()->setAbsolute()->toString();
    $node2_url = $this->node2->toUrl()->setAbsolute()->toString();
    $node3_url = $this->node3->toUrl()->setAbsolute()->toString();

    // Check that the sitemap contains only 'page' nodes.
    $this->drupalGet($this->defaultSitemapUrl);
    $this->assertSession()->responseContains($node_url);
    $this->assertSession()->responseNotContains($node2_url);
    $this->assertSession()->responseNotContains($node3_url);

    // Enable the display for 'post' nodes, to get those nodes exported.
    $this->setDisplayStatus('sitemap_export_post', TRUE);

    $this->generator->generate('backend');

    // Check that the sitemap contains both 'page' and 'post' nodes.
    $this->drupalGet($this->defaultSitemapUrl);
    $this->assertSession()->responseContains($node_url);
    $this->assertSession()->responseContains($node2_url);
    $this->assertSession()->responseNotContains($node3_url);

    // Only leave the args-driven display enabled.
    // Enable the display for 'post' nodes, to get those nodes exported.
    $this->setDisplayStatus('sitemap_export_page', FALSE);
    $this->setDisplayStatus('sitemap_export_post', FALSE);
    $this->setDisplayStatus('sitemap_export_args', TRUE);

    $this->generator->generate('backend');

    // Check that the sitemap contains only 'post' and 'event' nodes.
    $this->drupalGet($this->defaultSitemapUrl);
    $this->assertSession()->responseNotContains($node_url);
    $this->assertSession()->responseContains($node2_url);
    $this->assertSession()->responseContains($node3_url);
  }

}
