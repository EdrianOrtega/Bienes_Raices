<?php 

    $id = $_GET['id']; 
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if(!$id) {
        header('Location: /'); 
    }

    require 'includes/app.php'; 

    $db = conectarDB(); 

    // Consultar 
    $query = "SELECT * FROM propiedades WHERE id = ${id}"; 

    // Obtener resultados 
    $resultado = mysqli_query($db, $query); 

    if(!$resultado->num_rows) {
        header('Location: /'); 
    }

    $propiedad = mysqli_fetch_assoc($resultado); 


    incluirTemplate('header'); 
?>

    <main class="contenedor seccion contenido-centrado"> 
        <h1> <?php echo $propiedad['titulo']; ?> </h1> 

        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad"> 

        <div class="resumen-propiedad"> 
            <p class="precio"> <?php echo $propiedad['precio']; ?> </p> 
            <ul class="iconos-caracteristicas"> 
                <li> 
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc"> 
                    <p> <?php echo $propiedad['wc']; ?> </p> 
                </li> 
                <li> 
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento"> 
                    <p> <?php echo $propiedad['estacionamiento']; ?> </p> 
                </li> 
                <li> 
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones"> 
                    <p> <?php echo $propiedad['habitaciones']; ?> </p> 
                </li> 
            </ul>

            <?php echo $propiedad['descripcion']; ?>

        </div>
    </main>

<?php 

    // Cerrar la conexión 
    mysqli_close($db); 

    incluirTemplate('footer'); 
?>