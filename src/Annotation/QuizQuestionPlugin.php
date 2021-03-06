<?php

namespace Drupal\quiz\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a quiz question plugin annotation object.
 *
 * Plugin namespace: Plugin\quiz\Question.
 *
 * @Annotation
 */
class QuizQuestionPlugin extends Plugin {

  /**
   * The plugin identifier.
   *
   * @var string
   */
  public $id;
}
