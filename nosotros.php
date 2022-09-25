<?php 
    require 'includes/app.php'; 
    incluirTemplate('header'); 
?>

    <main class="contenedor seccion"> 
        <h1> Conoce sobre Nosotros </h1> 

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp"> 
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg"> 
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros"> 
                </picture>
            </div>

            <div class="texto-nosotros"> 
                <blockquote> 
                    25 Años de experiencia 
                </blockquote> 

                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid veritatis dolor debitis labore, ipsa unde! Quis sint dignissimos est quo velit, eligendi reiciendis similique alias rerum, libero dolorem obcaecati minus! Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis harum veniam quia, voluptatibus voluptatem praesentium itaque libero tenetur aspernatur neque aliquid ipsam facere porro sint aliquam delectus atque nostrum vitae. Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                </p> 
                
                <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque doloribus aperiam vero illum, assumenda nisi totam ea amet repudiandae hic cum molestias minus voluptate autem impedit commodi, saepe harum at. Lorem ipsum dolor sit amet consectetur adipisicing elit.  </p> 
            </div> 
        </div>
    </main>

    <section class="contenedor seccion"> 
        <h1> Más Sobre Nosotros </h1> 

        <div class="iconos-nosotros"> 
            <div class="icono"> 
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy"> 
                <h3> Seguridad </h3> 
                <p> Ab reprehenderit necessitatibus, nesciunt quis omnis iste, eum aut iusto laboriosam expedita quia odio impedit praesentium. Laudantium molestiae blanditiis tempora dolore adipisci! </p> 
            </div>
            <div class="icono"> 
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy"> 
                <h3> Precio </h3> 
                <p> Ab reprehenderit necessitatibus, nesciunt quis omnis iste, eum aut iusto laboriosam expedita quia odio impedit praesentium. Laudantium molestiae blanditiis tempora dolore adipisci! </p> 
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy"> 
                <h3> A Tiempo </h3> 
                <p> Ab reprehenderit necessitatibus, nesciunt quis omnis iste, eum aut iusto laboriosam expedita quia odio impedit praesentium. Laudantium molestiae blanditiis tempora dolore adipisci! </p> 
            </div>
        </div>
    </section>

<?php 
    incluirTemplate('footer'); 
?>