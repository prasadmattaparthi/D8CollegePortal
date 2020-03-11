<?php

namespace Drupal\faculty_reg\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;
class facultyListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = [
      '#markup' => $this->t('Content Entity Example implements a faculty model. These faculty are fieldable entities. You can manage the fields on the <a href="@adminlink">faculty admin page</a>.', array(
        '@adminlink' => \Drupal::urlGenerator()
          ->generateFromRoute('faculty_reg.faculty_settings'),
      )),
    ];

    $build += parent::render();
    return $build;
  }

  /**
   * {@inheritdoc}
   *
   * Building the header and content lines for the student list.
   *
   * Calling the parent::buildHeader() adds a column for the possible actions
   * and inserts the 'edit' and 'delete' links as defined for the entity type.
   */
   public function buildHeader() {
    $header['id'] = $this->t('UniqueID');
    $header['faculty_id'] = $this->t('Faculty ID');
    $header['first_name'] = $this->t('First Name');
    $header['last_name'] = $this->t('Last Name');
    $header['date_of_birth'] = $this->t('DOB');
 	  $header['password'] = $this->t('Password');
 	  $header['confirm_password'] = $this->t('Confirm Password');
 	  $header['email_id'] = $this->t('Email ID');
 	  $header['mobile_no'] = $this->t('Mobile Number');
 	  $header['city'] = $this->t('City');
    $header['state'] = $this->t('State');
    $header['experience'] = $this->t('Experience');
    $header['qualification'] = $this->t('Qualification');

     return $header + parent::buildHeader();
   }

   /**
    * {@inheritdoc}
    */
   public function buildRow(EntityInterface $entity) {
     /* @var $entity \Drupal\student_entity\Entity\student */
  $row['id'] = $entity->id();
 	$row['faculty_id'] = $entity->faculty_id->value;
  $row['first_name'] = $entity->first_name->value;
  $row['last_name'] = $entity->last_name->value;
  $row['date_of_birth'] = $entity->date_of_birth->value;
 	$row['password'] = $entity->password->value;
 	$row['confirm_password'] = $entity->confirm_password->value;
 	$row['email_id'] = $entity->email_id->value;
 	$row['mobile_no'] = $entity->mobile_no->value;
 	$row['city'] = $entity->city->value;
  $row['state'] = $entity->state->value;
  $row['experience'] = $entity->experience->value;
  $row['qualification'] = $entity->qualification->value;

  return $row + parent::buildRow($entity);
   }

}
?>
