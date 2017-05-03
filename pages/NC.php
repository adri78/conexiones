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
    <!-- ****************************************************************************************************** -->
    <style>
        tbody tr:nth-child(2) {
            text-aling:center;
        }

        tbody tr:nth-child(even) {
            background-color: #d9e8ee;
        }

        tbody tr:nth-child(odd) {
            background-color: #fff;
        }
        #BT1NC tr{ background:rgb(200,200,145) ; }

        #BT1NC tr td:nth-child(2) {
            text-align: right;
        }
        #BT1NC tr td:nth-child(3) {
            text-align: right;
        }
        #BT1NC tr td:nth-child(4) {
            text-align: center;
        }
        #BT1NC tr:hover{
            background: aqua;
        }
        tbody tr:hover{
            background: aqua;
        }
    </style>



</head>
<body>
<?php
    include 'menu.php';
?>


    <div class="row">
        <div class="col-sm-6" style="padding:0px 0px 0px 20px;">
            <div class="col-lg-6">
                <div class=" form-group input-group">
                    <span class="input-group-addon">Buscar:</span>
                    <input type="text" class="form-control" placeholder="Buscar" id="Buscar" autocomplete="off" >
                </div>
            </div>
            <div class="col-lg-5">
                <buton class="btn btn-success"  id="NuCli" onclick="SNuCli()">Nuevo</buton>
                <label><input type="checkbox" name="ante" id="ILiq" onclick="CargaClientes();" >Incluir liquidados</label>
            </div>

            <table width="100%" class="table table-bordered sortable" id="T1NC">
                <thead class="Titulo">
                    <tr>
                        <th width="260px">Cliente</th><th width="140px">DNI</th><th width="90px">Monto</th><th width="25px">L</th>
                        <th width="110px">UM</th><th class="TD" width="60px">MENU</th>
                    </tr>
                </thead>
                <tbody id="BT1NC"> </tbody>
            </table>
        </div>
        <div class="col-sm-6" style="padding-right:0px;">
            <label id="IdCli" class="NV">0</label>
            <label id="verCli" ></label>
            <buton class="btn btn-danger" style="margin:5px 50px" id="NuPago" onclick="btnNP()" >Nuevo Pago</buton>
            <buton class="btn btn-info" style="margin:5px 10px" id="detaP" onclick="PRNLIST()" >IMPRIMIR</buton>
            <table width="100%" class="table  table-bordered" id="T2NC">
                <thead class="Titulo"><tr><th class="TD" width="90px">N° Recibo</th><th width="110px">Fecha</th><th class="TD" width="90px">Monto</th><th>Nota</th></tr></thead>
                <tbody id="BT2NC">

                </tbody>
            </table>
        </div>

    </div>
    <!-- fin row -->
<div class="modal fade" id="fNucli" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Alta de Cliente</h4>
            </div>
            <div class="modal-body" style="heigth:160px;" >
                <dic class="col-sm-8">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Cliente:</p></span>
                        <input type="text" class="form-control" id="FCliente"  onkeypress="DeHasta('FCliente','FDni')">
                    </div>
                </dic>
                <dic class="col-sm-4">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">DNI:</p></span>
                        <input type="text" class="form-control" id="FDni"  onkeypress="DeHasta('FDni','FEmail')">
                    </div>
                </dic>
                <dic class="col-sm-7">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Email:</p></span>
                        <input type="text" class="form-control" id="FEmail"  onkeypress="DeHasta('FEmail','FTel')">
                    </div>
                </dic>
                <dic class="col-sm-5">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Tel:</p></span>
                        <input type="text" class="form-control" id="FTel"  onkeypress="DeHasta('FTel','btngracli')">
                    </div>
                </dic>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-success" id="btngracli" onclick="btngracli()">Grabar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal  alta clientes -->

