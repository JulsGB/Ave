<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TarjetaDescuento
 *
 * @author Samsung
 */
require_once ("../BDclases/BDTarjetaDescuento.php");
class TarjetaDescuento {
    //-------------------------------ATTRIBUTOS--------------------------------//
    private $id = null;
    private $descripcion = null;
    private $descuento = null;
    //-----------------------------------METODOS------------------------------//
    //constructor

    public function __construct() {
        $this->descripcion = "";
        $this->descuento = "";

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
    public function getDescripcion() {
        $returnValue = $this->descripcion;
        return $returnValue;
    }

    /**
     * @access public
     * @return String
     */
    public function getDescuento() {
        $returnValue = $this->descuento;

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
    public function setDescripcion($p) {
        $this->descripcion= $p;
    }


    /**
     * @access public
     * @param  String l
     * @return mixed
     */
    public function setDescuento($l) {
        $this->descuento = $l;
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
