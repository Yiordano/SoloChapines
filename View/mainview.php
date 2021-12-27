<?php
class sitio{
    public function header(){
        session_start();
        ?>
          <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Solo chapines</title>



                    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
                    <link
                        rel="stylesheet"
                        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
                        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
                        crossorigin="anonymous"> 

                    <link rel="stylesheet" href="assets/Estilos/Styles.css">
                </head>
                
                <body>

                        <header id='Header'>

                        <nav class='ImagenRedes'>
                            
                                <ul>
                                    <li><h1>Solo Chapines</h1></li>
                                    
                                    <li id='Complementos'>
                                        <nav>
                                            <ul>
                                                

                                                <?php
                                                        if(isset($_SESSION['UserId'])){
                                                                ?>
                                                                    <li>
                                                                        <a href="adm_perfil.php">
                                                                        <b>Bienvenido:
                                                                        </b><?php echo $_SESSION['UserName'] ?></a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="end.php">
                                                                            salir
                                                                        </a>
                                                                    </li>
                                                                <?php

                                                        }else{
                                                            ?>
                                                                <li>
                                                                    <a href="login.php">Inicia sesion</a>
                                                                    o
                                                                    <a href="register.php">registrate</a>
                                                                </li>
                                                            <?php
                                                        }
                                                ?>
                                                
                                            </ul>
                                        </nav>
                                    </li>

                                    
                                </ul>
                                
                                <ul>
                                <li> <p id='botonPublico'>&#8801;</p></li>
                                </ul>
                            
                        </nav>
                        <nav class='top' id='top'>
                                <ul>
                                    <li >
                                        <nav >
                                            <ul>
                                                <li>
                                                    <a href="index.php">Inicio</a>

                                                </li>
                                                <li id='ServicioCLiente'>
                                                    Servicio al cliente
                                                </li>

                                                <li id='ContactoyAyuda'>
                                                    Ayuda y contacto
                                                </li>
                                                <li id='SoporteTecnico'>
                                                    Soporte tecnico
                                                </li>
                                                <li><a href="Categorias.php?Venta=true">Promociona tus servicios</a></li>
                                            </ul>
                                        </nav>

                                    </li>
                                    <li>
                                        <nav>
                                            <ul>
                                                <li><a href="">Facebook</a></li>
                                                <li><a href="">Twitter</a></li>
                                                <li><a href="">Instagram</a></li>
                                               
                                                <li><a href="https://api.whatsapp.com/send?text=Visita%20el%20sitio%20web%20solochapines%20en%20https:solochapines.com/">Compartir</a></li>
                                            </ul>
                                        </nav>
                                    </li>
                                    
                                </ul>
                            </nav>
                           

                        <nav class='middle'>
                                <ul>

                                    <li id='finder'>
                                        <form method="POST" action="Productos.php">
                                            <div class="input-group mb-3">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    placeholder="Buscar Articulos"
                                                    aria-describedby="basic-addon2" name="TextoBusqueda" minlength="3" required
                                                >
                                                    
                                                    <select class="form-select" aria-label="Default select example" name="Categorias" id='SelectCategory'>
                                                        <option selected="selected" value="None" >Categorias</option>
                                                        <option value="Bienes">Bienes</option>
                                                        <option value="Servicios">Servicios</option>

                                                    </select>   
                                                <div class="input-group-append" style='padding-left:5px'>
                                                    <button class="btn  btn-dark" type="submit">Buscar</button>
                                                </div>
                                                
                                            </div>

                                        </form>
                                    </li>

                                   
                                </ul>
                        </nav>
                           <div id="dialogo" style='display:none'>
                               
                           </div>
                        </header>

        <?php
    }


    public function footer(){
        ?>
            </body>
            <script src="assets/scripts/script.js"></script>
            </html>
        <?php
    }

