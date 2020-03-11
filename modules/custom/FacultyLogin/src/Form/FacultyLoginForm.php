<?php

namespace Drupal\FacultyLogin\Form;

use Drupal\node\Entity\Node;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Database\StatementInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Implements an example form.
 */
class FacultyLoginForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'example_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

	$form['emp_id'] = array(
	  '#type' => 'textfield',
	  '#title' => $this->t('Your ID :'),
	  '#size' => 60,
	  '#maxlength' => 128,
	  '#required' => TRUE,
	);

	$form['pass'] = array(
	  '#type' => 'password',
	  '#title' => $this->t('Your Password :'),
      '#size' => 25,
	);

	$form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Login'),
	);
	  
	$form['register'] = array(
	  '#type' => 'link',
      '#title' => $this->t('Register Here'),
      '#url' => 'http://localhost/drupal-8.8.0/faculty_reg_faculty/add',
	);
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  // public function validateForm(array &$form, FormStateInterface $form_state) {
    // if (strlen($form_state->getValue('phone_number')) < 3) {
      // $form_state->setErrorByName('phone_number', $this->t('The phone number is too short. Please enter a full phone number.'));
    // }
  // }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // $this->messenger()->addStatus($this->t('Your phone number is @number', ['@number' => $form_state->getValue('phone_number')]));

	$F_EmpID = \Drupal::request()->request->get('emp_id');
	$F_Password = \Drupal::request()->request->get('pass');

	\Drupal\Core\Database\Database::setActiveConnection();
	$db = \Drupal\Core\Database\Database::getConnection();

$query = \Drupal::database()->select('faculty', 'f');
$query->fields('f', ['faculty_id','first_name','password']);
$result = $query->execute();
while ($row = $result->fetchAssoc()) {
	if($row['faculty_id'] == $F_EmpID && $row['password'] == $F_Password){
		$Filtered_EID = $row['faculty_id'];
		$Filtered_Password = $row['password'];
		$Filtered_FullName = $row['faculty_name'];
  }
}
	if($Filtered_EID == $F_EmpID && $Filtered_Password == $F_Password){

  $response = new RedirectResponse('/drupal-8.8.0/student_entity_student/add');
  $response->send();
  drupal_set_message($this->t($Filtered_FullName . ' You are logged in successfully.'));

  }else{
		drupal_set_message('Login Failed.....  Ckeck your credentials.');
	}
}
}
?>
