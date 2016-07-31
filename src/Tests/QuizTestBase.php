<?php

namespace Drupal\quiz\Tests;


use Drupal\simpletest\WebTestBase;

/**
 * Base test class for Quiz functional tests.
 *
 * @group Quiz
 *
 * @todo Change to abstract class.
 */
class QuizTestBase extends WebTestBase {

  static protected $modules = ['views', 'quiz'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

  /**
   * A simple test to assert that the module was installed.
   */
  public function testModuleInstalled() {
    /** @var \Drupal\Core\Extension\ModuleHandlerInterface $module_handler */
    $module_handler = \Drupal::service('module_handler');
    // Assert module exists.
    $this->assertTrue($module_handler->moduleExists('quiz'));
  }

  /**
   * A simple test for the assignment of administer configuration permissions.
   */
  public function testAssignPermission() {
    // Create user with "administer quiz configuration" permission.
    $user = $this->createUser(array('administer quiz configuration'));
    // Assert user has permission assigned.
    $this->assertTrue($user->hasPermission('administer quiz configuration'));
  }

}
