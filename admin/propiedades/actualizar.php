<?php

use App\Propiedad;

    require '../../includes/app.php'; 

    estaAutenticado(); 

    // Validar la URL por ID válido 
    $id = $_GET['id']; 
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if(!$id) {
        header('Location: /admin'); 
    }

    // Obtener los datos de la propiedad 
    $propiedad = Propiedad::find($id); 

    // Consultar para obtener los vendedores 
    $consulta = "SELECT * FROM vendedores"; 
    $resultado = mysqli_query($db, $consulta); 

    // Arreglo con mensajes de errores 
    $errores = []; 
    
    // Ejecutar el código después de que el usuario envia el formulario 
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) { 
        
        echo "<pre>"; 
        var_dump($_POST); 
        echo "</pre>"; 

        // echo "<pre>"; 
        // var_dump($_FILES); 
        // echo "</pre>"; 

        $titulo = mysqli_real_escape_string( $db,  $_POST['titulo'] ); 
        $precio = mysqli_real_escape_string( $db,  $_POST['precio'] ); 
        $descripcion = mysqli_real_escape_string( $db,  $_POST['descripcion'] ); 
        $habitaciones = mysqli_real_escape_string( $db,  $_POST['habitaciones'] ); 
        $wc = mysqli_real_escape_string( $db,  $_POST['wc'] ); 
        $estacionamiento = mysqli_real_escape_string( $db,  $_POST['estacionamiento'] ); 
        $vendedorId = mysqli_real_escape_string( $db,  $_POST['vendedor'] ); 
        $creado = date('Y/m/d'); 

        // Asignar files hacia una variable 
        $imagen = $_FILES['imagen']; 


        if(!$titulo) {
            $errores[] = "Debes añadir un Titulo"; 
        }

        if(!$precio) {
            $errores[] = "El Precio es Obligatorio"; 
        }

        if( strlen( $descripcion ) < 50 ) {
            $errores[] = "La Descripcion es Obligatoria y Debe tener al menos 50 Caracteres"; 
        }

        if(!$habitaciones) {
            $errores[] = "El número de Habitaciones es Obligatorio"; 
        }

        if(!$wc) {
            $errores[] = "El número de Baños es Obligatorio"; 
        }

        if(!$estacionamiento) {
            $errores[] = "El Número de Lugares de Estacionamiento es Obligatorio"; 
        }

        if(!$vendedorId) {
            $errores[] = "Elige un vendedor"; 
        }

        // Validar por tamaño (1mb máximo) 
        $medida = 1000 * 1000; 


        if($imagen['size'] > $medida ) { 
            $errores[] = 'La Imagen es muy Pesada'; 
        }


        // echo "<pre>"; 
        // var_dump($errores); 
        // echo "</pre>"; 

        // Revisar que el array de errores este vacío 

        if( empty($errores) ) {

            // Crear Carpeta 
            $carpetaImagenes = '../../imagenes/'; 

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes); 
            }

            $nombreImagen = ''; 

            /** SUBIDA DE ARCHIVOS */

            if($imagen['name']) {
                // Eliminar la imagen previa 

                unlink($carpetaImagenes . $propiedad['imagen']); // función para eliminar archivos 

                // Generar un Nombre Único 
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; 

                // Subir la imagen 
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen ); 
            } else {
                $nombreImagen = $propiedad['imagen']; 
            }

            // Insertar en la base de datos 
            $query = " UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id} "; 

            // echo $query; 
            
            $resultado = mysqli_query($db, $query); 

            if($resultado) {
                // Redireccionar al usuario 
                header('Location: /admin?resultado=2'); 
            }
        }

        
    }




    incluirTemplate('header'); 
?>

    <main class="contenedor seccion"> 
        <h1> Actualizar Propiedad </h1> 

        <a href="/admin" class="boton boton-verde"> Volver </a> 

        <?php foreach( $errores as $error ): ?> 
            <div class="alerta error">
                <?php echo $error; ?> 
            </div>
            
        <?php endforeach; ?> 

        <form class="formulario" method="POST" enctype="multipart/form-data"> 
            <?php include '../../includes/templates/formulario_propiedades.php'; ?> 
            
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde"> 
        </form>

    </main>

<?php 
    incluirTemplate('footer'); 
?>