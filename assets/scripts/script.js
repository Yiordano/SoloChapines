var registro = document.getElementById("Registro");

var listaservicios = document.getElementById("listService");
var MostrarpassBa = document.getElementById("MostrarPassB");

var Login = document.getElementById("Login");


var boolEstado = false;
var Opcion = "";


function MostrarPassword(Componente) {


    if (boolEstado) {
        Componente.type = 'password';
        boolEstado = false;
    } else {
        Componente.type = 'text';
        boolEstado = true;
    }
}

function EliminarContenido(Contenedor) {
    while (Contenedor.firstChild) {
        Contenedor.removeChild(Contenedor.firstChild);
    }
}

if (botonPublico) {
    botonPublico.addEventListener("click", (obj) => {
        $('.top').slideToggle(250);
    });
}

if (MostrarpassBa) {
    MostrarPassB.addEventListener("click", (MostrarPassB) => {
        MostrarPassword(txtPassword);
    });
}


if (Login) {
    Login.addEventListener("click", (obj) => {


        if (obj.target.id == "LoginUsuario") {
            var datos = new FormData();
            datos.append("UserName", TxtUsuario.value);
            datos.append("UserPass", TxtPassword.value);
            datos.append("UserLogin", true);

            fetch("controller/peticiones.php", {
                method: "POST",
                body: datos
            })

            .then(function(response) {
                return response.text();
            })

            .then(function(texto) {
                if (texto == "Hemos iniciado sesion por ti") {
                    alert("Inicion de sesion Exitosa");
                    window.location.href = "index.php";
                } else {
                    alert("Ingresaste mal alguna credencial");
                }
            })
        };

        if (obj.target.id == "recuperarContra") {

            var datos = new FormData();
            datos.append("Recuperar", true);
            fetch("controller/peticiones.php", {
                    method: "POST",
                    body: datos
                })
                .then(function(response) {
                    return response.text();
                })
                .then(function(texto) {
                    formularioLogin.innerHTML = texto;
                    recuperarContra.innerHTML = "<a href='login.php'> login</a>";
                })

        }
    });
}

