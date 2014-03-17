<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estacion
 *
 * @author Samsung
 */
require_once ("./BDEstacion.php");

class Estacion {
   //-------------------------------ATTRIBUTOS--------------------------------//
    private $id = null;
    private $nombre = null;
    private $ciudad = null;
    //-----------------------------------METODOS------------------------------//
    //constructor

    public function __construct() {
        $this->nombre = "";
        $this->ciudad = "";

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
     public function getNombre() {
        $returnValue = $this->nombre;
        return $returnValue;
    }
     public function getCiudad() {
        $returnValue = $this->ciudad;
        return $returnValue;
    }
     //-------------------SETTERS------------------//
    public function setId($i) {
        $this->id = $i;
    }

    public function setNombre($e) {
        $this->nombre = $e;
    }

    /**
     * @access public
     * @param  String p
     * @return mixed
     */
    public function setCiudad($p) {
        $this->ciudad = $p;
    }
    
     public function Insertar() {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDEstacion();

        $result = $objbd->Insertar($this->getNombre(), $this->getCiudad());
        //si se ha insertado correctamente actualizamos el id

        if ($result != false) {
            $this->setId($result);
        }

        return $result;
    }
    
     public function CuentaTodos($condiciones) {
        $objbd = new BDestacion();
        $res=$objbd->CuentaTodos($condiciones);
        return $res;
    }
    public function DameNombreCiudades(){
         $objbd = new BDestacion();
        $res=$objbd-> DameNombreCiudades();
        return $res;
    }
    
    public function DameTodos($condiciones) {
        $objbd = new BDEstacion();
        $res=$objbd->DameTodos($condiciones);
        return $res;
    }
     //funcion para borrar cualquier usuario devuelve true si se ha conseguido y false si no
    public function delete() {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDEstacion();
        $result = $objbd->delete($this->getId());
        return $result;
    }
    //funcion que devuelve un usuario por su email
    public function DamePorNombre($nombre) {
        //creamos un objeto transaccional con la base de datos
        $objbd = new BDEstacion();
        //obtenenemos el resultado
        $result = $objbd->DamePorNombre($nombre);
        return $result;
    }


    

}

?>
