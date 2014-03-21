<html>
    <head></head>
    <body>

       <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ("./BDEstaciones.php");


?>
        <table>
            <tr><td>  <form method="POST" action="Admin.php">
            Usuario:</td><td><input type="text" name="usuario"></td></tr>
        <tr><td>Contraseña:</td><td><input type="password" name="password"> </td></tr>
        <tr><td><input type="submit" value="Entrar"></td></tr>
           
            
            
  </form>
            
        </table>
        
        
<div><form id="busqueda" name="busqueda" method="post" action="Busqueda.php">
<p>
<label for="origen">
Ida
<input name="idavuelta" type="radio" id="tipo" value="1" checked="checked" />Ida y vuelta<input type="radio" name="idavuelta" id="tipo" value="2" />
<br />
Origen</label>
<select name="origen" id="origen">
     <?php
    $org = new BDEstaciones();
    $org->estaciones();
    
    ?>
</select>
</p>
<p>
Destino
<select name="destino" id="destino">
    <?php
    $dst = new BDEstaciones();
    $dst->estaciones();
    
    ?>
</select>
</p> 

<p><label>Salida :</label> 
<input type="text" class="caja_textofechaSal"  name="FechaIdaSel" value="" />
<select id="HoraIdaSel" name="HoraIdaSel" class="caja_textohoraSal">
                <option value = "00:00">00:00</option>
                <option value = "01:00">01:00</option>
                <option value = "02:00">02:00</option>
                <option value = "03:00">03:00</option>
                <option value = "04:00">04:00</option>
                <option value = "05:00">05:00</option>
                <option value = "06:00">06:00</option>
                <option value = "07:00">07:00</option>
                <option value = "08:00">08:00</option>
                <option value = "09:00">09:00</option>
                <option value = "10:00">10:00</option>
                <option value = "11:00">11:00</option>
                <option value = "12:00">12:00</option>
                <option value = "13:00">13:00</option>
                <option value = "14:00">14:00</option>
                <option value = "15:00">15:00</option>
                <option value = "16:00">16:00</option>
                <option value = "17:00">17:00</option>
                <option value = "18:00">18:00</option>
                <option value = "19:00">19:00</option>
                <option value = "20:00">20:00</option>
                <option value = "21:00">21:00</option>
                <option value = "22:00">22:00</option>
                <option value = "23:00">23:00</option>
</select></p> 

<p>         
                <label for="FechaVueltaSel" id="divFechaVuelta">Regreso :</label>
<input type="text" id="FechaVueltaSel" class="caja_textofechaReg" name="FechaVueltaSel" />

                <select id="HoraVueltaSel" name="HoraVueltaSel" class="caja_textohoraReg">
                                <option value = "00:00">00:00</option>
                                <option value = "01:00">01:00</option>
                                <option value = "02:00">02:00</option>
                                <option value = "03:00">03:00</option>
                                <option value = "04:00">04:00</option>
                                <option value = "05:00">05:00</option>
                                <option value = "06:00">06:00</option>
                                <option value = "07:00">07:00</option>
                                <option value = "08:00">08:00</option>
                                <option value = "09:00">09:00</option>
                                <option value = "10:00">10:00</option>
                                <option value = "11:00">11:00</option>
                                <option value = "12:00">12:00</option>
                                <option value = "13:00">13:00</option>
                                <option value = "14:00">14:00</option>
                                <option value = "15:00">15:00</option>
                                <option value = "16:00">16:00</option>
                                <option value = "17:00">17:00</option>
                                <option value = "18:00">18:00</option>
                                <option value = "19:00">19:00</option>
                                <option value = "20:00">20:00</option>
                                <option value = "21:00">21:00</option>
                                <option value = "22:00">22:00</option>
                                <option value = "23:00">23:00</option>
                </select></p>
<p><input name="tarjetaJoven" type="checkbox" class="buttom" value="TJ" id="tarjetaJoven" /><label for="tarjetaJoven">Tarjeta Joven</label>
<input name="tarjetaDorada" type="checkbox" class="buttom2"  value="TD" id="tarjetaDorada" /><label for="tarjetaDorada" class="buttom3">Tarjeta Dorada</label></p>
<p>
<label >Cod. Promocional :</label>
<INPUT type="text" name="codPromocional"/>
  </p>
  <input type="submit" value="Buscar">
  </form>
  </div>
    </body>
</html>


