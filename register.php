<?php
include ("View/mainview.php");
    $sitio= new sitio();
    $sitio->header();
?>

<main>
    <section id="Registro">
        <div id="dialogemergente">
            
        </div>
      <?php
      if(isset($_GET['ClienteComprador'])){

      }else{
          ?>
                <article id='OpcionesRegistro'>
                    <small  class="form-text text-muted" id='Indicaciones'>Selecciona la primera opcion si deseas vender algun bien o selecciona la segunda si deseas prestar algun servicio</small>
                        <div class="opciones">
                            <div class="col1">
                                    <button type="button" class="btn btn-primary" id='RegistroVendedor'>Registro para venta Bienes</button>
                            </div>
                            <div class="col1">
                                    <button type="button" class="btn btn-primary" id='RegistroComprador'>Registro para oferta de  Servicios</button>
                            </div>
                            
                        </div>  
                
                </article>
          <?php
      }
      ?>
       
            
        <article id='encabezado'>
            
        </article>

        <div class="Contenido" id='Contenido'>
            
        </div>
        <div class="" role="alert" id='MensajeAlerta'></div>
    </section>
</main>

<?php
$sitio->footer();

?>