if (registro) {

    var datos = new FormData();
    datos.append("BuscarEstados", true);



    registro.addEventListener('click', (obj) => {
        var encabezado = document.getElementById("encabezado");
        const mensaje = document.createElement("h3");



        if (obj.target.id == "RegistroVendedor" || obj.target.id == "RegistroComprador" || obj.target.id == "RegistroCliente") {

            var datos = new FormData();

            console.log(obj.target.id);

            while (encabezado.firstChild) {
                encabezado.removeChild(encabezado.firstChild);
            }

            MensajeAlerta.innerHTML = " ";

            switch (obj.target.id) {
                case "RegistroVendedor":
                    mensaje.innerText = "Registro para venta Bienes";
                    Opcion = "Bienes"
                    break;
                case "RegistroComprador":
                    mensaje.innerText = "Registro para oferta de  Servicios";
                    Opcion = "Servicios"
                    break;


            }







            datos.append("TipoServicio", Opcion);
            datos.append("RegistroCiudadano", true);

            encabezado.appendChild(mensaje);

            EliminarContenido(Contenido);
            fetch("controller/peticiones.php", {
                method: "POST",
                body: datos
            })

            .then(function(response) {
                    return response.text();
                })
                .then(function(texto) {
                    const contenidObjeto = document.createElement("div");
                    contenidObjeto.innerHTML = texto;
                    contenidObjeto.style.width = "100%";

                    Contenido.appendChild(contenidObjeto);







                })






        }


        if (obj.target.id == "RegistroUsuario") {
            /*Objetos*/
            var servicios = document.querySelectorAll('[id=TipoBien]');
            var serviciosEntrega = document.querySelectorAll('[id=TipoEntrega]');
            /*Variables*/

            var NombreEmpresa = txtNombre;
            var StrCorreo = txtCorreo;
            var Strusuario = txtUsuario;
            var StrContra = txtPassword;
            var localidad = IdEstados;
            var IntCodigo = CodigoPostal;
            var ContenidoServicios = "";
            var IntTelefono = NumeroTelefono;
            var imagen = ImagenPerfil;
            var EntregaServicios = "";
            var StrDetalles = txtMensaje;



            for (var x = 0; x < servicios.length; x++) {
                if (servicios[x].checked) {
                    if (x == 0) {
                        ContenidoServicios = ContenidoServicios + servicios[x].value;
                    } else {
                        ContenidoServicios = ContenidoServicios + "-" + servicios[x].value;
                    }
                }
            }

            if (serviciosEntrega) {
                for (var x = 0; x < serviciosEntrega.length; x++) {
                    if (serviciosEntrega[x].checked) {
                        if (x == 0) {
                            EntregaServicios = EntregaServicios + serviciosEntrega[x].value;
                        } else {
                            EntregaServicios = EntregaServicios + "-" + serviciosEntrega[x].value;
                        }
                    }
                }
            } else {
                EntregaServicios = "none";
            }






            var datos = new FormData();
            datos.append("Nombre", NombreEmpresa.value);
            datos.append("Correo", StrCorreo.value);
            datos.append("Usuario", Strusuario.value);
            datos.append("Pass", StrContra.value);
            datos.append("localidad", localidad.value);
            datos.append("CodigoPostal", IntCodigo.value);
            datos.append("TipoService", ContenidoServicios);
            datos.append("Telefono", IntTelefono.value);
            datos.append("Imagen", imagen.files[0]);
            datos.append("EnviosCorreo", EntregaServicios);
            datos.append("Detalles", StrDetalles.value);
            datos.append("Venta", Opcion);



            datos.append("RegistroU", true);

            while (MensajeAlerta.firstChild) {
                MensajeAlerta.removeChild(MensajeAlerta.firstChild);
            }

            fetch("controller/peticiones.php", {
                    method: "POST",
                    body: datos
                })
                .then(function(response) {
                    return response.text();
                })
                .then(function(texto) {

                    dialogemergente.innerHTML = texto;


                    $("#dialogemergente").dialog({
                        modal: true,
                        buttons: {
                            Ok: function() {
                                $(this).dialog("close");
                                if (texto == "Hemos iniciado sesion por ti") {
                                    window.location.href = "index.php";
                                }
                            }
                        }
                    });









                })







        }

        if (obj.target.id == "MostrarPass") {


            if (!boolEstado) {
                txtPassword.type = "text";
                boolEstado = true;
            } else {
                txtPassword.type = "password";
                boolEstado = false;
            }
        }

    });

    registro.addEventListener('change', (obj) => {

        if (obj.target.id == "CodigoPostal") {
            IdEstado.value = "---";
            IdCiudad.value = "---";
            var datos = new FormData();
            datos.append("Codigo", obj.target.value);
            datos.append("FindCiudadEstado", true);

            fetch("controller/peticiones.php", {
                    method: "POST",
                    body: datos
                })
                .then(function(response) {
                    return response.text();
                })
                .then(function(texto) {
                    var lugares = texto.split('_');



                    if (lugares.length > 1) {

                        IdEstado.value = lugares[0];
                        IdCiudad.value = lugares[1];
                    } else {
                        IdEstado.value = "---";
                        IdCiudad.value = "---";
                    }




                });
        }
    });

}

if (top) {
    top.addEventListener("click", (obj) => {
        var datos = new FormData();

        if (obj.target.id == "ServicioCLiente" || obj.target.id == "ContactoyAyuda" || obj.target.id == "SoporteTecnico") {
            datos.append("AyudaAlCliente", true);

            switch (obj.target.id) {
                case "ServicioCLiente":
                    datos.append("Tipoayuda", "Servicio");
                    break;
                case "ContactoyAyuda":
                    datos.append("Tipoayuda", "Contacto");
                    break;
                case "SoporteTecnico":
                    datos.append("Tipoayuda", "Soporte");
                    break;


            }

            fetch("controller/peticiones.php", {
                method: "POST",
                body: datos
            })

            .then(function(response) {
                return response.text();
            })

            .then(function(texto) {
                dialogo.innerHTML = texto;
                $("#dialogo").dialog({
                    width: 350


                });
            })

        }



    })
}

if (listaservicios) {

    listaservicios.addEventListener('change', (obj) => {



        var datos = new FormData();
        datos.append("TipoBien", obj.target.value);
        datos.append("IsViewBien", true);
        switch (obj.target.id) {
            case "SelectService":
                datos.append("Busqueda", "Servicios");
                break;
            case "SelectBien":
                datos.append("Busqueda", "Bienes");
                break;
        }

        fetch("controller/peticiones.php", {
            method: "POST",
            body: datos
        })

        .then(function(response) {
            return response.text();
        })

        .then(function(texto) {
            Resultado.innerHTML = texto;
        })




    });
}