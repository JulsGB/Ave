<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BDTrayecto
 *
 * @author Samsung
 */
require_once ("./BDatosConexion.php");
require_once('./Trayecto.php');

class BDTrayecto {

    private $BD = null;

    //creamos una un objeto de base de datos
    public function __construct() {
        $this->BD = new BDatosConexion();
    }

    public function __destruct() {
        
    }

    public function DameTrayectos($ciudadOrigen, $ciudadDestino) {
        $idciudadOrigen = $this->DameCiudad($ciudadOrigen);
        $idciudadDestino = $this->DameCiudad($ciudadDestino);
        $sql = "select id, Estacion_Ciudad_id_Origen,Estacion_Ciudad_id_Destino from Trayecto where Estacion_Ciudad_id_Origen='" . $idciudadOrigen . "' AND Estacion_Ciudad_id_Destino = '" . $idciudadDestino . "' group by id, Estacion_Ciudad_id_Origen,Estacion_Ciudad_id_Destino;";
        $datos = $this->BD->Query($sql);
        $result = null;
        $aTrayectos = array();
        while (!$datos->EOF) {
            $result = new Trayecto();
            $result->setId($datos->fields["id"]);
            $result->setCiudadOrigen($datos->fields["Estacion_Ciudad_id_Origen"]);
            $result->setCiudadDestino($datos->fields["Estacion_Ciudad_id_Destino"]);
            $aTrayectos[] = $result;
            $datos->MoveNext();
        }
        return $aTrayectos;
    }

    public function DameCiudad($ciudad) {
        $sql = "select id from Ciudad where nombre ='" . $ciudad . "'";
        $datos = $this->BD->Query($sql);
        $result = null; //creamos un nuevo usuario y le insertamos los valores de la BD 
        if (!$datos->EOF) {
            $result = $datos->fields["id"];
            return $result;
        }
        return $result;
    }

    public function AgregaUrlTrailer($url, $idTrayectos) {

        foreach ($idTrayectos as $value) {
            $sql = ("UPDATE Trayecto  SET url_trailer_peli='" . $url . "'where id='" . $value->getId() . "'");
            $result = $this->BD->Execute($sql);
            if (!$result->EOF) {
                $updated = true;
            } else {
                return false;
            }
        }
        return $update;
    }

}

?>
