<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BDEstacion
 *
 * @author Samsung
 */
require_once ("../BDatosConexion.php");
class BDEstacion {
       //funcion que devuelve un Usuario de la base de datos segun su ID encriptado null de lo contrario
    public function DamePorIDMD5($id) {
        $result = null;
        $sql = 'SELECT * FROM estacion ;';
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 

        while (!$datos->EOF) {
            if (md5((string) $datos->fields["id"]) == $id) {
              
                $result = new Estacion();
                $result->setId($datos->fields["id"]);
                $result->setNombre($datos->fields["nombre"]);
                $result->setCiudad($datos->fields["ciudad"]);
                return $result;
            }
            $datos->MoveNext();
        }
        //echo('no lo encuentra');
        return $result;
    }

    //funcion que devuelve un Usuario de la base de datos segun su ID null de lo contrario
    public function DamePorID($id) {
        $result = null;
        $sql = 'SELECT * FROM estacion where id=' . $id . ';';
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        if (!$datos->EOF) {
                $result = new Estacion();
                $result->setId($datos->fields["id"]);
                $result->setNombre($datos->fields["nombre"]);
                $result->setCiudad($datos->fields["ciudad"]);
                return $result;
        }
        return $result;
    }

    //funcion para borrar a un usuario segun su id
    // devuelve true si se ha conseguido y false en caso contrario
    public function delete($i) {
        $deleted = false;
        $result = $this->BD->Execute("DELETE FROM estacion WHERE id='" . $i . "'");
        if (!$result->EOF) {
            $deleted = true;
        }
        return $deleted;
    }

    //compruebaID del usuario encriptado en md5 y devuelve sus datos para su posterior 
    //activacion devuelve el  id Real


    public function ComprobarID($id) {

        $result = $this->BD->Query("SELECT * FROM estacion");
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
        $sql = 'SELECT * FROM estacion where 1 ' . $condiciones;
        ;
        $datos = $this->BD->Query($sql);
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        $aUsers = array();
        while (!$datos->EOF) {
            $result = new Estacion();
                $result->setId($datos->fields["id"]);
                $result->setNombre($datos->fields["nombre"]);
                $result->setCiudad($datos->fields["ciudad"]);
                return $result;
                $aUsers[] = $result;
            $datos->MoveNext();
        }
        return $aUsers;
    }

    //funcion que devuelve count de Usuario de la base de datos segun condiciones
    public function CuentaTodos($condiciones) {
        $sql = 'SELECT count(*) as total FROM estacion where 1 ' . $condiciones;
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
