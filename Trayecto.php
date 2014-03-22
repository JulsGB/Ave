<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trayecto
 *
 * @author Samsung
 */
   require_once('./BDTrayecto.php');

/**
 * clase Usuario
 * representa todos los usuarios de la aplicacion de ella heredan desarrollador
 * y cliente
 * 
 */ 
class Trayecto {

    //-------------------------------ATTRIBUTOS--------------------------------//
    private $id = null;
    private $ciudadOrigen = null;
    private $ciudadDestino = null;
    private $trailer=null;
    //-----------------------------------METODOS------------------------------//
    //constructor

    public function __construct() {
        $this->ciudadOrigen = "";
        $this->ciudadDestino = "";

    }

    //----------GETTERS-------//
    /**
     * @access public
     * @return Integer
     */
    public function getId() {
        $returnValue = $this->id;
        return $returnValue;
    }
    public function getTrailer() {
        $returnValue = $this->id;
        return $returnValue;
    }

    /**
     * @access public
     */
    public function getCiudadOrigen() {
        $returnValue = $this->ciudadOrigen;
        return $returnValue;
    }

    /**
     * @access public
     * @return String
     */
    public function getCiudadDestino() {
        $returnValue = $this->ciudadDestino;

        return $returnValue;
    }

    //-------------------SETTERS------------------//
    public function setId($i) {
        $this->id = $i;
    }   
    public function setTrailer($i) {
        $this->trailer = $i;
    }


    /**
     * @access public
     * @param  String p
     * @return mixed
     */
    public function setCiudadOrigen($p) {
        $this->ciudadOrigen = $p;
    }


    /**
     * @access public
     * @param  String l
     * @return mixed
     */
    public function setCiudadDestino($p) {
        $this->ciudadDestino = $p;
    }
     public function DameTrayectos($ciudadOrigen,$ciudadDestino){
         //creamos un objeto transaccional con la base de datos
        $objbd = new BDTrayecto();
        //obtenenemos el resultado
        $result = $objbd->DameTrayectos($ciudadOrigen,$ciudadDestino);
        return $result;
    }
     public function DameNombre($id){
         //creamos un objeto transaccional con la base de datos
        $objbd = new BDTrayecto();
        //obtenenemos el resultado
        $result = $objbd->DameNombre($id);
        return $result;
    }
    public function AgregaUrlTrailer($url,$idTrayectos){
        $objbd = new BDTrayecto();
        //obtenenemos el resultado
        $result = $objbd->AgregaUrlTrailer($url,$idTrayectos);
        return $result;
    }
     public function DameTrailer($id){
         //creamos un objeto transaccional con la base de datos
        $objbd = new BDTrayecto();
        //obtenenemos el resultado
        $result = $objbd->DameTrailer($id);
        return $result;
    }

    

}

?>
