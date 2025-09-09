<?php

namespace Drupal\Tests\simple_sitemap_auth\Functional;

use Drupal\simple_sitemap\Queue\QueueWorker;
use Drupal\Tests\simple_sitemap\Functional\SimplesitemapTestBase;

/**
 * Tests Simple XML Sitemap functional integration.
 *
 * @group simple_sitemap_auth
 */
class SimplesitemapAuthTest extends SimplesitemapTestBase {

  /**
   * Modules to enable for this test.
   *
   * @var string[]
   */
  protected static $modules = [
    'simple_sitemap',
    'simple_sitemap_auth',
    'node',
    'node_view_permissions',
    'content_translation',
  ];

  /**
   * Auth user.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $user;

  /**
   * A node.
   *
   * @var \Drupal\node\NodeInterface
   */
  protected $node3;

  /**
   * The auth sitemap URL.
   *
   * @var string
   */
  protected $authSitemapUrl = 'auth_hreflang/sitemap.xml';

  /**
   * {@inheritdoc}
   */
  protected function setUp() : void {
    parent::setUp();

    // Normal user.
    $this->user = $this->drupalCreateUser([], NULL, FALSE);

    // Login as admin.
    $this->drupalLogin($this->privilegedUser);

    // Create second content type.
    $this->drupalCreateContentType(['type' => 'article']);

    // Set sitemap user.
    $this->drupalGet('/admin/config/search/simplesitemap/user');
    $this->submitForm([
      'user' => $this->user->id(),
    ], 'Save configuration');

    // Set auth variant as default.
    $this->drupalGet('/admin/config/search/simplesitemap/variants/add');
    $this->submitForm([
      'label' => 'auth_hreflang',
      'id' => 'auth_hreflang',
      'type' => 'auth_hreflang',
      'description' => 'auth_hreflang',
    ], 'Save');

    // Set nodetype sitemap index.
    $this->drupalGet('/admin/structure/types/manage/page');
    $this->submitForm([
      'simple_sitemap[default][index]' => 1,
      'simple_sitemap[auth_hreflang][index]' => 1,
    ], 'Save content type');

    $this->drupalGet('/admin/structure/types/manage/article');
    $this->submitForm([
      'simple_sitemap[auth_hreflang][index]' => 1,
    ], 'Save content type');

    // Set permissions.
    $this->drupalGet('/admin/people/permissions');
    $this->submitForm([
      'anonymous[view any page content]' => TRUE,
      'authenticated[view any article content]' => TRUE,
    ], 'Save permissions');
    $this->drupalGet('admin/reports/status/rebuild');
    $this->submitForm([], 'Rebuild permissions');

    // Create node.
    $this->node3 = $this->createNode(['title' => 'Node3', 'type' => 'article']);

    // Generate sitemaps.
    $this->generator->generate(QueueWorker::GENERATE_TYPE_BACKEND);
  }

  /**
   * Tests Auth Sitemap.
   */
  public function testSitemapAuth() {
    // Test default sitemap.
    $this->drupalGet($this->defaultSitemapUrl);
    $this->assertSession()->responseContains('node/' . $this->node->id());
    $this->assertSession()->responseContains('node/' . $this->node2->id());
    $this->assertSession()->responseNotContains('node/' . $this->node3->id());

    // Test auth sitemap.
    $this->drupalGet($this->authSitemapUrl);
    $this->assertSession()->responseContains('node/' . $this->node->id());
    $this->assertSession()->responseContains('node/' . $this->node2->id());
    $this->assertSession()->responseContains('node/' . $this->node3->id());
  }

}
