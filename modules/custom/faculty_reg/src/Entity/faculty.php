<?php

namespace Drupal\faculty_reg\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\faculty_reg\facultyInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;


/**
*
* Defines the Advertiser entity.
*
* @ingroup advertiser
*
* @ContentEntityType(
*   id = "faculty_reg_faculty",
*   label = @Translation("faculty entity"),
*   handlers = {
*     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
*     "list_builder" = "Drupal\faculty_reg\Entity\Controller\facultyListBuilder",
*     "views_data" = "Drupal\views\EntityViewsData",
*     "form" = {
*        "add" = "Drupal\faculty_reg\Form\facultyForm",
*       "edit" = "Drupal\faculty_reg\Form\facultyForm",
*       "delete" = "Drupal\faculty_reg\Form\facultyDeleteForm",
*     },
*     "access" = "Drupal\faculty_reg\facultyAccessControlHandler",
*   },
*   base_table = "faculty",
*   admin_permission = "administer faculty entity",
*   fieldable = TRUE,
*   entity_keys = {
*     "id" = "id",
*     "uuid" = "uuid",
*     "faculty_id" = "faculty_id",
*     "password" = "password",
*     "confirm_password" ="confirm_password",
*     "first_name" = "first_name",
*     "last_name" = "last_name",
*     "date_of_birth" = "date_of_birth",
*     "email_id" = "email_id",
*     "mobile_no" = "mobile_no",
*     "city" = "city",
*     "state" = "state",
*     "experience" = "experience",
*     "qualification" = "qualification",
*     "langcode" = "langcode",
*     "created" = "created",
*     "changed" = "changed"
*   },
*   links = {
*     "canonical" = "/faculty_reg_faculty/{faculty_reg_faculty}",
*     "edit-form" = "/faculty_reg_faculty/{faculty_reg_faculty}/edit",
*     "delete-form" = "/faculty/{faculty_reg_faculty}/delete",
*     "collection" = "/faculty_reg_faculty/list"
*   },
*   field_ui_base_route = "faculty_reg.faculty_settings",
* )
*/
class faculty extends ContentEntityBase implements facultyInterface {
use EntityChangedTrait;
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

   $fields['faculty_id'] = BaseFieldDefinition::create('string')
       ->setLabel(t('Faculty ID'))
       ->setDescription(t('The UniqueID of the faculty.'))
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

    $fields['first_name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('First Name'))
            ->setDescription(t('The First Name of Faculty.'))
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

    $fields['last_name'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Last Name'))
            ->setDescription(t('The Last name of the Faculty.'))
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

    $fields['date_of_birth'] = BaseFieldDefinition::create('datetime')
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

    $fields['password'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Password'))
            ->setDescription(t('Create your password'))
            ->setSettings([
                'max_length' => 255,
                'text_processing' => 0,
            ])
            // Set no default value.
            ->setDefaultValue(NULL)
            ->setDisplayOptions('view', [
                'label' => 'above',
                'type' => 'password',
                'weight' => -6,
            ])
            ->setDisplayOptions('form', [
                'type' => 'string_textfield',
                'weight' => -6,
            ])
            ->setDisplayConfigurable('form', TRUE)
            ->setDisplayConfigurable('view', TRUE);

            $fields['confirm_password'] = BaseFieldDefinition::create('string')
                    ->setLabel(t('Confirm Password'))
                    ->setDescription(t('Confirm your password.'))
                    ->setSettings([
                        'max_length' => 255,
                        'text_processing' => 0,
                    ])
                    // Set no default value.
                    ->setDefaultValue(NULL)
                    ->setDisplayOptions('view', [
                        'label' => 'above',
                        'type' => 'password',
                        'weight' => -6,
                    ])
                    ->setDisplayOptions('form', [
                        'type' => 'string_textfield',
                        'weight' => -6,
                    ])
                    ->setDisplayConfigurable('form', TRUE)
                    ->setDisplayConfigurable('view', TRUE);

          $fields['email_id'] = BaseFieldDefinition::create('string')
                  ->setLabel(t('Email ID'))
                  ->setDescription(t('Enter your email ID.'))
                  ->setSettings([
                      'max_length' => 255,
                      'text_processing' => 0,
                  ])
                  // Set no default value.
                  ->setDefaultValue('@gmail.com')
                  ->setDisplayOptions('view', [
                  'label' => 'above',
                  'type' => 'number_unformatted',
                  'weight' => -6,
                  ])
                 ->setDisplayOptions('form', [
                  'type' => 'number',
                  'weight' => -6,
                  ])
                  ->setDisplayConfigurable('form', TRUE)
                  ->setDisplayConfigurable('view', TRUE);

          $fields['mobile_no'] = BaseFieldDefinition::create('string')
              ->setLabel(t('Mobile Number'))
              ->setDescription(t('The Conatct number of the Faculty.'))
              ->setPropertyConstraints('value', array('Length' => array('max' => 10)))
              ->setSettings([
                  'max_length' => 255,
                  'text_processing' => 0,
                ])
                // Set no default value.
               ->setDefaultValue(NULL)
               ->setDisplayOptions('view', [
                  'label' => 'above',
                  'type' => 'number_unformatted',
                  'weight' => -6,
                ])
               ->setDisplayOptions('form', [
                  'type' => 'number',
                  'weight' => -6,
                ])
                ->setDisplayConfigurable('form', TRUE)
                ->setDisplayConfigurable('view', TRUE);

          $fields['city'] = BaseFieldDefinition::create('string')
                ->setLabel(t('City'))
                ->setDescription(t('The city of Faculty.'))
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

          $fields['state'] = BaseFieldDefinition::create('string')
                ->setLabel(t('State'))
                ->setDescription(t('The state of Faculty.'))
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

          $fields['experience'] = BaseFieldDefinition::create('integer')
                ->setLabel(t('Experience (years)'))
                ->setDescription(t('The total experience of the Faculty in years.'))
                ->setSettings([
                    'min' => 1,
                    'max' => 20,
                    'max_length' => 2,
                    'text_processing' => 0,
                ])
                // Set no default value.
                ->setDefaultValue(NULL)
                ->setDisplayOptions('view', [
                    'label' => 'above',
                    'type' => 'number_unformatted',
                    'weight' => -6,
                ])
                ->setDisplayOptions('form', [
                    'type' => 'number',
                    'weight' => -6,
                ])
                ->setDisplayConfigurable('form', TRUE)
                ->setDisplayConfigurable('view', TRUE);
        $fields['qualification'] = BaseFieldDefinition::create('string')
                ->setLabel(t('Qualification'))
                ->setDescription(t('The state of Faculty.'))
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
