<?php

    include("main.php");

    $Controller = new Controller_Sitio();
    $Controller_Users= new Controller_User();
    $Controller_Producto= new Controller_Product();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        

        if(isset($_POST['FindCiudadEstado'])){
            $Controller->BuscarCiudad($_POST['Codigo']);

        }

        if(isset($_POST['RegistroCiudadano'])){
                $Controller->ContenidoRegistro($_POST['TipoServicio']);
        }


        if(isset($_POST['RegistroU'])){
            $StrNombre=empty($_POST['Nombre'])?" ":$_POST['Nombre'];
            $StrCorreo=empty($_POST['Correo'])?" ":$_POST['Correo'];
            $StrUser=empty($_POST['Usuario'])?" ":$_POST['Usuario'];
            $StrPass=empty($_POST['Pass'])?" ":$_POST['Pass'];
            $Strlocalidad=empty($_POST['localidad'])?" ":$_POST['localidad'];
            $intCodigo_Postal=intval($_POST['CodigoPostal'])>0?intval($_POST['CodigoPostal']):0;
            $StrServicio=empty($_POST['TipoService'])?" ":$_POST['TipoService'];
            $intTelefono= intval($_POST['Telefono'])>0?intval($_POST['Telefono']):0;
            //Aqui va imagen pero se valida abajo
            $StrEnvio_Correo=$_POST['EnviosCorreo']; 
            $StrDetalle=empty($_POST['Detalles'])?" ":$_POST['Detalles'];
            $StrTipo=$_POST['Venta'];
            

            if(isset($_FILES['Imagen'])){
                $FileArchivo=$_FILES['Imagen'];
            }else{
               $FileArchivo="NONE";
            }
            
                                      

            $Controller_Users->Registro($StrNombre,$StrCorreo,$StrUser,$StrPass,$Strlocalidad,
                                        $intCodigo_Postal,$StrServicio,$intTelefono,$FileArchivo,
                                        $StrEnvio_Correo,$StrDetalle,$StrTipo);
            

            
        }

        if(isset($_POST['UserLogin'])){
            $User=empty($_POST['UserName'])?" ": $_POST['UserName'];
            $UserPass=empty($_POST['UserPass'])?" ":$_POST['UserPass'];

            $Controller_Users->BuscarUsuario($User,$UserPass);
        }

        if(isset($_POST['IsViewBien'])){
            $TipoBien=empty($_POST['TipoBien'])?" ":$_POST['TipoBien'];
           

             
              
            $Controller_Producto->ListadoBienes($TipoBien,$_POST['Busqueda']);
        }

        if(isset($_POST['Actualizar'])){
                $StrNewName=empty($_POST['txtUsuario'])?"NULL":$_POST['txtUsuario'];
                $StrCorreo=empty($_POST['txtCorreo'])?"NULL":$_POST['txtCorreo'];
                $StrNewUser=empty($_POST['Usuario'])?"NULL":$_POST['Usuario'];
                $StrNewPass=empty($_POST['Pass'])?"NULL":$_POST['Pass'];
                $StrNewMensaje=empty($_POST['txtMensaje'])?"NULL":$_POST['txtMensaje'];

                $Contador=$Controller_Users->ActualizarDatos($StrNewName,$StrCorreo,$StrNewUser,$StrNewPass,$StrNewMensaje);

                echo  "<input type='hidden' id='AlertaBanner' value='$Contador'>";

                echo "<script>
                var Alerta = document.getElementById('AlertaBanner');
    
                alert(Alerta.value);
                </script>";    
    
                ?>
                    <script>
                        window.location.href="../index.php";
                    </script>
                <?php

        }

        if(isset($_POST['AddBanner'])){
              
            $StrTitulo=empty($_POST['txtTitulo'])?"Sin titulo":$_POST['txtTitulo'];
            $StrDescripcion=empty($_POST['txtMensaje'])?"Sin Descripcion":$_POST['txtMensaje'];
            $BlogImagen=$_FILES['ImagenBanner'];
            $boolResultado=$Controller_Producto->CrearBanner($StrTitulo,$StrDescripcion,$BlogImagen);

            echo  "<input type='hidden' id='AlertaBanner' value='$boolResultado'>";

            echo "<script>
            var Alerta = document.getElementById('AlertaBanner');

            alert(Alerta.value);
            </script>";    

            ?>
                <script>
                    window.location.href="../Categorias.php?Venta=true";
                </script>
            <?php

        }

        if(isset($_POST['Recuperar'])){

           $StrEmail=isset($_POST['Correo'])?$_POST['Correo']:" "; 
           
            $Correo=$Controller->FormularioOlvido($StrEmail);

            ?>
                <script>
                    window.location.href="../login.php";
                </script>
            <?php

        }

        if(isset($_POST['AyudaAlCliente'])){
            $StrTipoPeticion=$_POST['Tipoayuda'];

            $Controller->contenidoDinamico($StrTipoPeticion);
        }
    }