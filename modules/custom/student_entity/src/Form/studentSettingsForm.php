<?php

namespace Drupal\student_entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class student_entitySettingsForm.
 * @package Drupal\student_entity\Form
 * @ingroup student_entity
 */
class studentSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'student_entity_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Define the form used for student_entity settings.
   * @return array
   *   Form definition array.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param FormStateInterface $form_state
   *   An associative array containing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['student_settings']['#markup'] = 'Settings form for student_entity. Manage field settings here.';
    return $form;
  }
}
?>
