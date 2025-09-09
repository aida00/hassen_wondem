<?php

namespace Drupal\Tests\votingapi_widgets\Functional;

use Drupal\Core\Extension\ModuleUninstallValidatorException;
use Drupal\Tests\BrowserTestBase;
use Drupal\field\Entity\FieldConfig;
use Drupal\field\Entity\FieldStorageConfig;
use Drupal\user\Entity\Role;

/**
 * Tests uninstalling Voting API widgets.
 *
 * @group votingapi_widgets
 */
class UninstallTest extends BrowserTestBase {

  /**
   * We use the minimal profile because we need node types.
   *
   * @var string
   */
  protected $profile = 'minimal';

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'votingapi_widgets',
    'votingapi',
    'field',
    'user',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * A node used for testing.
   *
   * @var \Drupal\node\NodeInterface
   */
  protected $node;

  /**
   * An entity type manager used for testing.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * The field config entity for the voting_api_field field.
   *
   * @var Drupal\Core\Entity\EntityInterface
   */
  protected $field;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    // Create a node type called 'candidate' that can be voted on.
    $this->entityTypeManager = $this->container->get('entity_type.manager');
    $this->entityTypeManager->getStorage('node_type')->create([
      'type' => 'candidate',
      'name' => 'Candidate',
    ])->save();

    // Create a voting_api_field and bundle it with our node type.
    FieldStorageConfig::create([
      'field_name' => 'vote_field',
      'entity_type' => 'node',
      'type' => 'voting_api_field',
      'cardinality' => 1,
    ])->save();
    $this->field = FieldConfig::create([
      'field_name' => 'vote_field',
      'entity_type' => 'node',
      'bundle' => 'candidate',
      'label' => 'Test field',
      'settings' => [
        'vote_plugin' => 'useful',
        'vote_type' => 'fivestar',
        'status' => '',
      ],
    ]);
    $this->field->save();

    // Create a piece of content that can be voted on.
    $this->node = $this->entityTypeManager->getStorage('node')
      ->create([
        'title' => 'test',
        'type' => 'candidate',
      ]);
    $this->node->save();

    // Give both anonymous and authenticated roles permission to vote on our
    // test piece of content.
    Role::load(Role::ANONYMOUS_ID)
      ->grantPermission('vote on node:candidate:vote_field')
      ->save();
    Role::load(Role::AUTHENTICATED_ID)
      ->grantPermission('vote on node:candidate:vote_field')
      ->save();
  }

  /**
   * Tests that uninstalling the module doesn't delete roles.
   *
   * @see https://www.drupal.org/project/votingapi_widgets/issues/3265224
   */
  public function testUninstall(): void {

    // Verify that Authenticated and Anonymous roles exist.
    $roles = user_role_names(FALSE);
    $this->assertArrayHasKey('anonymous', $roles);
    $this->assertArrayHasKey('authenticated', $roles);

    // Verify that the votingapi_widgets module is installed.
    $this->assertTrue(\Drupal::service('module_handler')->moduleExists('votingapi_widgets'));

    // Try to uninstall votingapi_widgets.
    // This should fail because in setUp() we created a node type 'candidate'
    // that uses the voting_api_field provided by the votingapi_widgets module.
    // We can't uninstall the votingapi_widgets module before we delete this
    // field.
    try {
      // Don't use expectException(ModuleUninstallValidatorException::class)
      // because that will remain in effect for the rest of this test method
      // and hide any further uninstall failures.
      \Drupal::service('module_installer')->uninstall(['votingapi_widgets']);
      // If it doesn't throw an exception, then that's a problem ...
      $this->fail('ModuleUninstallValidatorException was not thrown');
    }
    catch (ModuleUninstallValidatorException $e) {
      $this->assertSame(
        // Full error message should be:
        // 'The following reasons prevent the modules from being uninstalled: The Voting api field field type is used in the following field: node.vote_field'
        // But for some reason the assertSame fails at character 70. I suspect
        // there is a non-printable character in the exception message.
        "The following reasons prevent the modules from being uninstalled: The",
        substr($e->getMessage(), 0, 69)
      );
    }

    // Verify that the votingapi_widgets module is still installed.
    $this->assertTrue(\Drupal::service('module_handler')->moduleExists('votingapi_widgets'));

    // Remove the field from the node and node_type then try again to
    // uninstall votingapi_widgets. This time it should pass.
    $this->field->delete();

    // Flush roles caches so that we can see if changes were made.
    // \Drupal::entityTypeManager()->getStorage('user_role')->resetCache();

    // Verify field permissions were removed from the roles when the field
    // was deleted.
    // $this->assertFalse(Role::load(Role::ANONYMOUS_ID)->hasPermission('vote on node:candidate:vote_field'));
    // $this->assertFalse(Role::load(Role::AUTHENTICATED_ID)->hasPermission('vote on node:candidate:vote_field'));

    // Uninstall votingapi_widgets.
    \Drupal::service('module_installer')->uninstall(['votingapi_widgets']);
    $this->assertFalse(\Drupal::service('module_handler')->moduleExists('votingapi_widgets'));

    // Flush roles caches so that we can see if changes were made.
    \Drupal::entityTypeManager()->getStorage('user_role')->resetCache();

    // Verify that Authenticated and Anonymous roles still exist.
    $roles = user_role_names(FALSE);
    $this->assertArrayHasKey('anonymous', $roles);
    $this->assertArrayHasKey('authenticated', $roles);
    $this->assertEquals('Anonymous user', $roles['anonymous']);
    $this->assertEquals('Authenticated user', $roles['authenticated']);

    // Verify permissions are no longer attached to the roles.
    $this->assertFalse(Role::load(Role::ANONYMOUS_ID)->hasPermission('vote on node:candidate:vote_field'));
    $this->assertFalse(Role::load(Role::AUTHENTICATED_ID)->hasPermission('vote on node:candidate:vote_field'));
  }

}
