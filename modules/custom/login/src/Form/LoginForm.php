<?php

namespace Drupal\login\Form;

use Drupal\node\Entity\Node;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Connection;
use Drupal\Core\Database\StatementInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Implements an example form.
 */
class LoginForm extends FormBase {

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
    // $form['phone_number'] = [
      // '#type' => 'tel',
      // '#title' => $this->t('Your phone number'),
    // ];

	$form['user_name'] = array(
	  '#type' => 'textfield',
	  '#title' => $this->t('UserName'),
	  '#size' => 60,
	  '#maxlength' => 128,
	  //'#pattern' => 'some-prefix-[a-z]+',
	  '#required' => TRUE,
	  );

	$form['pass'] = array(
	  '#type' => 'password',
	  '#title' => $this->t('Password'),
      '#size' => 25,
      //'#pattern' => '[01]+',
	  );

	$form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Login'),
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

	//$a = $form_state->getValue('title');
	//$b = $form_state->getValue('pass');

	$F_Username = \Drupal::request()->request->get('user_name');
	$F_Password = \Drupal::request()->request->get('pass');

	\Drupal\Core\Database\Database::setActiveConnection();
	$db = \Drupal\Core\Database\Database::getConnection();

$query = \Drupal::database()->select('studentinfo', 's');
$query->fields('s', ['student_id', 'password','First_Name','Last_Name','Sub_1','Sub_2','Sub_3','Sub_4','Sub_5','Total_Marks','Result_Status']);
$result = $query->execute();
while ($row = $result->fetchAssoc()) {
	if($row['student_id'] == $F_Username && $row['password'] == $F_Password){
		$Filter_User = $row['student_id'];
		$Filter_Password = $row['password'];
    $Filter_FName = $row['First_Name'];
    $Filter_LName = $row['Last_Name'];
    $Filter_S1 = $row['Sub_1'];
    $Filter_S2 = $row['Sub_2'];
    $Filter_S3 = $row['Sub_3'];
    $Filter_S4 = $row['Sub_4'];
    $Filter_S5 = $row['Sub_5'];
    $Filter_TM = $row['Total_Marks'];
    $Filter_RS = $row['Result_Status'];
  }
}
	if($Filter_User == $F_Username && $Filter_Password == $F_Password){

	$node = Node::create(['type' => 'student_results']);
	$node->set('title',  $Filter_FName );
	$node->set('field_student_uid', $Filter_User);
	$node->set('field_fname', $Filter_FName);
	$node->set('field_lname', $Filter_LName);
	$node->set('field_python', $Filter_S1);
	$node->set('field_dot_net', $Filter_S2);
	$node->set('field_web_design', $Filter_S3);
	$node->set('field_oracle', $Filter_S4);
  $node->set('field_jaava', $Filter_S5);
  $node->set('field_total_marks', $Filter_TM);
  $node->set('field_result_status', $Filter_RS);
	$node->save();

  $nid = $node->id();
  $title = preg_replace("/[\s_]/", "-", $title);
  $path = \Drupal::service('path.alias_storage')->save('/node/'.$nid, '/mypath/'.$title);


  $response = new RedirectResponse('/drupal-8.8.0/mypath');
  $response->send();
  //drupal_set_message($this->t('login done successfully.'));
  if($Filter_RS == 'PROMOTED')
  {
    drupal_set_message('CONGRATULATIONS..... ' . $Filter_FName . ' your are promoted');
  }else {
    drupal_set_message( $Filter_FName . ' YOUR FAILED IN THE SEMISTER.');
  }

  }
	else{
		drupal_set_message('Login Failed.....  Ckeck your credentials.');
	}

}
}
?>
