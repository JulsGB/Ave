<?php

$tipoBD = "mysql";
$hostBD = "bbdd.dlsi.ua.es:3306";
$userBD = "gi_ave";
$passBD = ".gi_ave.";
$schemeBD = "gi_ave";
$connection = mysqli_connect("bbdd.dlsi.ua.es", "gi_ave", ".gi_ave.", "gi_ave", "3306");
$Ciudad = $_POST["Ciudad"];
$imagen = $_FILES["imagen"];
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

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
