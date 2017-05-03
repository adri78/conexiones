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
  $Total=0;
  $x=0;

if(isset($_GET["T"])){ $modo=$_GET["T"]; }
if(isset($_GET["L"])){ $Local=$_GET["L"];}
if(isset($_GET["D"])){ $D=$_GET["D"]; }
if(isset($_GET["desde"])){ $Desde=$_GET["desde"] ." 00:00:00" ; }
if(isset($_GET["hasta"])){ $Hasta=$_GET["hasta"]." 23:59:59"  ; }


if ($modo==1) { // Tabla Ventas
    $sql= "SELECT `idart`, `Articulo`, `Codigo`, `ObsID`, `Costo`, `P1`, `P2`, `P3`, `S1`, `S2`, `S3`, `CatID` FROM `t_art`";

  /*echo '<table width="100%" class="table table-bordered sortable" id="LART"><thead class="Titulo">';
  echo '<tr><th width="100px">Codigo</th><th>Articulo</th><th  width="150px">Categoria</th>';
  echo '<th class="TD"  width="70px">Precio</th><th class="TD" width="50px">Stock</th></tr>';
  echo '</thead><tbody>';*/
  $segmento = mysqli_query($conexion,$sql);

 $X=0;
  while ($row = mysqli_fetch_array($segmento)){
         $X=$X+1;
         $ID=$row['idart'] ;
         $Articulo=$row["Articulo"];
         $Codigo= $row["Codigo"];
         $ObsID= $row["ObsID"];
         $Costo= $row["Costo"];  
         $P1= $row["P1"] ;  
         $P2= $row["P2"] ;
         $P3= $row["P3"] ;  
         $S1= $row["S1"] ;
         $S2= $row["S2"] ;  
         $S3= $row["S3"] ;
         $CatID= $row["CatID"] ; 
         $Stock=  $S1+ $S2 +$S3;
         $Clase="";
         $Categoria="";
      if($Stock < 1){ $Clase ="danger"; }
 
      switch ($CatID) {
        case 1:
             $Categoria="Celulares";
             break;
        case 2:
             $Categoria="Art PC";
             break;
        case 3:
             $Categoria="Baterias";
             break;
        case 4:
             $Categoria="Alamacenamiento";
             break;
        case 5:
             $Categoria="Otros";
             break;
      } //Categoria


      if($Local==1){  // Local Adrogue
         if(($S1 <1) and ($Stock >0)) { $Clase="warning" ;}

          echo '<tr class="'.$Clase .'" ondblclick="CA('.$ID.')" ><td>'.$Codigo.'</td><td>'.$Articulo.'</td><td>'.$Categoria.'</td>';
          echo '<td class="TD" title="P1:'.$P1.' // P2:'.$P2.' // P3:'.$P3.'">'. $P1.'</td>';
          echo '<td class="TC" title="Adrogue:'.$S1.' * Burzaco:'.$S2.'* Deposito: '.$S3.'">'.$S1.'</td></tr>';
      }
     if($Local==2){  // Local Burzaco
         if(($S2 <1) and ($Stock >0)){ $Clase="warning"; }
         
          echo '<tr class="'.$Clase .'" ondblclick="CA('.$ID.')"><td>'.$Codigo.'</td><td>'.$Articulo.'</td><td>'.$Categoria.'</td>';
          echo '<td class="TD" title="P3:'.$P3.' // P2:'.$P2.' // P1:'.$P1.'">'. $P3.'</td>';
          echo '<td class="TC" title="Adrogue:'.$S1.' * Burzaco:'.$S2.'* Deposito: '.$S3.'">'.$S2.'</td></tr>';
      }
     if($Local==3){  // Local Burzaco
         if(($S3 <1) and ($Stock >0)){ $Clase="warning"; }
         
          echo '<tr class="'.$Clase .'" ondblclick="CA('.$ID.')"><td>'.$Codigo.'</td><td>'.$Articulo.'</td><td>'.$Categoria.'</td>';
          echo '<td class="TD" title="P1:'.$P1.' // P2:'.$P2.' // P3:'.$P3.'">'. $P1.'</td>';
          echo '<td class="TC" title="Adrogue:'.$S1.' * Burzaco:'.$S2.'* Deposito: '.$S3.'">'.$S3.'</td></tr>';
      }
  } // Fin while tabla ventas 
/*  	echo '</tbody></table>';  */
   
}// Fin tabla ventas


