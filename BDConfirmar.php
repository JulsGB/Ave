<?php
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}
require_once ("./BDatosConexion.php");
require_once ("./BDCiudad.php");
require_once ("./BDEstacion.php");

$Ida = $_POST["Pida"];
$Vuelta = $_POST["Pvuelta"];
$codPromocional = $_POST["PromocionId"];
$Viajeros = $_POST["viajeros"];
$ip = getRealIP();

class Billete
{
    public $reserva;
    public $fecha;
    public $tren;
    public $identificador;
    public $estacion_origen;
    public $Hida;
    public $estacion_destino;
    public $Hllegada;
    public $clase;
    public $tarjeta;
    public $precio;
    
    public function getReserva()
    {
        return $this->reserva;
    }
}



class BDConfirmar {

    
    private $BD = null;
    private $trayectoIda;
    private $idTrenIda;
    private $corgIda;
    private $eorgIda;
    private $cdesIda;
    private $edesIda;
    private $salidaIda;
    private $llegadaIda;
    private $tarjetaIda;
    private $claseIda;
    private $descuentoIda;
    private $precioIda;
    private $trayectoVuelta;
    private $idTrenVuelta;
    private $corgVuelta;
    private $eorgVuelta;
    private $cdesVuelta;
    private $edesVuelta;
    private $salidaVuelta;
    private $llegadaVuelta;
    private $tarjetaVuelta;
    private $claseVuelta;
    private $descuentoVuelta;
    private $precioVuelta;
    private $idReserva;
    private $ip;
    private $codPromocional;
    private $Viajeros;
    private $idBilletesIda;
    private $idBilletesVuelta;
    private $vuelta;
    private $BilletesIda;
    private $BilletesVuelta;
    private $tmpStr;
    



    //creamos una un objeto de base de datos
    public function __construct() {
        $this->BD = new BDatosConexion();
    }
    
    public function tarjetaToString($tarjeta) 
    {
            if($tarjeta==1)
            {
                return "Tarjeta Joven";                 
            }
            else if ($tarjeta==2)
            {
                return "Tarjeta Dorada";
            }
            return "";

    }



