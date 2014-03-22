<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    require_once ("./BDatosConexion.php");
    
    class BDCiudad {
        private $BD = null;

        //creamos una un objeto de base de datos
        public function __construct() 
        {
            $this->BD = new BDatosConexion();
        }
        
        public function DameCodigoPorID($id) 
        {        
            $sql = 'SELECT codigo FROM Ciudad where id=' . $id . ';';
            $datos = $this->BD->Query($sql);
            //creamos un nuevo usuario y le insertamos los valores de la BD 
            $result = $datos->fields["codigo"];
            return $result;
        }
        
        public function DameNombrePorID($id) 
        {        
            $sql = 'SELECT nombre FROM Ciudad where id=' . $id . ';';
            $datos = $this->BD->Query($sql);
            //creamos un nuevo usuario y le insertamos los valores de la BD 
            $result = $datos->fields["nombre"];
            return $result;
        }
    }
?>    