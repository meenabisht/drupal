<?php

namespace Drupal\votesane_custom\form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class VotesaneSagepaySettingsForm extends ConfigformBase{
	
	/**
	 * Form Id
	 */
	public function getFormId(){
		return 'votesane_custom_sagepay_settings';
	}

	/**
	 * Build Form
	 */
	public function buildform(array $form , FormStateInterface $form_state){
		$config=$this->config('sagepay.settings');

		$form['protocol']=[
			'#type'=>'textfield',
			'#title'=>'Protocol',
			'#required'=>TRUE,
			'#description'=>'Sagepay protocl default to 3.00.',
			'#default_value'=>$config->get('protocol'),
		];
	
		$form['merchant_id_number']=[
			'#type'=>'textfield',
			'#title'=>'Merchant Id Number',
			'#required'=>TRUE,
			'#description'=>'Add the Merchent id Number provided by the Sagepay Server.',
			'#default_value'=>$config->get('merchant_id_number'),
		];
	    

	    $form['merchant_key']=[
			'#type'=>'textfield',
			'#title'=>'Merchant Key',
			'#required'=>TRUE,
			'#description'=>'Add the Merchent key provided by the Sagepay Server.',
			'#default_value'=>$config->get('merchant_key'),
		];


		$form['sage_payment_server']=[
			'#type'=>'textfield',
			'#title'=>'Sage Payment Server',
			'#required'=>TRUE,
			'#default_value'=>$config->get('sage_payment_server'),
		];


		$form['votesane_card_types']=[
			'#type'=>'checkboxes',
			'#title'=>'Card Types',
			'#required'=>TRUE,
			'#description'=>'Type of cards can be used.',
			'#options' =>  [ 'first'=>'Visa','second'=>'Master Card','third'=>'American Express'] ,
			'#default_value'=>$config->get('votesane_card_types'),
		];
	
		return parent::buildform($form,$form_state);
	}


	/**
	 * Submit Form
	 */
	public function submitform(array &$form, FormStateInterface $form_state){
		$this->config('sagepay.settings')
    	->set('protocol' , $form_state->getValue('protocol'))
    	->set('merchant_id_number', $form_state->getValue('merchant_id_number'))
    	->set('merchant_key',$form_state->getValue('merchant_key'))
    	->set('sage_payment_server',$form_state->getValue('sage_payment_server'))
    	->set('votesane_card_types',$form_state->getValue('votesane_card_types'))->save();

    	return parent::submitForm($form, $form_state);
	}

	/**
	 * Editable Config Names
	 */
	public function getEditableConfigNames(){
    	return ['sagepay.settings'];

    }
}