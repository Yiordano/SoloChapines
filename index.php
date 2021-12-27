<?php
include ("View/mainview.php");
include("controller/main.php");

$sitio= new sitio();

$sitio->header();

?>

<main>
   <section id="categorias">
        <article class='encabezado'>
            <h3>Servicios Disponibles</h3>
        </article>
        <div class="Contenido">
               <?php
                  $Controller_Product= new Controller_Product();    
                  $Controller_Product->RecomendarProductos("Servicios");
               ?>
         </div>
        
   </section>

   <section id="productos">
         <article class="encabezado">
            <h3>Bienes disponibles</h3>
         </article>

         <div class="Contenido">
               <?php
                  $Controller_Product= new Controller_Product();    
                  $Controller_Product->RecomendarProductos("Bienes");
               ?>
         </div>
   </section>
</main>

<?php

$sitio->footer();

?>