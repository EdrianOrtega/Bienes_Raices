<?php 

require '../../includes/app.php'; 

use App\Vendedor; 

estaAutenticado(); 

$vendedor = new Vendedor; 

// Arreglo con mensajes de errores 
$errores = Vendedor::getErrores(); 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
}

incluirTemplate('header'); 

?> 

    <main class="contenedor seccion"> 
        <h1> Actualizar Vendedor(a) </h1> 

        <a href="/admin" class="boton boton-verde"> Volver </a> 

        <?php foreach( $errores as $error ): ?> 
        <div class="alerta error">
            <?php echo $error; ?> 
        </div>
        <?php endforeach; ?> 

        <form class="formulario" method="POST"> 
            <?php include '../../includes/templates/formulario_vendedores.php'; ?> 
            
            <input type="submit" value="Guardar Cambios" class="boton boton-verde"> 
        </form>

    </main>

<?php 
    incluirTemplate('footer'); 
?> 