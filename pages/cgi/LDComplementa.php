<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 9/4/2017
 * Time: 02:21
 */

// error_reporting(0);
date_default_timezone_set('America/Argentina/Buenos_Aires');
$HOY = date("Y-m-d H:i:s");
$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

include 'config2.inc';
mysqli_set_charset($conexion,"utf8");
if (!mysqli_set_charset($conexion, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
}
$marca="";
if(isset($_GET["T"])){ $modo=$_GET["T"]; }
if(isset($_GET["D"])){ $marca=$_GET["D"]; }
if(isset($_GET["ID"])){ $ID=$_GET["ID"];}

if(isset($_POST["D"])){ $marca=$_POST["D"]; }
if(isset($_POST["T"])){ $modo=$_POST["T"]; }
if(isset($_POST["ID"])){ $ID=$_POST["ID"];}
if(isset($_POST["N"])){ $N=$_POST["N"]; }

if(isset($_POST["Marca"])){ $Marca=$_POST["Marca"]; }
if(isset($_POST["Repuesto"])){ $Repuesto=$_POST["Repuesto"]; }
if(isset($_POST["Equipo"])){ $Equipo=$_POST["Equipo"]; }
if(isset($_POST["Provee"])){ $Provee=$_POST["Provee"]; }
if(isset($_POST["Costo"])){ $Costo=str_replace ("$","", $formatter->formatCurrency($_POST["Costo"], 'USD')); } //$formatter->formatCurrency( $row["monto"], 'USD');
if(isset($_POST["P1"])){ $P1= str_replace ("$","",$formatter->formatCurrency( $_POST["P1"], 'USD')); }
if(isset($_POST["P2"])){ $P2= str_replace ("$","",$formatter->formatCurrency( $_POST["P2"], 'USD')); }
if(isset($_POST["P3"])){ $P3= str_replace ("$","",$formatter->formatCurrency( $_POST["P3"], 'USD')); }
if(isset($_POST["Stock"])){ $Stock=$_POST["Stock"]; }
if(isset($_POST["Color"])){ $Color=$_POST["Color"]; }
if(isset($_POST["Visible"])){ $Visible=($_POST["Visible"]=='true')? 1:0; }
if(isset($_POST["CStock"])){ $CStock= ($_POST["CStock"]=='true')? 1:0; }



/**********************************************************************************************/


if ($modo==1000) { //Lee Repuesto
    $sql = "SELECT `id_R`, `EquipoId`, `MarcaID`, `ProveeID`, `TipoId`, `Costo`, `P1`, `P2`, `P3`, `Stock`, `CStock`,`Color1`,`Visible` FROM `t_repuestos` ";
    $sql = $sql . " WHERE `id_R`='" . $ID . "';";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        Print $row['id_R'] . "|" . $row['EquipoId'] . "|" . $row['MarcaID'] . "|" . $row['ProveeID'] . "|" . $row['TipoId'] . "|" . $row['Costo'] . "|" . $row['P1'] . "|" . $row['P2'] . "|" . $row['P3'] . "|" . $row['Stock'] . "|" . $row['CStock'] . "|" . $row['Color1'] . "|" . $row['Visible'];
    }
}

if ($modo==1001) { //Lee Repuesto
    $sql="SELECT `id_R`, `EquipoId`, `MarcaID`,(SELECT `Proveedor` FROM `t_proveedor` WHERE `idProvee`=`ProveeID`) as Provee ,(SELECT `Tipo` FROM `t_tipo` WHERE `idTipo`=`TipoId`) as re , `Costo`, `P1`, `P2`, `P3`, `Stock`, `CStock`,( SELECT `color` FROM `t_color` WHERE `idco`=`Color1` ) as colores,`Visible` FROM `t_repuestos` ";

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $vi= ($row['Visible']==1)? "Visible":"Oculto";
       echo "<tr onclick='res(".$row['id_R'].")'><td>".$row['re']."</td><td>".$vi."</td><td>".$row['colores']."</td><td>".$row['Costo']."</td><td>";
       echo  $row['P1']."</td><td>".$row['P2']."</td><td>".$row['P3']."</td><td>".$row['Stock']."</td><td>".$row['Provee']."</td></tr>";
    }
}

