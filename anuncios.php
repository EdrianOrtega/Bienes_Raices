<?php 
    require 'includes/app.php'; 
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion"> 

        <section class="seccion contenedor"> 
            <h2> Casa y Depas en Venta </h2> 
    
            <?php 
                $limite = 10; 
                include 'includes/templates/anuncios.php'; 
            ?> 
    </main>

<?php 
    incluirTemplate('footer'); 
?>