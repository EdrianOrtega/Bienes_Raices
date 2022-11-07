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
}

