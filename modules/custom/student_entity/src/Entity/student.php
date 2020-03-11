<?php

namespace Drupal\student_entity\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\student_entity\studentInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
*
* Defines the Advertiser entity.
*
* @ingroup advertiser
*
* @ContentEntityType(
*   id = "student_entity_student",
*   label = @Translation("student entity"),
*   handlers = {
*     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
*     "list_builder" = "Drupal\student_entity\Entity\Controller\studentListBuilder",
*     "views_data" = "Drupal\views\EntityViewsData",
*     "form" = {
*        "add" = "Drupal\student_entity\Form\studentForm",
*       "edit" = "Drupal\student_entity\Form\studentForm",
*       "delete" = "Drupal\student_entity\Form\studentDeleteForm",
*     },
*     "access" = "Drupal\student_entity\studentAccessControlHandler",
*   },
*   base_table = "studentinfo",
*   admin_permission = "administer student entity",
*   fieldable = TRUE,
*   entity_keys = {
*     "id" = "id",
*     "uuid" = "uuid",
*     "student_id" = "student_id",
*     "password" = "password",
*     "First_Name" = "First_Name",
*     "Last_Name" = "Last_Name",
*     "Date_Of_Birth" = "Date_Of_Birth",
*     "Sub_1" = "Sub_1",
*     "Sub_2" = "Sub_2",
*     "Sub_3" = "Sub_3",
*     "Sub_4" = "Sub_4",
*     "Sub_5" = "Sub_5",
*     "Total_Marks" = "Total_Marks",
*     "Result_Status" = "Result_Status",
*     "langcode" = "langcode",
*     "created" = "created",
*     "changed" = "changed"
*   },
*   links = {
*     "canonical" = "/student_entity_student/{student_entity_student}",
*     "edit-form" = "/student_entity_student/{student_entity_student}/edit",
*     "delete-form" = "/student/{student_entity_student}/delete",
*     "collection" = "/student_entity_student/list"
*   },
*   field_ui_base_route = "student_entity.student_settings",
* )
*/
class student extends ContentEntityBase implements studentInterface {

