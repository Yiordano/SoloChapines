<?php

class Modelo_ConectarDB{

    private $usuario="root";
    private $password="";
    private $db="service_product";
    private $Cadena=null;

    protected function conexion(){
       
        try{
          $this->Cadena = new PDO('mysql:host=localhost;dbname='. $this->db, $this->usuario, $this->password);   //<-otra forma de conectar 
          
          $this->Cadena->exec("set names utf8");
          $this->Cadena->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        }catch(Exception $e){
           
        }
     
        return $this->Cadena;  
    }

}


class Modelo_Sitio extends Modelo_ConectarDB{
    public function BuscarCiudad($StrCiudad){
        $sqlQuery="SELECT city, state FROM cities_extended AS CityExt, states AS Estados WHERE zip=:zip AND
        Estados.state_code=CityExt.state_code";
        $FindCiudad=$this->conexion()->prepare($sqlQuery);
        $FindCiudad -> bindParam(":zip",$StrCiudad);
        $FindCiudad->execute();
        return $FindCiudad;
    }

    public function ContarObjetos($StrNombre,$StrTabla,$StrColumna){
        $sqlQuery="SELECT COUNT(*) FROM  $StrTabla WHERE $StrColumna=:$StrColumna";
        $Conteo=$this->conexion()->prepare($sqlQuery);
        $Conteo-> bindParam(":$StrColumna",$StrNombre);
        $Conteo->execute();
        return $Conteo;
    }

    
}


class Modelo_Servicios extends Modelo_ConectarDB {

    public function AddBaner($StrTitulo,$StrDescripcion,$StrUrl,$Fecha,$IdOperador){

        $sqlQuery="INSERT INTO  tb_banner VALUES(NULL,:Titulo,:Descripcion,:Imagen,:fecha_publicacion,0,:id_Operador)";
        $AddService=$this->conexion()->prepare($sqlQuery);
        $AddService -> bindParam(":Titulo",$StrTitulo);
        $AddService -> bindParam(":Descripcion",$StrDescripcion);
        $AddService -> bindParam(":Imagen",$StrUrl);
        $AddService -> bindParam(":fecha_publicacion",$Fecha);
        $AddService -> bindParam(":id_Operador",$IdOperador);
        $AddService->execute();
        return $AddService->rowCount();
    }

    public function ContarBannerPorUsuario($IdOperador){
        $sqlQuery="SELECT COUNT(*) FROM tb_banner WHERE id_Operador=$IdOperador";
        $CountService=$this->conexion()->prepare($sqlQuery);
        $CountService->execute();   
        return $CountService;


    }

    public function BannerPrincipal(){
        $sqlQuery="SELECT Titulo,Descripcion,Imagen,fecha_publicacion,id_banner FROM tb_banner WHERE isAprobado=0  ORDER BY fecha_publicacion,isAprobado ASC limit 10 ;";
        $BannerPrincipal=$this->conexion()->prepare($sqlQuery);
        $BannerPrincipal->execute();   
        return $BannerPrincipal;
    }

    public function BannerporUser($Userid){
        $sqlQuery="SELECT Titulo,Descripcion,Imagen,fecha_publicacion,id_banner FROM tb_banner WHERE isAprobado=0 AND id_Operador=:id_Operador";
        $BannerPrincipal=$this->conexion()->prepare($sqlQuery);
        $BannerPrincipal -> bindParam(":id_Operador",$Userid);
        $BannerPrincipal->execute();   
        return $BannerPrincipal;
    }

    public function BannerporId($Id){
        $sqlQuery="SELECT Titulo,Descripcion,Imagen,fecha_publicacion,id_banner FROM tb_banner WHERE isAprobado=0 AND id_banner=:id_banner";
        $BannerPrincipal=$this->conexion()->prepare($sqlQuery);
        $BannerPrincipal -> bindParam(":id_banner",$Id);
        $BannerPrincipal->execute();   
        return $BannerPrincipal;
    }

}


class Modelo_User extends Modelo_ConectarDB{

    public function Registro($StrNombre,$StrCorreo,$StrUser,$StrPass,$Strlocalidad,$intCodigo_Postal,$StrServicio,$intTelefono,$RutaServidor,$StrEnvio_Correo,$StrDetalle,$StrTipo){
        $sqlQuery="INSERT INTO tb_user VALUES(NULL,
        :Correo,:CodigoPostal,:NumeroTelefonico,:Usuario,
        :Contra,:Detalle,:SERVICIO,:EnvioCorreo,:NombreEmpresa,:UrlImagen,:localidad,:TipoCliente,0)";

        $Insertar_Usuario=$this->conexion()->prepare($sqlQuery);
       
