<?php  include 'contenido.php'; ?>
<?php $HOY=date("d") . "/" . date("m") . "/" . date("Y"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Control de Stock // <?php echo $_SESSION['real']; ?></title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/jquery/jquery-ui.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css?2" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- ****************************************************************************************************** -->
    <!-- ****************************************************************************************************** -->
    <style>
        table.sortable thead {
            background-color:#eee;
            color:#666666;
            font-weight: bold;
            cursor: default;
        }
        #L1 thead,#L3 thead,#L101 thead,#L102 thead { background:Black;color:white; }
        #L1 td:nth-child(1) { text-align: center; width:60px;}
        #L1 td:nth-child(3) { text-align: right; width:30px;}
        #L1 td:nth-child(4) { text-align: right; width:30px;}
        #L1 td:nth-child(5) { text-align: right; width:30px;}
        #L1 td:nth-child(6) { text-align: center; width:90px;}
        #L1 td:nth-child(7) { text-align: right; width:30px;}
        #L1 td:nth-child(8) { text-align: right; width:30px;}
        #L1 td:nth-child(9) { text-align: right; width:30px;}
        #L3 td:nth-child(1) { text-align: center;  }
        #L3 td:nth-child(3) { text-align: center;  }
        #L3 td:nth-child(4) { text-align: right;  }
        #L3 td:nth-child(5) { text-align: center; }
        #L2 td:nth-child(1) { text-align: right;  }
        #L2 td:nth-child(3) { text-align: right;  }
        #L2 td:nth-child(4) { text-align: center;  }
        #L2 td:nth-child(5) { text-align: right; }
        #L101 td:nth-child(3) { text-align: right;  }
        #L101 td:nth-child(4) { text-align: right;  }
        #L101 td:nth-child(5) { text-align: center; }
        #L102 td:nth-child(4),#L102 td:nth-child(5),#L102 td:nth-child(8) { text-align: right;  }

    </style>


</head>
<body>
<?php
    include 'menu.php';
?> 
    <div class="row">

        <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Listados
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-9">
                            <h4><Select id="Listados">
                                    <option value="1">Stock General</option>
                                    <option value="2">Stock Costos</option>
                                    <option value="3">Stock Local Adrogue</option>
                                    <option value="4">Stock Local Burzaco</option>
                                    <option value="5">Stock Local Deposito</option>
                                    <option value="6">Clientes</option>
                                </Select>
                            </h4>
                        </div>
                        <div class="col-xs-3"><h4>
                            <input type="checkbox" value="" >UM</h4>
                        </div>
                    </div>
                    <div class="panel-footer" style="padding: 5px;margin: 0px;">
                     <p>  <button type="button" class="btn btn-primary btn-lg" onclick="GeneraListado()"> Generar </button>
                          <button type="button" class="btn btn-warning btn-lg" onclick="PrintListado()"><i class="fa fa-print"></i></button>
                     </p>
                    </div>
                </div>
        </div>
        <div class="col-lg-7" >
            <div class="panel panel-info">
                <div class="panel-heading">
                    Informes
                </div>
                <div class="panel-body">
                    <div class="col-lg-3">
                        <label for="Fecha1">Desde:</label>
                        <input type="text" id="Fecha1" size="30" class="form-control TC" value="<?php echo $HOY; ?>" >
                    </div>
                    <div class="col-lg-3">
                        <label for="Fecha2">Hasta:</label>
                        <input type="text" id="Fecha2" size="30" class="form-control TC" value="<?php echo $HOY; ?>" >
                    </div>
                    <div class="col-lg-6"><br>
                        <h4> <select name="INFOCMB" id="INFOCMB">
                                <option value="1">Ventas Totales</option>
                                <option value="2">Ventas Adrogue</option>
                                <option value="3">Ventas Burzaco</option>
                                <option value="4">Ventas Deposito</option>
                                <option value="5">Compras Totales</option>
                                <option value="6">Cambios Totales</option>
                                <option value="7">Mov. Articulo</option>
                                <option value="8">Mejores</option>

                            </select>
                        </h4>
                    </div>
                    <br>
                </div>
                <div class="panel-footer" style="margin: 0px;padding: 0px;">
                    <p style="margin: 1px;"> <button type="button" class="btn btn-danger btn-lg" id="Informes" onclick="Informes()"> Ver </button>
                        <button type="button" id="PrintInfo2" class="btn btn-warning btn-lg" onclick="PrintInfo2()"><i class="fa fa-print"></i></button>
                    </p>
                </div>
            </div>
        </div><!-- Fin col de la tabla -->
        <hr>
<!-- **************************************************************************************************** -->
<div class="col-xs-12" id="Listado" style="background:white;padding: 10px 4em 4em 4em;">

</div>

    </div>
    <!-- fin row -->

<?php include 'cgi/Pedir.php'; ?>

    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/jquery/jquery-ui.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../js/comun.js"></script>
    <script type="text/javascript"  src="../js/sorttable.js"></script>
    <script src="../dist/js/sb-admin-2.js?1"></script>
<script>

    function GeneraListado(){
        var x= parseInt(10) + parseInt(document.getElementById("Listados").value);
        $("#Listado").load("cgi/tabla.php?T="+(x) , function (res) { });
    }
    function PrintListado() {
        var x=document.getElementById("Listados").value;
        var url="Info.php?N="+x  ;
        window.open(url, '', 'width=830,height=652,scrollbars=NO,statusbar=NO,left=200,top=100');
    }
</script>
<script>
    $( function() {
        $( "#Fecha1" ).datepicker();
        $( "#Fecha2" ).datepicker();
    } )
    function Informes() {
        var f1 = document.getElementById("Fecha1").value;
        var f2 = document.getElementById("Fecha2").value;
        var Info= document.getElementById("INFOCMB").value;
        var Fe1= f1.slice(6, 10)+"-"+ f1.slice(3, 5) +"-"+f1.slice(0, 2) ;
        var Fe2= f2.slice(6, 10)+"-"+ f2.slice(3, 5) +"-"+f2.slice(0, 2) ;
        console.log(Fe1 +"#"+Fe2+"XX"+Info);
        var x= '10'+ parseInt(document.getElementById("INFOCMB").value);
        $("#Listado").load("cgi/tabla.php?T="+(x)+"&desde="+Fe1+"&hasta="+ Fe2, function (res) { });
 /*
  SELECT `Fecha`, `Cliente`, `DNI`, `Email`, `Total`, `Control`, `Local`, `Num` FROM `t_venta` WHERE ((`Fecha` >= '2017-03-08 00:00:00') AND (`Fecha` <='2017-03-25 23:59:59')) ORDER BY `Fecha`,`Local`,`Num`;
  */


    }
   function PrintInfo2(){
       var x=document.getElementById("INFOCMB").value;
       var f1 = document.getElementById("Fecha1").value;
       var f2 = document.getElementById("Fecha2").value;

       var Fec1= f1.slice(6, 10)+"-"+ f1.slice(3, 5) +"-"+f1.slice(0, 2) ;
       var Fec2= f2.slice(6, 10)+"-"+ f2.slice(3, 5) +"-"+f2.slice(0, 2) ;

       var url="Info.php?N=0"+x+"&desde="+Fec1+"&hasta="+ Fec2 ;//el uno ya esta
       window.open(url, '', 'width=830,height=652,scrollbars=NO,statusbar=NO,left=200,top=100');
   }

</script>
</body>
</html>