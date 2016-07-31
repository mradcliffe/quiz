<?php

namespace Drupal\quiz\Plugin;

/**
 * Quiz question plugin interface.
 */
interface QuizQuestionInterface {

  /**
   * Get field definitions for the question type.
   *
   * @return array
   *   An array of field definitions keyed by the field name.
   */
  public function getQuestionFieldDefinitions();

  /**
   * Get field definitions for the question response type.
   *
   * @return array
   *   An array of field definitions keyed by the field name.
   */
  public function getQuestionResponseFieldDefinitions();

}

