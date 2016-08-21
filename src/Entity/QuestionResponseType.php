<?php

namespace Drupal\quiz\Entity;


use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Question Response bundle entity.
 *
 * @ConfigEntityType(
 *   id = "quiz_question_response_type",
 *   label = @Translation("Question Response Type"),
 *   handlers = {
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *     "list_builder" = "Drupal\quiz\QuestionResponseTypeListBuilder"
 *   },
 *   admin_permission = "administer quiz configuration",
 *   config_prefix = "quiz_question_response_type",
 *   bundle_of = "quiz_question_response",
 *   entity_keys = {
 *     "id" = "type",
 *     "label" = "name"
 *   },
 *   config_export = {
 *     "type",
 *     "name",
 *     "plugin"
 *   }
 * )
 */
class QuestionResponseType extends ConfigEntityBundleBase {

  /**
   * {@inheritdoc}
   */
  public function id() {
    return $this->type;
  }
}
