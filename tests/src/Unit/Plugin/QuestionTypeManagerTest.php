<?php

namespace Drupal\Tests\quiz\Unit\Plugin;

use Drupal\quiz\Plugin\QuestionTypeManager;
use Drupal\Tests\UnitTestCase;

/**
 * Test that question type manager is instantiated and functions correctly.
 *
 * @group Quiz
 */
class QuestionTypeManagerTest extends UnitTestCase {

  public function testQuestionTypeManager() {
    $moduleHandler = $this->prophesize('\Drupal\Core\Extension\ModuleHandlerInterface');
    $cacheBackend = $this->prophesize('\Drupal\Core\Cache\CacheBackendInterface');
    $entityTypeManager = $this->prophesize('\Drupal\Core\Entity\EntityTypeManagerInterface');
    $namespaces = new \ArrayObject([]);

    $manager = new QuestionTypeManager($entityTypeManager->reveal(), $namespaces, $cacheBackend->reveal(), $moduleHandler->reveal());

    $this->assertInstanceOf('\Drupal\quiz\Plugin\QuestionTypeManager', $manager);
  }
}
