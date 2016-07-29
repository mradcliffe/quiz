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

  protected $profile = 'testing';

  protected $modules = ['views', 'quiz'];

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

    $this->assertTrue($module_handler->moduleExists('quiz'));
  }

}
