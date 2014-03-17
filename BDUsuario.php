<?php

/**
 * @author AveTEAM
  if (0 > version_compare(PHP_VERSION, '5')) {
  die('This file was generated for PHP 5');
  }

  /**
 * includes 
 */
require_once ("./BDatosConexion.php");

/**
 * clase Usuario
 * representa todos los usuarios de la aplicacion 
 */
class BDUsuario {

    private $BD = null;

    //creamos una un objeto de base de datos
    public function __construct() {
        $this->BD = new BDatosConexion();
    }

    public function __destruct() {
        
    }

    //funcion para saber si un Usuario esta dado de alta en la base de datos
    public function BuscarPorID($id) {
        $found = false;
        $sql = 'SELECT * FROM usuario where id=' . $id . ';';
        $datos = $this->BD->Query($sql);
        if (!$datos->EOF) {
            $found = true;
        }
        return $found;
    }

    //funcion que devuelve un Usuario de la base de datos segun su ID null de lo contrario
    public function DamePorID($id) {
        $result = null;
        $sql = 'SELECT * FROM usuario where id=' . $id . ';';
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        if (!$datos->EOF) {
            $result = new Usuario();
            $result->setId($datos->fields["id"]);
            $result->setEmail($datos->fields["login"]);
            $result->setPassword($datos->fields["pass"]);
            return $result;
        }
        return $result;
    }

    //funcion para autentificar un usuario
    public function Autenticar($login, $pass) {
        $valido = false;
        //comprobamos que el usuario este activo + login + passw
        $sql = "SELECT * FROM usuario  WHERE login='" . $login . "' AND pass='" . md5($pass);
        $datos = $this->BD->Query($sql);
        if (!$datos->EOF) {
            $valido = true;
        }
        return $valido;
    }

    //funcion para borrar a un usuario segun su id
    // devuelve true si se ha conseguido y false en caso contrario
    public function delete($i) {
        $deleted = false;
        $result = $this->BD->Execute("DELETE FROM usuario WHERE id='" . $i . "'");
        if (!$result->EOF) {
            $deleted = true;
        }
        return $deleted;
    }

    //compruebaID del usuario encriptado en md5 y devuelve sus datos para su posterior 
    //activacion devuelve el  id Real


    public function ComprobarID($id) {

        $result = $this->BD->Query("SELECT * FROM usuario");
        $idReal = null;
        while (!$result->EOF) {

            if (md5((string) $result->fields["id"]) == $id) {
                $idReal = $result->fields["id"];
            }

            $result->MoveNext();
        }
        return $idReal;
    }

    //funcion que devuelve todos Usuario de la base de datos segun condiciones
    public function DameTodos($condiciones) {
        $result = null;
        $sql = 'SELECT * FROM usuario where 1 ' . $condiciones;

        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        $aUsers = array();
        while (!$datos->EOF) {
            $result = new Usuario();
            $result->setId($datos->fields["id"]);
            $result->setLogin($datos->fields["login"]);
            $result->setPassword($datos->fields["pass"]);
            $aUsers[] = $result;
            $datos->MoveNext();
        }
        return $aUsers;
    }

    //funcion que devuelve count de Usuario de la base de datos segun condiciones
    public function CuentaTodos($condiciones) {
        $sql = 'SELECT count(*) as total FROM usuario where 1 ' . $condiciones;
        //echo $sql;
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        $num = 0;
        if (!$datos->EOF) {
            $num = $datos->fields["total"];
        }
        return $num;
    }

    //funcion para insertar un usuario devuelve true si ha sido insertado y false  en el caso contrario
    public function Insertar($login, $password) {
        $sql = "INSERT INTO usuario values('','" . $login . "','" . md5($password) . "');";
        $result = $this->BD->Insert($sql);

        return $result;
    }

    //funcion que devuelve un Usuario de la base de datos segun su email
    public function DamePorLogin($e) {
        $result = null;
        $sql = 'SELECT * FROM usuario  WHERE login= "' . $e . '";';
        $datos = $this->BD->Query($sql);
        if (!$datos->EOF) {
            $result = new Usuario();
            $result->setId($datos->fields["id"]);
            $result->setNombre($datos->fields["nombre"]);
            $result->setLogin($datos->fields["login"]);
            $result->setPassword($datos->fields["pass"]);
        }
        return $result;
    }

    //funcion para saber si un usuario ya esta registrado false=no lo esta de lo contrario true
    public function Registrado($email) {
        $registrado = false;
        $sql = 'SELECT * FROM usuario  WHERE email= "' . $email . '";';

        $datos = $this->BD->Query($sql);
        if (!$datos->EOF) {
            $registrado = true;
        }

        return $registrado;
    }

    Public function Consulta($eorigen, $edestino, $corigen, $cdestino, $hsalida) {

        $tipoBD = "mysql";
        $hostBD = "bbdd.dlsi.ua.es:3306";
        $userBD = "gi_ave";
        $passBD = ".gi_ave.";
        $schemeBD = "gi_ave";
        $tarjetas[];
        $numt= 0;

        $connection = mysqli_connect("bbdd.dlsi.ua.es", "gi_ave", ".gi_ave.", "gi_ave", "3306");
        $query_ida = "call gi_ave.Consulta_Viaje(".$eorigen.",".$edestino.",".$corigen.
         ",".$cdestino.",'".$hsalida."')";
        $query_tarjetas = "select * from tarjetas";
         $result = mysqli_query($connection, $query_tarjetas) or die("Query fail: " . mysqli_error());
        //$result=$this->BD->Query("call gi_ave.Consulta_Viaje(1,4,1,4,'2014-03-10')");
        //loop the result set
         
         
         //$TarjetaDescuento=new Ta;
        while ($row = mysqli_fetch_array($result)) {
            //                               .0$tarjetas[3] = new TarjetaDescuento()
            echo $row[0] . " - " . + $row[1];
        }
        echo $query;
        //run the store proc
        $result = mysqli_query($connection, $query) or die("Query fail: " . mysqli_error());
        //$result=$this->BD->Query("call gi_ave.Consulta_Viaje(1,4,1,4,'2014-03-10')");
        //loop the result set
        while ($row = mysqli_fetch_array($result)) {
            echo $row[0] . " - " . + $row[1];
        }

        //$sql = "call  Consulta_Viaje('" . $eorigen . "','" . $edestino . "','" . $corigen . "','" . $cdestino . "','" . $hsalida . "');";
        //$datos = $this->BD->Query($sql);
        // echo $datos->fields["Trayecto_id"];
    }

}

/* fin de la clase Usuario */
?>