/* **********************************             */
if ($modo==2) { // Tabla Articulos
    $sql= "SELECT `idart`, `Articulo`, `Codigo`, `ObsID`, `Costo`, `P1`, `P2`, `P3`, `S1`, `S2`, `S3`, `CatID` FROM `t_art`";
/*
echo '<table width="100%" class="table table-striped table-bordered table-hover" id="Tart"><thead class="Titulo">';
echo '<tr><th width="100px">Codigo</th><th>Articulo</th><th  width="140px">Categoria</th><th width="45px">Menu</th>';
echo '<th class="TD" width="70px">Precio</th><th class="TD" width="50px">Stock</th></tr></thead><tbody>';*/

  $segmento = mysqli_query($conexion,$sql);

 $X=0;
  while ($row = mysqli_fetch_array($segmento)){
         $X=$X+1;
         $ID=$row['idart'] ;
         $Articulo=$row["Articulo"];
         $Codigo= $row["Codigo"];
         $ObsID= $row["ObsID"];
         $Costo= $row["Costo"];  
         $P1= $row["P1"] ;  
         $P2= $row["P2"] ;
         $P3= $row["P3"] ;  
         $S1= $row["S1"] ;
         $S2= $row["S2"] ;  
         $S3= $row["S3"] ;
         $CatID= $row["CatID"] ; 
         $Stock=  $S1+ $S2 +$S3;
         $Clase="";
         $Categoria="";
      if($Stock < 1){ $Clase ="danger"; }
 
      switch ($CatID) {
        case 1:
             $Categoria="Celulares";
             break;
        case 2:
             $Categoria="Art PC";
             break;
        case 3:
             $Categoria="Baterias";
             break;
        case 4:
             $Categoria="Alamacenamiento";
             break;
        case 5:
             $Categoria="Otros";
             break;
      } //Categoria

  $Clase="";

  if ($Stock <= 0 ) { $Clase="danger";}

          echo '<tr class="'.$Clase .'" ondblclick="CAD('.$ID.')" ><td>'.$Codigo.'</td><td>'.$Articulo.'</td><td>'.$Categoria.'</td>';
          echo '<td class="center"><button class="btn btn-primary btn-xs" onclick="Fart('.$ID.')">FICHA</button></td>';
          echo '<td class="TD" title="P1:'.$P1.' // P2:'.$P2.' // P3:'.$P3.'">'. $P1.'</td>';
          echo '<td class="TC" title="Adrogue:'.$S1.' * Burzaco:'.$S2.'* Deposito: '.$S3.'">'.$Stock.'</td></tr>';
    
      
  } // Fin while tabla ventas 
  	/*echo '</tbody></table>';  */
   
}// Fin tabla ventas
if ($modo==5) { // Lista de pednientes
    $sql="SELECT `idP`, Articulo, `C`, `L`, `Q`, `Estado`, `FP`, `FB`,S1,S2,S3 FROM `t_pedir`,`t_art`  WHERE (`Estado`=1) and (`ArtID`=idart) ORDER BY `L` ASC; ";

    $segmento = mysqli_query($conexion,$sql);

    echo'<style> .Ficha{ background: lightskyblue; border: 2px solid black;margin: 6px; height: 100px; } </style>';
    echo'<style> .Ficha2{ background: tan; border: 2px solid black;margin: 6px; height: 100px; } </style>';
    echo'<style> .Ficha3{ background: greenyellow; border: 2px solid black;margin: 6px; height: 100px; } </style>';
    echo'<style> .Ficha4{ background: whitesmoke; border: 2px solid black;margin: 6px; height: 100px; } </style>';


    while ($row = mysqli_fetch_array($segmento)) {
            $ID=$row["idP"];
            $Stock=$row["S1"]+$row["S2"]+$row["S3"];
            $FP= date ("d-m-Y", strtotime($row["FP"]));// $row["FP"];

            if($row["Q"]==0 ){ $Locales="X Comprar"; $Clas= "Ficha4";}
            if($row["Q"]==1 ){ $Locales="Adrogue";  $Clas= "Ficha";}
            if($row["Q"]==2 ){ $Locales="Burzaco";  $Clas= "Ficha2";}
            if($row["Q"]==3 ){ $Locales="Deposito";  $Clas= "Ficha3";}

            echo '<li><div class="'.$Clas.'"><div><h5><div class="col-xs-9">';
            echo  '<p><strong>'.$row["Articulo"].'</strong></p></div>' ;
            echo '<div class="col-xs-3 TD"><p title="Stock total de todos los locales">'.$Stock.'<span></p></div> </h5>';
            echo '<div class="col-xs-8"><p>Cant: <span>'.$row["C"].'</span></p></div><div class="col-xs-4"><p>'.$FP.'<span></p></div> ';
            echo '<div class="col-xs-8"><p>Local: <span>'. $Locales. '</span></p></div><div class="col-xs-4"><a href="#" class="btn btn-danger" onclick="BorPedido('.$ID.')"> Borrar</a> </div>';
            echo '</div></div> </li><li class="divider"> </li>';

    }// while
}// Fin Lista pendientes

if($modo==6){// Lista user
    $sql="SELECT `idver`, `U`, `P`, `L`, `nreal`, `A` FROM `ver` ORDER BY `nreal` ASC;";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $ID = $row["idver"];
        $U = $row["U"];
        $L = $row["L"];
        if($L==4){$L="Amin"; };
        $R = $row["nreal"];
        echo '<tr onclick="vtuse(' . $ID . ')"><td>' . $R . '</td><td>' . $U . '</td><td class="TC">' . $L . '</td></tr>';
    }
}// Fin Lista user

/* *************************************************** */

if ($modo==7){// Listado de articulos vendidos Garantia  string substr (
    $sql="SELECT `IdD`,`Articulo`, `Precio`, `OBS`, `Serial`, `Fecha`, `Cliente`, `Local`, `Num` FROM `t_detalle`,`t_venta`,`t_art` WHERE ((`IdV`=`Vid`) AND (`ArtID`=`idart`))";
    $sql=$sql." AND ( ( `Serial`='".$D."') OR ( `Num`='".$D."') OR ( `Cliente` LIKE '%".$D."%' )) ";

    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {

        if($row["Local"]==1){$LOC="A";};
        if($row["Local"]==2){$LOC="B";};
        if($row["Local"]==3){$LOC="D";};

        echo '<tr onclick="DG('.$row["IdD"].')"><th>'.$row["Fecha"].'</th><th>'.$row["Articulo"].'</th><th>'.$row["Serial"].'</th><th>'.str_pad($row["Num"], 6, "0", STR_PAD_LEFT).'</th>';
        echo '<th>'.$row["Cliente"].'</th><th>'.$formatter->formatCurrency( $row["Precio"], 'USD'), PHP_EOL.'</th><th>'. $LOC.'</th></tr>';
    }
}// Finlistado grantia


if ($modo==8){// tabla de cliente con señas

  $sql="SELECT `idcli`, `dni`, `tel`, `email`, `Cliente`, `Estado`, `Local`, total, um  FROM `t_cliente` ,
 (Select cliid,sum(`monto`) as total,max(`fecha`) as um from `t_nc` 
 GROUP BY `cliid`) as T ";
   // $sql="SELECT `idcli`, `dni`, `tel`, `email`, `Cliente`, `Estado`, `Local`, total,  um FROM `t_cliente` , (Select sum(`monto`) as total,max(`fecha`) as um  from `t_nc` where `idcli`=`cliid`) as T  ";

    if($D) {
          $sql=$sql."where ((cliid=idcli)and (`Estado`=1)) and (`Local`=".$Local.") ";
      }else{
          $sql=$sql."where (cliid=idcli)and ( `Local`=".$Local.") ";
      }

    $sql=$sql." ORDER BY `Cliente` ;";

    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
   // print $sql;
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {

        if($row["Local"]==1){$LOC="A";};
        if($row["Local"]==2){$LOC="B";};
        if($row["Local"]==3){$LOC="D";};

            $Total=$formatter->formatCurrency( $row["total"], 'USD'); //, PHP_EOL;
            $fecha= substr ($row["um"],0,10) ;
        echo '<tr ondblclick="TADE('.$row["idcli"].','.$row["Estado"].')"><td>'.$row["Cliente"].'</td><td>'.$row["dni"].'</td><td>'.$Total.'</td><td>'.$LOC ;
        echo '</td><td>'.$fecha.'</td><td><button onclick="Liq('.$row["idcli"].')" class="btn btn-danger" title="Liquidar cuenta"><i class="fa fa-dollar"> </i></button></td></tr>';

    }
    echo '<script>$("#BT1NC tr").on("click",function(){ document.getElementById("verCli2").innerHTML=this.getElementsByTagName("td")[0].innerHTML ;});</script>';
}// Finlistado seña x cliente

