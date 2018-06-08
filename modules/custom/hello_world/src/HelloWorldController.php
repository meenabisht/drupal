<?php

namespace Drupal\hello_world;

use Drupal\Core\Controller\ControllerBase;

class HelloWorldController extends ControllerBase {
	public function hello_content(){
		return array(
    		'#markup' => '123',
  		);
	}

    public function second_content(){
    	return array(
    		'#markup' => 'this is 234',
  		);
    }
}
