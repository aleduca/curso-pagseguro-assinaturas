<?php

namespace App\Classes;

use App\Classes\Logado;

class User{
	
	public static function user(){
		if(Logado::logado()){
			return $_SESSION['user'];
		}
	}

}