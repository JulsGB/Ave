<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:template match="reserva">        
        <HTML>
            <head>
                <title></title>
            </head>            
        </HTML>           
        <BODY>
                <xsl:apply-templates/>
        </BODY>
    </xsl:template>
    
    <xsl:template match="billete">
        <table border="1" bordercolor="#000000" width="650">
            <table width="650">
                <tr>
                    <td> 
                        <xsl:value-of select="id_reserva"/> 
                    </td>
                    <td align= "right"> 
                        <xsl:value-of select="fecha"/> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <td>Tren:</td>
                        <td>
                            <xsl:value-of select="tren"/>
                        </td>                    
                    </td>
                </tr>
                <tr border="1"> </tr>
                <tr> 
                    <xsl:value-of select="trayecto/identificador"/> 
                </tr>
                <tr>
                    <td>
                        <td>Origen:</td> 
                        <td>
                            <xsl:value-of select="trayecto/estacion_origen"/>
                        </td>
                    </td>
                    <td>
                        <xsl:value-of select="trayecto/hora_salida"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <td>Destino:</td> 
                        <td>
                            <xsl:value-of select="trayecto/estacion_destino"/>
                        </td>
                    </td>
                    <td>
                        <xsl:value-of select="trayecto/hora_llegada"/>
                    </td>               
                </tr>
                <tr>
                    <td>
                        <td>Clase:</td>
                        <td>
                            <xsl:value-of select="clase"/>
                        </td>                         
                    </td>
                    <td>
                        <xsl:value-of select="tarjeta"/>
                    </td>                
                </tr>
                <tr>
                    <td></td>
                    <td align= "right">
                        <xsl:value-of select="precio"/>
                    </td>                
                </tr>
            </table>                                    
        </table>
        <br></br>                                                                                                                   
    </xsl:template>    
</xsl:stylesheet>