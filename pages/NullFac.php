<?php  include 'contenido.php'; ?>

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
<style>
    body{
        background:#ffbf80 ;
    }
    tbody{background: white;}
    tbody tr:hover{background:aqua;}

    tbody td:nth-child(1) { text-align: center;}
    tbody td:nth-child(2) { text-align: center;}
    /*/td:nth-child(3) { text-align: right; }*/
    tbody th:nth-child(4) { text-align: center;}
    tbody th:nth-child(5) { text-align: center; }
    tbody th:nth-child(6) { text-align: right;}

</style>
</head>
<body>
<?php
    include 'menu.php';
?> 
    <div class="row">
        <div class="col-lg-3 TC"><h4>Anulación de Facturas</h4> </div>
        <div class="col-lg-5">
            <div class="form-group input-group">
                <p class="input-group-addon " ><i class="fa fa-edit" style="margin:0px;"></i></p>
                <input type="text" class="form-control" placeholder="Cliente o N° Recibo" id="Bus">
            </div>
        </div>
        <div class="col-lg-10">
            <table class="table" id="Ttmp" style=" margin: 1.5em 3em 1em 5em;">
                <thead  class="Titulo" style=" background: black; color:snow;">
                <tr><th class="TC">Fecha</th><th class="TC">Numero</th><th>Cliente</th><th>Monto</th><th class="TC">Estado</th><th>Menu</th></tr></thead>
                <tbody id="Tabla"></tbody>
            </table>
        </div>
    </div>
    <!-- fin row -->

<?php include 'cgi/Pedir.php'; ?>


    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../js/comun.js"></script>
    <script src="../dist/js/sb-admin-2.js?1"></script>
<script>
    function ver(){
        $("tbody tr").dblclick(function() {
            var x = $(this).data('id');
            if(confirm("Re imprimir Recibo")){
                var url="recibo.php?I="+x  ;
                window.open(url, '', 'width=830,height=652,scrollbars=NO,statusbar=NO,left=200,top=100');
            }
        });
    }
 function V(id) {
     var url="recibo.php?I="+id  ;
     window.open(url, '', 'width=830,height=652,statusbar=NO');
 }
function A(id){
     if(confirm("Anular Factura y devolver mercaderia a Stock?")){
         var d={M:1000,Local:Local,ID:id };
         console.log(d);
         $.post("cgi/Grabar.php",d,function (r){
             //alert(r);
             console.log(r);
             mostrar();
         });
     }

}// fin anulacion
    function mostrar(){
        $("#Tabla").load("cgi/tabla.php?T=1000&L="+Local+"&D=" + document.getElementById("Bus").value, function (res) { });
    }
    $(document).ready(function() {
        ver();
        $("input[type=text]").focus(function(){
            this.select();
        });
        $("#Bus").keydown(function(e){
            if (e.keyCode==13){
                e.preventDefault();
                mostrar();
                return false;
            }
        });
    });
function refrescar() {

}
</script>

</body>
</html>