<?php
//error_reporting(0);

include 'cgi/config2.inc';
    mysqli_set_charset($conexion,"utf8");

    if(isset($_GET["N"])){ $N=$_GET["N"];}
    if(isset($_GET["I"])){ $I=$_GET["I"];}else{$I=0;}

    if(isset($_GET["L"])){ $Local=$_GET["L"]; }

$Tabla="";

$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
 if($I==0){
     $sql="SELECT `IdV`, `Fecha`, `Cliente`, `DNI`, `Email`, `Total`, `Control`, `Local`, `Num`,`estado` FROM `t_venta` WHERE `Num`='".$N."' AND `Local`=".$Local.";";
 }else{
     $sql="SELECT `IdV`, `Fecha`, `Cliente`, `DNI`, `Email`, `Total`, `Control`, `Local`, `Num`,`estado` FROM `t_venta` WHERE  `IdV`=".$I.";";
 }
     $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $Cliente=$row["Cliente"];
        $Fecha= substr ($row["Fecha"],0,10) ;
        $Total=$row["Total"];
        $dni=$row["DNI"];
        $User=$row["Control"];
        $Local=$row["Local"];
        $recibo=str_pad($row["Num"], 6, "0", STR_PAD_LEFT);
        $id=$row["IdV"];
        $estado=$row["estado"];
    }

    $sql="SELECT `IdD`, `Codigo`, `Articulo` , `Precio`, `OBS`, `Serial` FROM `t_detalle`, `t_art` WHERE ((`ArtID`= `idart`) AND (`Vid`=".$id."));";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $Codigo=$row["Codigo"];
        $Tabla =$Tabla ."<tr><td>1</td><td>".$row["Codigo"]."</td><td>".$row["Articulo"]."</td><td>".$row["Serial"]."</td><td>".$formatter->formatCurrency( $row["Precio"], 'USD')."</td></tr>";
    }


$Logo="Logo.jpg"."?v=1";
    $sql="SELECT `Pie` FROM `varios` WHERE `idVarios`='1';";
    $segmento = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($segmento);

    $Mensaje=$row['Pie'];



if($Local==1) {
    $Local = "Adrogue";
    $Lugar="Salta 1391 (Adrogue)";
    $Tel="Tel:4236-3568";
}
if($Local==2) {
    $Local = "Burzaco";
    $Lugar="R. Rojas 973 (Bruzaco)" ;
    $Tel="Tel:3535-6767";
}
if($Local==3) {
    $Local = "Deposito";
    $Lugar="******";
    $Tel=" ";
}
 mysqli_close($conexion);
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recibo N° <?php echo $recibo; ?></title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->
    <style>
       .FLOGO{       }
       body {
           -webkit-print-color-adjust: exact;
       }
       .FLOGO img {
           position: absolute;
           vertical-align: middle;
           width: 70%;
           maxi-width:70mm;
           height: 108px;
           overflow: hidden;
           z-index:-1;
       }
       .FCABE{
            /*background:red;*/
       }
    .espa0{
        margin:0px;
        padding:0px;
    }
    .Anulado{
        margin-left: 3em;
        margin-top: 0.5;
        font-size: 5em;
        -ms-transform: rotate(8deg); /* IE 9 */
        -webkit-transform: rotate(8deg); /* Chrome, Safari, Opera */
        transform: rotate(8deg);
        position: absolute;
        z-index: 200;
    }
     thead tr{
         border:1px solid darkgray;
         background:#eae6e6;
     }

    .tablas{
        height:60mm;
    }
       td:nth-child(1) {
           text-align:right;
       }
       td:nth-child(4) {
           text-align: center;
       }
       td:nth-child(5) {
           text-align: right;
       }

        @media screen {
           #nover{display:none;}
        }
        @media print {
                   #nover{display:block;}
               }
        .pie1{
            font-size: 9px;
        }
       .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
         padding: 1px; }
    </style>
</head>
<?php
if(isset($_GET["V"])){ echo "<body>"; }else{ echo '<body  onmouseover="window.close();" onclick="window.close();">';}

?>


<div class="container-fluid">
     <div class="row">
          <div class="col-xs-6 FLOGO">
              <img src="<?php echo $Logo; ?>" >
             <!-- -->
          </div>
         <div class="col-xs-6 FCABE">
             <h4 class="TD espa0">Fecha: <span id="fecha"><?php echo $Fecha; ?></span></h4>
             <h4 class="TD espa0">Orden de compra  N°:  <span id="num"><?php echo $recibo; ?></span></h4>
             <h3 class="espa0">Cliente:<span id="cli"><?php echo $Cliente; ?></span></h3>
             <h5>Local:<span id="Local"><?php echo $Local; ?> <span> //C: <span id="control"><?php echo $User; ?> <span></h5>
         </div>
         <hr><hr>
         <div class="tablas">
             <div class="col-xs-4"><p style="font-size:0.9em;font-weight: bold;" class="TC">  <?php echo $Lugar; ?> </p></div>
             <div class="col-xs-3"><p style="font-size:0.9em;font-weight: bold;" class="TC">  <?php echo $Tel; ?> </p></div>
             <div class="col-xs-5"><p style="font-size:0.9em;" class="TC"><span style="font-weight: bold; color:#5656e6;">WWW.CONEXIONESMOVILES.COM.AR</span></p></div>
