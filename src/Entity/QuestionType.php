<?php


namespace Drupal\quiz\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Question bundle entity.
 *
 * @ConfigEntityType(
 *   id = "quiz_question_type",
 *   label = @Translation("Question Type"),
 *   handlers = {
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "list_builder" = "Drupal\quiz\QuestionTypeListBuilder"
 *   },
 *   admin_permission = "administer quiz configuration",
 *   config_prefix = "quiz_question_type",
 *   bundle_of = "quiz_question",
 *   entity_keys = {
 *     "id" = "type",
 *     "label" = "name"
 *   },
 *   config_export = {
 *     "name",
 *     "type",
 *     "plugin"
 *   }
 * )
 */
class QuestionType extends ConfigEntityBundleBase {

  /**
   * {@inheritdoc}
   */
  public function id() {
    return $this->type;
  }
}
