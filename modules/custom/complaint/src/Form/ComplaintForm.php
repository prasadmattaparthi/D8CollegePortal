<?php
/**
 * @file
 * Contains \Drupal\complaint\Form\ComplaintForm.
 */
namespace Drupal\complaint\Form;
use Drupal\node\Entity\Node;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ComplaintForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'register_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['Your_Name'] = array(
      '#type' => 'textfield',
      '#title' => t('Your Name :'),
      '#required' => TRUE,
    );
    $form['Your_Mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID :'),
      '#required' => TRUE,
    );


    $form['Contact_No'] = array (
      '#type' => 'tel',
      '#title' => t('Contact No :'),
	  '#required' => TRUE,
    );

    $form['City'] = array(
      '#type' => 'textfield',
      '#title' => t('City :'),
      '#required' => TRUE,
    );
	
    $form['Complaint_Against'] = array(
      '#type' => 'textfield',
      '#title' => t('Complaint Against :'),
      '#required' => TRUE,
    );
	
    $form['Address'] = array(
      '#type' => 'textarea',
      '#title' => $this
      ->t('Address :'),
    );
    
    $form['Complaints'] = array(
      '#type' => 'textarea',
      '#title' => $this
      ->t('Complaints :'),
    );
	
	
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
    public function validateForm(array &$form, FormStateInterface $form_state) {

      //if (strlen($form_state->getValue('Contact_No')) < 10) {
        //$form_state->setErrorByName('Contact_No', $this->t('Mobile number is too short.'));
//}

      

    }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

	$a = $form_state->getValue('Your_Name');
   // drupal_set_message($this->t('@can_name ,Your application is being submitted!', array('@can_name' => $form_state->getValue('candidate_name'))));
	$field = $form_state->getValues();
	
	$node = Node::create(['type' => 'complaint_form']);
	$node->set('title', $field['Your_Name']);
	$node->set('field_your_name', $field['Your_Name']);
	$node->set('field_your_mail', $field['Your_Mail']);
	$node->set('field_contact_no', $field['Contact_No']);
	$node->set('field_city', $field['City']);
	$node->set('field_complaint_against', $field['Complaint_Against']);
	$node->set('field_address', $field['Address']);
	$node->set('field_complaints', $field['Complaints']);
	$node->save();
	//drupal_set_message($this->t('Compalaint Added'));
	$response = new RedirectResponse('/drupal-8.8.0/ComplaintForm');
	$response->send();
	drupal_set_message('Hi ' . $a .'. Your complaint added successfully.');
   }
}