<?php if($estado==2){ echo "<h2 class='Anulado' > ANULADA </h2>";} ?>
             <table class="table" border="0" width="100%;" cellpadding="5" >
                 <thead>
                 <tr>
                     <th style="width: 20px;" >Cant.</th>
                     <th style="width: 100px;">Codigo</th>
                     <th>Articulo</th>
                     <th class="TC" style="width: 170px;">Serial</th>
                     <th  class="TC" style="width: 130px;">Monto</th>
                 </tr>
                 </thead>
                 <tbody>
                 <?php
                    echo $Tabla;
                 ?>

                 <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <th colasecell="3" class="TD"  >Total:</th><th><h4 class="espa0"><?php echo $Total; ?></h4></th>
                 </tr>
                 </tbody>
             </table>
         </div>
         <br>

         <p class="TC" style="font-size:0.65em;"><span style="font-size:1.1;color:red;">Atención:</span> El equipo se entrega en optimas condiciones, nuevo en caja, con sus accesorios correspondientes funcionando y probado delante del adquiriente, sin golpes, rayadoras, daños de sus partes y accesorios.
             La presente garantía no cubre daños por mal trato, mal uso, mojado, rotura de alguna de sus partes como: vidrios, LCD, conector de carga, botones, ficha de auricular, parlantes, golpes, rayones, salto de esmalte, pintura o cromo, presión o hundimiento, shock eléctrico.
             Esta garantía es por la reparación del equipo adquirido, siempre y cuando no haya sido violada o adulterada la faja de seguridad con fecha y logo de Conexiones y no haya sido abierto por otro centro técnico ajeno al nuestro, ubicado en Salta 1391, San José (Adrogue) Pudiendo este está facultado a cobrar un costo por su reparación si lo considera inconcuso.
             La vigencia de la garantía es por 30 Días, corridos desde su compra.
             <span style="font-size:1.1;color:red;">
             UNA VEZ REALIZADA SU COMPRA Y HA SIDO ENTREGADO Y RETIRADO DEL ESTABLECIMINETO EL PRODUCTO, NO SE ACEPTARAN CAMBIOS DE MARCA, COLOR, MODELO  O DIFERENTE MERCADERIA.
            </span>
         </p>
  <br><br>
         <div class="col-xs-5"> Firma:____________________</div>
         <div class="col-xs-4">Acl.:</div>
         <div class="col-xs-3 TC">DNI:<?php echo $dni;?></div>
         <br>
         <hr>
         <hr>
         <!-- ********************************************** -->
  <div id="nover">
          <div class="col-xs-6 FLOGO">
              <img src="<?php echo $Logo; ?>" >
              <!-- -->
          </div>
          <div class="col-xs-6 FCABE">
              <h4 class="TD espa0">Fecha: <span id="fecha"><?php echo $Fecha; ?></span></h4>
              <h4 class="TD espa0">Orden de compra  N°:  <span id="num"><?php echo $recibo; ?></span></h4>
              <h3 class="espa0">Cliente:<span id="cli"><?php echo $Cliente; ?></span></h3>
              <h5>Local:<span id="Local"><?php echo $Local; ?> <span> //C: <span id="control"><?php echo $User; ?> <span></h5>
          </div>
          <hr><hr>
          <div class="tablas">
              <div class="col-xs-4"><p style="font-size:0.9em;font-weight: bold;" class="TC">  <?php echo $Lugar; ?> </p></div>
              <div class="col-xs-3"><p style="font-size:0.9em;font-weight: bold;" class="TC">  <?php echo $Tel; ?> </p></div>
              <div class="col-xs-5"><p style="font-size:0.9em;" class="TC"><span style="font-weight: bold; color:#5656e6;">WWW.CONEXIONESMOVILES.COM.AR</span></p></div>
<?php if($estado==2){ echo "<h2 class='Anulado' > ANULADA </h2>";} ?>
              <table class="table" border="0" width="100%;" cellpadding="5" >
                  <thead>
                  <tr>
                      <th style="width: 20px;" >Cant.</th>
                      <th style="width: 100px;">Codigo</th>
                      <th>Articulo</th>
                      <th class="TC" style="width: 170px;">Serial</th>
                      <th  class="TC" style="width: 130px;">Monto</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  echo $Tabla;
                  ?>

                  <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <th colasecell="3" class="TD"  >Total:</th><th><h4 class="espa0"><?php echo $Total; ?></h4></th>
                  </tr>
                  </tbody>
              </table>
          </div>
          <br>

          <p class="TC" style="font-size:0.65em;"><span style="font-size:1.1;color:red;">Atención:</span> El equipo se entrega en optimas condiciones, nuevo en caja, con sus accesorios correspondientes funcionando y probado delante del adquiriente, sin golpes, rayadoras, daños de sus partes y accesorios.
              La presente garantía no cubre daños por mal trato, mal uso, mojado, rotura de alguna de sus partes como: vidrios, LCD, conector de carga, botones, ficha de auricular, parlantes, golpes, rayones, salto de esmalte, pintura o cromo, presión o hundimiento, shock eléctrico.
              Esta garantía es por la reparación del equipo adquirido, siempre y cuando no haya sido violada o adulterada la faja de seguridad con fecha y logo de Conexiones y no haya sido abierto por otro centro técnico ajeno al nuestro, ubicado en Salta 1391, San José (Adrogue) Pudiendo este está facultado a cobrar un costo por su reparación si lo considera inconcuso.
              La vigencia de la garantía es por 30 Días, corridos desde su compra.
              <span style="font-size:1.1;color:red;">
             UNA VEZ REALIZADA SU COMPRA Y HA SIDO ENTREGADO Y RETIRADO DEL ESTABLECIMINETO EL PRODUCTO, NO SE ACEPTARAN CAMBIOS DE MARCA, COLOR, MODELO  O DIFERENTE MERCADERIA.
            </span>
          </p>
          <br>
          <div class="col-xs-5"> Firma:____________________</div>
          <div class="col-xs-4">Acl.:</div>
          <div class="col-xs-3 TC">DNI:<?php echo $dni;?></div>
         <!-- ********************************************  -->
     </div>

 </div>

<script>
    window.onload=window.print();
</script>
</body>

</html>
