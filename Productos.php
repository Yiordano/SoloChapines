<?php
include ('View/mainview.php');
include("controller/main.php");
$Sitio= new sitio();



$Sitio->header();
?>



<main>
    <section id="listService">
        <article class='encabezado'>
            <?php
             if($_SERVER['REQUEST_METHOD'] == 'POST'){
                ?>  
                    <h3>Resultados de tu busqueda</h3>
                <?php
             }else{
                
                    
                    if(isset($_GET['type'])){
                        if($_GET['type']=="Bienes"){
                            ?>  
                                <h3>Categorias de Bienes</h3>
                            <?php
                        }else{
                            if($_GET['type']=="Servicios"){
                                ?>  
                                        <h3>Categorias de Servicios</h3>
                                <?php
                            }
                        }
                    }
                    
                
                
             }    
             
                

            ?>
          
        </article>

        <div class="Contenido">
           <?php
             if(isset($_GET['type'])){
                if($_GET['type']=="Bienes"){
                    ?>
                        <article id="topic">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Categorias disponibles</label>
                                </div>
                                <select class="custom-select" id="SelectBien">
                                    <option selected>Categorias</option>
                                    <option value="Comida">Comida tipica guatemalteca</option>
                                    <option value="Artesanias">Artesania guatemalteca</option>
                                    <option value="Dulces">Dulces tipicos</option>
                                    <option value="Ropa">Ropa Tipica</option>
                                    <option value="Otros">Otros Productos Guatemaltecos</option>
                                </select>
                            </div>
                                        
                        </article>
                                    
                    <?php
                    }else{
                        ?>
                            <article id="topic">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Categorias disponibles</label>
                                    </div>
                                    <select class="custom-select" id="SelectService">
                                        <option selected>Categorias</option>
                                        <option value="handy">HandyMan</option>
                                        <option value="jardinero">jardineros</option>
                                        <option value="Albanil">Albaniles</option>
                                        <option value="Electricista">Electricistas</option>
                                        <option value="OtrosService">Otros Servicios</option>
                                    </select>
                                </div>    
                            </article>
                        <?php
                    }
             }
            
           ?>
                        
        </div>

        <article id="Resultado">
            <?php
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    $Controller_Producto= new Controller_Product();
                    $Controller_Producto->BuscarBienes($_POST['TextoBusqueda'],$_POST['Categorias']);
                }
            ?>
        </article>
    </section>
</main>


<?php
$Sitio->footer();

?>