    public function TipoProductos($StrServicios){
        
        if($StrServicios=="Bienes"){
            ?>
                <form >

                    <div class="form-group">
                        <label for="txtUsuario">Nombre de tu negocio</label>
                        <input
                            type="text"
                            class="form-control"
                            id="txtNombre"
                            placeholder="Nombre"
                            name="txtUsuario">
                    </div>
                    <div class="form-group">
                        <label for="txtCorreo">Correo electronico</label>
                        <input
                            type="email"
                            class="form-control"
                            id="txtCorreo"
                            name="txtCorreo"
                            placeholder="name@example.com">
                    </div>

                    <div class="form-group">
                        <label for="Titulo">Usuario</label>
                        <input
                            type="text"
                            class="form-control"
                            id="txtUsuario"
                            placeholder="Usuario"
                            min="1">
                    </div>
                    <div class="form-group">
                        <label for="Titulo">Contraseña</label>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="MostrarPass">Mostrar Contraseña</button>
                            </div>
                            <input
                                type="password"
                                class="form-control"
                                id="txtPassword"
                                placeholder="Contraseña">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">En donde te encuentras</label>
                        <select class="form-control" id="IdEstados" name="Categorias">
                            <option value='NI'>---</option>
                            <option value='USA'>Usa</option>
                            <option value='EUROPA'>Europa</option>
                            <option value='CANADA'>Canada</option>
                            <option value='ASIA'>Asia</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Titulo">Codigo Postal</label>
                        <input
                            type="number"
                            class="form-control"
                            id="CodigoPostal"
                            placeholder="---"
                            min="1">
                    </div>

                    <div class="row">

                        <div class="col">
                            <label for="Titulo">Estado</label>
                            <input
                                type="text"
                                class="form-control"
                                id="IdEstado"
                                placeholder="---"
                                disabled="disabled">
                        </div>

                        <div class="col">
                            <label for="exampleFormControlFile1">
                                Ciudad
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="IdCiudad"
                                placeholder="---"
                                disabled="disabled">
                        </div>

                    </div>

                    <div class="mb-3">
                        <div class="encabezado">
                            <label for="txtMensaje" class="form-label">Que deseas vender</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="TipoBien" value="Comida">
                            <label class="form-check-label" for="inlineCheckbox1">Comida tipica guatemalteca</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="TipoBien"
                                value="Artesanias">
                            <label class="form-check-label" for="inlineCheckbox2">artesania guatemalteca</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="TipoBien" value="Dulces">
                            <label class="form-check-label" for="inlineCheckbox2">dulces tipicos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="TipoBien" value="Ropa">
                            <label class="form-check-label" for="inlineCheckbox2">ropa tipica</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="TipoBien" value="Otros">
                            <label class="form-check-label" for="inlineCheckbox2">otros productos guatemaltecos</label>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <label for="Titulo">Tu numero telefonico (incluye el codigo de area).</label>
                            <input
                                type="number"
                                class="form-control"
                                id="NumeroTelefono"
                                placeholder="---"
                                min="0">

                        </div>

                        <div class="col">
                            <label for="exampleFormControlFile1">
                                Agrega la foto para promocionar tu negocio
                            </label>
                            <input
                                type="file"
                                id='ImagenPerfil'
                                accept=".jpg, .jpeg, .png"
                                class="form-control-file">
                             <small  class="form-text text-muted">La imagen que coloques podra ser visualizada por otras personas</small>
                        </div>

                    </div>
                    <div class="mb-3">
                        <div class="encabezado">
                            <label for="txtMensaje" class="form-label">Como entregas los productos a tus clientes(Puedes seleccionar mas de 1)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="TipoEntrega" value="Local">
                            <label class="form-check-label" for="inlineCheckbox1">Local abierto al publico</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="TipoEntrega"
                                value="Domicilio">
                            <label class="form-check-label" for="inlineCheckbox2">Entrega a domicilio</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="TipoEntrega"
                                value="USPS,FEDEX,UPS">
                            <label class="form-check-label" for="inlineCheckbox2">Por correo (USPS, Fedex, UPS)</label>
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="txtMensaje" class="form-label">Detalla los servicios que prestas</label>
                        <textarea class="form-control" id="txtMensaje" rows="3" name="txtMensaje"></textarea>
                    </div>

                    <button type="button" class="btn btn-primary" id='RegistroUsuario'>Registrarse</button>

                </form>

            <?php
        }else{
         ?>

            <form >

                <div class="form-group">
                    <label for="txtUsuario">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        id="txtNombre"
                        placeholder="Nombre"
                        name="txtUsuario">
                </div>
                <div class="form-group">
                    <label for="txtCorreo">Correo electronico</label>
                    <input
                        type="email"
                        class="form-control"
                        id="txtCorreo"
                        name="txtCorreo"
                        placeholder="name@example.com">
                </div>

                <div class="form-group">
                    <label for="Titulo">Usuario</label>
                    <input
                        type="text"
                        class="form-control"
                        id="txtUsuario"
                        placeholder="Usuario"
                        min="1">
                </div>
                <div class="form-group">
                    <label for="Titulo">Contraseña</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" id="MostrarPass">Mostrar Contraseña</button>
                        </div>
                        <input
                            type="password"
                            class="form-control"
                            id="txtPassword"
                            placeholder="Contraseña">
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlSelect1">En donde te encuentras</label>
                    <select class="form-control" id="IdEstados" name="Categorias">
                        <option value='NI'>---</option>
                        <option value='USA'>Usa</option>
                        <option value='EUROPA'>Europa</option>
                        <option value='CANADA'>Canada</option>
                        <option value='ASIA'>Asia</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="Titulo">Codigo Postal</label>
                    <input
                        type="number"
                        class="form-control"
                        id="CodigoPostal"
                        placeholder="---"
                        min="1">
                </div>

                <div class="row">

                    <div class="col">
                        <label for="Titulo">Estado</label>
                        <input
                            type="text"
                            class="form-control"
                            id="IdEstado"
                            placeholder="---"
                            disabled="disabled">
                    </div>

                    <div class="col">
                        <label for="exampleFormControlFile1">
                            Ciudad
                        </label>
                        <input
                            type="text"
                            class="form-control"
                            id="IdCiudad"
                            placeholder="---"
                            disabled="disabled">
                    </div>

                </div>

                <div class="mb-3">
                    <div class="encabezado">
                        <label for="txtMensaje" class="form-label">Que Servicios Brindas</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="TipoBien" value="handy">
                        <label class="form-check-label" for="inlineCheckbox1">HandyMan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="TipoBien"
                            value="jardinero">
                        <label class="form-check-label" for="inlineCheckbox2">Jardinero</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="TipoBien" value="Albanil">
                        <label class="form-check-label" for="inlineCheckbox2">Alba;ileria</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="TipoBien" value="Electricista">
                        <label class="form-check-label" for="inlineCheckbox2">Electricista</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="TipoBien" value="Otros">
                        <label class="form-check-label" for="inlineCheckbox2">Otros</label>
                    </div>
                </div>

                <div class="row">

                    <div class="col">
                        <label for="Titulo">Tu numero telefonico (incluye el codigo de area).</label>
                        <input
                            type="number"
                            class="form-control"
                            id="NumeroTelefono"
                            placeholder="---"
                            min="0">

                    </div>

                    <div class="col">
                        <label for="exampleFormControlFile1">
                            Agrega la foto para promocionar tu negocio
                        </label>
                        <input
                            type="file"
                            id='ImagenPerfil'
                            accept=".jpg, .jpeg, .png"
                            class="form-control-file">
                        <small  class="form-text text-muted">La imagen que coloques podra ser visualizada por otras personas</small>
                    </div>

                </div>
                

                <div class="mb-3">
                    <label for="txtMensaje" class="form-label">Detalla los servicios que prestas</label>
                    <textarea class="form-control" id="txtMensaje" rows="3" name="txtMensaje"></textarea>
                </div>

                <button type="button" class="btn btn-primary" id='RegistroUsuario'>Registrarse</button>

            </form>
         <?php
        }
    }