      try{
            $Insertar_Usuario->bindParam(":Correo",$StrCorreo);
            $Insertar_Usuario->bindParam(":CodigoPostal",$intCodigo_Postal);
            $Insertar_Usuario->bindParam(":NumeroTelefonico",$intTelefono);
            $Insertar_Usuario->bindParam(":Usuario",$StrUser);
            $Insertar_Usuario->bindParam(":Contra",$StrPass);
            $Insertar_Usuario->bindParam(":Detalle",$StrDetalle);
            $Insertar_Usuario->bindParam(":SERVICIO",$StrServicio);
            $Insertar_Usuario->bindParam(":EnvioCorreo",$StrEnvio_Correo);
            $Insertar_Usuario->bindParam(":NombreEmpresa",$StrNombre);
            $Insertar_Usuario->bindParam(":UrlImagen",$RutaServidor);
            $Insertar_Usuario->bindParam(":localidad",$Strlocalidad);
            $Insertar_Usuario->bindParam(":TipoCliente",$StrTipo);
    
            $Insertar_Usuario->execute();

            return $Insertar_Usuario->rowCount();
        }catch(exception $e){
        echo "Algo ha fallado intenta mas tarde";
      }
       

       
    }

    public function ActualizarDatos($Nombre,$Correo,$User,$Pass,$Detalles,$Id){
       try{
            $sqlQuery="UPDATE tb_user SET NombreEmpresa=:NombreEmpresa, Correo=:Correo, Usuario=:Usuario, Contra=:Contra,Detalle=:Detalle WHERE id_user=:id_user";
            $UpdateUser=$this->conexion()->prepare($sqlQuery);
            $UpdateUser -> bindParam(":NombreEmpresa",$Nombre);
            $UpdateUser -> bindParam(":Correo",$Correo);
            $UpdateUser -> bindParam(":Usuario",$User);
            $UpdateUser -> bindParam(":Contra",$Pass);
            $UpdateUser -> bindParam(":Detalle",$Detalles);
            $UpdateUser -> bindParam(":id_user",$Id);
            $UpdateUser->execute();
            return $UpdateUser->rowCount();
          }catch(Exception $e){
              return -1;
          }
    }

    public function BuscarUsuario($User,$Pass){
        $sqlQuery="SELECT id_user,NombreEmpresa FROM tb_user WHERE Usuario=:Usuario AND
        Contra=:Contra";
        $FindUser=$this->conexion()->prepare($sqlQuery);
        $FindUser -> bindParam(":Usuario",$User);
        $FindUser -> bindParam(":Contra",$Pass);
        $FindUser->execute();
        return $FindUser;
    }

    public function BuscarUsuarioPorCategoria($StrTipo){
        $sqlQuery="SELECT 
        user.NumeroTelefonico,
        user.Detalle,
        user.EnvioCorreo,
        ciudad.city,
        estado.state,
        user.NombreEmpresa,
        user.UrlImagen,
        user.SERVICIO,
        user.id_user
        FROM tb_user as user, cities_extended as ciudad, states as estado
        WHERE TipoCliente=:TipoCliente
        AND user.CodigoPostal=ciudad.zip 
        AND estado.state_code=ciudad.state_code";
        $BuscarUsuarioCategoria=$this->conexion()->prepare($sqlQuery);
        $BuscarUsuarioCategoria->bindParam(":TipoCliente",$StrTipo);
        $BuscarUsuarioCategoria->execute();

        return $BuscarUsuarioCategoria;
        
       
    }
    
    public function BuscarById($Id){
        $sqlQuery="SELECT NombreEmpresa,Correo,Usuario,Contra,Detalle,SERVICIO,EnvioCorreo,TipoCliente 
        FROM tb_user WHERE id_user=:id_User";
        $FindUser=$this->conexion()->prepare($sqlQuery);
        $FindUser -> bindParam(":id_User",$Id);
        $FindUser->execute();
        return $FindUser;
    }

    public function AutoComplete($StrPalabra,$StrCategoria){
        $sqlQuery="SELECT 
        user.NumeroTelefonico,
        user.Detalle,
        user.EnvioCorreo,
        ciudad.city,
        estado.state,
        user.NombreEmpresa,
        user.UrlImagen,
        user.SERVICIO,
        user.id_user,
        user.TipoCliente
		FROM tb_user as user, cities_extended as ciudad, states as estado
        WHERE user.CodigoPostal=ciudad.zip AND
        estado.state_code=ciudad.state_code AND  
		NombreEmpresa like '$StrPalabra%'";

        $sqlQuery=$StrCategoria!="None"?
        $sqlQuery."AND user.TipoCliente= '$StrCategoria' ":
        $sqlQuery." ";
        $BuscarUsuarioCategoria=$this->conexion()->prepare($sqlQuery);
        $BuscarUsuarioCategoria->execute();

        return $BuscarUsuarioCategoria;
    }

    public function recuperarPass($StrEmail){
        $sqlQuery="SELECT Contra,Usuario,NombreEmpresa  FROM tb_user WHERE Correo=:Correo";
        $FindUser=$this->conexion()->prepare($sqlQuery);
        $FindUser -> bindParam(":Correo",$StrEmail);
        $FindUser->execute();
        return $FindUser;
    
    }

    

}