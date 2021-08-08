<?php

namespace App\Classes;

class Logado{
	
	public static function logado(){
		if(isset($_SESSION['logado']) == true){
			return true;
		}
		return false;
	}

}