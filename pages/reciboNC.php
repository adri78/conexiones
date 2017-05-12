<?php
//error_reporting(0);

include 'cgi/config2.inc';
    mysqli_set_charset($conexion,"utf8");

    if(isset($_GET["N"])){ $N=$_GET["N"];}
    if(isset($_GET["I"])){ $I=$_GET["I"];}else{$I=0;}

    if(isset($_GET["L"])){ $Local=$_GET["L"]; }

$Tabla="";
$Total=0;
$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);

$sql="SELECT `idnc`, `cliid`, `opid`, `nnc`, `fecha`, `monto`, `estado`, `Nota`, `Local` FROM `t_nc` WHERE `cliid`=".$I." ;";

$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
// print $sql;
$segmento = mysqli_query($conexion,$sql);
while ($row = mysqli_fetch_array($segmento)) {
    $Total=$Total+$row["monto"];
    $Monto=$formatter->formatCurrency( $row["monto"], 'USD'); //, PHP_EOL;
    $fecha= substr ($row["fecha"],0,10) ;
    $Tabla =$Tabla .'<tr><th>'.str_pad($row["nnc"], 6, "0", STR_PAD_LEFT).'</th><th>'.$fecha.'</th><th class="TD">'.$Monto.'</th><th>'.$row["Nota"].'</th></tr>';

}

$Total=$formatter->formatCurrency( $Total, 'USD');

$sql="SELECT  `Cliente`, `Estado`, `Local` FROM `t_cliente` where `idcli`='".$I."';";


$segmento = mysqli_query($conexion,$sql);
while ($row = mysqli_fetch_array($segmento)) {
    $Local=$row["Local"];
    $Estado=$row["Estado"];
    $Cliente=$row["Cliente"];
}

if($Estado=1){ $Estado="ACTIVA" ;}else {$Estado="Liquidada" ; }

$Logo="Logo.jpg"."?v=1";
    $sql="SELECT `Pie` FROM `varios` WHERE `idVarios`='1';";
    $segmento = mysqli_query($conexion,$sql);
    $row = mysqli_fetch_array($segmento);

    $Mensaje=$row['Pie'];

$recibo="000001";

if($Local==1) {
    $Local = "Adrogue";
}
if($Local==2) {
    $Local = "Burzaco";
}
if($Local==3) {
    $Local = "Deposito";
}
 mysqli_close($conexion);
?>


<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Señas</title>
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
       .FLOGO{

       }
       .FLOGO img {
           position: absolute;
           vertical-align: middle;
           width: 100%;
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

     thead tr{
         border:1px solid darkgray;
     }
    .tablas{
        height:80mm;
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


    </style>
</head>
<?php
 if(isset($_GET["V"])){ echo "<body>"; }else{ echo '<body  onmouseover="window.close();" onclick="window.close();">';}
?>

<div class="container-fluid">
     <div class="row">
          <div class="col-xs-6 FLOGO">
              <img src="<?php echo $Logo; ?>" >
          </div>
         <div class="col-xs-6 FCABE">
             <h4 class="TD espa0">Fecha: <span id="fecha"><?php echo date("d") . "/" . date("m") . "/" . date("Y"); ?></span></h4>
             <h4> Cliente:</h4>
             <h3 class="TC espa0"> <?php echo  strtoupper($Cliente); ?></span></h3>
             <h5>Local:<span id="Local"><?php echo $Local; ?> <span> //Estado de la cuenta: <span id="control"><?php echo $Estado ; ?> <span></h5>
         </div>
         <hr><hr>
         <div class="tablas">
             <table width="100%" class="table table-bordered"  >
                 <thead class="Titulo"><tr><th class="TD" width="90px">N° Recibo</th><th width="100px">Fecha</th><th class="TD" width="90px">Monto</th><th>Nota</th></tr></thead>
                 <tbody>
                    <?php echo $Tabla; ?>
                 </tbody>
             </table>

             <hr>
          <h2 class="TD">Total: <span id="TT"><?php echo $Total; ?> </span></h2>


         </div>
         <br><p id="NTEXTO"></p>
         <hr>
         <p><?php echo $Mensaje; ?></p>

         <hr>
     </div>

 </div>
<script src="cgi/NumaText.js?1"></script>
<script>
  function hacer(){
       document.getElementById("NTEXTO").innerHTML=" Total: "+ MaysPrimera(NumaText("<?php echo $Total; ?>")) ;
      window.print();
  }

    window.onload=hacer();
</script>
</>

</html>
