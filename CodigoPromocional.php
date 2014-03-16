<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CodigoPromocional
 *
 * @author Samsung
 */
require_once ("../BDclases/BDCodigoPromocional.php");
class CodigoPromocional {
    private $id = null;
    private $inicio = null;
    private $fin = null;
    private $actual=null;
    //-----------------------------------METODOS------------------------------//
    //constructor

    public function __construct() {   
     $this->inicio = "";
     $this->fin = "";
     $this->actual="";

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


    /**
     * @access public
     */
    public function getInicio() {
        $returnValue = $this->inicio;
        return $returnValue;
    }

    /**
     * @access public
     * @return String
     */
    public function getFin() {
        $returnValue = $this->fin;

        return $returnValue;
    }
    
     /**
     * @access public
     * @return String
     */
    public function getActual() {
        $returnValue = $this->fin;

        return $returnValue;
    }

    //-------------------SETTERS------------------//
    public function setId($i) {
        $this->id = $i;
    }


    /**
     * @access public
     * @param  String p
     * @return mixed
     */
    public function setInicio($p) {
        $this->inicio= $p;
    }


    /**
     * @access public
     * @param  String l
     * @return mixed
     */
    public function setFin($l) {
        $this->fin = $l;
    }
    
     /**
     * @access public
     * @param  String l
     * @return mixed
     */
    public function setActual($l) {
        $this->actual = $l;
    }


    //busqueda de usuario por id
    public function BuscarPorID($i) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDTarjetaDescuento();
        //obtenenemos el resultado
        $result = $objbd->BuscarPorID($i);
        return $result;
    }

    //funcion que devuelve un usuario por su id
    public function DamePorID($id) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDTarjetaDescuento();
        //obtenenemos el resultado
        $result = $objbd->DamePorID($id);
        return $result;
    }

    
    public function DameTodos($condiciones) {
        $objbd = new BDTarjetaDescuento();
        $res=$objbd->DameTodos($condiciones);
        return $res;
    }
}

?>