<div class="modal fade" id="fNuPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Nuevo pago</h4>
            </div>
            <div class="modal-body">
                <dic class="col-sm-8">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Pago $:</p></span>
                        <input type="text" class="form-control TC" id="MontoNP"  onkeypress="DeHasta('MontoNP','Nota')">
                    </div>
                </dic>
                <dic class="col-sm-12">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Nota:</p></span>
                        <textarea class="form-control" rows="4" id="Nota" onkeypress="DeHasta('Nota','btnPago')"></textarea>
                    </div>
                </dic>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-success" id="btnPago" onclick="bGPagos()">Grabar</button>
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
    <script src="../js/sorttable.js"></script>
    <!-- DataTables JavaScript
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js?1"></script>

<script>
    function btngracli(){
           var cliente,dni,tel,email,d;
           cliente=document.getElementById("FCliente").value.toUpperCase();
           dni=document.getElementById("FDni").value;
           tel=document.getElementById("FTel").value;
           email=document.getElementById("FEmail").value;
           if(cliente.length >3){
               d={M:10,ID:dni,Fecha:tel,Precio:email,Total:Local,Serial:cliente};
                $.post("cgi/Grabar.php", d, function(result){
                    document.getElementById("IdCli").innerHTML= result;
                    $("#fNucli").modal("hide");
                    alert("Grabado");
                    btnNP();
                    //CargaClientes();
               });
           }else{
               alert("Demaciado Corto");
               document.getElementById("FCliente").focus;
           }
       }
    function SNuCli(){
         document.getElementById("FCliente").value="";
         document.getElementById("FDni").value="";
         document.getElementById("FTel").value="";
         document.getElementById("FEmail").value="";
         $("#fNucli").modal("show");
        document.getElementById("FCliente").focus;
    }
    function btnNP(){
        $("#fNuPago").modal("show");
           document.getElementById("MontoNP").value="";
           document.getElementById("Nota").value="";
           document.getElementById("MontoNP").focus;
       }
    function bGPagos(){
        var d, monto, nota;
      var idCli= document.getElementById("IdCli").innerHTML;
        monto=parseFloat(document.getElementById("MontoNP").value);
        nota=document.getElementById("Nota").value;
        d={M:11,ID:idCli, Precio:monto, Serial:nota,Local:Local};
        $.post("cgi/Grabar.php", d, function(result){
            $("#fNuPago").modal("hide");
            alert("Pago generado");
            TADE(idCli,2);
            V(result);
        });
    }

    function TADE (id, es){
          document.getElementById("IdCli").innerHTML= id;
        $("#BT2NC").load("cgi/tabla.php?T=9&D="+id, function (res) {
            if(es==1){
                document.getElementById("NuPago").style.visibility = "visible";
                document.getElementById("detaP").style.visibility = "visible";
            }else{
                document.getElementById("NuPago").style.visibility = "hidden";
                document.getElementById("detaP").style.visibility = "hidden";
            }
        });
        //
    }
    function CargaClientes(){
        var ver=document.getElementById("ILiq").checked ;
        $("#BT1NC").load("cgi/tabla.php?T=8&L="+ Local+"&D="+ver, function (res) {});
    }

    $(document).ready(function() {
        document.getElementById("NuPago").style.visibility = "hidden";
        document.getElementById("detaP").style.visibility = "hidden";
        CargaClientes();

    });

    function Liq(id){
        if(confirm("Liquidar cuenta?")){
            alert("Cuenta Liquidada");
            CargaClientes();
        }
    }
    function PRNLIST(){
        var url="reciboNC.php?I="+document.getElementById("IdCli").innerHTML ;
        window.open(url, '', 'width=830,height=652,scrollbars=NO,statusbar=NO,left=200,top=100');
    }
    function V(id){
        var url="reciboNC2.php?I="+id ;
        window.open(url, '', 'width=830,height=652,scrollbars=NO,statusbar=NO,left=200,top=100');
    }
</script>
<script>

    jQuery.extend(jQuery.expr[":"],
        {
            "contiene-palabra": function (elem, i, match, array) {
                return (elem.textContent || elem.innerText || jQuery(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });

    $("#Buscar").keyup(function () {/* ******************    Motor del Buscador      ******************************************** */
        if (jQuery(this).val() != "") {
            jQuery("#T1NC tbody>tr").hide();
            jQuery("#T1NC td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
        }
        else {
            jQuery("#T1NC tbody>tr").show();
        }
    });

</script>
</body>
</html>