<?php


namespace Drupal\quiz\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * @ConfigEntityType(
 *   id = "quiz_question_type",
 *   label = @Translation("Question Type"),
 *   handlers = {
 *    "form" = {
 *      "add" = "Drupal\quiz\QuestionTypeForm",
 *      "edit" = "Drupal\quiz\QuestionTypeForm",
 *      "delete" = "Drupal\quiz\Form\QuestionTypeDeleteConfirm"
 *      },
 *    },
 *   admin_permission = "administer quiz configuration",
 *   config_prefix = "",
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
}
