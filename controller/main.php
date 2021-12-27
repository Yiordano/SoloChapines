<?php
    if(file_exists("../modelo/modelo.php")){
        include("../modelo/modelo.php");
        include("../View/mainview.php");
    }else{
        include("modelo/modelo.php");
       
    }
    
    
    

    class Controller_Sitio{

        public function BuscarCiudad($StrState){
            $Modelo_Sitio= new Modelo_Sitio();

            $StrCities=$Modelo_Sitio->BuscarCiudad($StrState);
            $array= array();
        
            foreach($StrCities as $cities){
                $array[0]=$cities[0]."_".$cities[1];
            
                
            }


            if(sizeof($array)>0){
            echo $array[0];
            }else{
                echo $array[0]=" "."-";
            }
            
        

            
        }

        public function GenerarPass(){
            $abecedario="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnoppqrstuvwxyz";
            $caracter="#@$0123456789";

            $pass="";

            for($IntInicio=0;$IntInicio<8;$IntInicio++){
                if($IntInicio<8){
                    if($IntInicio%2==0){
                        $IntLetra=rand(0,strlen($abecedario)-1);
                        $pass=$pass.$abecedario[$IntLetra];
                    }else{
                        if($IntInicio==3 || $IntInicio==5){
                            $IntCodigo=rand(0,strlen($caracter)-1);
                            $pass=$pass.$caracter[$IntCodigo];
                        }else if($IntInicio!=3 || $IntInicio!=5){
                            $IntCodigo=rand(0,strlen($caracter)-1);
                            $pass=$pass.$abecedario[$IntCodigo];  
                        }  
                    }
                    
                    
                }
            }
            return str_shuffle($pass);
        }

        public function Crear_Directorios($archivo,$strUrl){
            /*$imagen_optimizada=$this->redimensionar_imagen($archivo['name'],$strUrl."/".$archivo['name'],360,360);

            imagejpeg($imagen_optimizada, $strUrl.$archivo['name']);*/
        
           if(!file_exists($strUrl)){
                mkdir($strUrl,0700);
                move_uploaded_file($archivo['tmp_name'],$strUrl.$archivo['name']);           
            }else{
                move_uploaded_file($archivo['tmp_name'],$strUrl.$archivo['name']);                
            }

            
           
        }

        public function ContenidoRegistro($StrTipo){
            $View_Sitio= new sitio(); 
            $View_Sitio->TipoProductos($StrTipo);
        }

        public function HoraHoy($intlargoCantidad){
            date_default_timezone_set('America/Guatemala');
        

            if($intlargoCantidad>4){
                return date("d/m/Y H:i D");
            }
                return date("Y/m/d-D");
            
        }

        public function error404(){
            header("location:index.php");
        }

        public function enviarCorreo($StrCorreo,$StrContenido){
            $headers = "Content-Type: text/html; charset=UTF-8\r\n";


            try{
                mail($StrCorreo,"Extravio de datos",$StrContenido,$headers);
                return "Hemos enviado tus credenciales a tu correo";
            }
            catch(Exception $e){
                return "Error al enviar al enviar";
            }
        }

        public function FormularioOlvido($StrCorreo){
            if($StrCorreo!=" "){
                $Modelo_User= new Modelo_User();
                $BoolRecuperar=$Modelo_User->recuperarPass($StrCorreo);

                $var=0;
                $array=array();
                foreach($BoolRecuperar as $DatosRecuperados){
                    $array[$var]=$DatosRecuperados;
                    $var=$var+1;
                }

               if(sizeof($array)>0){
                $StrMensaje="<b>Estimado:</b>"." ". $array[0]['NombreEmpresa']." "."Gracias por escribirnos"."<br>".
                "acabamos de recibir una solicitud para enviarte tus credenciales, por favor actualiza tus datos desde tu perfil"."<br>".
                "<b>Usuario:</b>".$array[0]['Usuario']."<br>".
                "<b>password:</b>".$array[0]['Contra']."<br>";

                $this->enviarCorreo($StrCorreo,$StrMensaje);
               }else{
                return "No encontramos tu correo";
               }

            }else{
                $View_Sitio= new sitio(); 
                $View_Sitio->formularioOlvido();
            }
        }

        public function ContarObjetos($StrNombreObjeto,$StrTabla,$StrColumna){
            $Modelo_Sitio= new Modelo_Sitio();
            $ResultConteo=$Modelo_Sitio->ContarObjetos($StrNombreObjeto,$StrTabla,$StrColumna);
           
            $IntCantidad=0;
            foreach($ResultConteo as $Conteo){
                $IntCantidad=$Conteo[0];
            }
            return $IntCantidad;
        }

        public function contenidoDinamico($StrTipo){
            $View_Sitio= new sitio(); 
           
            switch($StrTipo){
                case "Servicio":
                    $View_Sitio->servicio();
                    break;
                    case "Contacto":
                        $View_Sitio->contacto();
                        break;
                        case "Soporte":
                            $View_Sitio->servicio();
                            break;
                          
            }

        }

        public function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax){  
            
    
            $ext = explode(".", $nombreimg);  
            $ext = $ext[count($ext)-1];  
          
            if($ext == "jpg" || $ext == "jpeg")  
                $imagen = imagecreatefromjpeg($rutaimg);  
            elseif($ext == "png")  
                $imagen = imagecreatefrompng($rutaimg);  
            elseif($ext == "gif")  
                $imagen = imagecreatefromgif($rutaimg);  
              
            $x = imagesx($imagen);  
            $y = imagesy($imagen);  
              
            if($x <= $xmax && $y <= $ymax){
               
                return $imagen;  
            }
          
            if($x >= $y) {  
                $nuevax = $xmax;  
                $nuevay = $nuevax * $y / $x;  
            }  
            else {  
                $nuevay = $ymax;  
                $nuevax = $x / $y * $nuevay;  
            }  
              
            $img2 = imagecreatetruecolor($nuevax, $nuevay);  
            imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);  
          
            return $img2;   
        }

        

        

    }


    class Controller_User extends Controller_Sitio{

        public function Registro($StrNombre,$StrCorreo,$StrUser,$StrPass,$Strlocalidad,$intCodigo_Postal,$StrServicio,$intTelefono,$FileArchivo,$StrEnvio_Correo,$StrDetalle,$StrTipo){

            $CodigosError=array();
            $CodigosError[0]="";
            $CodigoAlerta[0]="";
            $boolEstado=true;

            
            if(is_array($FileArchivo)){
                if($FileArchivo['size']>256000){
                    $CodigosError[0]="La imagen es muy grande <br>";
                
                }else{
                    
                    $Utilidades= new Controller_Sitio();
                    $RutaPagina="assets/img/servidor/Perfil/";
                    $RutaDirectorio = $_SERVER['DOCUMENT_ROOT']."/service&Product".'/'.$RutaPagina;
                    $RutaServidor=$RutaPagina.$FileArchivo['name'];
                    $Utilidades= new Controller_Sitio();
                    $Modelo_User=new Modelo_User();
                    
                   
                        
                    if(sizeof(explode('@',$StrCorreo))<2){
                            $CodigosError[0]="Correo invalido <br>";
                    }

                    
                    if($this->ContarObjetos($StrCorreo,"tb_user","Correo")>0){
                        $CodigosError[0]="El correo ya existe en nuestra base de datos, intenta con otro <br>";
                    }

                    if($StrUser==" " || strlen($StrUser)<8){
                                    $CodigoAlerta[0]=$CodigoAlerta[0]."Te asignaremos un usuario, puedes cambiarlo en cualquier momento desde tu perfil <br>";
                                    $StrUser="Usuario1250";

                    }


                    if($StrPass==" "){
                            
                        $CodigoAlerta[0]=$CodigoAlerta[0]."La contrase;a no puede estar vacia generaremos una contrase;a puedes cambiarla desde tu perfil <br>";
                        $StrPass=$Utilidades->GenerarPass();
                                    
                    }else{
                        if(strlen($StrPass)<8){
                        $CodigoAlerta[0]=$CodigoAlerta[0]."La contrase;a es demasiado corta <br>";
                                        
                                            
                        }else{
                            $TempCont=0;
                            for($intx=0;$intx<strlen($StrPass);$intx++){
                                if(intval($StrPass[$intx])>0){
                                    $TempCont=$TempCont+1;
                                }
                            }

                                        
                            if($TempCont>2){
                                                
                            $CodigosError[0]=$CodigosError[0]."La contrase;a no puede contener mas de 3 numeros <br>";
                            $boolEstado=false;
                                            
                                                
                            }
                        }
                                        
                                    
                    }

                    if($StrUser!=" " && $StrPass!=" " && $CodigosError[0]=="" && boolval($boolEstado)){
                        
                        $boolResult=$Modelo_User->Registro($StrNombre,$StrCorreo,$StrUser,$StrPass,$Strlocalidad,$intCodigo_Postal,$StrServicio,$intTelefono,$RutaServidor,$StrEnvio_Correo,$StrDetalle,$StrTipo);
        
                            if($boolResult>0){
                                
                                $Utilidades->Crear_Directorios($FileArchivo,$RutaDirectorio);
                                    $this->BuscarUsuario($StrUser,$StrPass);
                            }else{
                                echo "No pudo llevarse a cabo el registro intenta mas tarde <br>";
                            }
                        
                    
                    }else{
                    $CodigosError[0]=$CodigosError[0]."Algo fallo <br>";
        
                    echo $CodigosError[0];
                    }
                    

                    
                    
            
                
                        
                
                        
                        
                }

                
                
            
            
            
            }else{
                $CodigosError[0]="Imagen No encontrada";
                echo $CodigosError[0];
            }

            
        }

        

        public function BuscarUsuario($User,$Pass){
            $Modelo_User=new Modelo_User();
            session_start();

            $boolUser=$Modelo_User->BuscarUsuario($User,$Pass);

            foreach($boolUser as $Users){
                $_SESSION['UserId']=$Users[0];
                $_SESSION['UserName']=$Users[1];
            }


            if(isset($_SESSION['UserId'])){
                echo "Hemos iniciado sesion por ti";
            }else{
                echo "Fallo al logearse";
            }


        }

        public function ActualizarDatos($Nombre,$Correo,$Usuario,$pass,$Detalles){
            session_start();
            $Modelo_User=new Modelo_User();

            

            $CountUpdate=$Modelo_User->ActualizarDatos($Nombre,$Correo,$Usuario,$pass,$Detalles,$_SESSION['UserId']);
            
            switch($CountUpdate) {

                case 0:  return "No se actualizo porque no cambiaste ningun dato";
                break;
                case 1:   return "Se actualizo con exito, los cambios se veran reflejados la proxima vez que inicies sesion";
                break;
                default:  return "Algo fallo contacta a soporte tecnico";
                break;

            }
            


            

        }

        
    }

    class Controller_Product extends Controller_Sitio{

        public function ListadoBienes($StrTipo,$Categoria){
            $Modelo_User=new Modelo_User();
            $View_Sitio= new sitio(); 
            $boolProducto=$Modelo_User->BuscarUsuarioPorCategoria($Categoria);
        
            
            if($StrTipo=="OtrosService"){
                $StrTipo="Otros";
            }
            
            $var=0;
            $array=array();
            foreach($boolProducto as $producoUser){
                $array[$var]=$producoUser;
                $var=$var+1;
            }

            $Texto="";

            if($Categoria=="Servicios"){
                switch($StrTipo){
                    case "handy":
                        $Texto="Handyman Disponibles";
                        break;
                        case "jardinero":
                            
                        $Texto="Jardineros Disponibles";
                            break;
                            case "Albanil":
                                $Texto="Albañiles Disponibles";
                        break;
                        case "Electricista":
                            $Texto="Electricistas Disponibles";
                        break;
                        default:
                        $Texto="Otro Tipo de servicios";
                        break;
                }
            }else{
            
                switch($StrTipo){
                    case "Artesanias":
                        $Texto="Artesanias Guatemaltecas";
                        break;
                        case "Comida":
                            
                        $Texto="Comida Tipica Guatemalteca";
                            break;
                            case "Dulces":
                                $Texto="Dulces Tipicos";
                        break;
                        case "Ropa ":
                            $Texto="Ropa Tipica";
                        break;
                        default:
                        $Texto="Otro Tipo de Bienes";
                        break;
                }

            }
            
            
            $View_Sitio->ColocarTexto($Texto);
            
            for($var=0;$var<sizeof($array);$var++){
                
                $IntCiudad=$array[$var][3].",".$array[$var][4];
                $IntTelefono=$array[$var][0];
                $StrDetalle=$array[$var][1];
                $StrEnvios=$array[$var][2];
                $StrNombreMpresa=$array[$var][5];
                $StrUrl=$array[$var][6];
                $StrServicio=$array[$var][7];
                $intCode=$array[$var][8];
                $StrTypeOf=$StrTipo;

                $arrayServicios=explode("-",$StrServicio);

                for($VarX=0;$VarX<sizeof($arrayServicios);$VarX++){

                    if($arrayServicios[$VarX]==$StrTipo){
                        $View_Sitio->TipoBienes($IntCiudad,$IntTelefono,$StrDetalle,$StrEnvios,$StrNombreMpresa,$StrUrl,$StrServicio,$intCode,$StrTypeOf);
                        break;
                    }

                }
                
            }

        
        }

        public function CrearBanner($StrTitulo,$StrDescripcion,$StrImagen){
            
            if($StrImagen['size']<256000){
                session_start();
                $Utilidades= new Controller_Sitio();
                $RutaPagina="assets/img/servidor/Banner/";
                $RutaDirectorio = $_SERVER['DOCUMENT_ROOT']."/service&Product".'/'.$RutaPagina;
                $RutaServidor=$RutaPagina.$StrImagen['name'];
                $Modelo_Servicios=new Modelo_Servicios();

                $IntContador=$Modelo_Servicios->ContarBannerPorUsuario($_SESSION['UserId']);

                foreach($IntContador as $Contador){}
                

                if($Contador[0]<3){
                    $Fecha=$Utilidades->HoraHoy(5);
                    $boolBanner=$Modelo_Servicios->AddBaner($StrTitulo,$StrDescripcion,$RutaServidor,$Fecha,$_SESSION['UserId']);
        
                    if(intval($boolBanner)>0){
                        $Utilidades->Crear_Directorios($StrImagen,$RutaDirectorio);
                        return "Agregaste un banner, tienes que esperar un tiempo para que sea aprobado";
                    }else{
                        return "Algo fallo";
                    } 
                }else{
                    return "Ya has ingresado el maximo permitido contacta a atencion al cliente";
                }
                
                
            
            }else{
                return "La imagen es demasiado grande";
            }
        }

        public function BuscarBienes($StrNombre,$StrCategoria){
                
            $Modelo_User=new Modelo_User();
            $View_Sitio= new sitio(); 
            
            
            

            
            $resulModel=$Modelo_User->AutoComplete($StrNombre,$StrCategoria);
            $var=0;
            $array=array();
            foreach($resulModel as $producoUser){
                $array[$var]=$producoUser;
                $var=$var+1;
            }
           
            for($var=0;$var<sizeof($array);$var++){
                
                $IntCiudad=$array[$var][3].",".$array[$var][4];
                $IntTelefono=$array[$var][0];
                $StrDetalle=$array[$var][1];
                $StrEnvios=$array[$var][2];
                $StrNombreMpresa=$array[$var][5];
                $StrUrl=$array[$var][6];
                $StrServicio=$array[$var][7];
                $intCode=$array[$var][8];
                $StrType=$array[$var][9];
                

                $arrayServicios=explode("-",$StrServicio);

                for($VarX=0;$VarX<sizeof($arrayServicios);$VarX++){

                   
                        $View_Sitio->TipoBienes($IntCiudad,$IntTelefono,$StrDetalle,$StrEnvios,$StrNombreMpresa,$StrUrl,$StrServicio,$intCode,$StrType);
                        break;
                    

                }
                
            }
        }
        
        public function RecomendarProductos($StrTipoServicio){
            $Modelo_User=new Modelo_User();
            $View_Sitio= new sitio(); 

            $Banners=$Modelo_User->BuscarUsuarioPorCategoria($StrTipoServicio);
            $var=0;
            $array=array();
            foreach($Banners as $banner){
                $array[$var]=$banner;
                $var=$var+1;
            }

            for($intx=0;$intx<sizeof($array);$intx++){
                $StrTitulo=$array[$intx]['NombreEmpresa'];
                $StrDescripcion=$array[$intx]['Detalle'];
                $StrImagen=$array[$intx]['UrlImagen'];
                $StrFecha=$array[$intx]['city'];
                $IntId=$array[$intx]['id_user'];

                
                if($intx>4){
                    $View_Sitio->PromocionarBanner("",0,"Para ver mas click aqui","Ver mas","N.A",$StrTipoServicio);
                    $intx=sizeof($array);

                }else{
                    $View_Sitio->PromocionarBanner($StrImagen,$IntId,$StrDescripcion,$StrTitulo,$StrFecha,"N.A");
                }
            }

           
        }

        public function ColocarBanner($Id,$StrType){
          
            if(intval($Id)>0){
                $Modelo_Servicios=new Modelo_Servicios();
                $View_Sitio= new sitio(); 
               

                switch($StrType){
                    case"Usuario":
                        $resultBanner=$Modelo_Servicios->BannerporUser($Id);
                    break;
                    case"Unico":
                        $resultBanner=$Modelo_Servicios->BannerporId($Id);
                        break;
                }

                

                $var=0;
                $array=array();
                foreach($resultBanner as $asBanner){
                    $array[$var]=$asBanner;
                    $var=$var+1;
                }

                for($intX=0;$intX<sizeof($array);$intX++){
                    $StrTitulo=$array[$intX][0];
                    $StrDescripcion=$array[$intX][1];
                    $StrFechaPublicacion=$array[$intX][3];
                    $StrUrl=$array[$intX][2];
                  
                }

               
                

               

               


            }
        }

    }

?>