    public function registrarReserva()
    {
        $this->idBilletesIda = array($this->Viajeros);
        $this->idBilletesVuelta = array($this->Viajeros);
        $this->BilletesIda = array($this->Viajeros);
        $this->BilletesVuelta = array($this->Viajeros);
        
        
        $connection = mysqli_connect("bbdd.dlsi.ua.es", "gi_ave", ".gi_ave.", "gi_ave", "3306");               
        $date = date('Y-m-s h:i:s', time());
        if (!$connection) {
            die('No se pudo conectar: ' . mysql_error());
        }
        mysql_select_db('gi_ave');
        $sql = "INSERT INTO `gi_ave`.`Reserva`(`fecha`,`cliente`,`estado`,`ip`,`Codigo_Promocional_id`)" .
        "VALUES ('" . $date . "','Cliente Web',false,'" . $this->ip . "'," . $this->codPromocional . ")";

        mysql_query($sql);
        $this->idReserva = mysql_insert_id();
     
        $BDCiudad = new BDCiudad();
        $BDEstacion = new BDEstacion();
        
        for($i = 1;$i<=$this->Viajeros;$i++)
        {
            $sql = "INSERT INTO `gi_ave`.`Billete` " . 
            "(`descuento`,`Tipo`,`precio_base`,`porcentaje_impuesto`,`PVP`," .
                    "`coche`,`plaza`,`Tarjeta_de_Descuento_id`,`Reserva_id`,`Clase`,`Viajero`) ".
            "VALUES(" . $this->descuentoIda . ",1,0,0.21," . $this->precioIda .
            ",1,2," .$this->tarjetaIda . "," . $this->idReserva . ",'" . $this->claseIda . 
            "',". $i . ")";
           
             mysql_query($sql);
             $this->idBilletesIda[$i] = mysql_insert_id();   
             
             $codigoCiudadOrigen = $BDCiudad->DameCodigoPorID($this->corgIda);
             $codigoCiudadDestino = $BDCiudad->DameCodigoPorID($this->cdesIda);
             $nombreCiudadOrigen = $BDCiudad->DameNombrePorID($this->corgIda);
             $nombreCiudadDestino = $BDCiudad->DameNombrePorID($this->cdesIda);
             $nombreEstacionOrigen = $BDEstacion->DameNombrePorID($this->eorgIda);
             $nombreEstacionDestino = $BDEstacion->DameNombrePorID($this->edesIda);
                         
             $this->BilletesIda[$i] = new Billete();
             $this->BilletesIda[$i]->reserva = "REV-" . substr($this->salidaIda,0,4) . "." . $this->idReserva;
             $this->BilletesIda[$i]->fecha = substr($this->salidaIda,5,2) . "/" . substr($this->salidaIda,8,2) . "/" .  substr($this->salidaIda,0,4);
             $this->BilletesIda[$i]->tren = "ave".$this->idTrenIda;
             $this->BilletesIda[$i]->identificador = "TKT-".$codigoCiudadOrigen."-".$codigoCiudadDestino."-".$this->trayectoIda.".".$this->idReserva.".".$i;
             $this->BilletesIda[$i]->estacion_origen = $nombreCiudadOrigen."-".$nombreEstacionOrigen;
             $this->BilletesIda[$i]->Hida = $this->salidaIda;
             $this->BilletesIda[$i]->estacion_destino = $nombreCiudadDestino."-".$nombreEstacionDestino;
             $this->BilletesIda[$i]->Hllegada = $this->llegadaIda;
             $this->BilletesIda[$i]->clase = $this->claseIda;
             $this->BilletesIda[$i]->tarjeta = $this->tarjetaToString($this->tarjetaIda);         
             $this->BilletesIda[$i]->precio = $this->precioIda;      
                          
             $sql = "SELECT id FROM gi_ave.Tramo" .
               " where Trayecto_id =" . $this->trayectoIda . " and " .
                "salida>='" . $this->salidaIda . "' and llegada<='" .
                $this->llegadaIda . "'";
             
              $result = mysqli_query($connection, $sql) or die("Query fail: " . mysqli_error());
               while ($row = mysqli_fetch_array($result)) {  
                  
                    $idTrayecto = $row[0];
                    $sql = "INSERT INTO `gi_ave`.`Billete_has_Tramo` " . 
                    "(`Billete_id`,`Tramo_id`) VALUES (".
                    $this->idBilletesIda[$i] . "," . $idTrayecto . ")";
                    mysql_query($sql);
                    if($this->claseIda == "Turista")
                     $sql = "UPDATE `gi_ave`.`Tramo` SET `disponibilidad_turista` = `disponibilidad_turista` - 1 " .
                            "WHERE `id` = " . $idTrayecto;
                    else 
                        $sql = "UPDATE `gi_ave`.`Tramo` SET `disponibilidad_bussines` = `disponibilidad_bussines` - 1 " .
                            "WHERE `id` = " . $idTrayecto;                    
                     mysql_query($sql);  
               }
             
        }
        if($this->vuelta)
        {
            for($i = 1;$i<=$this->Viajeros;$i++)
            {
                $sql = "INSERT INTO `gi_ave`.`Billete` " . 
                "(`descuento`,`Tipo`,`precio_base`,`porcentaje_impuesto`,`PVP`," .
                        "`coche`,`plaza`,`Tarjeta_de_Descuento_id`,`Reserva_id`,`Clase`,`Viajero`) ".
                "VALUES(" . $this->descuentoVuelta . ",2,0,0.21," . $this->precioIda .
                ",1,2," .$this->tarjetaVuelta . "," . $this->idReserva . ",'" . $this->claseVuelta . 
                "',". $i . ")";
                mysql_query($sql); 
                $this->idBilletesVuelta[$i] = mysql_insert_id();                  

                $this->BilletesVuelta[$i] = new Billete();
                $this->BilletesVuelta[$i]->reserva = "REV-" . substr($this->salidaVuelta,0,4) . "." . $this->idReserva;
                $this->BilletesVuelta[$i]->fecha = substr($this->salidaVuelta,5,2) . "/" . substr($this->salidaVuelta,8,2) . "/" .  substr($this->salidaIda,0,4);
                $this->BilletesVuelta[$i]->tren = "ave".$this->idTrenVuelta;
                $this->BilletesVuelta[$i]->identificador = "TKT-".$codigoCiudadDestino."-".$codigoCiudadOrigen.".".$this->trayectoVuelta.".".$this->idReserva.".".$i;
                $this->BilletesVuelta[$i]->estacion_origen = $nombreCiudadDestino."-".$nombreEstacionDestino;
                $this->BilletesVuelta[$i]->Hida = $this->salidaVuelta;
                $this->BilletesVuelta[$i]->estacion_destino = $nombreCiudadOrigen."-".$nombreEstacionOrigen;
                $this->BilletesVuelta[$i]->Hllegada = $this->llegadaVuelta;
                $this->BilletesVuelta[$i]->clase = $this->claseVuelta;
                $this->BilletesVuelta[$i]->tarjeta = $this->tarjetaToString($this->tarjetaVuelta);         
                $this->BilletesVuelta[$i]->precio = $this->precioVuelta;  
                 
                $sql = "SELECT id FROM gi_ave.Tramo" .
               " where Trayecto_id =" . $this->trayectoVuelta . " and " .
                "salida>='" . $this->salidaVuelta . "' and llegada<='" .
                $this->llegadaVuelta . "'";
             
              $result = mysqli_query($connection, $sql) or die("Query fail: " . mysqli_error());
               while ($row = mysqli_fetch_array($result)) {  
                  
                   $idTrayecto = $row[0];
                   $sql = "INSERT INTO `gi_ave`.`Billete_has_Tramo` " . 
                    "(`Billete_id`,`Tramo_id`) VALUES (".
                    $this->idBilletesVuelta[$i] . "," . $idTrayecto . ")";
                    mysql_query($sql);
                    if($this->claseVuelta == "Turista")
                     $sql = "UPDATE `gi_ave`.`Tramo` SET `disponibilidad_turista` = `disponibilidad_turista` - 1 " .
                            "WHERE `id` = " . $idTrayecto;
                    else 
                        $sql = "UPDATE `gi_ave`.`Tramo` SET `disponibilidad_bussines` = `disponibilidad_bussines` - 1 " .
                            "WHERE `id` = " . $idTrayecto;
                     mysql_query($sql);  
               }
                     
             }
        }    
             
    }     
    private function cortarCadena()
    {
        $pos = strpos($this->tmpStr,";");
        $resultado = substr($this->tmpStr, 0,$pos);
        $this->tmpStr = substr($this->tmpStr, $pos+1,strlen($this->tmpStr)-$pos);
        return $resultado;
        
    }
    
