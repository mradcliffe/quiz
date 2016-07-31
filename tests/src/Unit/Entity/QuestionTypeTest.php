<?php


namespace Drupal\Tests\quiz\Unit\Entity;

use Drupal\quiz\Entity\QuestionType;
use Drupal\Tests\UnitTestCase;

/**
 * Question type test
 *
 * @group Quiz
 */
class QuestionTypeTest extends UnitTestCase {

  public function testQuestionTypeEntity() {
    $values = [];
    $bundle = new QuestionType($values, 'quiz_question');

    $this->assertInstanceOf('\Drupal\quiz\Entity\QuestionType', $bundle);
  }
}

