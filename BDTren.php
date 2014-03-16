<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BDTren
 *
 * @author Samsung
 */
require_once ("../BDatosConexion.php");

class BDTren {
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
        $sql = 'SELECT * FROM Tren where id=' . $id . ';';
        $datos = $this->BD->Query($sql);
        if (!$datos->EOF) {
            $found = true;
        }
        return $found;
    }


    //funcion que devuelve un Usuario de la base de datos segun su ID null de lo contrario
    public function DamePorID($id) {
        $result = null;
        $sql = 'SELECT * FROM Tren where id=' . $id . ';';
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        if (!$datos->EOF) {
                $result = new Tren();
                $result->setId($datos->fields["id"]);
                return $result;
        }
        return $result;
    }
    
     //funcion que devuelve todos Usuario de la base de datos segun condiciones
    public function DameTodos($condiciones) {
        $result = null;
        $sql = 'SELECT * FROM Tren where 1 ' . $condiciones;
        
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        $aUsers = array();
        while (!$datos->EOF) {
            $result = new Tren();
            $result->setId($datos->fields["id"]);
            $aUsers[] = $result;
            $datos->MoveNext();
        }
        return $aUsers;
    }

    //funcion que devuelve count de Usuario de la base de datos segun condiciones
    public function CuentaTodos($condiciones) {
        $sql = 'SELECT count(*) as total FROM Tren where 1 ' . $condiciones;
        //echo $sql;
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        $num = 0;
        if (!$datos->EOF) {
            $num = $datos->fields["total"];
        }
        return $num;
    }


}

?>
