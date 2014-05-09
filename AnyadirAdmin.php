<?php
require_once('./Trayecto.php');

$tipoBD = "mysql";
$hostBD = "bbdd.dlsi.ua.es:3306";
$userBD = "gi_ave_operario";
$passBD = "ave_operario";
$schemeBD = "gi_ave";
$connection = mysqli_connect("bbdd.dlsi.ua.es", "gi_ave_operario", "ave_operario", "gi_ave", "3306");


if ($_FILES["imagen"]["tmp_name"]!="") {
    $imagen = $_FILES["imagen"];
    $Ciudad = $_POST["Ciudad"];
    $image = imagecreatefromjpeg($imagen["tmp_name"]);
    ob_start();
    imagejpeg($image);
    $jpg = ob_get_contents();
    ob_end_clean();
    $jpg = str_replace('##', '##', mysql_escape_string($jpg));
    $que = ("UPDATE Ciudad  SET imagen='" . $jpg . "'where nombre='" . $Ciudad . "'");
    $result = mysqli_query($connection, $que);
    if ($result) {
        echo"<script>
                    alert('Imagen guardada!');
                     </script>";
        echo"<script>window.location='Home.php'</script>";
    } else {
        echo"<script>
                    alert('No se ha podido guardar la imagen');
                     </script>";
        echo"<script>window.location='Home.php'</script>";
    }
}

elseif (!empty($_FILES["video"]["tmp_name"])){
    

    $CiudadOrigen = $_POST["CiudadOrigen"];
    $CiudadDestino = $_POST["CiudadDestino"];

    if ($CiudadOrigen == $CiudadDestino) {
        echo"<script>
                    alert('La  ciudad de origen y destino deben ser diferentes ');
                     </script>";
        echo"<script>window.location='Home.php'</script>";
    } else {
        if (file_exists('Videos/' . $_FILES['video']['name'])) {
            echo 'El archivo ya existe: ' . $_FILES['video']['name'];
        } else {
            move_uploaded_file($_FILES['video']['tmp_name'], "Videos/" . $_FILES['video']['name']);

            echo "Guardado en: " . "Videos/" . $_FILES['video']['name'];
        }
        $trayecto= new Trayecto();
        $idTrayecto=$trayecto->DameTrayectos($CiudadOrigen, $CiudadDestino);
        $trayecto->AgregaUrlTrailer( "Videos/" . $_FILES['video']['name'], $idTrayecto);
        foreach ($idTrayecto as $value) {
        echo('trayectos con trailer: '.$value->getId());
        }}
 }
 else{
         echo"<script>
                    alert('se debe seleccionar uin video o una imagen');
                     </script>";
        echo"<script>window.location='Home.php'</script>";
    
 }

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