if ($modo==1002) { //Lee Repuesto
    $sql="SELECT `id_R`, `EquipoId`, `MarcaID`,(SELECT `Proveedor` FROM `t_proveedor` WHERE `idProvee`=`ProveeID`) as Provee ,(SELECT `Tipo` FROM `t_tipo` WHERE `idTipo`=`TipoId`) as re , `Costo`, `P1`, `P2`, `P3`, `Stock`, `CStock`,( SELECT `color` FROM `t_color` WHERE `idco`=`Color1` ) as colores,`Visible` FROM `t_repuestos` ";
    $sql = $sql . " WHERE `id_R`='" . $ID . "';";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $vi= ($row['Visible']==1)? "Visible":"Oculto";
        echo "<tr onclick='res(".$row['id_R'].")'><td>".$row['re']."</td><td>".$vi."</td><td>".$row['colores']."</td><td>".$row['Costo']."</td><td>";
        echo  $row['P1']."</td><td>".$row['P2']."</td><td>".$row['P3']."</td><td>".$row['Stock']."</td><td>".$row['Provee']."</td></tr>";
    }
}
/* ***************************  Manejo de Respuestos   ************************************* */
if ($modo==70) { //Listado de reapaciones
    if ($marca > 0) { // en relaidad id
        $sql="SELECT `id_R`, `Tipo` ,  `P1`, `P2`, `P3`, `Stock` FROM `t_repuestos` ,`t_tipo` WHERE ";

        $sql=$sql."(`EquipoId`=".$marca.") and(`TipoId`=`idTipo`)";
        $segmento = mysqli_query($conexion,$sql);
        while ($row = mysqli_fetch_array($segmento)) {
            echo "<tr onclick='Res2(".$row['id_R'].")'><td>".$row['Stock']."</td><td>".$row['Tipo']."</td><td>".$row['P1']."</td></tr>";
        }
       // print $sql;

     }

}// Fin Listado de reapaciones

if ($modo==80) { //Graba Repuesto
     if($ID>0){
         $sql="UPDATE `t_repuestos` SET `EquipoId`='".$Equipo."',`MarcaID`='".$Marca."',`ProveeID`='".$Provee."',`TipoId`='".$Repuesto."',";
         $sql=$sql."`Costo`='".$Costo."',`P1`='".$P1."',`P2`='".$P2."',`P3`='".$P3."',`Stock`='".$Stock."',`CStock`='".$CStock."',`Visible`='".$Visible."',`Color1`='".$Color."' WHERE `id_R`='".$ID."';";
     }else{
         if ( $Stock<0 || $Stock==''){$Stock=0;}
         $sql="INSERT INTO `t_repuestos`( `EquipoId`, `MarcaID`, `ProveeID`, `TipoId`, `Color1`, `Costo`, `P1`, `P2`, `P3`, `Stock`, `CStock`, `Visible`) VALUES('";
         $sql=$sql.$Equipo."','".$Marca."','".$Provee."','".$Repuesto."','".$Color."','".$Costo."','".$P1 ."','". $P2."','". $P3."','". $Stock."','".$CStock."','".$Visible."');";
     }

 print $sql;
    $segmento = mysqli_query($conexion,$sql);

} // Fin Graba Repuesto

if ($modo==90) { //Graba Repuesto
    $sql="SELECT `id_R`,`Equipo`,`Marca` , `Proveedor`,`Tipo` , `Costo`, `P1`, `P2`, `P3`, `Stock`, `CStock`,(SELECT `color` FROM `t_color` WHERE `idco`=
`Color1`) as Colo FROM ";
    $sql=$sql."`t_repuestos`, `t_marca` ,`t_equi`,`t_proveedor`,`t_tipo` WHERE  ";
    $sql=$sql."(`EquipoId`=`id_equi`) and(`idMarca`=`t_repuestos`.MarcaID)and(`idProvee`=`ProveeID`)and(`TipoId`=`idTipo`)";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo "<tr onclick='Res(".$row['id_R'].")'><td>".$row['Stock']."</td><td>".$row['Marca']."- ".$row['Tipo']."- ".$row['Colo']."</td><td>".$row['Equipo']."</td><td>".$row['P1']."</td><td>".$row['P2']."</td><td>".$row['P3']."</td></tr>";
    }
    //print $sql;
} // Fin Graba Repuesto

