<?php

namespace App\Classes;

use App\Models\User;

class Login{
	
	public function logar($email,$password){
		$user = new User;
		$userEncontrado = $user->findUser($email,$password);

		if(!$userEncontrado) return false;

		$_SESSION['logado'] = true;
		$_SESSION['user'] = $userEncontrado;
		return true;
	}

	public function logout(){
		session_destroy();
	}

}