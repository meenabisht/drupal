<?php

namespace Drupal\votesane_custom\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class VotesaneBasicSettingsForm extends ConfigFormBase{
	public function getFormId(){
		return 'votesane_custom_basic_settings';
	}

	public function buildForm(array $form, FormStateInterface $form_state ){

		$config = $this->config('meena.bisht');

		// Array in Drupal 8 is denoted as []

		$form['congress_api_key']=[
		'#type'=>'textfield',
		'#title'=>'Congress Api Key',
		'#required' => TRUE,
		'#description'=> "The API key from Propublica. If you don't have one, please register at Propublica API's website",
		'#default_value'=>$config->get('congress_api_key'),
		];

		$form['congress_id'] = [
		'#type'=>'textfield',
		'#title'=>'Congress Id',
		'#required' => TRUE,
		'#description' => 'The current Congress ID',
		'#default_value'=>$config->get('congress_id'),
		];


		$form['cron_interval']= [
		'#type'=>'select',
		'#title'=>'Cron Interval',
		'#description'=> 'Time after which congressapi_cron will respond to a processing request.',
		'#options' =>  [ 'first'=>'1 day','second'=>'2 days','third'=>'3 days' , 'fourth'=>'4 days','fifth'=>'1 week' ] ,
		'#default_value'=>$config->get('cron_inteval'),
		];

		$form['cron_duration']=array(
			'#title'=>'Cron Duration',
			'#type'=>'textfield',
			'#attributes' => array( 'size' => 10 ),
			'#description'=> 'Time (in secs) for which the queue should execute.',
			'#default_value'=>$config->get('cron_duration'),
			);

		$form['propublica_api_autoupdate_disable']=array(
			'#title'=>'Disable legislators auto update',
			'#type'=> 'checkbox',
			'#default_value'=>$config->get('propublica_api_autoupdate_disable'),
			);



		return parent::buildForm($form,$form_state);
	}

	public function submitForm(array &$form,FormStateInterface $form_state){

		$this->configFactory->getEditable('meena.bisht')
		->set('congress_api_key', $form_state->getValue('congress_api_key'))
		->set('congress_id', $form_state->getvalue('congress_id'))
		->set('cron_interval', $form_state->getValue('cron_interval'))
		->set('cron_duration', $form_state->getValue('cron_duration'))
		->set('propublica_api_autoupdate_disable', $form_state->getvalue('propublica_api_autoupdate_disable'))->save();

		return parent::submitForm($form, $form_state);

	}

	public function getEditableConfigNames(){
		return ['meena.bisht'];
	}
} 

