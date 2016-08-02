<?php

namespace Drupal\quiz\Plugin;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * Question type plugin manager.
 */
class QuestionTypeManager extends DefaultPluginManager {

  /**
   * Entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Initialize method.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityManager
   *   The entity type manager.
   * @param \Traversable $namespaces
   *   Namespaces.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cacheBackend
   *   The cache backend to store plugin definitions.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $moduleHandler
   *   The moduler handler service.
   */
  public function __construct(EntityTypeManagerInterface $entityManager, \Traversable $namespaces, CacheBackendInterface $cacheBackend, ModuleHandlerInterface $moduleHandler) {
    parent::__construct('Plugin/quiz/Question', $namespaces, $moduleHandler, '\Drupal\quiz\Plugin\QuizQuestionInterface', '\Drupal\quiz\Annotation\QuizQuestionPlugin');

    $this->entityTypeManager = $entityManager;
    $this->alterInfo('quiz_question_info');
    $this->setCacheBackend($cacheBackend, 'quiz_question');
  }

}
