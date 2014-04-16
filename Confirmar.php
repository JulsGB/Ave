<?php
  /*  header("Content-type: text/xml");
    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo '<?xml-stylesheet type="text/xsl" href="billete.xsl"?>';
    echo '<!DOCTYPE reserva SYSTEM "./billetedtd.dtd">';*/
    
    require_once ("./BDConfirmar.php");

  /*  $numTickets = $confirmacion->getViajeros();
    $infoIda = $confirmacion->getBilletesIda();
    $infoVuelta = $confirmacion->getBilletesVuelta();        

    echo '<reserva>';
    for($i=1; $i<=$numTickets; $i++)
    {
        echo '<billete>';
            echo'<id_reserva>'.$infoIda{$i}->reserva.'</id_reserva>';
            echo'<fecha>'.$infoIda{$i}->fecha.'</fecha>';
            echo'<tren>'.$infoIda{$i}->tren.'</tren>';
            echo'<trayecto>';
                echo'<identificador>'.$infoIda{$i}->identificador.'</identificador>';
                echo'<estacion_origen>'.$infoIda{$i}->estacion_origen.'</estacion_origen>';
                echo'<hora_salida>'.$infoIda{$i}->Hida.'</hora_salida>';
                echo'<estacion_destino>'.$infoIda{$i}->estacion_destino.'</estacion_destino>';
                echo'<hora_llegada>'.$infoIda{$i}->Hllegada.'</hora_llegada>';
            echo'</trayecto>';
            echo'<clase>'.$infoIda{$i}->clase.'</clase>';
            echo'<tarjeta>'.$infoIda{$i}->tarjeta.'</tarjeta>';
            echo'<precio>'.$infoIda{$i}->precio.' euros.</precio>';
        echo '</billete>';
    }

    if($Vuelta!="")
    {
        for($i=1; $i<=$numTickets; $i++)
        {
            echo '<billete>';
                echo'<reserva>'.$infoVuelta{$i}->reserva.'</reserva>';
                echo'<fecha>'.$infoVuelta{$i}->fecha.'</fecha>';
                echo'<tren>'.$infoVuelta{$i}->tren.'</tren>';
                echo'<trayecto>';
                    echo'<identificador>'.$infoVuelta{$i}->identificador.'</identificador>';
                    echo'<estacion_origen>'.$infoVuelta{$i}->estacion_origen.'</estacion_origen>';
                    echo'<hora_salida>'.$infoVuelta{$i}->Hida.'</hora_salida>';
                    echo'<estacion_destino>'.$infoVuelta{$i}->estacion_destino.'</estacion_destino>';
                    echo'<hora_llegada>'.$infoVuelta{$i}->Hllegada.'</hora_llegada>';
                echo'</trayecto>';
                echo'<clase>'.$infoVuelta{$i}->clase.'</clase>';
                echo'<tarjeta>'.$infoVuelta{$i}->tarjeta.'</tarjeta>';
                echo'<precio>'.$infoVuelta{$i}->precio.' euros.</precio>';
            echo '</billete>';
        }
    }
    echo '</reserva>';*/
?>