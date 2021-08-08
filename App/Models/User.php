<?php

namespace App\Models;

class User extends Model{
		
	protected $table = 'users';

	public function findUser($email,$password){
		$sql = "select * from {$this->table} where email = ? and password = ?";
		$find = $this->connection->prepare($sql);
		$find->bindValue(1,$email);
		$find->bindValue(2,$password);
		$find->execute();
		return $find->fetch();
	}

}