  use EntityChangedTrait; // Implements methods defined by EntityChangedInterface.
  /**
   * {@inheritdoc}
   * When a new entity instance is added, set the user_id entity reference to the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }
  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }
  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }
  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   * Define the field properties here.
   * Field name, type and size determine the table structure.
   * In addition, we can define how the field and its content can be manipulated
   * in the GUI. The behaviour of the widgets used can be determined here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
	// Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the student entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Contact entity.'))
      ->setReadOnly(TRUE);

$fields['student_id'] = BaseFieldDefinition::create('string')
       ->setLabel(t('Student ID'))
       ->setDescription(t('The UniqueID of the student.'))
       ->setSettings([
         'max_length' => 255,
         'text_processing' => 0,
       ])
       // Set no default value.
       ->setDefaultValue(NULL)
       ->setDisplayOptions('view', [
         'label' => 'above',
         'type' => 'string',
         'weight' => -3,
       ])
       ->setDisplayOptions('form', [
         'type' => 'string_textfield',
         'weight' => -3,
       ])
       ->setDisplayConfigurable('form', TRUE)
       ->setDisplayConfigurable('view', TRUE);

       $fields['password'] = BaseFieldDefinition::create('string')
              ->setLabel(t('Password'))
              ->setDescription(t('Make a password for student login.'))
              ->setSettings([
                'max_length' => 255,
                'text_processing' => 0,
              ])
              // Set no default value.
              ->setDefaultValue(NULL)
              ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'string',
                'weight' => -3,
              ])
              ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => -3,
              ])
              ->setDisplayConfigurable('form', TRUE)
              ->setDisplayConfigurable('view', TRUE);


     $fields['First_Name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('First Name'))
            ->setDescription(t('The First Name of the student.'))
            ->setSettings([
              'max_length' => 255,
              'text_processing' => 0,
            ])
            // Set no default value.
            ->setDefaultValue(NULL)
            ->setDisplayOptions('view', [
              'label' => 'above',
              'type' => 'string',
              'weight' => -6,
            ])
            ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['Last_Name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Last Name'))
            ->setDescription(t('The Last name of the student.'))
            ->setSettings([
              'max_length' => 255,
              'text_processing' => 0,
            ])
            // Set no default value.
            ->setDefaultValue(NULL)
            ->setDisplayOptions('view', [
              'label' => 'above',
              'type' => 'string',
              'weight' => -6,
            ])
            ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

        $fields['Date_Of_Birth'] = BaseFieldDefinition::create('datetime')
            ->setLabel(t('DOB'))
            ->setDescription(t('Date of bith.'))
            ->setRevisionable(TRUE)
            ->setSettings([
              'datetime_type' => 'date'
            ])
            ->setDefaultValue('')
            ->setDisplayOptions('view', [
              'label' => 'above',
              'type' => 'datetime_default',
              'settings' => [
                'format_type' => 'medium',
              ],
              'weight' => 14,
            ])
            ->setDisplayOptions('form', [
              'type' => 'datetime_default',
              'weight' => 14,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);


            $fields['Sub_1'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('PYTHON'))
          ->setDescription(t('1st semister, 1st subject marks.'))
          ->setSettings([
    	    'min' => 1,
            'max' => 100,
    		'max_length' => 3,
            'text_processing' => 0,
          ])
          // Set no default value.
           ->setDefaultValue(NULL)
          ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'number_unformatted',
            'weight' => -1,
          ])
          ->setDisplayOptions('form', [
            'type' => 'number',
            'weight' => -1,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);



    	   $fields['Sub_2'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('DOT NET'))
          ->setDescription(t('1st semister, 2nd subject marks.'))
          ->setSettings([
    	    'min' => 1,
            'max' => 100,
    		'max_length' => 3,
            'text_processing' => 0,
          ])
          // Set no default value.
           ->setDefaultValue(NULL)
          ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'number_unformatted',
            'weight' => -1,
          ])
          ->setDisplayOptions('form', [
            'type' => 'number',
            'weight' => -1,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

    	  $fields['Sub_3'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('WEB DESIGN'))
          ->setDescription(t('1st semister, 3rd subject marks.'))
          ->setSettings([
    	    'min' => 1,
            'max' => 100,
    		'max_length' => 3,
            'text_processing' => 0,
          ])
          // Set no default value.
           ->setDefaultValue(NULL)
          ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'number_unformatted',
            'weight' => -1,
          ])
          ->setDisplayOptions('form', [
            'type' => 'number',
            'weight' => -1,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

    	  $fields['Sub_4'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('ORACLE'))
          ->setDescription(t('1st semister, 4th subject marks.'))
          ->setSettings([
    	    'min' => 1,
            'max' => 100,
    		'max_length' => 3,
            'text_processing' => 0,
          ])
          // Set no default value.
           ->setDefaultValue(NULL)
          ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'number_unformatted',
            'weight' => -1,
          ])
          ->setDisplayOptions('form', [
            'type' => 'number',
            'weight' => -1,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

    	  $fields['Sub_5'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('JAVA'))
          ->setDescription(t('1st semister, 5th subject marks.'))
          ->setSettings([
    	    'min' => 1,
            'max' => 100,
    		'max_length' => 3,
            'text_processing' => 0,
          ])
          // Set no default value.
           ->setDefaultValue(NULL)
          ->setDisplayOptions('view', [
            'label' => 'above',
            'type' => 'number_unformatted',
            'weight' => -1,
          ])
          ->setDisplayOptions('form', [
            'type' => 'number',
            'weight' => -1,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

          $fields['Total_Marks'] = BaseFieldDefinition::create('integer')
            ->setLabel(t('Total Marks'))
            ->setDescription(t('Total marks of all subject in this semister'))
            ->setSettings([
      	    'min' => 1,
              'max' => 500,
      		'max_length' => 3,
              'text_processing' => 0,
            ])
            // Set no default value.
             ->setDefaultValue(NULL)
            ->setDisplayOptions('view', [
              'label' => 'above',
              'type' => 'number_unformatted',
              'weight' => -1,
            ])
            ->setDisplayOptions('form', [
              'type' => 'number',
              'weight' => -1,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

            $fields['Result_Status'] = BaseFieldDefinition::create('string')
                ->setLabel(t('Result Status'))
                ->setDescription(t('Result status of student. Should enetr only PROMOTED OR FAILED'))
                ->setSettings([
                  'max_length' => 255,
                  'text_processing' => 0,
                ])
                // Set no default value.
                ->setDefaultValue(NULL)
                ->setDisplayOptions('view', [
                  'label' => 'above',
                  'type' => 'string',
                  'weight' => -6,
                ])
                ->setDisplayOptions('form', [
                  'type' => 'string_textfield',
                  'weight' => -6,
                ])
                ->setDisplayConfigurable('form', TRUE)
                ->setDisplayConfigurable('view', TRUE);

	$fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of StudentEntity entity.'));
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }
}

?>
