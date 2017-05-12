<?php  include 'contenido.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
        .DT{
            padding-right: 25px;
            padding-left: 25px;
            max-height: 40vh;
        }
        input:focus{background: #c6ffba;}
        textarea:focus{background: #c6ffba;}
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
            text-align: center;
        }
        #BT1NC tr td:nth-child(3) {
            text-align: center;
        }
        #BT1NC tr td:nth-child(4) {
            text-align: right;
        }
        #BT1NC tr td:nth-child(5) {
            text-align: right;
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
        <div class="col-lg-12 DT">
            <div class="col-lg-7">
                <div class=" form-group input-group">
                    <span class="input-group-addon">Buscar:</span>
                    <input type="text" class="form-control" placeholder="Buscar" id="Buscar" autocomplete="off" onfocus="CargaClientes()">
                </div>
            </div>
            <div class="col-lg-4">
                <buton class="btn btn-success"  id="NuCli" onclick="SNuCli()">Nuevo</buton>
                <label><input type="checkbox" name="ante" id="ILiq" onclick="CargaClientes();" >Incluir liquidados</label>
            </div>

            <table width="98%" class="table table-bordered sortable" id="T1NC">
                <thead class="Titulo">
                    <tr>
                        <th>Cliente</th><th width="140px">DNI</th><th width="140px">Telefono</th><th width="90px">Monto</th><th width="90px">Cuenta</th><th width="25px">L</th>
                        <th width="110px">UM</th><th width="100px">MENU</th>
                    </tr>
                </thead>
                <tbody id="BT1NC"> </tbody>
            </table>
        </div>
        <hr><br><hr>
        <div class="col-lg-12 DT">
            <label id="IdCli" class="NV">0</label>
            <label id="verCli" style="color:darkblue;font-size: 2.5em;"></label>
            <buton class="btn btn-danger" style="margin:5px 50px" id="NuPago" onclick="btnNP()">Nuevo Pago</buton>
            <buton class="btn btn-info" style="margin:5px 10px" id="detaP" onclick="PRNLIST()">Imprimir Listado</buton>
            <table width="100%" class="table  table-bordered" id="T2NC">
                <thead class="Titulo"><tr><th class="TD" width="90px">N° Recibo</th><th width="110px">Fecha</th><th class="TD" width="90px">Monto</th><th>Nota</th></tr></thead>
                <tbody id="BT2NC"></tbody>
            </table>
        </div>

    </div>
    <!-- fin row-->
<div class="modal fade" id="fNucli" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Alta de Cliente</h4><label id="ID" class="NV">0</label>
            </div>
            <div class="modal-body" style="heigth:160px;" >
                <div class="col-sm-8">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Cliente:</p></span>
                        <input type="text" class="form-control" id="FCliente"  onkeypress="DeHasta('FCliente','FDni')">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">DNI:</p></span>
                        <input type="text" class="form-control" id="FDni"  onkeypress="DeHasta('FDni','FEmail')">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Email:</p></span>
                        <input type="text" class="form-control" id="FEmail"  onkeypress="DeHasta('FEmail','FTel')">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Tel:</p></span>
                        <input type="text" class="form-control" id="FTel"  onkeypress="DeHasta('FTel','Nota')">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Nota:</p></span>
                        <textarea rows="4" cols="50" class="form-control" id="Nota"  onkeypress="DeHasta('Nota','Estimado')"></textarea>

                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Estimado:</p></span>
                        <input type="text" class="form-control TD" id="Estimado"  onkeypress="DeHasta('Estimado','btngracli')">
                </div>
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

</div>
<!-- /.modal  alta clientes-->

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
                        <input type="text" class="form-control TC" id="MontoNP"  onkeypress="DeHasta('MontoNP','Nota2')">
                    </div>
                </dic>
                <dic class="col-sm-12">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Nota:</p></span>
                        <textarea class="form-control" rows="4" id="Nota2" onkeypress="DeHasta('Nota2','btnPago')"></textarea>
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
    <script src="../dist/js/sb-admin-2.js?1"></script>

<script>
    function btngracli(){
           var cliente,dni,tel,email,d,nota,estimado,id;
           cliente=document.getElementById("FCliente").value.toUpperCase().trim();
           dni=document.getElementById("FDni").value.trim();
           id=document.getElementById("ID").innerHTML;
           tel=document.getElementById("FTel").value.trim();
           email=document.getElementById("FEmail").value.trim();
           nota=document.getElementById("Nota").value.trim();
           estimado=document.getElementById('Estimado').value.trim();
           if(cliente.length >3){
               d={M:10,Num:dni,Serial:tel,ID:id,Precio:estimado,Total:Local,Cliente:cliente,Obs:nota,Email:email,Local:Local};
              console.log(d);
                $.post("cgi/Grabar.php", d, function(result){
                    console.log(result);
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
        nota=document.getElementById("Nota2").value;
        d={M:11,ID:idCli, Total:monto, Obs:nota,Local:Local,Control:AMSJ};
        $.post("cgi/Grabar.php", d, function(result){
            $("#fNuPago").modal("hide");
            alert("Pago generado");
            CargaClientes();
            TADE(idCli,2);

            V(result);
        });
    }

    function TADE (id, es){
          document.getElementById("IdCli").innerHTML= id;
        $("#BT2NC").load("cgi/tabla.php?T=9&D="+id, function (res) {
            $("#verCli").load("cgi/tabla.php?T=88&D="+id, function (res){});
            if(es==1){
                document.getElementById("NuPago").style.visibility = "visible";
                document.getElementById("detaP").style.visibility = "visible";
                document.getElementById("verCli").style.visibility = "visible";

            }else{
                document.getElementById("NuPago").style.visibility = "hidden";
                document.getElementById("detaP").style.visibility = "hidden";
                document.getElementById("verCli").style.visibility = "hidden";
            }
        });

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
        console.log("llego ese" + id);
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