if ($modo==9){// tabla de cliente con señas

    $sql="SELECT `idnc`, `cliid`, `uid`, `nnc`, `fecha`, `monto`, `nota` FROM `t_nc` WHERE `cliid`=".$D." ;";

    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    // print $sql;
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {

        $Total=$formatter->formatCurrency( $row["monto"], 'USD'); //, PHP_EOL;
        $fecha= substr ($row["fecha"],0,10) ;

        echo '<tr onclick="V('.$row["idnc"].')"><td>'.str_pad($row["nnc"], 6, "0", STR_PAD_LEFT).'</td><td>'.$fecha.'</td><td class="TD">'.$Total.'</td><td>'.$row["nota"].'</td></tr>';

    }
}// Finlistado grantia

if ($modo==10){// tabla de recibo reimpresion
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $sql="SELECT `IdV`, `Fecha`, `Cliente` , `Total`, `Control`, `Local`, `Num` FROM `t_venta` WHERE ((`Local`=".$Local .") AND (( `Num`='".$D."') OR ( `Cliente` LIKE '%".$D."%' ))) ORDER BY `IdV` DESC LIMIT 10;";

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<tr data-id="'.$row["IdV"].'">';
        $recibo=str_pad($row["Num"], 6, "0", STR_PAD_LEFT);
        echo '<td>'.$recibo.'</td>';
        echo '<td>'.$row["Cliente"].'</td>';
        $Total=$formatter->formatCurrency( $row["Total"], 'USD'); //, PHP_EOL;
        echo '<td>'.$Total.'</td>';
        $Fecha=  $row["Fecha"]  ;
        echo '<td>'.$Fecha.'</td>';
        echo '</tr>';
    }
    echo '<script>ver();</script>';
}// Fin Re impresion de facturas


if ($modo==11){ // Listado de Articulo
        $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
        echo '<h2>Listado General </h2>';
        $sql = "SELECT `Codigo`, `Articulo`, `Costo`, `P1`, `P2`, `P3`, `S1`, `S2`, `S3`, `CatID` FROM `t_art` ORDER BY `CatID`,`Articulo`;";
        echo '<table class="table table-striped" id="L1"><thead><tr><th>CODIGO</th><th>ARTICULO</th><th>Lista 1</th><th>Lista 2</th>';
        echo '<th>Lista 3</th><th class="TC">Categoria</th><th>Adrogue</th><th>Burzaco</th><th>Deposito</th></tr></thead><tbody>';
        $segmento = mysqli_query($conexion, $sql);
        while ($row = mysqli_fetch_array($segmento)) {
            switch ($row["CatID"]) {
                case 1:
                    $Categoria = "Celulares";
                    break;
                case 2:
                    $Categoria = "Art PC";
                    break;
                case 3:
                    $Categoria = "Baterias";
                    break;
                case 4:
                    $Categoria = "Alamacenamiento";
                    break;
                case 5:
                    $Categoria = "Otros";
                    break;
            } //Categoria

            echo '<tr><td>' . $row["Codigo"] . '</td><td>' . $row["Articulo"] . '</td>';
            echo '<td>' . $formatter->formatCurrency($row["P1"], 'USD') . '</td>';
            echo '<td>' . $formatter->formatCurrency($row["P2"], 'USD') . '</td>';
            echo '<td>' . $formatter->formatCurrency($row["P3"], 'USD') . '</td>';
            echo '<td>' . $Categoria . '</td>';
            echo '<td>' . $row["S1"] . '</td>';
            echo '<td>' . $row["S2"] . '</td>';
            echo '<td>' . $row["S3"] . '</td>';
            echo '</tr>';

        }
        echo ' </tbody></table>';
        echo '<h2 class="TC">Resumen</h2>';
        echo '<h3  style="padding: 1px 6em 1em 6em;"><table class="table table-striped table-bordered"><thead><tr><th width="30px">Cantidad</th><th width="160px">Categoria</th><th width="90px">Valor</th></tr></thead>';
        $sql = "SELECT COUNT(`Articulo`)as Hay ,`CatID` , (sum(if(`S1`<0,`S1`=0,`S1`)+if(`S2`<0,`S2`=0,`S2`)+if(`S3`<0,`S3`=0,`S3`))*`Costo` ) as Total FROM `t_art` GROUP BY `CatID`;";
        $segmento = mysqli_query($conexion, $sql);
        while ($row = mysqli_fetch_array($segmento)) {
            switch ($row["CatID"]) {
                case 1:
                    $Categoria = "Celulares";
                    break;
                case 2:
                    $Categoria = "Art PC";
                    break;
                case 3:
                    $Categoria = "Baterias";
                    break;
                case 4:
                    $Categoria = "Alamacenamiento";
                    break;
                case 5:
                    $Categoria = "Otros";
                    break;
            } //Categoria
            echo '<tr><td class="TD">' . $row["Hay"] . '</td><td>' . $Categoria . '</td>';
            echo '<td class="TD">' . $formatter->formatCurrency($row["Total"], 'USD') . '</td></tr>';
        }// fin while

        echo '</tbody></table></h3>';
} //  Fin  Listado de Articulos

/*****************************          Listado completa de costos ************************************************************************/

