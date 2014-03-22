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
class BDTrayecto {
    private $BD = null;

    //creamos una un objeto de base de datos
    public function __construct() {
        $this->BD = new BDatosConexion();
    }

    public function __destruct() {
        
    }
    
    public function DameTrayecto($ciudadOrigen,$ciudadDestino){
       $sql= "select Estacion_Ciudad_id_Origen, Estacion_Ciudad_id_Destino from Trayecto group by Estacion_Ciudad_id_Origen, Estacion_Ciudad_id_Destino;";
    
    }
    
    public function DameCiudad($idciudad){
        $sql="select nombre from Ciudad where id ='".$idciudad."'";
        return $nombre;
    }   
    }

?>
