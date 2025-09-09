<?php

namespace Drupal\simple_sitemap_auth\Plugin\simple_sitemap\UrlGenerator;

use Drupal\simple_sitemap\Entity\EntityHelper;
use Drupal\simple_sitemap\Logger;
use Drupal\simple_sitemap\Manager\EntityManager;
use Drupal\simple_sitemap\Plugin\simple_sitemap\UrlGenerator\EntityUrlGenerator;
use Drupal\simple_sitemap\Plugin\simple_sitemap\UrlGenerator\UrlGeneratorManager;
use Drupal\simple_sitemap\Settings;
use Drupal\Core\Cache\MemoryCache\MemoryCacheInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\user\Entity\User;

/**
 * EntityUrlGenerator for Auth.
 *
 * @package Drupal\simple_sitemap_auth\Plugin\simple_sitemap\UrlGenerator
 *
 * @UrlGenerator(
 *   id = "auth_entity",
 *   label = @Translation("Auth Entity URL generator"),
 *   description = @Translation("Generates URLs for entity bundles and bundle overrides of an authenticated user."),
 * )
 */
class AuthEntityUrlGenerator extends EntityUrlGenerator {

  /**
   * EntityUrlGenerator constructor.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\simple_sitemap\Logger $logger
   *   Simple XML Sitemap logger.
   * @param \Drupal\simple_sitemap\Settings $settings
   *   The simple_sitemap.settings service.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\simple_sitemap\Entity\EntityHelper $entity_helper
   *   Helper class for working with entities.
   * @param \Drupal\simple_sitemap\Manager\EntityManager $entities_manager
   *   The simple_sitemap.entity_manager service.
   * @param \Drupal\simple_sitemap\Plugin\simple_sitemap\UrlGenerator\UrlGeneratorManager $url_generator_manager
   *   The UrlGenerator plugins manager.
   * @param \Drupal\Core\Cache\MemoryCache\MemoryCacheInterface $memory_cache
   *   The memory cache.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    Logger $logger,
    Settings $settings,
    LanguageManagerInterface $language_manager,
    EntityTypeManagerInterface $entity_type_manager,
    EntityHelper $entity_helper,
    EntityManager $entities_manager,
    UrlGeneratorManager $url_generator_manager,
    MemoryCacheInterface $memory_cache
  ) {
    parent::__construct(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $logger,
      $settings,
      $language_manager,
      $entity_type_manager,
      $entity_helper,
      $entities_manager,
      $url_generator_manager,
      $memory_cache
    );
    $this->anonUser = $this->getUser();
  }

  /**
   * Set user access for generated links.
   *
   * @return \Drupal\Core\Session\AccountInterface|null
   *   User object.
   */
  protected function getUser() {
    $user = $this->anonUser;
    $config = \Drupal::config('simple_sitemap_auth.settings');
    if ($config->get("user") && User::load($config->get("user"))) {
      $user = User::load($config->get("user"));
    }
    return $user;
  }

}