if ($modo==12){// Listado de Articulo
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    /* ************************ Local Adrogue *********************************** */
    $sql="SELECT `Codigo`,`Articulo`, `Costo`,`S1` ,(IF(`S1`<0,0,`S1`)* `Costo`) as valuado FROM `t_art` ORDER BY `Articulo`,`CatID` ASC";
    echo '<h2>Adrogue</h2><hr>';
    echo '<table class="table table-striped" id="L2"><thead><tr><th>CODIGO</th><th>ARTICULO</th><th>Costo</th><th>Stock</th><th>Valuado</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<tr><td>'.$row["Codigo"].'</td><td>'.$row["Articulo"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["Costo"], 'USD').'</td>';
        echo '<td>'.$row["S1"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["valuado"], 'USD').'</td>';
        echo '</tr>';
    }
    echo ' </tbody></table><hr>';
    echo '<h2 class="TC">Resumen Adrogue</h2>' ;
    echo '<h3  style="padding: 1px 6em 1em 6em;"><table class="table table-striped table-bordered"><thead><tr><th width="30px">Cantidad</th><th width="160px">Categoria</th><th width="90px">Valor</th></tr></thead>';
    $sql="SELECT SUM(IF(`S1`<0,0,`S1`)) as unidad,`CatID` ,SUM(IF(`S1`<0 ,0,`S1`) * `Costo`) as valuado FROM `t_art` GROUP BY `CatID` ORDER BY `CatID` ASC;";
    $segmento = mysqli_query($conexion,$sql);
    $Suma=0;
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria = "Celulares";
                break;
            case 2:
                $Categoria = "Art PC";
                break;
            case 3:
                $Categoria = "Baterias";
                break;
            case 4:
                $Categoria = "Alamacenamiento";
                break;
            case 5:
                $Categoria = "Otros";
                break;
        } //Categoria
        $Suma=$Suma+$row["valuado"];
        echo '<tr><td class="TD">' . $row["unidad"] . '</td><td>' . $Categoria . '</td>';
        echo '<td class="TD">' . $formatter->formatCurrency($row["valuado"], 'USD') . '</td></tr>';
    }// fin while

    echo'</tbody></table><hr></h3>';
    /********************** Fin Local Adrogue -********************************** */
     /* ************************ Local Burzaco *********************************** */
    $sql="SELECT `Codigo`,`Articulo`, `Costo`,`S2` ,(IF(`S2`<0,0,`S2`)* `Costo`) as valuado FROM `t_art` ORDER BY `Articulo`,`CatID` ASC";
    echo '<h2>Burzaco</h2><hr>';
    echo '<table class="table table-striped" id="L2"><thead><tr><th>CODIGO</th><th>ARTICULO</th><th>Costo</th><th>Stock</th><th>Valuado</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<tr><td>'.$row["Codigo"].'</td><td>'.$row["Articulo"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["Costo"], 'USD').'</td>';
        echo '<td>'.$row["S2"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["valuado"], 'USD').'</td>';
        echo '</tr>';
    }
    echo ' </tbody></table><hr>';
    echo '<h2 class="TC">Resumen Burzaco</h2>' ;
    echo '<h3  style="padding: 1px 6em 1em 6em;"><table class="table table-striped table-bordered"><thead><tr><th width="30px">Cantidad</th><th width="160px">Categoria</th><th width="90px">Valor</th></tr></thead>';
    $sql="SELECT SUM(IF(`S2`<0,0,`S2`)) as unidad,`CatID` ,SUM(IF(`S2`<0 ,0,`S2`) * `Costo`) as valuado FROM `t_art` GROUP BY `CatID` ORDER BY `CatID` ASC;";
    $segmento = mysqli_query($conexion,$sql);
    $Suma=0;
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria = "Celulares";
                break;
            case 2:
                $Categoria = "Art PC";
                break;
            case 3:
                $Categoria = "Baterias";
                break;
            case 4:
                $Categoria = "Alamacenamiento";
                break;
            case 5:
                $Categoria = "Otros";
                break;
        } //Categoria
        $Suma=$Suma+$row["valuado"];
        echo '<tr><td class="TD">' . $row["unidad"] . '</td><td>' . $Categoria . '</td>';
        echo '<td class="TD">' . $formatter->formatCurrency($row["valuado"], 'USD') . '</td></tr>';
    }// fin while

    echo'</tbody></table><hr></h3>';
    /********************** Fin Local Burzaco -********************************** */
     /* ************************ Deposito *********************************** */
    $sql="SELECT `Codigo`,`Articulo`, `Costo`,`S3` ,(IF(`S3`<0,0,`S3`)* `Costo`) as valuado FROM `t_art` ORDER BY `Articulo`,`CatID` ASC";
    echo '<h2>Deposito</h2><hr>';
    echo '<table class="table table-striped" id="L2"><thead><tr><th>CODIGO</th><th>ARTICULO</th><th>Costo</th><th>Stock</th><th>Valuado</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        echo '<tr><td>'.$row["Codigo"].'</td><td>'.$row["Articulo"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["Costo"], 'USD').'</td>';
        echo '<td>'.$row["S3"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["valuado"], 'USD').'</td>';
        echo '</tr>';
    }
    echo ' </tbody></table><hr>';
    echo '<h2 class="TC">Resumen Stock Deposito</h2>' ;
    echo '<h3  style="padding: 1px 6em 1em 6em;"><table class="table table-striped table-bordered"><thead><tr><th width="30px">Cantidad</th><th width="160px">Categoria</th><th width="90px">Valor</th></tr></thead>';
    $sql="SELECT SUM(IF(`S3`<0,0,`S3`)) as unidad,`CatID` ,SUM(IF(`S3`<0 ,0,`S3`) * `Costo`) as valuado FROM `t_art` GROUP BY `CatID` ORDER BY `CatID` ASC;";
    $segmento = mysqli_query($conexion,$sql);
    $Suma=0;
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria = "Celulares";
                break;
            case 2:
                $Categoria = "Art PC";
                break;
            case 3:
                $Categoria = "Baterias";
                break;
            case 4:
                $Categoria = "Alamacenamiento";
                break;
            case 5:
                $Categoria = "Otros";
                break;
        } //Categoria
        $Suma=$Suma+$row["valuado"];
        echo '<tr><td class="TD">' . $row["unidad"] . '</td><td>' . $Categoria . '</td>';
        echo '<td class="TD">' . $formatter->formatCurrency($row["valuado"], 'USD') . '</td></tr>';
    }// fin while

    echo'</tbody></table><hr></h3>';
    /********************** Fin Local Deposito -********************************** */
}// Fin  Listado de Articulos


/*****************************  Fin listado completo ***********************************************************************/

