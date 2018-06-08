<?php

namespace Drupal\votesane_custom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class VotesaneDonationSettingsForm extends ConfigFormBase{

    public function getformid(){
    	return 'votesane_custom_donation_settings';
    }

    public function buildform(array $form , FormStateInterface $form_state){

    	$config = $this->config('donation.settings');

    	

		$form['prefix_text'] = [
	    	'#type'=>'textfield',
	    	'#title'=>'Prefix Text',
	    	'#description' => 'This will be displayed on donation detail page like "Donate to [Candidate]',
	    	'#default_value' =>$config->get('prefix_text'),
    	];


    	$form['contribution_rules']=[
	    	'#type'=>'textarea',
	    	'#title'=>'Contribution Rules',
	    	'#description'=> 'Add the text for contribution rules to display it on payment page.',
	    	'#default_value'=>$config->get('contribution_rules'),
    	];


    	$form['privacy_policy']=[
    	'#type'=> 'textarea',
    	'#title'=>'Privacy Policy',
    	'#description'=> 'Add the text for privacy policy to display it on payment page.',
    	'#default_value'=>$config->get('privacy_policy'),
    	];


    	$form['finanical_donation']=[
    	'#type'=> 'textarea',
    	'#title'=>'Finanical Donation ',
    	'#description'=> 'Add the text for privacy policy to display it on payment page.',
    	'#default_value'=>$config->get('finanical_donation'),
    	];



    	return parent::buildForm($form, $form_state);

    }

    public function submitForm(array &$form,FormStateInterface $form_state) {

    	// $this->configFactory->getEditable('donation.settings')
    	$this->config('donation.settings')
    	->set('prefix_text' , $form_state->getValue('prefix_text'))
    	->set('contribution_rules', $form_state->getValue('contribution_rules'))
    	->set('privacy_policy',$form_state->getValue('privacy_policy'))
    	->set('finanical_donation',$form_state->getValue('finanical_donation'))->save();

    	return parent::submitForm($form, $form_state);
    }

    public function getEditableConfigNames(){
    	return ['donation.settings'];

    }
}