<?php

/*
 */

namespace Drupal\quiz\Tests;

/**
 * Test basic module functionality such as permissions.
 *
 * @group Quiz
 */
class QuizModuleTest extends QuizTestBase {

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
