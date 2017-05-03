<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 16/4/2017
 * Time: 18:49
 */

date_default_timezone_set('America/Argentina/Buenos_Aires');
$HOY = date("Y-m-d H:i:s");

include 'config2.inc';
mysqli_set_charset($conexion,"utf8");
if (!mysqli_set_charset($conexion, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
}

$MODO="";
if(isset($_GET["A"])){ $A=$_GET["A"];  }
if(isset($_GET["MODO"])){ $MODO=$_GET["MODO"];  }


if(isset($_POST["ID"])){ $ID=$_POST["ID"];  }
if(isset($_POST["D"])){ $D=$_POST["D"];  }
if(isset($_POST["A"])){ $A=$_POST["A"];  }
if(isset($_POST["MSG"])){ $MSG=$_POST["MSG"];  }
if(isset($_POST["MODO"])){ $MODO=$_POST["MODO"];  }

if($MODO==0){// Mensaje nuevo
   $sql="INSERT INTO `t_msj` ( `de`, `a`, `msj`, `fe`, `fl`, `estado`) VALUES ('".$D."','".$A."','".$MSG."','".$HOY."','".$HOY."','0');";
   $segmento = mysqli_query($conexion,$sql);
}// fin Nuevo

if($MODO==1){// Mensaje Leido
    $sql="UPDATE `t_msj` SET `fl`='".$HOY."',`estado`='1' WHERE `idmsj`='".$ID."';";
    $segmento = mysqli_query($conexion,$sql);
}// fin Leido

if($MODO==2){// Mensaje Listado
    $sql="SELECT `idmsj`, `de`, `a`, `msj`, `fe`, `fl`, `estado` FROM `t_msj` WHERE (`a`='".$A."')and (`estado`=0);";
    $segmento = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($segmento)){
        $ID=$row['idmsj'] ;
        $DE= $row["de"];
        $A=$row["a"];
        $MSG=$row["msj"];
        $fe=$row["fe"];

        print "$ID|$DE|$A|$MSG|$fe";
    }//while

}// fin Listado

if($MODO==3){// Listado 20
    $sql="SELECT `idmsj`, `de`, `a`, `msj`, `fe`, `fl`, `estado` FROM `t_msj` WHERE ((`a`='".$A."')and (`de`='".$D."')) or ((`a`='".$D."')and (`de`='".$A."')) ORDER BY `idmsj` DESC LIMIT 20  ;";
    $segmento = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($segmento)){
        $ID=$row['idmsj'] ;
        $DE= $row["de"];
        $A=$row["a"];
        $MSG=$row["msj"];
        $fe=$row["fe"];
        $fl=$row["fl"];
        print "$ID|$DE|$A|$MSG|$fe";
    }//while

}// fin Listado 20

if($MODO==30){// Listado 20 globo
    $sql="SELECT `idmsj`,(SELECT `nreal` FROM `ver` WHERE `idver`=`de`) as DU,`de`, `a`, `msj`, `fe`, `fl`, `estado` FROM `t_msj` WHERE ((`a`='".$A."')and (`de`='".$D."')) or ((`a`='".$D."')and (`de`='".$A."')) ORDER BY `idmsj` DESC LIMIT 20  ;";
    $segmento = mysqli_query($conexion,$sql);
    $resultado="";
    while ($row = mysqli_fetch_array($segmento)){
        $ID=$row['idmsj'] ;
        $MDE= $row["de"];
        $MDE2= $row["DU"];
        $MA=$row["a"];
        $MSG=$row["msj"];
        $fe=$row["fe"];
        if($row["estado"]==1){$fl=$row["fl"]; }else{$fl=" No Leido ";}


        if($MDE==$D){ $clase="MIN";}else{$clase="MOUT";}
        $resultado= $resultado. "<div class='".$clase."'><h4>". $MDE2."</h4><p>".$MSG."</p> <small class='TC'>".$fe." -*- ".$fl."</small> </div>";

    }//while
    print "$resultado";
}// fin Listado 20 globo

if($MODO==20){// Mensaje Listado
    $sql="SELECT `idmsj`, (SELECT `nreal` FROM `ver` WHERE `idver`=`de`) as DU,`de`, (SELECT `nreal` FROM `ver` WHERE `idver`=t_msj.a) as AU, `msj`, `fe`, `fl`, `estado` FROM `t_msj`  WHERE (t_msj.a='".$A."')and (`estado`=0);";
    $segmento = mysqli_query($conexion,$sql);

    while ($row = mysqli_fetch_array($segmento)){
        $ID=$row['idmsj'] ;
        $DE= $row["DU"];
        $DE2= $row["de"];
        $A=$row["AU"];
        $MSG=$row["msj"];
        $fe=$row["fe"];

        echo '<li class="msgtext"><div><strong class="btn" onclick="resp('.$DE2.')">'.$DE.'</strong><span class="text-muted FR" ><em>'.$fe.'</em></span></div> <div>'.$MSG.'</div> <buton class="btn btn-danger FR" onclick="NoMSJ('.$ID.')"> Leido </buton></a> </li>';

        echo ' <li class="divider" id="divider"></li>';


    }//while
    echo '<li id="VerTmsg"><a href="mensajes.php" target="_blank"><strong>Leer Todos</strong> <i class="fa fa-angle-right"></i></a></li>';
}// fin Listado

mysqli_close($conexion);
?>