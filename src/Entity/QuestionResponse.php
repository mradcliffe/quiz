<?php

namespace Drupal\quiz\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Question Response entity.
 *
 * @ContentEntityType(
 *   id = "quiz_question_response",
 *   label = @Translation("Question response"),
 *   bundle_label = @Translation("Question response type"),
 *   handlers = {
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *   },
 *   base_table = "quiz_question_response",
 *   data_table = "quiz_question_response_data",
 *   translatable = FALSE,
 *   entity_keys = {
 *     "id" = "question_response_id",
 *     "bundle" = "type",
 *     "revision" = "revision_id",
 *     "uuid" = "uuid",
 *     "uid" = "owner",
 *   },
 *   bundle_entity_type = "quiz_question_response_type",
 *   common_reference_target = TRUE,
 *   permission_granularity = "bundle",
 *   links = {}
 * )
 */
class QuestionResponse extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // @todo use setTargetEntityBundle() based on the bundle plugin's question bundle?
    $fields['question'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Question'))
      ->setDescription(t('The question related to the response.'))
      ->setRevisionable(FALSE)
      ->setRequired(TRUE)
      ->setTargetEntityTypeId('quiz_question_entity');

    $fields['is_correct'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Correct'))
      ->setDescription(t('Boolean indicating whether this question is correct.'))
      ->setRevisionable(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue(FALSE);

    $fields['is_skipped'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Skipped'))
      ->setDescription(t('Boolean indicating whether this question was skipped.'))
      ->setRevisionable(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue(FALSE);

    $fields['is_doubtful'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Doubtful'))
      ->setDescription(t('Boolean indicating whether the user marked the answer as doubtful.'))
      ->setRevisionable(TRUE)
      ->setRequired(TRUE)
      ->setDefaultValue(FALSE);

    $fields['answered'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Anwered On'))
      ->setDescription(t('The timestamp when the question was answered.'))
      ->setRevisionable(FALSE)
      ->setRequired(TRUE);

    $fields['points'] = BaseFieldDefinition::create('float')
      ->setLabel(t('Points Awarded'))
      ->setDescription(t('The number of points awarded for this response.'))
      ->setRevisionable(TRUE)
      ->setRequired(FALSE)
      ->setDefaultValue(0.0);

    return $fields;
  }

}
