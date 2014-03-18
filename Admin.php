<?php
$login = $_POST["usuario"];
$pass = $_POST["password"];
?>

<!DOCTYPE html>         
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title> Admin</title>
        <meta charset="utf-8">

    </head>
    <body>
        <form method="post" enctype="multipart/form-data" action="AnyadirAdmin.php">        
            



            <?
            require_once("./Usuario.php");
            require_once("./Estacion.php");
            $usuario = new Usuario();
            $usuario->setLogin($login);
            $usuario->setPassword($pass);
            $seguro = $usuario->Autenticar($usuario->getLogin(), $usuario->getPassword());

            if ($seguro) {
                $estacion = new Estacion();
                $ciudad = new Estacion();
                $ciudades = $estacion->DameNombreCiudades();
              ?> 
                 <table>

                <tr>
                    <td><?echo'<label> Ciudad</label>';?></td>
                    <td><?echo' <SELECT NAME="Ciudad">';

                       foreach ($ciudades as $ciudad) {
                       echo "<option  value= \"" . $ciudad->getCiudad() . "\">" . $ciudad->getCiudad() . "</option>";
                        }
                        echo'</SELECT>';?>
                    </td>
                    <td><input type=file size=60 name="imagen"></td>
                    <td> <input type="submit" value="SubirImagen"></td>
                </tr>
                <tr>
                    <td><?echo'<label>Trayecto</label>';?></td>
                    <td><?echo' <SELECT NAME="Ciudad">';

                       foreach ($ciudades as $ciudad) {
                       echo "<option  value= \"" . $ciudad->getCiudad() . "\">" . $ciudad->getCiudad() . "</option>";
                        }
                        echo'</SELECT>';?>
                    </td>
                    <td><input type=file size=60 name="video"></td>
                    <td> <input type="submit" value="SubirVideo"></td>
                </tr>
            </table>

            <?    
            } else {

                echo"<script>
                    alert('usuario o contraseña incorrectos');
                     </script>";

                echo"<script>window.location='Home.php'</script>";
            }
            ?>
           
        </form>
    </body>



</html>