    private function extraer_ida()
    {
        $this->trayectoIda = $this->cortarCadena();
        $this->idTrenIda = $this->cortarCadena();
        $this->corgIda = $this->cortarCadena();
        $this->eorgIda = $this->cortarCadena();
        $this->cdesIda = $this->cortarCadena();
        $this->edesIda = $this->cortarCadena();
        $this->salidaIda = $this->cortarCadena();
        $this->llegadaIda = $this->cortarCadena();
        $this->tarjetaIda = $this->cortarCadena();
        $this->claseIda = $this->cortarCadena();
        $this->descuentoIda = $this->cortarCadena();
        $this->precioIda = $this->cortarCadena();
    }
    private function extraer_vuelta()
    {
        $this->trayectoVuelta = $this->cortarCadena();
        $this->idTrenIda = $this->cortarCadena();
        $this->corgVuelta = $this->cortarCadena();
        $this->eorgVuelta = $this->cortarCadena();
        $this->cdesVuelta = $this->cortarCadena();
        $this->edesVuelta = $this->cortarCadena();
        $this->salidaVuelta = $this->cortarCadena();
        $this->llegadaVuelta = $this->cortarCadena();
        $this->tarjetaVuelta = $this->cortarCadena();
        $this->claseVuelta = $this->cortarCadena();
        $this->descuentoVuelta = $this->cortarCadena();
        $this->precioVuelta = $this->cortarCadena();
        
    }
               
    public function setReserva($ida, $vuelta, $ip, $codPromocional, $viajeros)
    {
        $this->tmpStr = $ida;
        $this->extraer_ida();    
        if($vuelta != "")
        {
            $this->tmpStr = $vuelta;
            $this->vuelta = true;
            $this->extraer_vuelta();       
        }    
        else 
        {
            $this->vuelta = false;
        }
        $this->ip = $ip; 
        if($codPromocional)
            $this->codPromocional = $codPromocional;
        else
            $this->codPromocional = 0;
        $this->Viajeros = $viajeros;
        $this->registrarReserva();
    }
    
    public function getBilletesIda()
    {
        return $this->BilletesIda;
    }
    
    public function getBilletesVuelta()
    {
        return $this->BilletesVuelta;
    }
    public function getViajeros() 
    {
        return $this->Viajeros;
    }    
}

$confirmacion = new BDConfirmar();
$confirmacion->setReserva($Ida,$Vuelta,$ip,$codPromocional,$Viajeros);
?>  