<?php
require_once ("./BDConfirmar.php");

    $numTickets = $confirmacion->getViajeros();
    $infoIda = $confirmacion->getBilletesIda();
    $infoVuelta = $confirmacion->getBilletesVuelta();        
    
    for($i=1; $i<=$numTickets; $i++)
    {
        echo "Reserva: ".$infoIda{$i}->reserva."<br/>";
        echo "Fecha: ".$infoIda{$i}->fecha."<br/>";
        echo "Tren: ".$infoIda{$i}->tren."<br/>";
        echo "Id: ".$infoIda{$i}->identificador."<br/>";
        echo "Origen: ".$infoIda{$i}->estacion_origen."<br/>";
        echo "Salida: ".$infoIda{$i}->Hida."<br/>";
        echo "Destino: ".$infoIda{$i}->estacion_destino."<br/>";
        echo "Llegada: ".$infoIda{$i}->Hllegada."<br/>";
        echo "Tarjeta Descuento: ".$infoIda{$i}->clase."<br/>";
        echo "Tarjeta: ".$infoIda{$i}->tarjeta."<br/>";
        echo "Precio: ".$infoIda{$i}->precio."<br/>";
    }
    echo "<br/>";
    for($i=1; $i<=$numTickets; $i++)
    {
        echo "Reserva: ".$infoVuelta{$i}->reserva."<br/>";
        echo "Fecha: ".$infoVuelta{$i}->fecha."<br/>";
        echo "Tren: ".$infoVuelta{$i}->tren."<br/>";
        echo "Id: ".$infoVuelta{$i}->identificador."<br/>";
        echo "Origen: ".$infoVuelta{$i}->estacion_origen."<br/>";
        echo "Salida: ".$infoVuelta{$i}->Hida."<br/>";
        echo "Destino: ".$infoVuelta{$i}->estacion_destino."<br/>";
        echo "Llegada: ".$infoVuelta{$i}->Hllegada."<br/>";
        echo "Tarjeta Descuento: ".$infoVuelta{$i}->clase."<br/>";
        echo "Tarjeta: ".$infoVuelta{$i}->tarjeta."<br/>";
        echo "Precio: ".$infoVuelta{$i}->precio."<br/>";
    }
?>