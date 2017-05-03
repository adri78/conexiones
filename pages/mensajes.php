<?php  include 'contenido.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Historico CHAT</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      ul {padding-top:20px;}
      ul li{ text-decoration: none;padding: 6px; }
      .btn-info:hover{color:brown}
      .MIN{ background: aqua;padding: 10px;border-radius: 8px;margin: 25px 100px 25px 5px;}
      .MOUT{ background: #ffd2ac;padding: 10px;border-radius: 8px;margin: 25px 10px 25px 100px; }
        .MIN h4,MOUT h4{ font-weight: bold; color:#b52b27;}
    </style>
</head>

<body style="background: #c0c4ab;">

<div class="container-fluid">
     <div class="row">
        <div class="col-xs-3">
            <ul class="nav">
                <?php
                include 'cgi/config2.inc';
                mysqli_set_charset($conexion,"utf8");
                if (!mysqli_set_charset($conexion, "utf8")) {
                    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
                }
                $sql="SELECT `idver`, `nreal` FROM `ver` ORDER BY `nreal` ASC;";
                $segmento = mysqli_query($conexion,$sql);
                $Usuaios="";

                while ($row = mysqli_fetch_array($segmento)) {
                   echo '<li><a class="btn btn-info btn-lg btn-block" onclick="ver('.$row['idver'].');">'.$row['nreal'].'</a></li>';
                }
                ?>

            </ul>
        </div>
         <div class="col-xs-8">
             <div id="charla" style="overflow: auto;">

             </div>
         </div>
     </div><!-- Fin row -->

 </div><!-- Fin fluid -->


    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
    <script>
        var AMSJ= <?php echo $_SESSION['AMSJ'] ;?> ;
            function ver(id){
                    var d;
                    d={MODO:30,D:AMSJ,A:id}
                    $("#charla").load("cgi/msj.php",d,function (res){ });
            }
    </script>
</body>

</html>