    public function ColocarTexto($StrTipo){
        ?>
        <article class='encabezado'>
            <h4><?php echo $StrTipo; ?></h4>
        </article>
        <?php
    }

    public function TipoBienes($Ciudad,$NumeroTelefono,$Detalle,$EnvioCorreo,$NombreEmpresa,$urlImagen,$Servicio,$intIdCodigo,$StrTypeOf){
        ?>
        
        <article id="topic">
                                
           
                <div class="imagen">
                   <img src="<?php echo $urlImagen; ?>" alt="">
                </div>
                <div class="text">
                    <nav>
                        <ul>
                            <li>Nombre de empresa o persona individual:
                                <nav>
                                    <ul>
                                        <li><?php echo $NombreEmpresa ?></li>
                                    </ul>
                                </nav>
                            </li>
                            <li>Ciudad:
                                <nav>
                                    <ul>
                                        <li><?php echo $Ciudad ?></li>
                                    </ul>
                                </nav>
                            </li>
                            <li>Numero de telefono:
                                <nav>
                                    <ul>
                                        <li><?php echo $NumeroTelefono ?></li>
                                    </ul>
                                </nav>
                            </li>
                            <li>Tipos de envio:
                                <nav>
                                    <ul>
                                        <li><?php echo $EnvioCorreo ?></li>
                                    </ul>
                                </nav>
                            </li>
                             <li>Categorias:
                                <nav>
                                    <ul>
                                        <li><?php echo $Servicio ?></li>
                                    </ul>
                                </nav>
                            </li>
                            <li>Detalle:
                            <nav>
                                    <ul>
                                        <li><?php echo $Detalle ?></li>
                                    </ul>
                                </nav>
                            </li>
                            <li>Contactar:
                                <nav>
                                    <ul>
                                        <li><a href="Contacto.php?id=<?php echo $intIdCodigo ?>">Ver Volantes</a></li>
                                    </ul>
                                </nav>
                            </li>
                        </ul>
                    </nav>    
                </div>
               
            </article>
        <?php
    }

