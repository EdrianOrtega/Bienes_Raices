<?php 
    require 'includes/funciones.php'; 
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion contenido-centrado"> 
        <h1> Casa en Venta frente al bosque </h1> 

        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp"> 
            <source srcset="build/img/destacada2.jpg" type="image/jpeg"> 
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad"> 
        </picture>
        
        <p class="informacion-meta"> Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p> 

        <div class="resumen-propiedad"> 
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid veritatis dolor debitis labore, ipsa unde! Quis sint dignissimos est quo velit, eligendi reiciendis similique alias rerum, libero dolorem obcaecati minus! Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis harum veniam quia, voluptatibus voluptatem praesentium itaque libero tenetur aspernatur neque aliquid ipsam facere porro sint aliquam delectus atque nostrum vitae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            </p> 
            
            <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque doloribus aperiam vero illum, assumenda nisi totam ea amet repudiandae hic cum molestias minus voluptate autem impedit commodi, saepe harum at. Lorem ipsum dolor sit amet consectetur adipisicing elit.  </p> 
        </div>
    </main>

<?php 
    incluirTemplate('footer'); 
?>