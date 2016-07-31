<?php


namespace Drupal\Tests\quiz\Unit\Entity;

use Drupal\Core\DependencyInjection\ContainerBuilder;
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
    $bundle = new QuestionType($values, 'quiz_question_type');

    $this->assertInstanceOf('\Drupal\quiz\Entity\QuestionType', $bundle);

 }

  public function testAccessHandlerExists() {
    $container = new ContainerBuilder();
    $bundle = new QuestionType([], 'quiz_question_type');

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
}