    public function ActualizarPerfil($StrNombre,$StrCorreo,$StrUser,$StrPass,$StrDetalle,$StrServicio,$StrEnvioCorreo,$StrTipoCliente){
        ?>
        <small class="form-text text-muted">Puedes obtener otro tipo de beneficios mas info <a href="">Aqui</a></small>
            <form method="POST" action="controller/peticiones.php" >

                    <div class="form-group">
                        <label for="txtUsuario">Nombre</label>
                        <input
                                type="text"
                                class="form-control"
                                id="txtNombre"
                                placeholder="Nombre"
                                name="txtUsuario" required value="<?php echo $StrNombre ?>" maxlength="10">
                                
                    </div>
                    <div class="form-group">
                        <label for="txtCorreo">Correo electronico</label>
                        <input
                            type="email"
                            class="form-control"
                            id="txtCorreo"
                            name="txtCorreo"
                            placeholder="name@example.com" required value="<?php echo $StrCorreo ?>">
                    </div>

                    <input type="hidden" name='Actualizar'>

                    <div class="form-group">
                        <label for="Titulo">Usuario</label>
                        <input
                            type="text"
                            class="form-control"
                            id="txtUsuario"
                            placeholder="Usuario" name="Usuario"
                            required maxlength="8" minlength="8" value="<?php echo $StrUser ?>">
                    </div>
                    <div class="form-group">
                        <label for="Titulo">Contraseña</label>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="MostrarPassB">Mostrar Contraseña</button>
                            </div>
                            <input
                                type="password"
                                class="form-control"
                                id="txtPassword"
                                placeholder="Contraseña" require maxlength="8" minlength="8" name="Pass" required value="<?php echo $StrPass ?>">
                        </div>
                    </div>

                  

                    
                   
                   
                    


                    <div class="mb-3">
                        <label for="txtMensaje" class="form-label">Detalla los servicios que prestas</label>
                        <textarea class="form-control" id="txtMensaje" rows="3" name="txtMensaje" required><?php echo $StrDetalle ?></textarea>
                        
                    </div>

                    <button type="submit" class="btn btn-primary" id='ActualizarDatos'>Actualizar</button>

            </form>

        <?php
    }

