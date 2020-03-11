<?php

namespace Drupal\faculty_reg\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Language\Language;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Form controller for the student_entity entity edit forms.
 *
 * @ingroup student_entity
 */
class facultyForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\faculty_reg\Entity\faculty */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
//   public function validateform(array &$form, formstateinterface $form_state) {

//      if (strlen($form_state->getvalue($entity->mobile_no->value)) < 10) {
//          $form_state->seterrorbyname('$entity->mobile_no->value', $this->t('mobile number is too short.'));
//        }
//  }

  public function save(array $form, FormStateInterface $form_state) {
    $status = parent::save($form, $form_state);

    $entity = $this->entity;
    if ($status == SAVED_UPDATED) {
      drupal_set_message($this->t('The faculty %feed has been updated.', ['%feed' => $entity->toLink()->toString()]));
    } else {
      drupal_set_message($this->t('The faculty %feed has been added.', ['%feed' => $entity->toLink()->toString()]));
    }

    //$form_state->setRedirectUrl($this->entity->toUrl('collection'));
    //return $status;
	
    $response = new RedirectResponse('/drupal-8.8.0/facultylogin');
	$response->send();
  }
}

?>
