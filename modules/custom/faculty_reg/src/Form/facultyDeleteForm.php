<?php

namespace Drupal\faculty_reg\Form;

use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class facultyDeleteForm extends ContentEntityConfirmFormBase {
  public function getQuestion()
  {
    return $this->t('Delete faculty Record ??');
  }
  public function getCancelUrl()
  {
    return new Url('');
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Delete the entity.
    $this->entity->delete();

    // Set a message that the entity was deleted.
    $this->messenger()->addMessage($this->t('Student %label was deleted.', [
      '%label' => $this->entity->label(),
    ]));

    // Redirect the user to the list controller when complete.
  //  $form_state->setRedirectUrl($this->getCancelUrl());
    $response = new RedirectResponse('/drupal-8.8.0/faculty_reg_faculty/list');
		$response->send();
  }


}
?>
