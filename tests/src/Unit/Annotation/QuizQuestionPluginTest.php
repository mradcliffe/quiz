<?php

namespace Drupal\Tests\quiz\Unit\Annotation;

use Drupal\Tests\UnitTestCase;
use Drupal\quiz\Annotation\QuizQuestionPlugin;

/**
 * Tests that the annotation has the appropriate meta data.
 *
 * @group Quiz
 */
class QuizQuestionPluginTest extends UnitTestCase {

  public function testAnnotationProperties() {
    $annotation = new QuizQuestionPlugin([]);

    $this->assertObjectHasAttribute('id', $annotation);
    $this->assertObjectHasAttribute('definition', $annotation);
  }
  
  public function testGet() {
    $values = ['id' => 'quiz_test'];
    $annotation = new QuizQuestionPlugin($values);
    $this->assertEquals($values, $annotation->get());
  }
}
