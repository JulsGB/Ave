<?php

/**
 * Description of BDatos
 * Clase que crea la conexion con la base de Datos y la destruye
 * @author AveTeam
 */

require_once ("./adodb5/adodb.inc.php");

class BDatosConexion {

    //atributos para la coneccion de la base Datos
    private $tipoBD = "mysql";
    private $hostBD = "bbdd.dlsi.ua.es:3306";
    private $userBD = "gi_ave";
    private $passBD = ".gi_ave.";
    private $schemeBD = "gi_ave";
    //atributo en donde  guardamos la conexion con la base de datos
    private $conexionBD = null;

    //constructor
    public function __construct() {
        if (!isset($this->conexionBD)) {

            //creamos la conexion con la base de datos
            $this->conexionBD = NewADOConnection($this->getTipoBD());			
            $this->conexionBD->Connect($this->getHostBD(), $this->getUserBD(), $this->getPassBD(), $this->getschemeBD());
			
        }
    }

    //destructor cerramos la conexion con la base de datos
    public function __destruct() {
        
    }

    //ejecuta una  sentencia a la base de datos y devuelve 
    //el resultado determinado
    public function Query($sql) {

        $result = $this->conexionBD->Execute($sql);
        return $result;
    }

    // es para solo ejecutar sentencias que no tengan un reultado
    //ejemplo modificar , eliminar
    public function Execute($sql) {

        $this->conexionBD->Execute($sql);
    }
    
    //funcion para insertar en la base de datos 
    //si inserta devuelve el ID si no devuelve false
    
    public function Insert($sql) {        
         $result = $this->conexionBD->Execute($sql);
         $insertado = $this->conexionBD->Insert_ID($result);
       
         if (!$result->EOF) {
            $insertado=false;       
        }
        return $insertado;
    }

    //-------------------GETTERS----------------------------//

    public function getTipoBD() {
        return $this->tipoBD;
    }

    public function getHostBD() {
        return $this->hostBD;
    }

    public function getUserBD() {
        return $this->userBD;
    }

    public function getPassBD() {
        return $this->passBD;
    }

    public function getschemeBD() {
        return $this->schemeBD;
    }

    public function getElemPage() {
        return $this->elemPage;
    }

    // -----------------------SETERS-------------------------------//
    public function setTipoBD($tipoBD) {
        $this->tipoBD = $tipoBD;
    }

    public function setHostBD($hostBD) {
        $this->hostBD = $hostBD;
    }

    public function setUserBD($userBD) {
        $this->userBD = $userBD;
    }

    public function setPassBD($passBD) {
        $this->passBD = $passBD;
    }

    public function setnombreBD($schemeBD) {
        $this->nombreBD = $schemeBD;
    }

    public function setElemPage($elemPage) {
        $this->elemPage = $elemPage;
    }

}

?>
