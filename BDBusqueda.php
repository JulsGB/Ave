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
class BDBusqueda {

    private $BD = null;
    private $id_trayecto;
    private $id_tren;
    private $precioT;
    private $precioB;
    private $mostrarT;
    private $mostrarB;  
    private  $descuento;
    private $eorigen;
    private $edestino;
    private $corigen;
    private $cdestino;
    private $hsalida;
    private $hvuelta;
    private $viajeros;
    private $descJoven;
    private $descViejo;
    private $idaVuelta;
    private $option;
    

    //creamos una un objeto de base de datos
    public function __construct() {
        $this->BD = new BDatosConexion();
    }

    public function __destruct() {
        
    }
    function do_alert($msg) 
    {
        echo '<script type="text/javascript">alert("' . $msg . '"); </script>';
    }
    public function date2sql($date)
    {
         $anno = substr($date,6  ,4);
         $mes = substr($date,3,2);
         $dia = substr($date,0,2); 
         return $anno . "-" . $mes . "-" . $dia;
        
    }
    public function codigoPromocional($cod,$date) 
    {
       // $datesql = $this->date2sql($date);
        $sql = "SELECT descuento FROM gi_ave.Codigo_Promocional where"
                . " id='" . $cod . "' AND "
                . "inicio<='" . $date . "' AND "
                . "fin>='" . $date . "';";
        $datos = $this->BD->Query($sql);
       // echo $sql;
        //creamos un nuevo usuario y le insertamos los valores de la BD 
        if (!$datos->EOF) {
            $this->descuento = $datos->fields[0];                       
        }  
        else {    
            if($cod)
                $this->do_alert("Cod malo");
        }
    }
    Public function find($sql) {    
        $BD2 = new BDatosConexion();
        $datos = $BD2->Query($sql);
      //creamos un nuevo usuario y le insertamos los valores de la BD 
        if (!$datos->EOF) {
            return  $datos->fields[0];                 
        }    
        $BD2 = null;
        return "";
    }
    Public function PrintImgCiudadOrd() {    
         $sql = "SELECT imagen FROM gi_ave.Ciudad WHERE gi_ave.Ciudad.id =" . $this->corigen;      
         $link = mysql_connect("bbdd.dlsi.ua.es", "gi_ave", ".gi_ave.", "gi_ave", "3306") or die(mysql_error($link));;         
         $conn = mysql_query($sql, $link) or die(mysql_error($link)); 
         $datos = mysql_fetch_array($conn);
        // La imagen
        $imagen = $datos[0];
        $img_str = base64_encode($imagen);
        echo '<td align=center colspan=4><img src="data:image/jpg;base64,'.$img_str.'" height="91" width="137"/></td>';
        
    }
    Public function PrintImgCiudadDes() {    
         $sql = "SELECT imagen FROM gi_ave.Ciudad WHERE gi_ave.Ciudad.id =" . $this->cdestino;               
         $link = mysql_connect("bbdd.dlsi.ua.es", "gi_ave", ".gi_ave.", "gi_ave", "3306") or die(mysql_error($link));;         
         $conn = mysql_query($sql, $link) or die(mysql_error($link)); 
         $datos = mysql_fetch_array($conn);
        // La imagen
        $imagen = $datos[0];
        $img_str = base64_encode($imagen);
        echo '<td align=center colspan=4><img src="data:image/jpg;base64,'.$img_str.'" height="91" width="137"/></td>';
        
    }
    Public function descuentosTarjeta() {    
        $sql = "SELECT gi_ave.Tarjeta_de_Descuento.id,gi_ave.Tarjeta_de_Descuento.descuento FROM gi_ave.Tarjeta_de_Descuento";
        $BD2 = new BDatosConexion();
        $datos = $BD2->Query($sql);
       
      //creamos un nuevo usuario y le insertamos los valores de la BD 
        while (!$datos->EOF) 
        {
            if($datos->fields[0] == 1)                 
                $this->descJoven = $datos->fields[1];
            else 
                $this->descViejo = $datos->fields[1];
            $datos->MoveNext();        
        }    
        $BD2 = null;
        return "";
    }
    Public function filaTrayecto()
    {
        echo  "<tr><td>";
        echo  "ID-".$this->id_trayecto;
        echo "</td><td>";       
        $query = "Select gi_ave.Tren.marca from gi_ave.Tren where gi_ave.Tren.id = " . $this->id_tren;
        echo  "" . $this->id_tren . "-" . $this->find($query);           
        
        echo "</td><td>";       
        $query = "SELECT code FROM gi_ave.EstacionCiudad where idciudad = " . $this->corigen .
                " AND idestacion = " . $this->eorigen;
        echo  $this->find($query);   
        echo "</td><td>"; 
        $query = "SELECT salida FROM gi_ave.Tramo where Estacion_Ciudad_id_Origen = " . $this->corigen .
                " AND Estacion_id_Origen = " . $this->eorigen .
                " AND Trayecto_id = " . $this->id_trayecto;

        echo  "" . substr($this->find($query),11,5);   
        echo "</td><td>";       
        $query = "SELECT code FROM gi_ave.EstacionCiudad where idciudad = " . $this->cdestino .
                " AND idestacion = " . $this->edestino;
        echo  $this->find($query);   
        echo "</td><td>";         
        $query = "SELECT llegada FROM gi_ave.Tramo where Estacion_Ciudad_id_Destino = " . $this->cdestino .
                " AND Estacion_id_Destino = " . $this->edestino .
                " AND Trayecto_id = " . $this->id_trayecto;
            echo  "" . substr($this->find($query),11,5);   
        echo "</td><td>";        
        echo "<input type='radio' name='" . $this->option . "'/> " . $this->precioT . " euros";       
        echo "<br><input type='radio' name='" . $this->option . "'/>Tarjeta Joven: " . $this->precioT * (1-$this->descJoven) . " euros";
        echo "<br><input type='radio' name='" . $this->option . "'/>Tarjeta Dorada: " . $this->precioT * (1-$this->descViejo). " euros";
        echo "</td><td>";        
        echo "<input name='radio' type='radio' name='" . $this->option . "'/> " . $this->precioB . " euros";       
        echo "<br><input type='radio' name='" . $this->option . "'/>Tarjeta Joven: " . $this->precioB * (1-$this->descJoven) . " euros";
        echo "<br><input type='radio' name='" . $this->option . "'/>Tarjeta Dorada: " . $this->precioB * (1-$this->descViejo). " euros";
       /*echo "</td><td>";
       echo $this->PrintImgCiudadOrd();
       echo "</td><td>";
       echo $this->PrintImgCiudadDes();*/    
        
        
        
        echo "</td></tr>";
                
    }
    Public function Consulta($eorigen, $edestino, $corigen, $cdestino, $hsalida,$hregreso,$idaVuelta,$viajeros) {
        
        $this->eorigen = $eorigen;
        $this->edestino = $edestino;
        $this->corigen = $corigen;
        $this->cdestino = $cdestino;
        $this->hsalida = $hsalida;
        $this->hvuelta = $hregreso;
        $this->idaVuelta = $idaVuelta;
        $this->viajeros = $viajeros;
        $query_ida = "call gi_ave.Consulta_Viaje(".$eorigen.",".$edestino.",".$corigen.
         ",".$cdestino.",'".$hsalida."'," . $viajeros . ")"; 
        $this->option = "Pida";
        $this->Ida($query_ida);
        $query_ida = "call gi_ave.Consulta_Viaje(".$edestino.",".$eorigen.",".$cdestino.
         ",".$corigen.",'".$hregreso."'," . $viajeros . ")"; 
         if($this->idaVuelta)
         {
            $this->option = "Pvuelta";
            $this->Vuelta($query_ida);
         }
    }
    Public function Ida($query_ida) {
        $connection = mysqli_connect("bbdd.dlsi.ua.es", "gi_ave", ".gi_ave.", "gi_ave", "3306");               
        //run the store proc
        $result = mysqli_query($connection, $query_ida) or die("Query fail: " . mysqli_error());
        //$result=$this->BD->Query("call gi_ave.Consulta_Viaje(1,4,1,4,'2014-03-10')");
        //loop the result set
        $this->descuentosTarjeta();
        echo '<table border = "1"><form id="confirmar" name="confirmar" method="post" action="confirmar.php">';
        echo '<tr><td align=center colspan=8> IDA </td>' . 
                '<tr>' .$this->PrintImgCiudadOrd() .    
                '' .
                $this->PrintImgCiudadDes() .    '</tr>';
                
        echo "<tr><td>Trayecto</td><td>Tren</td><td>Origen</td><td>Salida</td><td>Destino</td><td>Llegada</td><td>" . 
                "Precio Turista</td><td>Precio Preferente</td></tr>";
        while ($row = mysqli_fetch_array($result)) {  
            $this->id_trayecto =  $row[0];            
            $this->id_tren = $row[1];
            $this->precioT = $row[2]* (1-$this->descuento);
            $this->precioB = $row[3]* (1-$this->descuento);            
            $this->mostrarT = $row[4]>=$this->viajeros;
            $this->mostrarB = $row[5]>=$this->viajeros;          
            $this->filaTrayecto();
        }
        //$sql = "call  Consulta_Viaje('" . $eorigen . "','" . $edestino . "','" . $corigen . "','" . $cdestino . "','" . $hsalida . "');";
        //$datos = $this->BD->Query($sql);
        // echo $datos->fields["Trayecto_id"];
    }
     Public function Vuelta($query_ida) {
        $connection = mysqli_connect("bbdd.dlsi.ua.es", "gi_ave", ".gi_ave.", "gi_ave", "3306");                       
        $result = mysqli_query($connection, $query_ida) or die("Query fail: " . mysqli_error());
        
        echo '<tr><td align=center colspan=8> VUELTA </td></tr>';                
        echo "<tr><td>Trayecto</td><td>Tren</td><td>Origen</td><td>Salida</td><td>Destino</td><td>Llegada</td><td>" . 
                "Precio Turista</td><td>Precio Preferente</td></tr>";
        while ($row = mysqli_fetch_array($result)) {  
            $this->id_trayecto =  $row[0];            
            $this->id_tren = $row[1];
            $this->precioT = $row[2]* (1-$this->descuento);
            $this->precioB = $row[3]* (1-$this->descuento);            
            $this->mostrarT = $row[4]>=$this->viajeros;
            $this->mostrarB = $row[5]>=$this->viajeros;          
            $this->filaTrayecto();
        }
        //$sql = "call  Consulta_Viaje('" . $eorigen . "','" . $edestino . "','" . $corigen . "','" . $cdestino . "','" . $hsalida . "');";
        //$datos = $this->BD->Query($sql);
        // echo $datos->fields["Trayecto_id"];
    }
}
 ?>
