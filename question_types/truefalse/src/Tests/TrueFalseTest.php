<?php

namespace Drupal\truefalse\Tests;

use Drupal\quiz\Tests\QuizTestBase;

/**
 * Test class for true false questions.
 *
 * @group Quiz
 */
class TrueFalseTest extends QuizTestBase {

  static protected $modules = ['views', 'quiz', 'truefalse'];

  /**
   * Assert that the truefalse module is installed correctly.
   */
  public function testModuleInstalled() {
    $entityBundleInfo = $this->container->get('entity_type.bundle.info');

    $questionInfo = $entityBundleInfo->getBundleInfo('quiz_question');

    $this->assertTrue(isset($questionInfo['truefalse']), 'Found TrueFalse question type.');

    $responseInfo = $entityBundleInfo->getBundleInfo('quiz_question_response');

    $this->assertTrue(isset($responseInfo['truefalse']), 'Found TrueFalse question response type.');

    $pluginDefinition = $this->container->get('quiz.question_type_manager');
    $definitions = $pluginDefinition->getDefinitions();

    $this->assertTrue(isset($definitions['truefalse']), 'Found TrueFalse question plugin.');
  }

  /**
   * Test adding and taking a truefalse question.
   */
  /**
  function testCreateQuizQuestion() {
    // Login as our privileged user.
    $this->drupalLogin($this->admin);

    $question_node = $this->drupalCreateNode(array(
      'type' => 'truefalse',
      'title' => 'TF 1 title',
      'correct_answer' => 1,
      'body' => array(LANGUAGE_NONE => array(array('value' => 'TF 1 body text'))),
    ));

    return $question_node;
  }

  function testTakeQuestion() {
    $question_node = $this->testCreateQuizQuestion();

    // Link the question.
    $quiz_node = $this->linkQuestionToQuiz($question_node);

    // Test that question appears in lists.
    $this->drupalGet("node/$quiz_node->nid/quiz/questions");
    $this->assertText('TF 1 title');

    // Login as non-admin.
    $this->drupalLogin($this->user);

    // Take the quiz.
    $this->drupalGet("node/$quiz_node->nid/take");
    $this->assertNoText('TF 1 title');
    $this->assertText('TF 1 body text');
    $this->assertText('True');
    $this->assertText('False');

    // Test validation.
    $this->drupalPost(NULL, array(), t('Finish'));
    $this->assertText('You must provide an answer.');

    // Test correct question.
    $this->drupalGet("node/$quiz_node->nid/take");
    $this->drupalPost(NULL, array(
      "question[$question_node->nid][answer]" => 1,
      ), t('Finish'));
    $this->assertText('You got 1 of 1 possible points.');

    // Test incorrect question.
    $this->drupalGet("node/$quiz_node->nid/take");
    $this->drupalPost(NULL, array(
      "question[$question_node->nid][answer]" => 0,
      ), t('Finish'));
    $this->assertText('You got 0 of 1 possible points.');
  }

  function testQuestionFeedback() {
    // Login as our privileged user.
    $this->drupalLogin($this->admin);

    // Create the quiz and question.
    $question_node = $this->testCreateQuizQuestion();

    // Link the question.
    $quiz_node = $this->linkQuestionToQuiz($question_node);

    // Test incorrect question with all feedbacks on.

    // Login as non-admin.
    $this->drupalLogin($this->user);
    // Take the quiz.
    $this->drupalGet("node/$quiz_node->nid/take");
    $this->drupalPost(NULL, array(
      "question[$question_node->nid][answer]" => 1,
      ), t('Finish'));
    $this->assertRaw('quiz-score-icon correct');
    $this->assertRaw('quiz-score-icon should');
    // Take the quiz.
    $this->drupalGet("node/$quiz_node->nid/take");
    $this->drupalPost(NULL, array(
      "question[$question_node->nid][answer]" => 0,
      ), t('Finish'));
    $this->assertRaw('quiz-score-icon incorrect');
    $this->assertRaw('quiz-score-icon should');
  }
  */

  /**
   * Test that the question response can be edited.
   */
  /**
  function testEditQuestionResponse() {
    // Create & link a question.
    $question_node = $this->testCreateQuizQuestion();
    $quiz_node = $this->linkQuestionToQuiz($question_node);

    $question_node2 = $this->testCreateQuizQuestion();
    $this->linkQuestionToQuiz($question_node2, $quiz_node);

    // Login as non-admin.
    $this->drupalLogin($this->user);

    // Take the quiz.
    $this->drupalGet("node/$quiz_node->nid/take");

    // Test editing a question.
    $this->drupalGet("node/$quiz_node->nid/take");
    $this->drupalGet("node/$quiz_node->nid/take/1");
    $this->drupalPost(NULL, array(
      "question[$question_node->nid][answer]" => 0,
      ), t('Next'));
    $this->drupalGet("node/$quiz_node->nid/take/1");
    $this->drupalPost(NULL, array(
      "question[$question_node->nid][answer]" => 1,
      ), t('Next'));
  }
  */


}
