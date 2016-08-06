<?php

namespace Drupal\Tests\quiz\Unit\Entity {

  use Drupal\Core\DependencyInjection\ContainerBuilder;
  use Drupal\Core\Language\LanguageInterface;
  use Drupal\quiz\Entity\Question;
  use Drupal\Tests\UnitTestCase;
  use Prophecy\Argument;

  /**
   * Test question entity.
   *
   * @group Quiz
   */
  class QuestionTest extends UnitTestCase {

    /**
     * {@inheritdoc}
     */
    protected function setUp() {
      $key_map = [
        'langcode' => 'langcode',
        'default_langcode' => LanguageInterface::LANGCODE_DEFAULT,
        'label' => 'title',
        'status' => 'status',
        'uid' => 'owner',
        'bundle' => 'type',
      ];
      $container = new ContainerBuilder();

      // Mock Default Language.
      $langProphecy = $this->prophesize('\Drupal\Core\Language\LanguageInterface');
      $langProphecy->getId()->willReturn(LanguageInterface::LANGCODE_DEFAULT);

      // Mock the Language Manager.
      $langManagerProphecy = $this->prophesize('\Drupal\Core\Language\LanguageManagerInterface');
      $langManagerProphecy->getDefaultLanguage()->willReturn($langProphecy->reveal());

      // Mock Typed Data Manager.
      $typedDataManagerProphecy = $this->prophesize('\Drupal\Core\TypedData\TypedDataManager');
      $typedDataManagerProphecy
        ->getDefinition('field_item:string')
        ->willReturn(['class' => '\Drupal\Core\Field\Plugin\Field\FieldType\StringItem']);

      // Mock a Field Item List.
      $fieldListProphecy = $this->prophesize('\Drupal\Core\Field\FieldItemListInterface');
      $fieldListProphecy->setLangcode(Argument::type('string'));

      // Mock Field Type Manager.
      $fieldTypeManagerProphecy = $this->prophesize('\Drupal\Core\Field\FieldTypePluginManagerInterface');
      $fieldTypeManagerProphecy->getDefaultStorageSettings(Argument::any())
        ->willReturn([]);
      $fieldTypeManagerProphecy->getDefaultFieldSettings(Argument::any())
        ->willReturn([]);
      $fieldTypeManagerProphecy
        ->createFieldItemList(Argument::any(), Argument::any(), Argument::any())
        ->willReturn($fieldListProphecy->reveal());

      $container->set('plugin.manager.field.field_type', $fieldTypeManagerProphecy->reveal());
      $container->set('language_manager', $langManagerProphecy->reveal());
      $container->set('typed_data_manager', $typedDataManagerProphecy->reveal());

      // Set the container so that the container can be set again, DrupalWTF.
      \Drupal::setContainer($container);

      // Mock the entity type class for the bundle.
      $bundleTypeProphecy = $this->prophesize('\Drupal\Core\Entity\EntityType');

      // Mock the entity type class.
      $entityTypeProphecy = $this->prophesize('\Drupal\Core\Entity\ContentEntityType');
      $entityTypeProphecy
        ->getKey(Argument::type('string'))
        ->will(function ($args) use ($key_map) {
          $key = $args[0];
          return $key_map[$key];
        });
      $entityTypeProphecy
        ->hasKey(Argument::type('string'))
        ->will(function ($args) use ($key_map) {
          $key = $args[0];
          return isset($key_map[$key]);
        });
      $entityTypeProphecy
        ->getKeys(Argument::any())
        ->willReturn($key_map);
      $entityTypeProphecy->getBundleEntityType()
        ->willReturn($bundleTypeProphecy->reveal());
      $entityTypeProphecy->getLabelCallback()->willReturn(NULL);
      $entityTypeProphecy->getBundleLabel()->willReturn('Question type');
      $entityTypeProphecy->isRevisionable()->willReturn(TRUE);
      $entityTypeProphecy->isTranslatable()->willReturn(TRUE);
      $entityType = $entityTypeProphecy->reveal();

      // Mock the entity manager.
      // @todo this should be replaced by entity type manager in 9.0.0.
      $entityManagerProphecy = $this->prophesize('\Drupal\Core\Entity\EntityManagerInterface');
      $entityManagerProphecy
        ->getDefinition('quiz_question')
        ->willReturn($entityType);
      $entityManagerProphecy->getFieldDefinitions('quiz_question', 'blank')
        ->willReturn(Question::baseFieldDefinitions($entityType));

      // Set the container with the entity manager.
      $container->set('entity.manager', $entityManagerProphecy->reveal());

      \Drupal::setContainer($container);
    }

    /**
     * Assert that the question entity can be created.
     */
    public function testQuestionProperties() {
      $values = [
        'title' => [
          LanguageInterface::LANGCODE_DEFAULT => $this->getRandomGenerator()->sentences(5),
        ],
        'status' => 1,
        'owner' => 1,
        'langcode' => LanguageInterface::LANGCODE_DEFAULT,
      ];

      $question = new Question($values, 'quiz_question', 'blank');

      $this->assertEquals('blank', $question->bundle());
      $this->assertEquals('quiz_question', $question->getEntityTypeId());
      $this->assertEquals($values['title'][LanguageInterface::LANGCODE_DEFAULT], $question->label());
    }

  }

}

namespace {

  /**
   * Mock the t() function used in static methods. DrupalWTF.
   *
   * @param string $value
   *   The value to translate.
   *
   * @return string
   *   Pass through for translation.
   */
  function t($value) {
    return $value;
  }

}
