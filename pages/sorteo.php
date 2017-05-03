<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 23/2/2017
 * Time: 23:18
 */

function sorteo ($numResultados,$digitos,$numMin,$numMax){
    $Ganador = array();
    /* aca generamos el numero de resultados */
    for ($i = 1; $i < $numResultados; $i++) {
        otro:
        $tmp=rand ( $numMin , $numMax );
        $Ganador[$i]=$tmp;
   /*  anti repetidos */
        $longitud = count($Ganador) ;
        for($x=1; $x<$longitud; $x++){
             if ($Ganador[$i]==$Ganador[$x]) { goto otro ; }
        }/* si se repite busco otro */
    }

    /* Mostramos los resultados */
    for ($i = 1; $i < $numResultados; $i++) {
        $tmp= str_pad($Ganador[$i], $digitos , "0", STR_PAD_LEFT); /* si lo queres con ceros adelantes */

        echo "resultado ->".$i." de ->".$Ganador[$i]." o Con Formaro / ".$tmp." / <br>" ;

        /*  aca iria tu conexion a tu base de datos */

        $sql="Select * from tablaX where numerito=".$Ganador[$i];
        /********************************* */
    }
}
 /* para usarlo solo */
sorteo(100,4,1,9);