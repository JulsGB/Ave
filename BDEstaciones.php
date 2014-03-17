<?php

/**
* @author AveTEAM
if (0 > version_compare(PHP_VERSION, '5')) {
die('This file was generated for PHP 5');
}

/**
* includes 
*/
require_once ("./BDatosConexion.php");

/**
* clase Usuario
* representa todos los usuarios de la aplicacion 
*/
class BDEstaciones {

private $BD = null;

//creamos una un objeto de base de datos
public function __construct() {
    $this->BD = new BDatosConexion();
}

public function __destruct() {

}
public function estaciones() 
{
    $sql = 'SELECT * FROM gi_ave.EstacionCiudad;';
    $datos = $this->BD->Query($sql);
    echo  "<option value = \"0\"></option>";
   //creamos un nuevo usuario y le insertamos los valores de la BD 
    while (!$datos->EOF) {
        echo  "<option value = \"" .$datos->fields[0] . "\">" . 
                                    $datos->fields[1] . "</option>";
        $datos->MoveNext();            
    }       
}
}
?>