if ($modo==13){// Listado de Adrogue
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    echo '<h2>Listado Adrogue </h2>';
    $sql="SELECT `S1`, `Articulo`, `Codigo`, `P1`, `CatID` FROM `t_art` WHERE `S1` >0  ORDER BY `CatID` ;";
    echo '<table class="table table-striped" id="L3"><thead><tr><th>Stock</th><th>ARTICULO</th><th class="TC">CODIGO</th><th class="TD">Precio Venta</thclass>';
    echo ' <th class="TC">Categoria</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria="Celulares";
                break;
            case 2:
                $Categoria="Art PC";
                break;
            case 3:
                $Categoria="Baterias";
                break;
            case 4:
                $Categoria="Alamacenamiento";
                break;
            case 5:
                $Categoria="Otros";
                break;
        } //Categoria

        echo '<tr><td>'.$row["S1"].'</td><td>'.$row["Articulo"].'</td><td>'.$row["Codigo"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["P1"], 'USD').'</td>';
        echo '<td>'.$Categoria.'</td></tr>';

    }
    echo ' </tbody></table>';
    echo '<h2 class="TC">Resumen Valuado Venta</h2>' ;
    echo '<h3  style="padding: 1px 6em 1em 6em;"><table class="table table-striped table-bordered"><thead><tr><th width="30px">Cantidad</th><th width="160px">Categoria</th><th width="90px">Valor</th></tr></thead>';
    $sql="SELECT COUNT(`Articulo`)as Hay ,`CatID` , (sum(if(`S1`<0,`S1`=0,`S1`))*`P1` ) as Total FROM `t_art` GROUP BY `CatID`;";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria = "Celulares";
                break;
            case 2:
                $Categoria = "Art PC";
                break;
            case 3:
                $Categoria = "Baterias";
                break;
            case 4:
                $Categoria = "Alamacenamiento";
                break;
            case 5:
                $Categoria = "Otros";
                break;
        } //Categoria
        echo '<tr><td class="TD">' . $row["Hay"] . '</td><td>' . $Categoria . '</td>';
        echo '<td class="TD">' . $formatter->formatCurrency($row["Total"], 'USD') . '</td></tr>';
    }// fin while

    echo'</tbody></table><hr></h3>';
    /* aca van señas activas */
    echo '<hr><h4>Listado Adrogue </h4>';
    $sql="SELECT `Codigo`,  `Articulo`, `CatID` FROM `t_art` WHERE `S1` < 1  ORDER BY `CatID`;";
    echo '<table class="table table-striped" id="L3"><thead><tr><th class="TC">CODIGO</th><th>ARTICULO</th><th class="TC">Categoria</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria="Celulares";
                break;
            case 2:
                $Categoria="Art PC";
                break;
            case 3:
                $Categoria="Baterias";
                break;
            case 4:
                $Categoria="Alamacenamiento";
                break;
            case 5:
                $Categoria="Otros";
                break;
        } //Categoria
        echo '<tr><td>'.$row["Codigo"].'</td><td>'.$row["Articulo"].'</td><td><td>'.$Categoria.'</td></tr>';
    }
    echo ' </tbody></table>';
    /* ******************* */
}// Fin  Listado de Adrogue

if ($modo==14){// Listado de Adrogue
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    echo '<h2>Listado Burzaco </h2>';
    $sql="SELECT `S2`, `Articulo`, `Codigo`, `P3`, `CatID` FROM `t_art` WHERE `S2` >0  ORDER BY `CatID`;";
    echo '<table class="table table-striped" id="L3"><thead><tr><th>Stock</th><th>ARTICULO</th><th class="TC">CODIGO</th><th class="TD">Precio Venta</thclass>';
    echo ' <th class="TC">Categoria</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria="Celulares";
                break;
            case 2:
                $Categoria="Art PC";
                break;
            case 3:
                $Categoria="Baterias";
                break;
            case 4:
                $Categoria="Alamacenamiento";
                break;
            case 5:
                $Categoria="Otros";
                break;
        } //Categoria

        echo '<tr><td>'.$row["S2"].'</td><td>'.$row["Articulo"].'</td><td>'.$row["Codigo"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["P3"], 'USD').'</td>';
        echo '<td>'.$Categoria.'</td></tr>';

    }
    echo ' </tbody></table>';
    echo '<h2 class="TC">Resumen Valuado Venta</h2>' ;
    echo '<h3  style="padding: 1px 6em 1em 6em;"><table class="table table-striped table-bordered"><thead><tr><th width="30px">Cantidad</th><th width="160px">Categoria</th><th width="90px">Valor</th></tr></thead>';
    $sql="SELECT COUNT(`Articulo`)as Hay ,`CatID` , (sum(if(`S2`<0,`S2`=0,`S2`))*`P1` ) as Total FROM `t_art` GROUP BY `CatID`;";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria = "Celulares";
                break;
            case 2:
                $Categoria = "Art PC";
                break;
            case 3:
                $Categoria = "Baterias";
                break;
            case 4:
                $Categoria = "Alamacenamiento";
                break;
            case 5:
                $Categoria = "Otros";
                break;
        } //Categoria
        echo '<tr><td class="TD">' . $row["Hay"] . '</td><td>' . $Categoria . '</td>';
        echo '<td class="TD">' . $formatter->formatCurrency($row["Total"], 'USD') . '</td></tr>';
    }// fin while

    echo'</tbody></table><hr></h3>';
    /* aca van señas activas */
    echo '<hr><h4>Listado Faltantes </h4>';
    $sql="SELECT `Codigo`,  `Articulo`, `CatID` FROM `t_art` WHERE `S2` < 1  ORDER BY `CatID` ;";
    echo '<table class="table table-striped" id="L3"><thead><tr><th class="TC">CODIGO</th><th>ARTICULO</th><th class="TC">Categoria</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria="Celulares";
                break;
            case 2:
                $Categoria="Art PC";
                break;
            case 3:
                $Categoria="Baterias";
                break;
            case 4:
                $Categoria="Alamacenamiento";
                break;
            case 5:
                $Categoria="Otros";
                break;
        } //Categoria
        echo '<tr><td>'.$row["Codigo"].'</td><td>'.$row["Articulo"].'</td><td><td>'.$Categoria.'</td></tr>';
    }
    echo ' </tbody></table>';
    /* ******************* */
}// Fin  Listado de Burzaco

