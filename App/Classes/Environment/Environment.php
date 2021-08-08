<?php

namespace App\Classes\Environment;

use App\Interfaces\EnvironmentInterface;

class Environment {
	
	private $environment;

	public function __construct(EnvironmentInterface $environment){
		$this->environment = $environment;
	}

	public function getEmail(){
		return $this->environment->emailEnvironment();
	}

	public function getToken(){
		return $this->environment->tokenEnvironment();
	}

}