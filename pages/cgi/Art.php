<?php
  // error_reporting(0); 
date_default_timezone_set('America/Argentina/Buenos_Aires');
$HOY = date("Y-m-d H:i:s"); 

 include 'config2.inc';
      mysqli_set_charset($conexion,"utf8");
        if (!mysqli_set_charset($conexion, "utf8")) {
              printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
         }

  $modo="";

if(isset($_POST["ID"])){ $ID=$_POST["ID"];  }
if(isset($_POST["H"])){ $H=$_POST["H"]; }
if(isset($_POST["Art"])){ $Art= strtoupper ( trim ( $_POST["Art"])); }
if(isset($_POST["Cod"])){ $Cod=strtoupper ( trim ( $_POST["Cod"])); }
if(isset($_POST["Obs"])){ $Obs=$_POST["Obs"]; }
if(isset($_POST["Cos"])){ $Cos=$_POST["Cos"]; }
if(isset($_POST["P1"])){ $P1=$_POST["P1"]; }
if(isset($_POST["P2"])){ $P2=$_POST["P2"]; }
if(isset($_POST["P3"])){ $P3=$_POST["P3"]; }
if(isset($_POST["S1"])){ $S1=$_POST["S1"]; }
if(isset($_POST["S2"])){ $S2=$_POST["S2"]; }
if(isset($_POST["S3"])){ $S3=$_POST["S3"]; }
if(isset($_POST["Cat"])){ $Cat=$_POST["Cat"]; }
 


if ($H==1) { // ver articulo
    $sql= "SELECT `idart`, `Articulo`, `Codigo`, `ObsID`, `Costo`, `P1`, `P2`, `P3`, `S1`, `S2`, `S3`, `CatID` FROM `t_art` where `idart`=".$ID.";";
     $segmento = mysqli_query($conexion,$sql);
      while ($row = mysqli_fetch_array($segmento)){
             $ID=$row['idart'] ; 
             $Articulo= $row["Articulo"]; 
             $Codigo=$row["Codigo"];
             $ObsID=$row["ObsID"];
             $Costo=$row["Costo"]; 
             $P1=$row["P1"];
             $P2=$row["P2"];
             $P3=$row["P3"];
             $S1=$row["S1"]; 
             $S2=$row["S2"];
             $S3=$row["S3"];
            $CatID=$row["CatID"];  

      print "$ID|$Articulo|$Codigo|$ObsID|$Costo|$P1|$P2|$P3|$S1|$S2|$S3|$CatID";                             
                   }    
     mysqli_close($conexion);
}// Fin Ver Articulo

if ($H==2) { // ver articulo

  if($ID<1){ // Nuevo 
               /* d={H:2,ID:ID,Art:ART,Obs:DET,Cos:COS,P1:P1,P2:P2,P3:P3,S1:S1,S2:S2,S3:S3,Cat:CAT,Cod:COD}*/
      $sql="INSERT INTO `t_art`(`Articulo`, `Codigo`, `ObsID`, `Costo`, `P1`, `P2`, `P3`, `S1`, `S2`, `S3`, `CatID`) VALUES ('".$Art;
      $sql= $sql."','".$Cod."','".$Obs."','".$Cos."','".$P1."','".$P2."','".$P3."','".$S1."','".$S2."','".$S3."','".$Cat."' );";

  }else{// Actulizar

      $sql="UPDATE `t_art` SET `Articulo`='".$Art."',`Codigo`='".$Cod."',`ObsID`='".$Obs."',`Costo`='".$Cos."',`P1`='".$P1."',`P2`='".$P2;
      $sql=$sql."',`P3`='".$P3."',`S1`='".$S1."',`S2`='".$S2."',`S3`='".$S3."',`CatID`='".$Cat."' WHERE `idart`=".$ID." ;";
     // print $sql;
  }//fin grabar art
  // print $sql;
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// H2 grabador articulos

if ($H==3) { // ver articulo X Codigo
    $sql = "SELECT `idart`, `Articulo`, `Codigo`, `ObsID`, `Costo`, `P1`, `P2`, `P3`, `S1`, `S2`, `S3`, `CatID` FROM `t_art` where `Codigo`='" . $Cod . "';";

    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $ID = $row['idart'];
        $Articulo = $row["Articulo"];
        $Codigo = $row["Codigo"];
        $ObsID = $row["ObsID"];
        $Costo = $row["Costo"];
        $P1 = $row["P1"];
        $P2 = $row["P2"];
        $P3 = $row["P3"];
        $S1 = $row["S1"];
        $S2 = $row["S2"];
        $S3 = $row["S3"];
        $CatID = $row["CatID"];
        print "$ID|$Articulo|$Codigo|$ObsID|$Costo|$P1|$P2|$P3|$S1|$S2|$S3|$CatID";
    }
    mysqli_close($conexion);
}
if ($H==4) { // ver VUSER
    $sql="SELECT `idver`, `U`, `P`, `L`, `nreal`, `A` FROM `ver` where `idver`='".$ID."';";
        $segmento = mysqli_query($conexion,$sql);
        while ($row = mysqli_fetch_array($segmento)){
            $ID=$row['idver'] ;
            $Articulo= $row["U"];
            $Codigo=$row["P"];
            $ObsID=$row["L"];
            $S1=$row["nreal"];
            print "$ID|$Articulo|$Codigo|$ObsID|$S1";
        }
    mysqli_close($conexion);
}// Fin Ver Articulo

if ($H==5) { // borra VUSER
    $sql="DELETE FROM `ver` WHERE `idver`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Ver Articulo


if ($H==6) { // Grabar VUser { ID: 0, H: 4, Obs: "qw", Cat: "aaa", S1: "1", Art: "aa" }
    $Obs=md5($Obs);
    if($ID<1){ // Nuevo
        $sql="INSERT INTO `ver`( `U`, `P`, `L`, `nreal`, `A`) VALUES ('".$Cat."','".$Obs."','".$S1."','".$Art."','0');";

    }else{// Actulizar
        $sql="UPDATE `ver` SET `U`='".$Cat."',`L`='".$S1."',`nreal`='".$Art."' WHERE idver=" .$ID.";" ;

    }//fin grabar art

    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// H6

if ($H==7) { // Grabar VUser
    $Obs=md5($Obs);
    if($ID>1){
        $sql="UPDATE `ver` SET `P`='".$Obs."' WHERE idver=" .$ID.";" ;
    }//fin grabar art
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// H6