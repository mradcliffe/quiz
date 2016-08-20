<?php

namespace Drupal\quiz\Entity;


use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Quiz Question Entity.
 *
 * @ContentEntityType(
 *   id = "quiz_question",
 *   label = @Translation("Question"),
 *   bundle_label = @Translation("Question type"),
 *   handlers = {
 *     "access" = "Drupal\Core\Entity\EntityAccessControlHandler",
 *   },
 *   base_table = "quiz_question",
 *   data_table = "quiz_question_data",
 *   translatable = TRUE,
 *   entity_keys = {
 *     "id" = "question_id",
 *     "bundle" = "type",
 *     "revision" = "revision_id",
 *     "label" = "title",
 *     "langcode" = "langcode",
 *     "uuid" = "uuid",
 *     "status" = "status",
 *     "uid" = "owner",
 *   },
 *   bundle_entity_type = "quiz_question_type",
 *   common_reference_target = TRUE,
 *   permission_granularity = "bundle",
 *   links = {}
 * )
 */
class Question extends ContentEntityBase {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setRevisionable(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ]);
    $fields['status'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Status'))
      ->setRequired(TRUE)
      ->setRevisionable(TRUE)
      ->setSetting('max', 2)
      ->setSetting('min', 0)
      ->setDisplayOptions('form', [
        'label' => 'hidden',
        'type' => 'string_textfield',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE);
    $fields['owner'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Owner'))
      ->setRequired(TRUE)
      ->setRevisionable(TRUE)
      ->setCardinality(1)
      ->setTargetEntityTypeId('user')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }

}
