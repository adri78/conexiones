<?php  include 'contenido.php'; ?>

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
    <!-- ****************************************************************************************************** -->

    <style>
       tbody tr:hover { background: #4db4f6; }

        tr:nth-child(even){
            background: #91eda2;
            color: #000000;
        }
        th:nth-child(3) {
            text-align:center;
        }
       th:nth-child(4) {
           text-align: right;
       }
       th:nth-child(6) {
           text-align: right;
       }
    </style>
    <!-- ****************************************************************************************************** -->
<script>                
/********************************************* */
function pulsar(e) {  
    tecla=(document.all) ? e.keyCode : e.which; 
    if (tecla==112 && e.ctrlKey){ // control + F1
        //alert("listo");
         document.getElementById("btnGrabar").focus();
         
    } //78 = letra n  
} 
/******************************************** */

</script>

    <style>
        #input-group-addon{
            margin-bottom: 10px;
        }
    </style>
</head>
<body onkeydown="return pulsar(event)">
<?php
    include 'menu.php';
?> 
    <div class="row">
        <p></p>
       <div class="col-xs-12">
           <div class="col-xs-3"></div>
           <div class="col-xs-6">
               <div class="form-group input-group">
                   <p class="input-group-addon " ><i class="fa fa-edit" style="margin:0px;"></i></p>
                   <input type="text" class="form-control" placeholder="Serial,Cliente,N° Factura" id="Bus">
               </div>
           </div>
           <div class="col-xs-3"></div>
       </div>
        <div class="col-xs-12" >
               <table width="95%" class="table  table-bordered" id="Garart">
                   <thead class="Titulo"><tr><th class="TD" width="100px">Fecha</th><th>Articulo</th><th width="150px">Serial</th>
                       <th width="150px">N°Factura</th><th>Cliente</th> <th class="TD" width="90px">Monto</th>
                       <th width="10px">L</th></tr>
                   </thead>
                   <tbody id="TGarant">
                        <tr> </tr>
                   </tbody>
               </table>

           </div>

    </div>
    <!-- fin row -->

<!-- Modal_Pedido-->
<div class="modal fade" id="FichaGart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #36d4ce;">
            <div class="modal-header" style="padding:4px 10px 0px 10px">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">  <div class="col-xs-11"><h3 id="Artg"  >Articulo</h3></div></h4>
            </div>
            <div class="modal-body" style="height: 230px;">
                <p  class="NV" id="IdArtg">0</p>
                <div class="col-xs-12">
                    <h4 style="background:white;padding:1px 10px; ">Cliente: <span id="cliente" style="color:blue">Cliente cliente cliente</span></h4>
                </div>
                <div class="col-xs-4 TC">
                    <h4>Fecha: <span id="Fecha" >20/03/1999</span></h4>
                    <h4>N°: <span id="NF" >000001</span></h4>
                    <h4>Local: <span id="Local" >A</span></h4>
                    <h4 style="background:rgb(145, 242, 86);padding:1px 10px; ">Serial: <span id="Serial" >123456789 </span></h4>
                    <h4 style="background:white;padding:1px 10px; ">Valor $: <span id="Monto" style="color:blue">1245.00</span></h4>

                </div>
                <div class="col-xs-8">
                    <div class="form-group">
                        <label for="comment">Observaciones:</label>
                        <textarea class="form-control" rows="5" id="Obs"></textarea>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-success btn-lg" onclick="btnGNC()" >Generar Nota de Credito</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



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
       function btnGNC(){
           $("#FichaGart").modal("hide");
          // d={M:10,ID:id,Local:Local,User:User,Obs:Obs};
         //  $.post("cgi/Grabar.php", d, function(result){  })
       }

       function mostrar(){
           var x=document.getElementById("Bus").value;
           if(x.length >2){
               $("#TGarant").load("cgi/tabla.php?T=7&L="+Local+"&D=" + document.getElementById("Bus").value, function (res) {});
           }
       }

       function DG(id){
           d={M:9,ID:id};
           $.post("cgi/Grabar.php", d, function(result){
               var D = result.split("|");
               document.getElementById("IdArtg").innerHTML=D[0];
               document.getElementById("Artg").innerHTML=D[1];
               document.getElementById("Monto").innerHTML=D[2];
               document.getElementById("Obs").value=D[3];
               document.getElementById("Serial").innerHTML=D[4];
               document.getElementById("Fecha").innerHTML=D[5];
               document.getElementById("cliente").innerHTML=D[6];
               document.getElementById("Local").innerHTML=D[7];
               document.getElementById("NF").innerHTML=D[8];
               $("#FichaGart").modal("show");
           });
       }

 $(document).ready(function() {
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
    </script>
</body>
</html>