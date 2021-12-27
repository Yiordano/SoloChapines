<?php

include("View/mainview.php");
include("controller/main.php");

$Sitio= new Sitio();

$Sitio->header();

?>

<main>
    <section id="descripcion">
        <h3>banner promocional</h3>

        <?php
            $Controller_Product= new Controller_Product();
            if(isset($_GET['FindId'])){
                
               
                $IntBanner=$_GET['FindId'];
                $StrBanner="Unico";
            }else  if(isset($_GET['Id'])){
                $IntBanner=$_GET['Id'];
                $StrBanner="Usuario";
            }else{
                $IntBanner=0;
                $StrBanner="";
            }

            ?>
                    <div class="contenido">
                        <?php   $Controller_Product->ColocarBanner($IntBanner,$StrBanner); ?>
                    </div>

                    <?php
                     $Sitio->ColocarbannerFormulario();
                    ?>
             
            <?php
            
            
        ?>
    </section>
</main>


<?php
$Sitio->footer();
?>