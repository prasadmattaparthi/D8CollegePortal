<?php

namespace Drupal\student_entity\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for student_content entity.
 *
 * @ingroup student
 */
class studentListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   *
   * We override ::render() so that we can add our own content above the table.
   * parent::render() is where EntityListBuilder creates the table using our
   * buildHeader() and buildRow() implementations.
   */
  public function render() {
    $build['description'] = [
      '#markup' => $this->t('Content Entity Example implements a Student model. These Student are fieldable entities. You can manage the fields on the <a href="@adminlink">Student admin page</a>.', array(
        '@adminlink' => \Drupal::urlGenerator()
          ->generateFromRoute('student_entity.student_settings'),
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
    /*$header['id'] = $this->t('UniqueID');
    $header['student_id'] = $this->t('StudentID');
    $header['First_Name'] = $this->t('First Name');
    $header['Last_Name'] = $this->t('Last Name');
    $header['Date_Of_Birth'] = $this->t('DOB');
 	  $header['Sub_1'] = $this->t('P & S');
 	  $header['Sub_2'] = $this->t('DW & DM');
 	  $header['Sub_3'] = $this->t('MEFA');
 	  $header['Sub_4'] = $this->t('MFCS');
 	  $header['Sub_5'] = $this->t('JAVA');
*/

    $header['id'] = $this->t('UniqueID');
    $header['student_id'] = $this->t('StudentID');
    $header['First_Name'] = $this->t('Name');
    //$header['Last_Name'] = $this->t('Last Name');
    $header['Date_Of_Birth'] = $this->t('DOB');
 	  $header['Sub_1'] = $this->t('PYTHON');
 	  $header['Sub_2'] = $this->t('DOT NET');
 	  $header['Sub_3'] = $this->t('WEB DESIGN');
 	  $header['Sub_4'] = $this->t('ORACLE');
 	  $header['Sub_5'] = $this->t('JAVA');
    $header['Total_Marks'] = $this->t('Total Mark');
    $header['Result_Status'] = $this->t('Result Status');
     return $header + parent::buildHeader();
   }

   /**
    * {@inheritdoc}
    */
   public function buildRow(EntityInterface $entity) {
     /* @var $entity \Drupal\student_entity\Entity\student */
/*  $row['id'] = $entity->id();
 	$row['student_id'] = $entity->student_id->value;
  $row['First_Name'] = $entity->First_Name->value;
  $row['Last_Name'] = $entity->Last_Name->value;
  $row['Date_Of_Birth'] = $entity->Date_Of_Birth->value;
 	$row['Sub_1'] = $entity->Sub_1->value;
 	$row['Sub_2'] = $entity->Sub_2->value;
 	$row['Sub_3'] = $entity->Sub_3->value;
 	$row['Sub_4'] = $entity->Sub_4->value;
 	$row['Sub_5'] = $entity->Sub_5->value;
*/
    $row['id'] = $entity->id();
    $row['student_id'] = $entity->student_id->value;
    $row['First_Name'] = $entity->First_Name->value;
    //$row['Last_Name'] = $entity->Last_Name->value;
    $row['Date_Of_Birth'] = $entity->Date_Of_Birth->value;
    $row['Sub_1'] = $entity->Sub_1->value;
    $row['Sub_2'] = $entity->Sub_2->value;
    $row['Sub_3'] = $entity->Sub_3->value;
    $row['Sub_4'] = $entity->Sub_4->value;
    $row['Sub_5'] = $entity->Sub_5->value;
    $row['Total_Marks'] = $entity->Total_Marks->value;
    $row['Result_Status'] = $entity->Result_Status->value;
      return $row + parent::buildRow($entity);
   }

}
?>
