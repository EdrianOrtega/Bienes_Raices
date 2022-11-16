<?php 


define('TEMPLATES_URL', __DIR__ . '/templates'); // constante 
define('FUNCIONES_URL', __DIR__ . 'funciones.php'); // constante 
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/'); // constante 

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/${nombre}.php"; 
}

function estaAutenticado() {
    session_start(); 

    if(!$_SESSION['login']) {
        header('Location: /'); 
    }
// Cuando se coloque un return no es necesario tener un else. 

}

function debuguear($variable) {
    echo "<pre>"; 
    var_dump($variable); 
    echo "</pre>"; 
    exit; 
}

// Escapa / Sanitizar el HTML 
function s($html) : string {
    $s = htmlspecialchars($html); 
    return $s; 
}

// Validar tipo de contenido 
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad']; 

    return in_array($tipo, $tipos); 
}