if ($modo==15){// Listado de Deposito
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    echo '<h2>Listado Deposito </h2>';
    $sql="SELECT `S3`, `Articulo`, `Codigo`, `P1`, `CatID` FROM `t_art` WHERE `S3` >0 ORDER BY `CatID`;";
    echo '<table class="table table-striped" id="L3"><thead><tr><th>Stock</th><th>ARTICULO</th><th class="TC">CODIGO</th><th class="TD">Precio Venta</thclass>';
    echo ' <th class="TC">Categoria</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria="Celulares";
                break;
            case 2:
                $Categoria="Art PC";
                break;
            case 3:
                $Categoria="Baterias";
                break;
            case 4:
                $Categoria="Alamacenamiento";
                break;
            case 5:
                $Categoria="Otros";
                break;
        } //Categoria

        echo '<tr><td>'.$row["S3"].'</td><td>'.$row["Articulo"].'</td><td>'.$row["Codigo"].'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["P1"], 'USD').'</td>';
        echo '<td>'.$Categoria.'</td></tr>';

    }
    echo ' </tbody></table>';
    echo '<h2 class="TC">Resumen Valuado Venta</h2>' ;
    echo '<h3  style="padding: 1px 6em 1em 6em;"><table class="table table-striped table-bordered"><thead><tr><th width="30px">Cantidad</th><th width="160px">Categoria</th><th width="90px">Valor</th></tr></thead>';
    $sql="SELECT COUNT(`Articulo`)as Hay ,`CatID` , (sum(if(`S3`<0,`S3`=0,`S3`))*`P1` ) as Total FROM `t_art` GROUP BY `CatID`;";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria = "Celulares";
                break;
            case 2:
                $Categoria = "Art PC";
                break;
            case 3:
                $Categoria = "Baterias";
                break;
            case 4:
                $Categoria = "Alamacenamiento";
                break;
            case 5:
                $Categoria = "Otros";
                break;
        } //Categoria
        echo '<tr><td class="TD">' . $row["Hay"] . '</td><td>' . $Categoria . '</td>';
        echo '<td class="TD">' . $formatter->formatCurrency($row["Total"], 'USD') . '</td></tr>';
    }// fin while

    echo'</tbody></table><hr></h3>';
    /* aca van señas activas */
    echo '<hr><h4>Falatantes </h4>';
    $sql="SELECT `Codigo`,  `Articulo`, `CatID` FROM `t_art` WHERE `S3` < 1  ORDER BY `CatID` ;";
    echo '<table class="table table-striped" id="L3"><thead><tr><th class="TC">CODIGO</th><th>ARTICULO</th><th class="TC">Categoria</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["CatID"]) {
            case 1:
                $Categoria="Celulares";
                break;
            case 2:
                $Categoria="Art PC";
                break;
            case 3:
                $Categoria="Baterias";
                break;
            case 4:
                $Categoria="Alamacenamiento";
                break;
            case 5:
                $Categoria="Otros";
                break;
        } //Categoria
        echo '<tr><td>'.$row["Codigo"].'</td><td>'.$row["Articulo"].'</td><td><td>'.$Categoria.'</td></tr>';
    }
    echo ' </tbody></table>';
    /* ******************* */
}// Fin  Listado de Deposito

if ($modo==16) {// Listado de Clientes
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $sql = "SELECT `Cliente`,`DNI`,`Email`,MAX(`Fecha`) as UVenta,SUM(`Total`) as Vendido ,`Local` FROM `t_venta` GROUP BY `Local`,`Cliente` ORDER BY `Local`;";
    echo '<h2>Cliente por Ventas</h2>';
    echo '<table class="table table-striped" id="L"><thead><tr><th>Cliente</th><th width="30px">DNI</th><th width="30px">Email</th><th>Vendido</th>';
    echo '<th>U.Venta</th><th class="TC">Local</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["Local"]) {
            case 1:
                $Local = "Adrogue";
                break;
            case 2:
                $Local = "Burzaco";
                break;
            case 3:
                $Local = "Deposito";
                break;

        } //Local

        echo '<tr><td>' . $row["Cliente"] . '</td><td>' . $row["DNI"] . '</td><td>' . $row["Email"] . '</td>';
        echo '<td>' . $formatter->formatCurrency($row["Vendido"], 'USD') . '</td>';
        echo '<td>' . $row["UVenta"] . '</td>';
        echo '<td>' . $Local . '</td>';
        echo '</tr>';

    }
    echo ' </tbody></table>';
    echo '<h3>Clientes con Señas</h3>';

    $sql = "SELECT `Cliente`,`dni`,`tel`,`email`,`Estado`,`Local` FROM `t_cliente` GROUP BY `Cliente` ORDER BY`Local`,`Cliente`;";

    echo '<table class="table table-striped" id="L"><thead><tr><th>Cliente</th><th width="30px">DNI</th><th width="30px">Telefono</th><th width="30px">Email</th><th>Estado</th>';
    echo '<th class="TC">Local</th></tr></thead><tbody>';

    $segmento = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["Local"]) {
            case 1:
                $Local = "Adrogue";
                break;
            case 2:
                $Local = "Burzaco";
                break;
            case 3:
                $Local = "Deposito";
                break;
        } //Local
        switch ($row["Estado"]) {
            case 1:
                $Estado = "Activa";
                break;
            case 2:
                $Local = "Terminada";
                break;
        } //Estado
        echo '<tr><td>' . $row["Cliente"] . '</td><td>' . $row["dni"] . '</td><td>' . $row["tel"] . '</td><td>' . $row["email"] . '</td>';
        echo '<td>' . $row["Estado"] . '</td><td>' . $Local . '</td></tr>';

    }

}// Fin  Listado de Clientes

/************************************  Informes ***********************************************************/

