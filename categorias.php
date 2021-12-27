<?php

include('View/mainview.php');

$sitio= new sitio();



$sitio->header();

?>




<?php

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $Opcion=isset($_GET['Venta'])?"Venta":"Compra";


   if($Opcion=="Venta"){
    
    if(isset($_SESSION['UserId'])){
        ?>
            <main>
                <section id='Banner'>
                    <article class='encabezado'>
                        <h3>Crear Banner</h3>
                    </article>

                    <?php
                        $sitio->CrearBanner();
                    ?>
                </section>
            </main>
            
        <?php
        

    }else{
        ?>
        <main>
            <section id="Banner">
            <div class='alert alert-danger' role='alert' >
                        No puedes publicar nada hasta que te registres, puedes hacerlo completamente gratis <a href='register.php'>Aqui</a>
                </div>
            </section>
        </main>
        <?php
        
    }   
    
    }else{
        ?>
            
            <main>
                <section id="categorias">
                    <article class='encabezado'>
                        <h3>Categorias</h3>
                    </article>
                    <div class="Contenido">
                        <article id="topic">
                            

                            <div class="texto">
                            <img src="assets/img/Koala.jpg" alt="">
                                
                                <button type="button" id='Conocenos' class="btn btn-success">
                                    <a href="Productos.php?type=Servicios">Servicios</a>
                                </button>
                            </div>
                        </article>
                        <article id="topic">
                            

                            <div class="texto">
                            <img src="assets/img/Koala.jpg" alt="">
                                
                                <button type="button" id='Conocenos' class="btn btn-success">
                                    <a href="Productos.php?type=Bienes">Bienes</a>
                                </button>
                            </div>
                        </article>
                    </div>
                
                </section>

    
            </main>

        <?php
   }

}

?>