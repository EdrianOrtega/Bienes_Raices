<?php 

namespace App; 

class Propiedad extends ActiveRecord {
    
    protected static $tabla = 'propiedades'; 

    protected static $columnas_DB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId']; // Crear arreglo de columnas 

    public $id; 
    public $titulo; 
    public $precio; 
    public $imagen; 
    public $descripcion; 
    public $habitaciones; 
    public $wc; 
    public $estacionamiento; 
    public $creado; 
    public $vendedorId; 

    public function __construct($args = []) 
    {
        $this->id = $args['id'] ?? null; 
        $this->titulo = $args['titulo'] ?? ''; 
        $this->precio = $args['precio'] ?? ''; 
        $this->imagen = $args['imagen'] ?? ''; 
        $this->descripcion = $args['descripcion'] ?? ''; 
        $this->habitaciones = $args['habitaciones'] ?? ''; 
        $this->wc = $args['wc'] ?? ''; 
        $this->estacionamiento = $args['estacionamiento'] ?? ''; 
        $this->creado = date('Y/m/d'); 
        $this->vendedorId = $args['vendedorId'] ?? ''; 
    }

    public function validar() {
        
        if(!$this->titulo) {
            self::$errores[] = "Debes añadir un Titulo"; 
        }

        if(!$this->precio) {
            self::$errores[] = "El Precio es Obligatorio"; 
        }

        if( strlen( $this->descripcion ) < 50 ) {
            $errores[] = "La Descripcion es Obligatoria y Debe tener al menos 50 Caracteres"; 
        }

        if(!$this->habitaciones) {
            self::$errores[] = "El número de Habitaciones es Obligatorio"; 
        }

        if(!$this->wc) {
            self::$errores[] = "El número de Baños es Obligatorio"; 
        }

        if(!$this->estacionamiento) {
            self::$errores[] = "El Número de Lugares de Estacionamiento es Obligatorio"; 
        }

        if(!$this->vendedorId) {
            self::$errores[] = "Elige un vendedor"; 
        }

        if(!$this->imagen) { 
            self::$errores[] = 'La Imagen de la propiedad es Obligatoria'; 
        }

        return self::$errores; 
    }

}

