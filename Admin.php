<?php
$login=$_POST["usuario"];
$pass=$_POST["password"];

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
        <input type=file size=60 name="imagen">
       
        
        
        <?
            require_once("./Usuario.php");
            require_once("./Estacion.php");
            $usuario= new Usuario();
            $usuario->setLogin($login);
            $usuario->setPassword($pass);
            $seguro=$usuario->Autenticar($usuario->getLogin(), $usuario->getPassword());
            
            if($seguro){
                $estacion=new Estacion();
                $ciudad=new Estacion();
                $ciudades=$estacion->DameNombreCiudades();
               echo'<label> Ciudad</label>' ;
               echo' <SELECT NAME="Ciudad">'; 
                   
               foreach ($ciudades as $ciudad) {
                     echo "<option  value= \"" . $ciudad->getCiudad() . "\">" . $ciudad->getCiudad() . "</option>";
               }     
               echo'</SELECT>'; 
            }
            else{
                
                echo"<script>
                    alert('usuario o contraseña incorrectos');
                     </script>";
                
                echo"<script>window.location='Home.php'</script>";
                         
                    
                
                
                }
                
        
        ?>
        <input type="submit" value="Subir">
       </form>
    </body>



</html>

