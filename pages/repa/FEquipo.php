<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 29/3/2017
 * Time: 20:14
 */


// error_reporting(0);
date_default_timezone_set('America/Argentina/Buenos_Aires');
$HOY = date("Y-m-d H:i:s");
$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

include '../cgi/config2.inc';
mysqli_set_charset($conexion,"utf8");
if (!mysqli_set_charset($conexion, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
}

$modo="";
$Obs="";
$NOrden=0;

/* d={M:1,ID:ID,Local:Local,User:Atendio,Cliente:Cliente,Equipo:Equipo,Tel:Tel,EMEI:EMEI,Falla:Falla,NOrden:NOrden,
RTecnico:RTecnico,Estado:Estado,Total:Total,Sena:Sena,Restan:Restan,Tapa:Tapa,Bata:Bata,Chip:Chip,Memo:Memo};*/

if(isset($_GET["M"])){ $M=$_GET["M"];}
if(isset($_GET["ID"])){ $ID=$_GET["ID"];}

if(isset($_POST["M"])){ $M=$_POST["M"];}
if(isset($_POST["Local"])){ $Local=$_POST["Local"]; }
if(isset($_POST["Cliente"])){ $Cliente=$_POST["Cliente"]; }
if(isset($_POST["ID"])){ $ID=$_POST["ID"]; }
if(isset($_POST["User"])){ $User=$_POST["User"]; }
if(isset($_POST["Equipo"])){ $Equipo=$_POST["Equipo"]; }
if(isset($_POST["Tel"])){ $Tel=$_POST["Tel"]; }
if(isset($_POST["EMEI"])){ $EMEI=$_POST["EMEI"]; }
if(isset($_POST["Falla"])){ $Falla=$_POST["Falla"]; }
if(isset($_POST["NOrden"])){ $NOrden= intval( $_POST["NOrden"]);}
if(isset($_POST["RTecnico"])){ $RTecnico=$_POST["RTecnico"];}
if(isset($_POST["Estado"])){ $Estado=$_POST["Estado"];}
if(isset($_POST["Total"])){ $Total=$_POST["Total"];}
if(isset($_POST["Sena"])){ $Sena=$_POST["Sena"];}
if(isset($_POST["Restan"])){ $Restan=$_POST["Restan"];}
if(isset($_POST["Tapa"])){ $Tapa= ($_POST["Tapa"])? 1:0 ;}
if(isset($_POST["Bata"])){ $Bata=($_POST["Bata"])? 1:0 ;}
if(isset($_POST["Chip"])){ $Chip=($_POST["Chip"])? 1:0 ;}
if(isset($_POST["Memo"])){ $Memo=($_POST["Memo"])? 1:0 ;}


if($M==1){ // Graba la venta

    if($NOrden <1){ //Si no hay N° de orden crea una
        $sql="SELECT max(`Num`)+1 as U FROM `t_equipo` WHERE Local='".$Local."';";
        $segmento = mysqli_query($conexion,$sql);
        while ($row = mysqli_fetch_array($segmento)){ $NOrden=$row['U'] ;}
    }

    $sql="INSERT INTO `t_equipo`( `Cliente`, `Telefono`, `Equipo`, `Emai`, `Num`, `Monto`, `Senia`, `Restan`, `UE`,`UT`, `UV`";
    $sql=$sql. ", `Falla`, `Tecnico`, `FE`, `FT`, `FV`, `Chip`, `Tapa`, `Bateria`, `Memo`, `Local`, `Estado`) VALUES ('";
    $sql=$sql.$Cliente."','".$Tel ."','".$Equipo."','".$EMEI."','".$NOrden."','".$Total."','".$Sena."','".$Restan."','".$User."',' ','','";
    $sql=$sql.$Falla."','".$RTecnico."',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,'".$Chip."','".$Tapa."','".$Bata."','".$Memo."','".$Local."','".$Estado."');";

     //print $sql;

    $segmento = mysqli_query($conexion,$sql);
     $sql="select LAST_INSERT_ID;";

    /*$sql="SELECT max(`IdV`) as U FROM `t_venta` WHERE Local='".$Local."';";*/
    $segmento = mysqli_query($conexion,"SELECT LAST_INSERT_ID() ;");
    while ($row = mysqli_fetch_array($segmento)){ $ID=$row[0] ;}
    //$ID=mysql_insert_id();

    print $ID;
   // mysqli_close($conexion);
}// Fin Grabar Nuevo

if($M==3){ // Graba la venta

    if($NOrden <1){ //Si no hay N° de orden crea una
        $sql="SELECT max(`Num`)+1 as U FROM `t_equipo` WHERE Local='".$Local."';";
        $segmento = mysqli_query($conexion,$sql);
        while ($row = mysqli_fetch_array($segmento)){ $NOrden=$row['U'] ;}
    }

    $sql="UPDATE `t_equipo` SET `Cliente`='".$Cliente."',`Telefono`='".$Tel ."',`Equipo`='".$Equipo."',`Emai`='".$EMEI."',`Num`='".$NOrden."',`Monto`='".$Total."',`Senia`='".$Sena."',";
    $sql=$sql. "`Restan`='".$Restan."',`UT`='".$User."', `Falla`='".$Falla."',`Tecnico`='".$RTecnico."',`FT`= CURRENT_TIMESTAMP, `Chip`='".$Chip."',";
    $sql=$sql. "`Tapa`='".$Tapa."',`Bateria`='".$Bata."',`Memo`='".$Memo."',`Estado`='".$Estado."' WHERE `idEqui`=". $ID." ;";

    //print $sql;

    $segmento = mysqli_query($conexion,$sql);
  // mysqli_close($conexion);
}// Fin Actulizar

if($M==2){ // ver equipo
    $sql="SELECT `idEqui`, `Cliente`, `Telefono`, `Equipo`, `Emai`, `Num`, `Monto`, `Senia`, `Restan`, `UE`, `UT`, `UV`, `Falla`, `Tecnico`, `FE`, `FT`, `FV`, `Chip`, `Tapa`, `Bateria`, `Memo`, `Local`, `Estado` FROM `t_equipo`";
    $sql=$sql." WHERE (`idEqui`='".$ID."' );";

    $segmento = mysqli_query($conexion,$sql);
    $X=0;
    while ($row = mysqli_fetch_array($segmento)) {

        $Cliente = $row["Cliente"];
        $ID = $row['idEqui'];
        $Telefono = $row["Telefono"];
        $Equipo = $row["Equipo"];
        $Emai = $row["Emai"];
        $Num = str_pad($row["Num"], 5, "0", STR_PAD_LEFT);
        $Monto = $row["Monto"];
        $Senia = $row["Senia"];
        $Restan = $formatter->formatCurrency($row["Restan"], 'USD');
        $UE = $row["UE"];
        $UT = $row["UT"];
        $UV = $row["UV"];
        $Falla = $row["Falla"];
        $Tecnico = $row["Tecnico"];
        $FE = $row["FE"];
        $FT = $row["FT"];
        $FV = $row["FV"];
        $Chip = $row["Chip"];
        $Tapa = $row["Tapa"];
        $Bateria = $row["Bateria"];
        $Memo = $row["Memo"];
        $Local = $row["Local"];
        $Estado = $row["Estado"];
    }
    print "$ID|$Num|$Cliente|$Equipo|$Telefono|$Emai|$Falla|$Tecnico|$Monto|$Senia|$Restan|$Tapa|$Bateria|$Chip|$Memo|$FE|$UE|$FT|$UT|$FV|$UV|$Estado";

} // FIN ver equipo

if($M==10){ // Entregar Reparado
    $sql="UPDATE `t_equipo` SET `UV`='".$User."',`FV`=CURRENT_TIMESTAMP,`Estado`=5 WHERE `idEqui`='".$ID."';";
    //print $sql;
    $segmento = mysqli_query($conexion,$sql);

} // Fin Entrega Reparado
if($M==11){ // Reparado
    $sql="UPDATE `t_equipo` SET `UT`='".$User."',`FT`=CURRENT_TIMESTAMP,`Estado`=4 WHERE `idEqui`='".$ID."';";
    //print $sql;
    $segmento = mysqli_query($conexion,$sql);

} // Fin  Reparado
if($M==12){ // Sin Reparacion
    $sql="UPDATE `t_equipo` SET `UT`='".$User."',`FT`=CURRENT_TIMESTAMP,`Estado`=1 WHERE `idEqui`='".$ID."';";
    print $sql;
    $segmento = mysqli_query($conexion,$sql);
} // Fin  Sin Reparacion
if($M==13){ //Entregado  Sin Reparacion
    $sql="UPDATE `t_equipo` SET `UV`='".$User."',`FV`=CURRENT_TIMESTAMP,`Estado`=6 WHERE `idEqui`='".$ID."';";
    print $sql;
    $segmento = mysqli_query($conexion,$sql);
} // Fin Entregado  Sin Reparacion

 mysqli_close($conexion);

?>