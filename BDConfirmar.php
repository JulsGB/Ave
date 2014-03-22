<?php
function getRealIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   
    return $_SERVER['REMOTE_ADDR'];
}
require_once ("./BDatosConexion.php");
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
    
}



class BDConfirmar {

    private $BD = null;
    private $trayectoIda;
    private $idTren;
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
    
    



    //creamos una un objeto de base de datos
    public function __construct() {
        $this->BD = new BDatosConexion();
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
             
             
             $this->BilletesIda[$i] = new Billete();
             $this->BilletesIda[$i]->reserva = "REV-" . substr($this->salidaIda,1,4) . "." . $this->idReserva;
             $this->BilletesIda[$i]->fecha = substr($this->salidaIda,5,2) . "/" . substr($this->salidaIda,8,2) . "/" .  substr($this->salidaIda,0,4);
             $this->BilletesIda[$i]->tren = "ave".$this->idTren;
             $this->BilletesIda[$i]->identificador = 
             echo $this->BilletesIda[$i]->fecha;
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
    public function setRerserva($ida,$vuelta,$ip,$codPromocional,$viajeros)
    {
        $pos = strpos($ida,";");
        $this->trayectoIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);
        
        $pos = strpos($ida,";");
        $this->idTren = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->corgIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->eorgIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->cdesIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->edesIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->salidaIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->llegadaIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->tarjetaIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->claseIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->descuentoIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        $pos = strpos($ida,";");
        $this->precioIda = substr($ida, 0,$pos);
        $ida = substr($ida, $pos+1,strlen($ida)-$pos);

        if($vuelta != "")
        {
            $this->vuelta = true;
            $pos = strpos($vuelta,";");
            $this->trayectoVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->corgVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->eorgVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->cdesVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->edesVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->salidaVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->llegadaVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->tarjetaVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->claseVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->descuentoVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);

            $pos = strpos($vuelta,";");
            $this->precioVuelta = substr($vuelta, 0,$pos);
            $vuelta = substr($vuelta, $pos+1,strlen($vuelta)-$pos);
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
    

}

$confirmacion = new BDConfirmar();
$confirmacion->setRerserva($Ida,$Vuelta,$ip,$codPromocional,$Viajeros);

?>  