<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 29/3/2017
 * Time: 20:25
 */

// error_reporting(0);
date_default_timezone_set('America/Argentina/Buenos_Aires');
$HOY = date("Y-m-d H:i:s");

include '../cgi/config2.inc';
mysqli_set_charset($conexion,"utf8");
if (!mysqli_set_charset($conexion, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
}

    $modo="";
    $Total=0;
    $x=0;
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
//$formatter->formatCurrency( $row["Precio"], 'USD'), PHP_EOL

if(isset($_GET["T"])){ $modo=$_GET["T"]; }
if(isset($_GET["L"])){ $Local=$_GET["L"];}
if(isset($_GET["D"])){ $D=$_GET["D"]; }
if(isset($_GET["desde"])){ $Desde=$_GET["desde"] ." 00:00:00" ; }
if(isset($_GET["hasta"])){ $Hasta=$_GET["hasta"]." 23:59:59"  ; }


if ($modo==1) { // Lista todos los Telefonos que estan en el local
    $sql="SELECT `idEqui`, `Cliente`, `Telefono`, `Equipo`, `Emai`, `Num`, `Monto`, `Senia`, `Restan`, `UE`, `UT`, `UV`, `Falla`, `Tecnico`, `FE`, `FT`, `FV`, `Chip`, `Tapa`, `Bateria`, `Memo`, `Local`, `Estado` FROM `t_equipo`";
    $sql=$sql." WHERE ((`Local`='".$Local."' )AND (`Estado` <5)) ;";

    $segmento = mysqli_query($conexion,$sql);
    $X=0;
    while ($row = mysqli_fetch_array($segmento)){
        $X=$X+1;
        $Cliente=$row["Cliente"];
        $ID=$row['idEqui'];
        $Telefono= $row["Telefono"];
        $Equipo= $row["Equipo"];
        $Emai= $row["Emai"];
        $Num=str_pad( $row["Num"] , 5, "0", STR_PAD_LEFT);
        $Monto= $row["Monto"] ;
        $Senia= $row["Senia"] ;
        $Restan= $formatter->formatCurrency( $row["Restan"], 'USD')  ;
        $UE= $row["UE"] ;
        $UT= $row["UT"] ;
        $UV= $row["UV"] ;
        $Falla= $row["Falla"] ;
        $Tecnico= $row["Tecnico"] ;
        $FE= $row["FE"] ;
        $FT= $row["FT"] ;
        $FV= $row["FV"] ;
        $Chip= $row["Chip"] ;
        $Tapa= $row["Tapa"] ;
        $Bateria= $row["Bateria"] ;
        $Memo= $row["Memo"] ;
        $Local= $row["Local"] ;
        $Estado= $row["Estado"] ;
        $R=', 1)';
        $R0="R(".$ID.",'0')";
          $insertar="<a class='btn btn-info' onclick='R(".$ID.");'><i class='fa fa-check-square'></i><br> SI </a> <a class='btn btn-danger' onclick='N(".$ID.");'><i class='fa fa-ban'></i><br>NO</a>";
        $Clase="";
        $esta="";
        //$insertar="";
         switch ($Estado) {
            case 0:
                $Clase="";
                $esta="ESPERA";
                break;
            case 1:
                $Clase="Pre";
                $esta="Sin Reparación";
                $E="SR(".$ID.")";
                $insertar="<a class='btn btn-success' onclick='".$E."'>Entregar</a>";
                break;
            case 3:
                $Clase="SR";
                $esta="Represupuestar";
                break;
            case 4:
                $Clase="Repa";
                $esta="Aprobado";
                $E="ER(".$ID.")";
                 $insertar="<a class='btn btn-danger' onclick='".$E."'>Entregar</a>";
                break;
            case 5:
                $Clase="Entre";
                $esta="Entragado";
                $insertar="<p class='btn btn-success'> Entragado OK </p>";
                break;
            case 6:
                $Clase="Pre";
                $esta="Entragado";
                $insertar="<p class='btn'>Entragar SR</p>";
                break;
        } //Categoria

        /*  Orden / Fecha / IMEI / Dispositivo / Falla / Cliente / Telefono / Costo / Tecnico / Menu */


            echo '<tr class="'.$Clase .'" ondblclick="CE('.$ID.')"><td>'.$Num.'</td><td>'.$FE.'</td><td>'.$Emai.'</td>';
            echo '<td>'. $Equipo.'</td><td>'. $Falla.'</td><td>'. $Cliente.'</td><td>'. $Telefono.'</td><td>'. $Restan.'</td><td>'. $esta.'</td>';
            echo '<td>'.$insertar.'</td></tr>';
        }// Fin while tabla ventas
      echo '</tbody></table>';
    } // Fin Lista todos los Telefonos que estan en el local
if ($modo==2) { // Lista todos los Telefonos que estan en el local
    $sql="SELECT `idEqui`, `Cliente`, `Telefono`, `Equipo`, `Emai`, `Num`, `Monto`, `Senia`, `Restan`, `UE`, `UT`, `UV`, `Falla`, `Tecnico`, `FE`, `FT`, `FV`, `Chip`, `Tapa`, `Bateria`, `Memo`, `Local`, `Estado` FROM `t_equipo`";
    $sql=$sql." WHERE (`Local`='".$Local."' ) LIMIT 2000 ;";

    $segmento = mysqli_query($conexion,$sql);
    $X=0;
    while ($row = mysqli_fetch_array($segmento)){
        $X=$X+1;
        $Cliente=$row["Cliente"];
        $ID=$row['idEqui'];
        $Telefono= $row["Telefono"];
        $Equipo= $row["Equipo"];
        $Emai= $row["Emai"];
        $Num=str_pad( $row["Num"] , 5, "0", STR_PAD_LEFT);
        $Monto= $row["Monto"] ;
        $Senia= $row["Senia"] ;
        $Restan= $formatter->formatCurrency( $row["Restan"], 'USD')  ;
        $UE= $row["UE"] ;
        $UT= $row["UT"] ;
        $UV= $row["UV"] ;
        $Falla= $row["Falla"] ;
        $Tecnico= $row["Tecnico"] ;
        $FE= $row["FE"] ;
        $FT= $row["FT"] ;
        $FV= $row["FV"] ;
        $Chip= $row["Chip"] ;
        $Tapa= $row["Tapa"] ;
        $Bateria= $row["Bateria"] ;
        $Memo= $row["Memo"] ;
        $Local= $row["Local"] ;
        $Estado= $row["Estado"] ;
        $R=', 1)';
        $R0="R(".$ID.",'0')";
        $insertar="<a class='btn btn-info' onclick='R(".$ID.");'><i class='fa fa-check-square'></i><br> SI </a> <a class='btn btn-danger' onclick='N(".$ID.");'><i class='fa fa-ban'></i><br>NO</a>";
        $Clase="";
        $esta="";
        //$insertar="";
        switch ($Estado) {
            case 0:
                $Clase="";
                $esta="ESPERA";
                break;
            case 1:
                $Clase="Pre";
                $esta="Sin Reparación";
                $E="SR(".$ID.")";
                $insertar="<a class='btn btn-success' onclick='".$E."'>Entregar</a>";
                break;
            case 3:
                $Clase="SR";
                $esta="Represupuestar";
                break;
            case 4:
                $Clase="Repa";
                $esta="Aprobado";
                $E="ER(".$ID.")";
                $insertar="<a class='btn btn-danger' onclick='".$E."'>Entregar</a>";
                break;
            case 5:
                $Clase="Entre";
                $esta="Entragado";
                $insertar="<p class='btn btn-success'> Entragado OK </p>";
                break;
            case 6:
                $Clase="Pre";
                $esta="Entragado";
                $insertar="<p class='btn'>Entragado SR</p>";
                break;
        } //Categoria

        /*  Orden / Fecha / IMEI / Dispositivo / Falla / Cliente / Telefono / Costo / Tecnico / Menu */


        echo '<tr class="'.$Clase .'" ondblclick="CE('.$ID.')"><td>'.$Num.'</td><td>'.$FE.'</td><td>'.$Emai.'</td>';
        echo '<td>'. $Equipo.'</td><td>'. $Falla.'</td><td>'. $Cliente.'</td><td>'. $Telefono.'</td><td>'. $Restan.'</td><td>'. $esta.'</td>';
        echo '<td>'.$insertar.'</td></tr>';
    }// Fin while tabla ventas
    echo '</tbody></table>';
}  // Fin Lista todos los Telefonos del local
if ($modo==3) { // Lista todos los Telefonos del local
    $sql="SELECT `idEqui`, `Cliente`, `Telefono`, `Equipo`, `Emai`, `Num`, `Monto`, `Senia`, `Restan`, `UE`, `UT`, `UV`, `Falla`, `Tecnico`, `FE`, `FT`, `FV`, `Chip`, `Tapa`, `Bateria`, `Memo`, `Local`, `Estado` FROM `t_equipo`";
    $sql=$sql." WHERE (`Local`='".$Local."' ) ORDER BY `Estado`, `Num` ASC LIMIT 2000  ;";

    $segmento = mysqli_query($conexion,$sql);
    $X=0;
    while ($row = mysqli_fetch_array($segmento)){
        $X=$X+1;
        $Cliente=$row["Cliente"];
        $ID=$row['idEqui'];
        $Telefono= $row["Telefono"];
        $Equipo= $row["Equipo"];
        $Emai= $row["Emai"];
        $Num=str_pad( $row["Num"] , 5, "0", STR_PAD_LEFT);
        $Monto= $row["Monto"] ;
        $Senia= $row["Senia"] ;
        $Restan= $formatter->formatCurrency( $row["Restan"], 'USD')  ;
        $UE= $row["UE"] ;
        $UT= $row["UT"] ;
        $UV= $row["UV"] ;
        $Falla= $row["Falla"] ;
        $Tecnico= $row["Tecnico"] ;
        $FE= $row["FE"] ;
        $FT= $row["FT"] ;
        $FV= $row["FV"] ;
        $Chip= $row["Chip"] ;
        $Tapa= $row["Tapa"] ;
        $Bateria= $row["Bateria"] ;
        $Memo= $row["Memo"] ;
        $Local= $row["Local"] ;
        $Estado= $row["Estado"] ;

        switch ($Estado) {
            case 0:
                $Clase="";
                $esta="ESPERA";
                break;
            case 1:
                $Clase="Pre";
                $esta="Sin Reparación";
                break;
            case 3:
                $Clase="SR";
                $esta="Represupuestar";
                break;
            case 4:
                $Clase="Repa";
                $esta="Aprobado";
                break;
            case 5:
                $Clase="Entre";
                $esta="Entragado";
                break;
        } //Categoria

        /*  Orden / Fecha / IMEI / Dispositivo / Falla / Cliente / Telefono / Costo / Tecnico / Menu */


        echo '<tr class="'.$Clase .'" ondblclick="CE('.$ID.')"><td>'.$Num.'</td><td>'.$FE.'</td><td>'.$Emai.'</td>';
        echo '<td>'. $Equipo.'</td><td>'. $Falla.'</td><td>'. $Cliente.'</td><td>'. $Telefono.'</td><td>'. $Restan.'</td><td>'. $esta.'</td>';
        echo '<td><button class="btn btn-success fa fa-thumbs-o-up"> Entregar</button><button class="btn btn-info fa fa-reply"> Listo</button></td></tr>';
    }// Fin while tabla ventas
    echo '</tbody></table>';
} // Fin Lista todos los Telefonos del local



    mysqli_close($conexion);
?>