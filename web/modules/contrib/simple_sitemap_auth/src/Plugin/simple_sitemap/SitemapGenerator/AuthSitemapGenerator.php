<?php

namespace Drupal\simple_sitemap_auth\Plugin\simple_sitemap\SitemapGenerator;

use Drupal\simple_sitemap\Plugin\simple_sitemap\SitemapGenerator\DefaultSitemapGenerator;

/**
 * SitemapGenerator for Auth.
 *
 * @package Drupal\simple_sitemap_auth\Plugin\simple_sitemap\SitemapGenerator
 *
 * @SitemapGenerator(
 *   id = "auth",
 *   label = @Translation("Auth sitemap generator"),
 *   description = @Translation("Generates a standard conform hreflang sitemap of your content of an authenticated user."),
 * )
 */
class AuthSitemapGenerator extends DefaultSitemapGenerator {

}
