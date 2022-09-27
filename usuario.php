<?php 

// Importar la conexión 
require 'includes/app.php'; 

$db = conectarDB(); 

// Crear un e-mail y un password 
$email = "correo@correo.com"; 
$password = "123456"; 

$passwordHash = password_hash($password, PASSWORD_BCRYPT); 



// Query para crear usuario 
$query = " INSERT INTO usuarios (email, password) VALUES ( '${email}', '${passwordHash}'); "; 

// echo $query; 

// Agregarlo a la base de datos 
mysqli_query($db, $query); 