    public function CrearBanner(){
        ?> 
            <div class='Contenido'>
                <article>
                    <form method="POST" action="controller/peticiones.php" enctype = "multipart/form-data">
                        <div class="form-group">
                            <label for="txtUsuario">Titulo</label>
                            <input
                                type="text"
                                class="form-control"
                                id="txtTitulo"
                                placeholder="Titulo"
                                name="txtTitulo"
                                required="required">
                        </div>
                        <div class="row">

                            <div class="col">
                                <label for="exampleFormControlFile1">
                                    Agrega la foto para el banner tu negocio
                                </label>
                                <input
                                    type="file"
                                    id='ImagenPerfil'
                                    accept=".jpg, .jpeg, .png"
                                    class="form-control-file" name='ImagenBanner' required>
                                    <small  class="form-text text-muted">La imagen que coloques podra ser visualizada por otras personas</small>
                            </div>
                                <input type="hidden" name='AddBanner'>
                        </div>
                        <div class="form-group">
                           
                            <label for="txtMensaje" class="form-label">Describe el producto que estas promocionando</label>
                            <textarea class="form-control" id="txtMensaje" rows="3" name="txtMensaje" required name='txtMensaje'></textarea>
                            <small  class="form-text text-muted">Recuerda agregar informacion como precio, cantidad</small>
                        </div>
                        <button type="submit" class="btn btn-primary" id='AddBanner'>Agregar Banner</button>
                    </form>
                </article>
            </div>
        <?php
    }

    public function PromocionarBanner($StrUrl,$IntId,$StrDescripcion,$StrTitulo,$StrCiudad,$StrTipoServicio){
        $StrResto=$IntId!=""?

        " <li><b>Nombre de la empresa: </b>$StrTitulo</li>
        <li><b>Detalles de los servicios: </b>$StrDescripcion</li>
        <li><b>Ciudad y Estado:</b> $StrCiudad</li> 
        <li><button class='btn  btn-dark'  type='button'><a href='Contacto.php?Id=$IntId '>Ver mas Informacion</a></button></li>"
        :
        "
        <li><button class='btn  btn-dark'  type='button'><a href='Productos.php?type=$StrTipoServicio'>Ver mas</a></button></li>";

        $imagenAImprimir=$StrTipoServicio.".jpg";
        $Imagen=$IntId!=""?$StrUrl:"assets/img/servidor/Servicios/$imagenAImprimir";
        ?>
              <article id="topic">
                  

                 <div class="Imagen">
                    <img src="<?php echo $Imagen; ?>" alt="">
                   
                 </div>

                 <div class="texto">
                    <nav>
                        <ul>
                           
                           
                            <?php echo  $StrResto ?>
                           
                        </ul>
                    </nav>
                 </div>
           </article>
        <?php
    }

    public function ColocarbannerFormulario(){
        ?>
            <div class="formularioPedido">
            <form >
                    
                <?php
                $StrContenido=isset($_SESSION['UserId'])?
                "<button type='button' class='btn btn-primary' id='ContactarVendedor'>Contactar al vendedor</button>"
                :
                "<div class='alert alert-danger' role='alert' >
                        Para comunicarte con el usuario y gozar de otras funciones de este sitio, te recomendamos que inicies sesion, si no tienes usuario
                        puedes crear uno completamente gratis <a href='register.php'>Aqui</a>
                </div>";
                ?>
                    
                <?php
                echo $StrContenido;
                ?>
              
            </form>
            </div>
        <?php
    }

    public function formularioOlvido(){
        ?>
            <form action="controller/peticiones.php" method="POST">
                <div class="form-group">
                        <label for="txtCorreo">Correo electronico</label>
                        <input
                            type="email"
                            class="form-control"
                            id="txtCorreo"
                            name="Correo"
                            placeholder="name@example.com" required >
                            <input type="hidden" name='Recuperar'>
                </div>
                <button class='btn  btn-dark'  type='submit'>Recuperar</button>
            </form>
        <?php
    }

    public function Contacto(){
        ?>
            <form action="">
                
                <div class="mb-3">
                    <label for="txtNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="txtNombre" placeholder="Nombre">
                </div>
                <div class="mb-3">
                    <label for="txtCorreo" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="txtCorreo" placeholder="Correo electronico">
                </div>
                            
                <div class="mb-3" >
                    <label for="txtMensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="txtMensaje" rows="3" placeholder="Mensaje"></textarea>
                </div>

                <small  class="form-text text-muted">envianos un mensaje con tus dudas te responderemos de inmediato</small>
                <button type="submit" class="btn btn-primary">Contactanos</button>
            </form>
        <?php
    }

    public function Servicio(){
        ?>
                lamentamos los incovenientes aun estamos desarrollando esta funcion, trabajamos duro para brindarte la mejor experiencia
        <?php
    }
}
?>