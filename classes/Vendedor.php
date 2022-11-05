<?php 

namespace App; 

class Vendedor extends ActiveRecord {

    

    // Lista todos los registros 
    public static function all() {
        $query = "SELECT * FROM vendedores"; 

        $resultado = self::consultarSQL($query);

        return $resultado; 
    }
}

