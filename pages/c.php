<?php  include 'contenido.php';
    if( $_SESSION['Local1'] !=4){
        header("Location: ../index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
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

</head>
<body>
<?php
    include 'menu.php';
?>
<style>
    #tuser tr:hover {
        background:tomato;
    }
    .M1{
        margin-top:0.5em;
    }
</style>
 <div class="row">
     <p> </p>
    <div class="col-lg-6" ><!--  col6-->
        <table class="table table-striped table-hover" style="margin-left:5px;">
            <thead >
            <tr style="background: gainsboro;" >
                <th>Real</th>
                <th style="width:60px;">Usuario</th>
                <th style="width:20px;">Local</th>
            </tr>
            </thead>
            <tbody id="tuser" style="overflow-y:scroll;">
            <tr id="1" oncilck="t_use(1);">
                <td>juan perez garcia</td>
                <td>juan123</td>
                <td class="TC">1</td>
            </tr>
            </tbody>
        </table>
        <script>
            function t_use(id){

            }
        </script>
    </div><!-- Fin col6-->
    <div class="col-lg-6" style="padding-right: 30px;"><!-- col6-->
        <div class="panel panel-green">
            <div class="panel-heading">
                <label style="font-size:1.3em">Usuario</label>
            </div>
            <div class="panel-body"  >
                <div class="col-xs-12 M1">

                    <div class="form-group input-group" style="margin-bottom: initial;">
                        <span class="input-group-addon"><p style="margin: 0px;"> Nombre:</p></span>
                        <input class="form-control" id="UNombre" autocomplete="off" type="text"  maxlength="25" onkeypress="DeHasta('UNombre','UUser')" >
                    </div>
                </div>
                <div class="col-xs-5 M1 ">
                    <div class="form-group input-group" style="margin-bottom: initial;">
                        <span class="input-group-addon"><p style="margin: 0px;"> User:</p></span>
                        <input class="form-control" id="UUser" autocomplete="off" type="text"  maxlength="10" onkeypress="DeHasta('UUser','ULocal')" >
                    </div>
                </div>
                <div class="col-xs-4 M1">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p style="margin: 0px;">De</p></span>
                        <select name="ULocal" id="ULocal" class="form-control" onkeypress="DeHasta('ULocal','UBTNG')">
                            <option value="1" selected>Adrogue</option>
                            <option value="2">Burzaco</option>
                            <option value="3">Deposito</option>
                            <option value="4">Administrador</option>
                        </select>
                    </div>
                </div>
                    <buton class="btn btn-danger M1" onclick="CCU()"> Cambiar Clave</buton>
                    <p id="UC" class="NV">123</p>
                    <p id="UID"  class="NV">0</p>
            </div>
            <div class="panel-footer " style="height: 5em;">
                <div class="col-xs-4 M1"><button type="button" id="UBTNN" onclick="LimpiaU()" class="btn btn-outline btn-primary btn-lg btn-block">Nuevo</button> </div>
                <div class="col-xs-3 M1"><button type="button" id="UBTNB" onclick="BorraU()" class="btn btn-outline btn-danger btn-lg btn-block">Borrar</button> </div>
                <div class="col-xs-5 M1"><button type="button" id="UBTNG"  onclick="GraU()" class="btn btn-outline btn-success btn-lg btn-block">Grabar</button> </div>
            </div>
    </div><!-- Fin col6-->
 </div> <!-- fin row -->


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
    var tmpUC;
function BorraU(){
        var x= parseInt(document.getElementById("UID").innerHTML) ;
        if(x >0){
            if(confirm(" ATENCION !! Borrar Usuario?")){
                var d = {ID:x,H:5};
                $.post('cgi/Art.php', d, function (res) {
                    LimpiaU();
                    miniu();
                });
            }
        }
}
function LimpiaU(){
    document.getElementById("UID").innerHTML="";
    document.getElementById("UUser").value="";
    document.getElementById("ULocal").value= 1;
    document.getElementById("UNombre").value="";
    document.getElementById("UNombre").select;
}

function CCU(){
    var id=parseInt(document.getElementById("UID").innerHTML);
    if(id>0){
        var Obs= prompt("Ingrese el PASSWORD", "123");
        var d = {ID:id,H:7,Obs:Obs };
        console.log(d);
        $.post('cgi/Art.php', d, function (res) {
            alert("Grabada");
            miniu();
            LimpiaU();
        });
    };
}
function GraU(){
    var id=parseInt(document.getElementById("UID").innerHTML);
    var Cat=document.getElementById("UUser").value ;
    var S1=document.getElementById("ULocal").value;
    var Art=document.getElementById("UNombre").value
    var Obs;
    if(id<1){
        tmpUC=  prompt("Ingrese el PASSWORD", "123");
        Obs=tmpUC;
    };
    var d = {ID:id,H:6,Obs:Obs,Cat:Cat,S1:S1,Art:Art};
    console.log(d);
    $.post('cgi/Art.php', d, function (res) {
        alert("listo");
        miniu();
        LimpiaU();
    });
}

function LimpiaU(){
        document.getElementById("UID").innerHTML="0";
        document.getElementById("UUser").value="";
        document.getElementById("ULocal").value="";
        document.getElementById("UNombre").value= "";
        document.getElementById("UNombre").select();
 }

  $(document).ready(function() {
        miniu();
 });

function vtuse(id){
    var d = {ID:id,H:4};
    $.post('cgi/Art.php', d, function (res) {
        var Datos = res.split("|");
        document.getElementById("UID").innerHTML=Datos[0];
        document.getElementById("UUser").value=Datos[1];
        document.getElementById("ULocal").value= Datos[3];
        document.getElementById("UNombre").value= Datos[4];
        document.getElementById("UNombre").select();
    });
}

function miniu(){$("#tuser").load("cgi/tabla.php?T=6", function(res) {}); }

</script>
</body>
</html>