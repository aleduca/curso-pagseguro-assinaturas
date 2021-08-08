<?php

namespace App\Models;

use PDO;

class Connection{

    public function connect(){
        $pdo = new PDO("mysql:host=localhost;dbname=plano_assinatura","root","root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }

}