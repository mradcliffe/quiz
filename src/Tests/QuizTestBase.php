<?php

namespace Drupal\quiz\Tests;


use Drupal\simpletest\WebTestBase;

/**
 * Base test class for Quiz functional tests.
 */
abstract class QuizTestBase extends WebTestBase {

  static protected $modules = ['views', 'quiz'];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();
  }

}
