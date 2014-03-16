<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tren
 *
 * @author Samsung
 */
require_once ("../BDclases/BDTren.php");
class Tren {
    //-------------------------------ATTRIBUTOS--------------------------------//
    private $id = null;
    //-----------------------------------METODOS------------------------------//
    //constructor

    public function __construct() {
        $this->id = "";

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


    //-------------------SETTERS------------------//
    public function setId($i) {
        $this->id = $i;
    }



    //busqueda de usuario por id
    public function BuscarPorID($i) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDTren();
        //obtenenemos el resultado
        $result = $objbd->BuscarPorID($i);
        return $result;
    }

    //funcion que devuelve un usuario por su id
    public function DamePorID($id) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDTren();
        //obtenenemos el resultado
        $result = $objbd->DamePorID($id);
        return $result;
    }

    
    public function CuentaTodos($condiciones) {
        $objbd = new BDTren();
        $res=$objbd->CuentaTodos($condiciones);
        return $res;
    }
    
    public function DameTodos($condiciones) {
        $objbd = new BDTren();
        $res=$objbd->DameTodos($condiciones);
        return $res;
    }
    
    
}

?>
