<?php

namespace Drupal\student_entity\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Provides a form for deleting a student entity.
 *
 * @ingroup student_entity
 */
class studentDeleteForm extends ContentEntityConfirmFormBase {

 /**
   * Gathers a confirmation question.
   *
   * The question is used as a title in our confirm form. For delete confirm
   * forms, this typically takes the form of "Delete Student Record ??", including the entity label.
   * @return string
   *   The form question. The page title will be set to this value.
   */
  public function getQuestion()
  {
    return $this->t('Delete Student Record ??');
  }

  /**
   * Returns the route to go to if the user cancels the action.
   *
   * @return \Drupal\Core\Url
   *   A URL object.
   */
  public function getCancelUrl()
  {
    return new Url('');
  }

  /**
   * The submit handler for the confirm form.
   *
   * For entity delete forms, you use this to delete the entity in
   * $this->entity.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Delete the entity.
    $this->entity->delete();

    // Set a message that the entity was deleted.
    $this->messenger()->addMessage($this->t('Student %label was deleted.', [
      '%label' => $this->entity->label(),
    ]));

    // Redirect the user to the list controller when complete.
  //  $form_state->setRedirectUrl($this->getCancelUrl());
    $response = new RedirectResponse('/drupal-8.8.0/student_entity_student/list');
		$response->send();
  }


}
?>
