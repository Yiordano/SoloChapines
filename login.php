<?php
include ("View/mainview.php");

$sitio= new sitio();

$sitio->header();

?>

<main>
    <section id="Login">
        <article class='encabezado'>
            <h3>Logearse</h3>
        </article>
        <div class="Contenido">
         
        <div id="formularioLogin">
        <form >
                    <div class="form-group">
                        <label for="Titulo">Usuario</label>
                        <input
                            type="text"
                            class="form-control"
                            id="TxtUsuario"
                            placeholder="Usuario"
                            >
                    </div>
                    <div class="form-group">
                            <label for="Titulo">password</label>
                            <input
                            type="password"
                            class="form-control"
                            id="TxtPassword"
                            placeholder="password">
                    </div>
                

               
                <button type="button" class="btn btn-primary" id='LoginUsuario'>Ingresar</button>
                <div class="" role="alert" id='MensajeAlerta'>
                    
                </div>
            </form>
        </div>
            <div class="row1">
                    <div class="col">
                        <a href="register.php">Registro</a>
                    </div>
                    <div class="col">
                        <p id='recuperarContra'>Recuperar Contrase;a</p>
                    </div>
                
                </div>
        </div>

    </section>
</main>

<?php
$sitio->footer();

?>