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
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet"> 
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css?2" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- ****************************************************************************************************** -->

</head>
<body>
<?php
    include 'menu.php';
?> 
    <div class="row">

        <div class="col-lg-4" style="margin: 0em 0em 0em 1.5em;">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Imprimir
                </div>
                <div class="panel-body" style="background:rgba(155, 158, 160, 0.46); color:while;">
                    <div class="row">
                        <img src="Logo.jpg" alt="Logo" style="width:100%; height: 200px;" id="Logo" style="border: 2px solid red;">
                        <div class="form-group">
                            <label>Nuevo Logo</label>

                            <form method="post" id="formulario" enctype="multipart/form-data">
                                 <input type="file" name="file"  id="FLogo">
                            </form>

                            <hr>
                            <div class="form-group">
                                <label>Nota al pie</label>
                                <textarea class="form-control" rows="3" id="NPie" maxlength="249"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <button id="idNP" class="btn btn-success btn-block" onclick="GRAPie()">Grabar Pie</button>
                    </div> <!-- fin row -->
                </div>
            </div>
        </div>


    </div><!-- fin row -->


<?php include 'cgi/Pedir.php'; ?>

    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/jquery/jquery-ui.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../js/comun.js"></script>
    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js?1"></script>

<script>
    $(function(){
        LeerPie();
        $("#FLogo").on("change", function(){
             console.log("entro");
            var formData = new FormData($("#formulario")[0]);
            var ruta = "ajax-imagen.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {
                   // $("#resul").html(datos);
                    alert(datos);
                    location.reload();
                }
            });
        });
    });

function LeerPie(){
    var d={M:12 };
    $.post("cgi/Grabar.php", d, function(result){
        $("#NPie").val(result);
    });
}

 function GRAPie(){
        var Datos=document.getElementById("NPie").value;
        var d={M:13,Serial:Datos};
        $.post("cgi/Grabar.php", d, function(result){
            alert("Actulizado");
        });
    }
</script>
</body>
</html>