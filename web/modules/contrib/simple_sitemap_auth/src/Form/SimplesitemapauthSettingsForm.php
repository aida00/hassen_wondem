<?php

namespace Drupal\simple_sitemap_auth\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Form\FormStateInterface;
use Drupal\simple_sitemap\Manager\Generator;
use Drupal\simple_sitemap\Form\FormHelper;
use Drupal\simple_sitemap\Form\SimpleSitemapFormBase;
use Drupal\simple_sitemap\Settings;

/**
 * SimplesitemapForm for Auth.
 *
 * @package Drupal\simple_sitemap_auth\Form
 */
class SimplesitemapauthSettingsForm extends SimpleSitemapFormBase {

  /**
   * The variable containing the user manager.
   *
   * @var \Drupal\user\UserStorage
   */
  protected $userManager;

  /**
   * CustomLinksForm constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory service.
   * @param \Drupal\simple_sitemap\Manager\Generator $generator
   *   The sitemap generator service.
   * @param \Drupal\simple_sitemap\Settings $settings
   *   The simple_sitemap.settings service.
   * @param \Drupal\simple_sitemap\Form\FormHelper $form_helper
   *   Simple XML Sitemap form helper.
   * @param \Drupal\Core\Entity\EntityTypeManager $entityTypeManager
   *   Entity type manager.
   */
  public function __construct(
    ConfigFactoryInterface $config_factory,
    Generator $generator,
    Settings $settings,
    FormHelper $form_helper,
    EntityTypeManager $entityTypeManager
  ) {
    parent::__construct(
      $config_factory,
      $generator,
      $settings,
      $form_helper
    );
    $this->userManager = $entityTypeManager->getStorage('user');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('simple_sitemap.generator'),
      $container->get('simple_sitemap.settings'),
      $container->get('simple_sitemap.form_helper'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'simple_sitemap_auth_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() : array {
    return ['config.simple_sitemap_auth'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('simple_sitemap_auth.settings');
    $form['simple_sitemap_settings']['user'] = [
      '#type' => 'select',
      '#title' => $this->t('User'),
      '#description' => $this->t('The user whose permissions are used for crawling. Anonymous user (default) and all users except users with administrator role.'),
      '#default_value' => $config->get('user'),
      '#required' => TRUE,
      '#options' => $this->userList(),
    ];

    $this->formHelper->regenerateNowForm($form['simple_sitemap_settings']);

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->configFactory()->getEditable('simple_sitemap_auth.settings');
    $config->set('user', $form_state->getValue('user'));
    $config->save();

    parent::submitForm($form, $form_state);

    // Regenerate sitemaps according to user setting.
    if ($form_state->getValue('simple_sitemap_regenerate_now')) {
      $this->generator->setVariants(TRUE)
        ->rebuildQueue()
        ->generate();
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function userList() {
    $filtered_users = [];
    $user_query = $this->userManager->getQuery();

    // Users with explicit roles set except administrators.
    $role_user = $user_query
      ->andConditionGroup()
      ->exists('roles')
      ->condition('status', 1)
      ->condition('roles', 'administrator', '<>');

    // Users with simple authenticated role.
    $auth_user = $user_query
      ->andConditionGroup()
      ->notExists('roles')
      ->condition('status', 1);

    // All groups above and anonymous user.
    $user_group = $user_query
      ->orConditionGroup()
      ->condition('uid', 0)
      ->condition($auth_user)
      ->condition($role_user);
    $ids = $user_query
      ->condition($user_group)
      ->accessCheck(TRUE)
      ->execute();
    $all_users = $this->userManager->loadMultiple($ids);
    /** @var \Drupal\Core\Session\AccountInterface $value */
    foreach ($all_users as $key => $value) {
      $filtered_users[$key] = $value->getDisplayName();
    }
    return $filtered_users;
  }

}