if ($modo=='1I1'){// Informe Ventas Totales
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $sql="SELECT `Fecha`, `Cliente`, `DNI`, `Email`, `Total`, `Control`, `Local`, `Num` FROM `t_venta` WHERE ((`Fecha` >= '".$Desde."') AND (`Fecha` <='".$Hasta."')) ORDER BY `Local`,`Fecha`,`Num`;";

     echo '<h3>Informe de Ventas</h3>';
    echo '<table class="table table-striped" id="L101"><thead><tr><th width="130px">Fecha</th><th>Cliente</th><th width="40px">N°</th><th width="40px">Total</th><th class="TC" width="30px">Local</th>';
    echo'<th>Control</th></tr></thead><tbody>';

    $MaxVen=0;
    $NumMax=0;
    $x=0;
    $Total=0;

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        switch ($row["Local"]) {
            case 1:
                $Local="Adrogue";
                break;
            case 2:
                $Local="Burzaco";
                break;
            case 3:
                $Local="Deposito";
                break;
        } //Local
        $recibo=str_pad($row["Num"], 6, "0", STR_PAD_LEFT);
        echo '<tr><td>'.$row["Fecha"].'</td><td>'.$row["Cliente"].'</td><td>'.$recibo.'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["Total"], 'USD').'</td>';
        echo '<td>'.$Local.'</td><td>'.$row["Control"].'</td>';
        echo '</tr>';
        $Total=$Total+$row["Total"];
        $x=$x+1;
        if ($MaxVen < $row["Total"] ){
            $MaxVen =$row["Total"];
            $NumMax= $row["Num"];
            $MaxLocal=$Local;
        }

    }
    echo ' </tbody></table><hr>';
    if($x>0){
        echo '<h4 style="padding: 1em 10em 5em;">';
        echo '<table class="table table-striped table-bordered table-hover"  style="width: 450px"><thead><tr><th class="TC"><h3>Resumen de ventas</h3></th><th></th></th></tr></thead><tbody>';

         echo '<tr><td class="TD" >Total Vendido</td><td class="TD" >'.$formatter->formatCurrency( $Total , 'USD').'</td></tr>';
         echo '<tr><td class="TD" >Ventas</td><td class="TD" >'.$x .'</td></tr>';
         echo '<tr><td class="TD" >Venta Promedio</td><td class="TD" >'.$formatter->formatCurrency( ($Total /$x), 'USD').'</td></tr>';
         echo '<tr><td class="TD" >Maximo Vendido</td><td class="TD" >' .$formatter->formatCurrency( $MaxVen  , 'USD').' </td></tr>';
         echo '<tr><td class="TD" >Max Numero</td><td class="TD" >' .str_pad($NumMax, 6, "0", STR_PAD_LEFT).' </td></tr>';
         echo '<tr><td class="TD" >Local</td><td class="TD" >' .$MaxLocal.' </td></tr>';

        echo ' </tbody></table><hr></h4>';
    }
}// Fin Informes Ventas Totales

if ($modo=='1I2'){// Informe Ventas Totales
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $sql="SELECT `Fecha`, `Cliente`, `DNI`, `Email`, `Total`, `Control`,  `Num` FROM `t_venta` WHERE (`Local`=1) AND ((`Fecha` >= '".$Desde."') AND (`Fecha` <='".$Hasta."')) ORDER BY `Local`,`Fecha`,`Num`;";

    echo '<h3>Informe de Ventas Adrogue </h3>';
    echo '<table class="table table-striped" id="L101"><thead><tr><th width="130px">Fecha</th><th>Cliente</th><th width="40px">N°</th><th width="40px">Total</th><th class="TC" width="30px">Local</th>';
    echo'<th>Control</th></tr></thead><tbody>';

    $MaxVen=0;
    $NumMax=0;
    $x=0;
    $Total=0;

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
         $Local="Adrogue"; //Local
        $recibo=str_pad($row["Num"], 6, "0", STR_PAD_LEFT);
        echo '<tr><td>'.$row["Fecha"].'</td><td>'.$row["Cliente"].'</td><td>'.$recibo.'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["Total"], 'USD').'</td>';
        echo '<td>'.$Local.'</td><td>'.$row["Control"].'</td>';
        echo '</tr>';
        $Total=$Total+$row["Total"];
        $x=$x+1;
        if ($MaxVen < $row["Total"] ){
            $MaxVen =$row["Total"];
            $NumMax= $row["Num"];
            $MaxLocal=$Local;
        }

    }
    echo ' </tbody></table><hr>';
    if($x>0){
        echo '<h4 style="padding: 1em 10em 5em;">';
        echo '<table class="table table-striped table-bordered table-hover"  style="width: 450px"><thead><tr><th class="TC"><h3>Resumen de ventas</h3></th><th></th></th></tr></thead><tbody>';

        echo '<tr><td class="TD" >Total Vendido</td><td class="TD" >'.$formatter->formatCurrency( $Total , 'USD').'</td></tr>';
        echo '<tr><td class="TD" >Ventas</td><td class="TD" >'.$x .'</td></tr>';
        echo '<tr><td class="TD" >Venta Promedio</td><td class="TD" >'.$formatter->formatCurrency( ($Total /$x), 'USD').'</td></tr>';
        echo '<tr><td class="TD" >Maximo Vendido</td><td class="TD" >' .$formatter->formatCurrency( $MaxVen  , 'USD').' </td></tr>';
        echo '<tr><td class="TD" >Max Numero</td><td class="TD" >' .str_pad($NumMax, 6, "0", STR_PAD_LEFT).' </td></tr>';
        echo '<tr><td class="TD" >Local</td><td class="TD" >' .$MaxLocal.' </td></tr>';

        echo ' </tbody></table><hr></h4>';
    }
}// Fin Informes Ventas Totales Adrogue

if ($modo=='1I3'){// Informe Ventas Totales Burzaco
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $sql="SELECT `Fecha`, `Cliente`, `DNI`, `Email`, `Total`, `Control`,  `Num` FROM `t_venta` WHERE (`Local`=2) AND ((`Fecha` >= '".$Desde."') AND (`Fecha` <='".$Hasta."')) ORDER BY `Local`,`Fecha`,`Num`;";

    echo '<h3>Informe de Ventas Burzaco </h3>';
    echo '<table class="table table-striped" id="L101"><thead><tr><th width="130px">Fecha</th><th>Cliente</th><th width="40px">N°</th><th width="40px">Total</th><th class="TC" width="30px">Local</th>';
    echo'<th>Control</th></tr></thead><tbody>';

    $MaxVen=0;
    $NumMax=0;
    $x=0;
    $Total=0;

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
         $Local="Burzaco"; //Local
        $recibo=str_pad($row["Num"], 6, "0", STR_PAD_LEFT);
        echo '<tr><td>'.$row["Fecha"].'</td><td>'.$row["Cliente"].'</td><td>'.$recibo.'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["Total"], 'USD').'</td>';
        echo '<td>'.$Local.'</td><td>'.$row["Control"].'</td>';
        echo '</tr>';
        $Total=$Total+$row["Total"];
        $x=$x+1;
        if ($MaxVen < $row["Total"] ){
            $MaxVen =$row["Total"];
            $NumMax= $row["Num"];
            $MaxLocal=$Local;
        }

    }
    echo ' </tbody></table><hr>';
    if($x>0){
        echo '<h4 style="padding: 1em 10em 5em;">';
        echo '<table class="table table-striped table-bordered table-hover"  style="width: 450px"><thead><tr><th class="TC"><h3>Resumen de ventas</h3></th><th></th></th></tr></thead><tbody>';

        echo '<tr><td class="TD" >Total Vendido</td><td class="TD" >'.$formatter->formatCurrency( $Total , 'USD').'</td></tr>';
        echo '<tr><td class="TD" >Ventas</td><td class="TD" >'.$x .'</td></tr>';
        echo '<tr><td class="TD" >Venta Promedio</td><td class="TD" >'.$formatter->formatCurrency( ($Total /$x), 'USD').'</td></tr>';
        echo '<tr><td class="TD" >Maximo Vendido</td><td class="TD" >' .$formatter->formatCurrency( $MaxVen  , 'USD').' </td></tr>';
        echo '<tr><td class="TD" >Max Numero</td><td class="TD" >' .str_pad($NumMax, 6, "0", STR_PAD_LEFT).' </td></tr>';
        echo '<tr><td class="TD" >Local</td><td class="TD" >' .$MaxLocal.' </td></tr>';

        echo ' </tbody></table><hr></h4>';
    }
}// Fin Informes Ventas Totales Burzaco

