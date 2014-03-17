<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ("./BDBusqueda.php");
$busqueda = new BDBusqueda();
$codPromocional = $_POST["codPromocional"];
$FechaIdaSel = $busqueda->date2sql($_POST["FechaIdaSel"]);


$origen = $_POST["origen"];
$pos = strpos($origen,".");
$eorigen = substr($origen, 0,$pos);
$corigen = substr($origen, $pos+1, strlen($origen)-$pos);
$destino = $_POST["destino"];
$pos = strpos($destino,".");
$edestino = substr($destino, 0,$pos);
$cdestino = substr($destino, $pos+1, strlen($destino)-$pos);
$hsalida  = $FechaIdaSel . " " . $_POST["HoraIdaSel"];

$busqueda->codigoPromocional($codPromocional, $FechaIdaSel);
$busqueda->Consulta($eorigen,$edestino,$corigen,$cdestino,$hsalida,1);



?>
