<?php

namespace Drupal\faculty_reg\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class facultySettingsForm extends FormBase {

  public function getFormId() {
    return 'faculty_reg_settings';
  }
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['faculty_settings']['#markup'] = 'Settings form for faculty_entity. Manage field settings here.';
    return $form;
  }
}
?>
