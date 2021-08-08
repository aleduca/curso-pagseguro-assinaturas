<?php

namespace App\Classes\Environment;

use App\Interfaces\EnvironmentInterface;

class PypalEnvironment implements EnvironmentInterface{

	public function emailEnvironment()
	{
		getenv('PAG_EMAIL');
	}

	public function tokenEnvironment()
	{
		return (getenv('ENV') == 'local') ? getenv('PAG_TOKEN_LOCAL') : getenv('PAG_TOKEN_PRODUCTION')
	}
}