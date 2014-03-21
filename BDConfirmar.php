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
$ip = getRealIP();





class BDConfirmar {

    private $BD = null;
    private $trayectoIda;
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
    private $ip;


    //creamos una un objeto de base de datos
    public function __construct() {
        $this->BD = new BDatosConexion();
    }
    public function setRerserva($ida,$vuelta,$ip)
    {
        $pos = strpos($ida,";");
        $this->trayectoIda = substr($ida, 0,$pos);
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
        $this->ip = $ip;    
    }

}

$confirmacion = new BDConfirmar();
$confirmacion->setRerserva($Ida,$Vuelta,$ip);

?>