if ($modo=='1I4'){// Informe Ventas Totales Burzaco
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $sql="SELECT `Fecha`, `Cliente`, `DNI`, `Email`, `Total`, `Control`,  `Num` FROM `t_venta` WHERE (`Local`=3) AND ((`Fecha` >= '".$Desde."') AND (`Fecha` <='".$Hasta."')) ORDER BY `Local`,`Fecha`,`Num`;";

    echo '<h3>Informe de Ventas Deposito </h3>';
    echo '<table class="table table-striped" id="L101"><thead><tr><th width="130px">Fecha</th><th>Cliente</th><th width="40px">N°</th><th width="40px">Total</th><th class="TC" width="30px">Local</th>';
    echo'<th>Control</th></tr></thead><tbody>';

    $MaxVen=0;
    $NumMax=0;
    $x=0;
    $Total=0;

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $Local="Deposito"; //Local
        $recibo=str_pad($row["Num"], 6, "0", STR_PAD_LEFT);
        echo '<tr><td>'.$row["Fecha"].'</td><td>'.$row["Cliente"].'</td><td>'.$recibo.'</td>';
        echo '<td>'.$formatter->formatCurrency( $row["Total"], 'USD').'</td>';
        echo '<td>'.$Local.'</td><td>'.$row["Control"].'</td>';
        echo '</tr>';
        $Total=$Total+$row["Total"];
        $x=$x+1;
        if ($MaxVen < $row["Total"] ){
            $MaxVen =$row["Total"];
            $NumMax= $row["Num"];
            $MaxLocal=$Local;
        }

    }
    echo ' </tbody></table><hr>';
    if($x>0){
        echo '<h4 style="padding: 1em 10em 5em;">';
        echo '<table class="table table-striped table-bordered table-hover"  style="width: 450px"><thead><tr><th class="TC"><h3>Resumen de ventas</h3></th><th></th></th></tr></thead><tbody>';

        echo '<tr><td class="TD" >Total Vendido</td><td class="TD" >'.$formatter->formatCurrency( $Total , 'USD').'</td></tr>';
        echo '<tr><td class="TD" >Ventas</td><td class="TD" >'.$x .'</td></tr>';
        echo '<tr><td class="TD" >Venta Promedio</td><td class="TD" >'.$formatter->formatCurrency( ($Total /$x), 'USD').'</td></tr>';
        echo '<tr><td class="TD" >Maximo Vendido</td><td class="TD" >' .$formatter->formatCurrency( $MaxVen  , 'USD').' </td></tr>';
        echo '<tr><td class="TD" >Max Numero</td><td class="TD" >' .str_pad($NumMax, 6, "0", STR_PAD_LEFT).' </td></tr>';
        echo '<tr><td class="TD" >Local</td><td class="TD" >' .$MaxLocal.' </td></tr>';

        echo ' </tbody></table><hr></h4>';
    }
}// Fin Informes Ventas Totales Deposito

if ($modo=='15'){// Informe Compras
    $formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
    $sql=" SELECT `Codigo`,`Articulo`, `Cantidad`, `t_dc`.`Costo`, if( `Destino`=1,'Adrogue',if(`Destino`=2,'Burzaco','Deposito')) as Local,
 `idProve`, `Fecha`, `Compro`, `Total`, `Pago` FROM `t_compras`,`t_dc`,`t_art`  WHERE ((`ArtID`=`idart`) and(`idC`= `Cid`))
AND  ((`Fecha` >= '".$_GET["desde"]."') AND (`Fecha` <='".$_GET["hasta"]."')) ORDER BY `Fecha`,Local,`Compro`;";


    echo '<h3>Informe de Compras </h3>';
    echo '<table class="table table-striped sortable" id="L102"><thead><tr><th width="130px">Fecha</th><th>Codigo</th><th>Articulo</th><th>Cantidad</th><th>Parcial</th>';
    echo '<th class="TC" width="30px">Local</th>';
    echo'<th>Proveedor</th><th>N°</th></tr></thead><tbody>';

    $MaxVen=0;
    $NumMax=0;
    $x=0;

    $Total=0;

    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $Local= $row["Local"];
        $recibo=str_pad($row["Compro"], 6, "0", STR_PAD_LEFT);

        echo '<tr><td>'.$row["Fecha"].'</td><td>'.$row["Codigo"].'</td><td>'.$row["Articulo"].'</td><td class="TD">'.$row["Cantidad"].'</td>';
        echo '<td class="TC">'.$formatter->formatCurrency( ($row["Costo"]*$row["Cantidad"]), 'USD').'</td>';
        echo '<td>'.$Local.'</td><td> Proveedor '.$row["idProve"].'</td><td class="TD">'.$recibo.'</td>';
        echo '</tr>';
        $Total=$Total+($row["Costo"]*$row["Cantidad"]);
        $x=$x+$row["Cantidad"];

    }
    echo ' </tbody></table><hr>';
    if($x>0){
        echo '<h4 style="padding: 1em 10em 5em;">';
        echo '<table class="table table-striped table-bordered table-hover"  style="width: 450px"><thead><tr><th class="TC"><h3>Resumen de Compras </h3></th><th></th></th></tr></thead><tbody>';
        echo '<tr><td class="TD" >Total Comprado</td><td class="TD" >'.$formatter->formatCurrency( $Total , 'USD').'</td></tr>';
        echo '<tr><td class="TD" >Unidades</td><td class="TD" >'.$x .'</td></tr>';
        echo ' </tbody></table><hr></h4>';
    }

}// Fin Informes Compras

/**************************************  Fin Informes   ***************************************************************/
    mysqli_close($conexion);
?>
