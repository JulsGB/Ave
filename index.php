<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
           require_once ("./BDatosConexion.php");
           require_once ("./Usuario.php");
           
           $usu= new Usuario();
           $hsalida= new DateTime('2014-03-09 09:00:00');
           $usu->Consulta(1, 3, 1, 3, $hsalida->format('Y-m-d H:i:s'));
          
          
          
            
        ?>
    </body>
</html>
