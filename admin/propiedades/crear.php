<?php 

    require '../../includes/app.php'; 

    use App\Propiedad; 

    estaAutenticado(); 

    $db = conectarDB(); 

    // Consultar para obtener los vendedores 
    $consulta = "SELECT * FROM vendedores"; 
    $resultado = mysqli_query($db, $consulta); 

    // Arreglo con mensajes de errores 
    $errores = []; 

    $titulo = ''; 
    $precio = ''; 
    $descripcion = ''; 
    $habitaciones = ''; 
    $wc = ''; 
    $estacionamiento = ''; 
    $vendedorId = ''; 

    // Ejecutar el código después de que el usuario envia el formulario 
    if( $_SERVER['REQUEST_METHOD'] === 'POST' ) { 
        
        $propiedad = new Propiedad($_POST); 

        $propiedad->guardar(); 


        // echo "<pre>"; 
        // var_dump($_POST); 
        // echo "</pre>"; 

        echo "<pre>"; 
        var_dump($_FILES); 
        echo "</pre>"; 

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

        if(!$imagen['name'] || $imagen['error']) { 
            $errores[] = 'La Imagen es Obligatoria'; 
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

            /** SUBIDA DE ARCHIVOS */

            // Crear Carpeta 
            $carpetaImagenes = '../../imagenes/'; 

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes); 
            }

            // Generar un Nombre Único 
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; 

            // Subir la imagen 
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen ); 

            // echo $query; 
            
            $resultado = mysqli_query($db, $query); 

            if($resultado) {
                // Redireccionar al usuario 
                header('Location: /admin?resultado=1'); 
            }
        }

        
    }




    require '../../includes/funciones.php'; 
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion"> 
        <h1> Crear </h1> 



        <a href="/admin" class="boton boton-verde"> Volver </a> 

        <?php foreach( $errores as $error ): ?> 
            <div class="alerta error">
                <?php echo $error; ?> 
            </div>
            
        <?php endforeach; ?> 

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data"> 
            <fieldset>
                <legend> Información General </legend>

                <label for="titulo"> Titulo: </label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>"> 

                <label for="precio"> Precio: </label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>"> 

                <label for="imagen"> Imagen: </label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen"> 

                <label for="descripcion"> Descripción: </label>
                <textarea id="descripcion" name="descripcion"> <?php echo $descripcion; ?> </textarea> 
            </fieldset>

            <fieldset>
                <legend> Información Propiedad </legend>

                <label for="habitaciones"> Habitaciones: </label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>"> 

                <label for="wc"> Baños: </label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>"> 

                <label for="estacionamiento"> Estacionamiento: </label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>"> 

            </fieldset>

            <fieldset>
                <legend> Vendedor </legend> 

                <select name="vendedorId"> 
                    <option value=""> -- Seleccione -- </option> 
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ) : ?> 
                        <option  <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['id']; ?>"> <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> </option> 

                    <?php endwhile; ?> 
                </select>

            </fieldset>
            
            <input type="submit" value="Crear Propiedad" class="boton boton-verde"> 
        </form>

    </main>

<?php 
    incluirTemplate('footer'); 
?>