if ($modo==91) { //Lee Repuesto
    $sql="SELECT `id_R`, `EquipoId`, `MarcaID`, `ProveeID`, `TipoId`, `Costo`, `P1`, `P2`, `P3`, `Stock`, `CStock`,`Color1`,`Visible` FROM `t_repuestos` ";
    $sql=$sql." WHERE `id_R`='" .$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        Print $row['id_R']."|".$row['EquipoId']."|".$row['MarcaID']."|".$row['ProveeID']."|".$row['TipoId']."|".$row['Costo']."|".$row['P1']."|".$row['P2']."|".$row['P3']."|".$row['Stock']."|".$row['CStock']."|".$row['Color1']."|".$row['Visible'] ;
    }

} // Fin Graba Repuesto

if ($modo==92) { //Borrar Repuesto
    $sql="DELETE FROM `t_repuestos` WHERE `id_R` ='" .$ID."';";
    $segmento = mysqli_query($conexion,$sql);

} // Fin Graba Repuesto
/************************************************* Fin manejo respuestos ************************************************ */

if ($modo==1) { //Lista todos los proveedores
    $sql="SELECT `idProvee`, `Proveedor` FROM `t_proveedor` ORDER BY `Proveedor` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $N= $row["Proveedor"] ;
       echo '<tr onclick="E('.$row["idProvee"].',' ;
       echo "'".$N."'";
       echo ')"><td>'.$N.'</td></tr>';
    }
}
if ($modo==2) { //Lista todos las MARCAS
    $sql="SELECT `idMarca`, `Marca` FROM `t_marca` ORDER BY `Marca`";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $N=$row["Marca"];
        echo '<tr onclick="E('.$row["idMarca"].',';
        echo "'".$N."'";
        echo ')"><td>'.$N.'</td></tr>';
    }
}
if ($modo==3) { //Lista todos los TIPOS
    $sql="SELECT `idTipo`, `Tipo` FROM `t_tipo` ORDER BY `Tipo` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $N=$row["Tipo"];
        echo '<tr onclick="E('.$row["idTipo"].',';
        echo "'".$N."'";
        echo ')"><td>'.$N.'</td></tr>';
    }
}

if ($modo==4) { // Graba Proveedor
     $sql= "INSERT INTO `t_proveedor`( `Proveedor`, `Tel`, `email`, `Contacto`) VALUES ('";
     $sql= $sql .$N. "',' ',' ',' ');";
     $segmento = mysqli_query($conexion,$sql);
     mysqli_close($conexion);
}// Fin Grabar Proveedor

