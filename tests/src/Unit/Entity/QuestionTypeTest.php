<?php


namespace Drupal\Tests\quiz\Unit\Entity;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\quiz\Entity\QuestionType;
use Drupal\quiz\QuestionTypeListBuilder;
use Drupal\Tests\UnitTestCase;
use Prophecy\Argument;

/**
 * Question type test.
 *
 * @group Quiz
 */
class QuestionTypeTest extends UnitTestCase {

  /**
   * Assert that the question type class is returned.
   */
  public function testQuestionTypeEntity() {
    $values = ['type' => 'test'];
    $bundle = new QuestionType($values, 'quiz_question_type');

    $this->assertInstanceOf('\Drupal\quiz\Entity\QuestionType', $bundle);
  }

  /**
   * Assert that the question type has an access handler.
   */
  public function testAccessHandlerExists() {
    $container = new ContainerBuilder();
    $bundle = new QuestionType(['type' => 'test'], 'quiz_question_type');

    $accountProphecy = $this->prophesize('\Drupal\Core\Session\AccountInterface');
    $account = $accountProphecy->reveal();
    $accessHandlerProphecy = $this->prophesize('\Drupal\Core\Entity\EntityAccessControlHandler');
    $accessHandlerProphecy->createAccess('quiz_question_type', $account, [], FALSE)->willReturn(FALSE);
    $entityManagerProphecy = $this->prophesize('\Drupal\Core\Entity\EntityManagerInterface');
    $entityManagerProphecy
      ->getAccessControlHandler('quiz_question_type')
      ->willReturn($accessHandlerProphecy->reveal());

    $container->set('entity.manager', $entityManagerProphecy->reveal());
    \Drupal::setContainer($container);

    $this->assertFalse($bundle->access('create', $account), 'Anonymous user cannot create question types by default.');
  }

  /**
   * Assert that the question type has a functional list builder class.
   */
  public function testListBuilderExists() {
    $questionTypeProphecy = $this->prophesize('\Drupal\Core\Entity\EntityTypeInterface');
    $questionProphecy = $this->prophesize('\Drupal\Core\Entity\EntityInterface');
    $questionProphecy->id()->willReturn('long_answer');
    $questionProphecy->label()->willReturn('Long Answer');
    $questionProphecy->access(Argument::any())->willReturn(TRUE);
    $storageProphecy = $this->prophesize('\Drupal\Core\Entity\EntityStorageInterface');

    $question = $questionProphecy->reveal();

    $listBuilder = new QuestionTypeListBuilder($questionTypeProphecy->reveal(), $storageProphecy->reveal());
    $expected_row = [
      'id' => 'long_answer',
      'label' => 'Long Answer',
    ];

    $expected_header = [
      'label' => 'Name',
      'id' => 'Question Type',
    ];

    $container = new ContainerBuilder();
    $translation = $this->getStringTranslationStub();
    $translation->expects($this->any())
      ->method('translate')
      ->will($this->returnValueMap([['Name', 'Name'], ['Question Type', 'Question Type']]));

    $container->set('string_translation', $translation);
    \Drupal::setContainer($container);

    $header = $listBuilder->buildHeader();
    $row = $listBuilder->buildRow($question);
    $this->assertArrayEquals($expected_header, $header);
    $this->assertArrayEquals($expected_row, $row);
  }

  /**
   * Assert that the id method returns a string.
   */
  public function testId() {
    $bundle = new QuestionType(['type' => 'test'], 'quiz_question_type');

    $this->assertEquals('test', $bundle->id());
  }

}
