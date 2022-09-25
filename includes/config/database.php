<?php 

function conectarDB() : mysqli { // Conectar a base de datos
    $db = new mysqli('localhost', 'root', '', 'bienes_raices'); 

    if(!$db) { // Revición de si se conectó la base de datos 
        echo "Error no se pudo conectar"; 
        exit; // Hará que las siguientes líneas del if se dejen de ejecutar
    } 

    return $db; 

}

