<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 24/3/2017
 * Time: 14:31
 */
$mas="";
 $Titulo="";

  if(isset($_GET["N"])){ $N=$_GET["N"];}
  if(isset($_GET["V"])){ $Ver="";}else{ $Ver= 'onmouseover="window.close();" onclick="window.close();"' ;}
  if(isset($_GET["desde"])){ $Desde=$_GET["desde"] ; }
  if(isset($_GET["hasta"])){ $Hasta=$_GET["hasta"] ; $mas="&desde=".$Desde."&hasta=".$Hasta;}


  if($N==1){ $Titulo="Listado General";}
  if($N==2){ $Titulo="Listado Valuación a Costo";}
  if($N==3){ $Titulo="Informe Adrogue";}
  if($N==4){ $Titulo="Informe Burzaco";}
  if($N==5){ $Titulo="Informe Deposito";}
  if($N==6){ $Titulo="Listado Clientes";}

    if($N=='I1'){ $Titulo="Informe de Ventas  <br>".$_GET["desde"]." - ".$_GET["hasta"] ;}
    if($N=='I2'){ $Titulo="Informe de Ventas Adrogue <br>".$_GET["desde"]." - ".$_GET["hasta"] ;}
    if($N=='I3'){ $Titulo="Informe de Ventas Burzaco <br>".$_GET["desde"]." - ".$_GET["hasta"] ;}
    if($N=='I4'){ $Titulo="Informe de Ventas Deposito <br>".$_GET["desde"]." - ".$_GET["hasta"] ;}
    if($N=='I5'){ $Titulo="Informe de Compras <br> ".$_GET["desde"]." - ".$_GET["hasta"] ;}
    if($N=='I6'){ $Titulo=" Mejores <br> ".$_GET["desde"]." - ".$_GET["hasta"] ;}

/*$N=1;*/
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="print">

    <title>INFOME</title>
    <style>
        .TD{ text-align:right;}
        .TC{ text-align:center; }
        body{
            -webkit-print-color-adjust:exact;
        }

        hr.style2 {
            border-top: 3px double #8c8b8b;
        }
        @page {size 297mm 210mm;} ;
        <?php
            if ($N==1){
                  echo '@page {size 297mm 210mm;}';
                  echo ' #L1 td:nth-child(1) { text-align: center; width:60px;}';
                  echo ' #L1 td:nth-child(3) { text-align: right; width:30px;}';
                  echo ' #L1 td:nth-child(4) { text-align: right; width:30px;}';
                  echo ' #L1 td:nth-child(5) { text-align: right; width:30px;}';
                  echo ' #L1 td:nth-child(6) { text-align: center; width:90px;}';
                  echo ' #L1 td:nth-child(7) { text-align: right; width:30px;}';
                  echo ' #L1 td:nth-child(8) { text-align: right; width:30px;}';
                  echo ' #L1 td:nth-child(9) { text-align: right; width:30px;}';
                  echo ' @media print { writing-mode: tb-rl; height: 80%;margin: 10% 0%;  }';

            }
            if ($N==2){
                  echo ' #L2 td:nth-child(3) { text-align: right; width:30px;}';
                  echo ' #L2 td:nth-child(4) { text-align: right; width:30px;}';
                  echo ' #L2 td:nth-child(5) { text-align: right; width:30px;}';
                  echo ' #L2 td:nth-child(6) { text-align: center; width:90px;}';
            }

        ?>
        #L2 td:nth-child(1) { text-align: right;  }
        #L2 td:nth-child(3) { text-align: right;  }
        #L2 td:nth-child(4) { text-align: center;  }
        #L2 td:nth-child(5) { text-align: right; }
        #L3 thead,#L2 thead,#L1 thead,#L101 thead  { background:Black;color:white; }
        #L3 td:nth-child(1) { text-align: center;  }
        #L3 td:nth-child(3) { text-align: center;  }
        #L3 td:nth-child(4) { text-align: right;  }
        #L3 td:nth-child(5) { text-align: center; }
        #L101 td:nth-child(3) { text-align: right;  }
        #L101 td:nth-child(4) { text-align: right;  }
        #L101 td:nth-child(5) { text-align: center; }
    </style>


<body  <?php echo $Ver ; ?> >
 <h5 class="TD"><?php echo date("d") . "/" . date("m") . "/" . date("Y"); ?> </h5>
 <h2 class="TC"> INFORME - <?php  echo $Titulo ?></h2>
<hr class="style2">

 <div class="col-xs-12" id="Listado" style="background:white;padding: 10px;">
     <script src="../vendor/jquery/jquery.min.js"></script>
<script>

    <?php
       echo 'function A() {  $("#Listado").load("cgi/tabla.php?T=1'.$N.$mas.'", function (res) {  window.print();  });  }';

    ?>

    $( document ).ready(function() {
        A();
    });


</script>
</body>
</html>