if ($modo==5) { // Actuliza Proveedor
    $sql= "UPDATE `t_proveedor` SET `Proveedor`='".$N."' WHERE `idProvee`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Actuliza Proveedor

if ($modo==6) { // Borrar Proveedor
    $sql= "DELETE FROM `t_proveedor` WHERE `idProvee`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Borrar Proveedor
/* **************************************************************************************************** */
if ($modo==7) { // Graba Marca
    $sql= "INSERT INTO `t_marca`( `Marca`) VALUES ('".$N. "');";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Grabar Marca

if ($modo==8) { // Actuliza Marca
    $sql= "UPDATE `t_marca` SET  `Marca`='".$N."' WHERE `idMarca`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Actuliza Marca

if ($modo==9) { // Borrar Marca
    $sql= "DELETE FROM `t_marca` WHERE `idMarca`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Borrar Marca

/* **************************************************************************************************** */
if ($modo==10) { // Graba Marca
    $sql= "INSERT INTO `t_tipo` (`Tipo`) VALUES ('".$N."');";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Grabar Marca

if ($modo==11) { // Actuliza Marca
    $sql= "UPDATE `t_tipo` SET  `Tipo`='".$N."' WHERE `idTipo`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Actuliza Marca

if ($modo==12) { // Borrar Marca
    $sql= "DELETE FROM `t_tipo` WHERE `idTipo`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Borrar Marca
/* ************************************************************************************************************* */
if ($modo==30) { // Graba Color
    $sql= "INSERT INTO `t_color` (`color`) VALUES ('".$N."');";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Grabar Marca

if ($modo==31) { // Actuliza Color
    $sql= "UPDATE `t_color` SET `color`='".$N."' WHERE `idco`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Actuliza Marca

if ($modo==32) { // Borrar Borra
    $sql= "DELETE FROM `t_color` WHERE `idco`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Borrar Marca

if ($modo==35) { //Lista todos los proveedores
    $sql="SELECT `idco`, `color` FROM `t_color` ORDER BY `color` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $N= $row["color"] ;
        echo '<tr onclick="E('.$row["idco"].',' ;
        echo "'".$N."'";
        echo ')"><td>'.$N.'</td></tr>';
    }
}
/* **************************************************************************************************** */
if ($modo==100) { //Lista todos los Modelos
    $sql="SELECT `id_equi`, `MarcaID`, `Equipo` FROM `t_equi` WHERE `MarcaID`='".$marca."' ORDER BY `Equipo` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $N=$row["Equipo"];
        echo '<tr onclick="E('.$row["id_equi"].',';
        echo "'".$N."'";
        echo ')"><td>'.$N.'</td></tr>';
    }
}
if ($modo==105) { //Lista todos los Modelos
    $sql="SELECT `id_equi`, `MarcaID`, `Equipo` FROM `t_equi` ORDER BY `Equipo` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $N=$row["Equipo"];
        echo '<tr onclick="E('.$row["id_equi"].',';
        echo "'".$N."'";
        echo ')"><td>'.$N.'</td></tr>';
    }
}
if ($modo==101) { // Graba Marca
    $sql= "INSERT INTO `t_equi`( `MarcaID`, `Equipo`) VALUES ('".$marca. "','".$N. "');";
    console.log($sql);
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Grabar Marca

if ($modo==102) { // Actuliza Marca
    $sql= "UPDATE `t_equi`  SET  `Equipo`='".$N."',`MarcaID`='".$marca."'  WHERE `id_equi` ='".$ID."';";
    console.log($sql);
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Actuliza Marca

if ($modo==103) { // Borrar Marca
    $sql= "DELETE FROM `t_equi`  WHERE `id_equi`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
    mysqli_close($conexion);
}// Fin Borrar Marca
/* ************************************************************************************************************* */

if ($modo==201) { //Lista todos los proveedores
    $sql="SELECT `idProvee`, `Proveedor` FROM `t_proveedor` ORDER BY `Proveedor` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<option value="'.$row["idProvee"].'">'.$row["Proveedor"].'</option>';
    }
}
if ($modo==202) { //Lista todos las MARCAS
    $sql="SELECT `idMarca`, `Marca` FROM `t_marca` ORDER BY `Marca`";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<option value="'.$row["idMarca"].'">'.$row["Marca"].'</option>';
    }
}
if ($modo==203) { //Lista todos los TIPOS
    $sql="SELECT `idTipo`, `Tipo` FROM `t_tipo` ORDER BY `Tipo` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<option value="'.$row["idTipo"].'">'.$row["Tipo"].'</option>';
    }
}
if ($modo==204) { //Lista todos los Colores
    $sql="SELECT `idco`, `color` FROM `t_color` ORDER BY `color` ASC";
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<option value="'.$row["idco"].'">'.$row["color"].'</option>';
    }
}
if ($modo==210) { //Lista todos los TIPOS
    $sql="SELECT `id_equi`, `MarcaID`, `Equipo` FROM `t_equi` WHERE `MarcaID`='".$marca."' ORDER BY `Equipo` ASC";//
    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<option value="'.$row["id_equi"].'">'.$row["Equipo"].'</option>';
    }
}





//print $sql;
?>

