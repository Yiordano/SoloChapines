<?php
include('View/mainview.php');


include("controller/main.php");

$sitio= new sitio();
$sitio->header();
$Modelo_User= new Modelo_User();
?>


<?php
    if(isset($_SESSION['UserName'])){
    
        $ArrayDatos=$Modelo_User->BuscarById($_SESSION['UserId']);
        foreach($ArrayDatos as $datos){}   

        $Nombre=$datos[0];
        $Correo=$datos[1];
        $User=$datos[2];
        $Contra=$datos[3];
        $Detalle=$datos[4];
        $Servicio=$datos[5];
        $EnvioCorreo=$datos[6];
        $TipoCliente =$datos[7];
        
        
            ?>

                <main>
                    <section id="perfil">
                    
                        <h3>Bienvenido: <b><?php echo $_SESSION['UserName'] ?> </b></h3>

                        <?php
                            $sitio->ActualizarPerfil($Nombre,$Correo, $User,$Contra,$Detalle,'','','');
                        ?>
                    </section>
                </main>

            <?php
    }else{
        $Controller_Sitio=new Controller_Sitio();
        $Controller_Sitio->error404();
    }
?>




<?php
$sitio->footer();