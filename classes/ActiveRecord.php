<?php 

namespace App; 

class ActiveRecord {
    // Base de Datos 
    protected static $db; 
    protected static $columnas_DB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId']; // Crear arreglo de columnas 

    // Errores 
    protected static $errores = []; 

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

    // Definir la conexión a la base de datos 
    public static function setDB($database) {
        self::$db = $database; 
    }

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
        $this->vendedorId = $args['vendedorId'] ?? 1; 
    }

    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar 
            $this->actualizar(); 
        } else {
            // Crendo un nuevo registro
            $this->crear(); 
        }
    }

    public function crear() {

        // Sanitizar los datos 
        $atributos = $this->sanitizarAtributos(); 

        // Insertar en la base de datos 
        $query = " INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos)); 
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos)); 
        $query .= " ')"; 
        
        $resultado = self::$db->query($query); 

        // Mensaje de exito 
        if($resultado) {
            // Redireccionar al usuario 
            header('Location: /admin?resultado=1'); 
        }
    }

    public function actualizar() {
        // Sanitizar los datos 
        $atributos = $this->sanitizarAtributos(); 

        $valores = []; 
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'"; 
        }

        $query = " UPDATE propiedades SET ";
        $query .= join(', ', $valores); 
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' "; 
        $query .= " LIMIT 1 "; 

        $resultado = self::$db->query($query); 

        if($resultado) {
            // Redireccionar al usuario 
            header('Location: /admin?resultado=2'); 
        }
    }


    // Eliminar un registro 
    public function eliminar() {
        // Eliminar la propiedad
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1"; 
        $resultado = self::$db->query($query); 

        if($resultado) {
            $this->borrarImagen(); 
            header('location: /admin?resultado=3'); 
        }
    }

    // Identificar y unir los atributos de la BD
    public function atributos() { 
        $atributos = []; 
        foreach(self::$columnas_DB as $columna) {
            if($columna === 'id') continue; 
            $atributos[$columna] = $this->$columna; 
        } 
        return $atributos; 
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos(); 
        $sanitizado = []; 
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value); // vamos sanitizando nuestros datos 
        }
        return $sanitizado; // los retornamos nuestros datos ya sanitizados 
    }
    // Subida de Archivos 
    public function setImagen($imagen) { // set es para modificar un valor 
        
        // Elimina la imagen previa 
        if(!is_null($this->id) ) {
            $this->borrarImagen(); 
        }

        // Asignar al atributo de imagen el nombre de la imagen 
        if($imagen) {
            $this->imagen = $imagen; 
        }
    }

    // Elimina el archivo 
    public function borrarImagen() {
        // Comprobar si existe el archhivo 
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen); 
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen); 
        }
    }

    // Validación 
    public static function getErrores() { // get es para obtener un valor
        return self::$errores; 
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
            self::$errores[] = 'La Imagen es Obligatoria'; 
        }

        return self::$errores; 
    }

    // Lista todos los registros 
    public static function all() {
        $query = "SELECT * FROM propiedades"; 

        $resultado = self::consultarSQL($query);

        return $resultado; 
    }

    // Busca un registro por su id 
    public static function find($id) {
        $query = "SELECT * FROM propiedades WHERE id = ${id}"; 

        $resultado = self::consultarSQL($query); 

        return array_shift( $resultado ); 
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos 
        $resultado = self::$db->query($query); 

        // Iterar los resultados 
        $array = []; 
        while($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro); 
        }

        // Liberar la memoria 
        $resultado->free(); 

        // Retornar los resultados 
        return $array; 
    }

    protected static function crearObjeto($registro) {
        $objeto = new self; 

        foreach($registro as $key => $value ) {
            if( property_exists( $objeto, $key ) ) {
                $objeto->$key = $value; 
            }
        }

        return $objeto; 
    }


    // Sincronizar el objeto en memoria con los cambios realizados por el usuario 
    public function sincronizar( $args = [] ) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key ) && !is_null($value)) {
                $this->$key = $value; 
            }
        }
    }
}