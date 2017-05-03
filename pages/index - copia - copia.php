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


</head>
<body onkeydown="return pulsar(event)">
<?php
    include 'menu.php';
?> 
    <div class="row">

        <div class="col-lg-4 cuadro">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Ventas
                    <button class="btn btn-success" style="float: right!important;margin-top: -2px;"  onclick="paPedir2()">Pedir</button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div  class="NV" id="pCargar">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Articulo:</label><label class="NV" id="ArtID"></label>
                                    <h4 class="lblarticulo"> </h4>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Precio:</label>
                                    <select class="form-control" id="cmbPrecio" onkeypress="DeHasta('cmbPrecio','Serial')"  >
                                                <option active> </option> 
                                     </select>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <label>S</label>
                                    <h4 id="lblStock2" >0</h4>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label>Serial:</label>
                                    <input class="form-control" id="Serial" onkeypress="DeHasta('Serial','txtObs')">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-outline btn-primary btn-lg" style="margin-top: 15px;" id="btnAgregar" >Agregar</button>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="Observaciones" id="txtObs" onkeypress="DeHasta('txtObs','btnAgregar')"></textarea>
                                </div>
                            </div>
                    </div> <!-- Fin pCargar -->
                            <!-- tabla temporal -->
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped  minitabla" id="Ttmp">
                                        <thead  class="Titulo" style=" background: black; color:snow;">
                                            <tr><th>Articulo</th><th>Precio</th><th>Serial</th><th>Obs.</th></tr></thead>
                                        <tbody id="tmp"></tbody>                                       
                                    </table>
                                </div>
                                <!-- fin tabla temporal -->
                                <div class="row">
                                    <div class="col-lg-1"><h4 id="son">0</h4></div>
                                    <div class="col-lg-7"></div>
                                    <div class="col-lg-4"><h4 class="TD" id="Total">0.00 &nbsp;</h4></div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                    <form1 role="form1">
                        <div class="col-lg-8">
                          <div class="form-group input-group">
                               <span class="input-group-addon"><p class="fa fa-user" style="margin: 0px;"></p></span>
                               <input type="text" class="form-control" placeholder="Cliente" id="Cliente">
                          </div>
                          <div class="form-group input-group">
                               <span class="input-group-addon">@</span>
                               <input type="text" class="form-control" placeholder="Email" id="Email">
                         </div>
                         <div class="form-group input-group has-error">
                               <span class="input-group-addon"><p class="glyphicon glyphicon-ok" style="margin: 0px;"></p></span>
                               <input type="text" class="form-control" placeholder="Controlado por" id="Control">
                         </div>
                        </div>
                        <div class="col-lg-4 formu">
                                 <input type="text" class="form-control" placeholder="DNI" maxlength="9" id="DNI"> <p></p>
                                 <button class="btn btn-outline btn-info btn-lg" id="btnGrabar" >GRABAR</button>
                                 <p></p>
                                 <input type="checkbox" checked name="chkprn" id="chkprn"><label for="chkprn" > &nbsp; IMPRIMIR</label>
                        </div>                       
                    </form1>
                    </div> <!-- fin row -->
                </div>
            </div>
        </div>
        <div class="col-lg-8" >
            <h5></h5>
             <div id="ListaArt">
                <table width="100%" class="table  table-bordered" id="LART">
                    <thead class="Titulo"><tr><th width="100px">Codigo</th><th>Articulo</th>
                           <th  width="150px">Categoria</th> <th class="TD"  width="70px">Precio</th>
                         <th class="TD"  width="50px">Stock</th></tr>
                        </thead><tbody> </tbody></table> 
            </div> <!-- Fin ListaArt -->
        </div><!-- Fin col de la tabla -->


    </div>
    <!-- fin row -->

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

 function CA(id){
       document.getElementById("pCargar").style.display = "block";
        var d = {ID:id,H:1}; 
         $.post('cgi/Art.php', d, function (res) {
              var Datos = res.split("|");  
            $("#ArtID").text(Datos[0]);
            $(".lblarticulo").text(Datos[1]);
            $("#txtObs").val(Datos[3]);
            if (Local==1){ $("#lblStock2").text(Datos[8]);}
            if (Local==2){ $("#lblStock2").text(Datos[9]);}
            if (Local==3){ $("#lblStock2").text(Datos[10]);}   
            $("#cmbPrecio").empty();
        var fijo="DeHasta('cmbPrecio','Serial')" ;
            $("#cmbPrecio").append('<option value= "'+Datos[5]+'"  onkeypress="'+ fijo +'">'+Datos[5]+'</option>');
            $("#cmbPrecio").append("<option value=\""+Datos[6]+"\">"+Datos[6]+"</option>");
            $("#cmbPrecio").append("<option value=\""+Datos[7]+"\">"+Datos[7]+"</option>");
            $("#cmbPrecio").focus();
         });
    }
function Limpiar1(){
     $("#ArtID").text("");
     $(".lblarticulo").text("");
     $("#txtObs").val("");
     $("#lblStock2").text(""); 
     $("#cmbPrecio").empty(); 
     $("#Serial").val("");
     $("#Serial").focus();
 }
function Limpiar2(){
       document.getElementById("Cliente").value="";
       document.getElementById("DNI").value="";
       document.getElementById("Email").value="";
       document.getElementById("Control").value="";
       document.getElementById("Total").innerHTML="0.00 ";
       document.getElementById("son").innerHTML="0"; 
      $("#tmp tr").remove(); // vacia tabla
  }
function refrescar() {
          CargaArt();
          mPedir();
   }
function CargaArt(){
           var d={};
           $.post('cgi/version.php?V=1', d, function (res) {
               if (res > verMovil) {
                   verMovil = res;
                   $("#ListaArt").load("cgi/tabla.php?T=1&L=1", function (res) {
                       $('#LART').DataTable();
                   });
               }// Fin IF
           });//
       }// Fin */

function Dart(a1,a2,a3) {
     $("#txtObs").val(a3);   
     $("#Serial").val(a2);
     $("#cmbPrecio").append('<option value= "'+a1+'" selected>'+a1+'</option>');
}     
function RR2(id){
    var IDS="#"+ id +""; 
    var IDART = $(IDS).attr("data-id");
       CA(IDART);
    var a1=$(IDS).find("td").eq(1).html();
    var a2=$(IDS).find("td").eq(2).html();
    var a3=$(IDS).find("td").eq(3).html();  
     $(IDS).closest('tr').remove(); 
      calcular();
     setTimeout(function(){ Dart(a1,a2,a3); }, 600);  
}
function Temporal(){ 
     var nuevaFila=""; 
     var Tempo2 = "I" + (Math.floor(+new Date()/1000));
     var RR="RR2('"+Tempo2 +"')"; 
       nuevaFila+='<tr data-id="'+ $("#ArtID").text() + '" ondblclick="'+RR+'"  id="'+ Tempo2 +'"> <td>'+$(".lblarticulo").text()+'</td><td class="TD">'+ $("#cmbPrecio").val() +'</td>';
       nuevaFila+='<td class="TD">'+ $("#Serial").val()+'</td><td>'+$("#txtObs").val()+'</td>' ;
       nuevaFila+="</tr>"; 
       $("#Ttmp tbody").append(nuevaFila);
      Limpiar1();
      calcular();
   }
function calcular(){
    var tabla=document.getElementById("Ttmp"); 
    var cantArt = (tabla.rows.length);
    var total = 0; 
    for(var i = 1; i < cantArt ; i++) { 
            total += parseFloat(tabla.rows[i].cells[1].innerHTML); 
    } 
    document.getElementById("Total").innerHTML= total;
    document.getElementById("son").innerHTML = cantArt-1;
}


$( "#btnGrabar" ).click(function( event ) {
   
      event.preventDefault();
      var IDGraba;
      var d;
      var Hay= document.getElementById("Ttmp").rows.length;
      if( Hay >1){
         var Cliente= document.getElementById("Cliente").value;
         var DNI= document.getElementById("DNI").value;
         var Email= document.getElementById("Email").value;
         var Control= document.getElementById("Control").value;
         var Total= document.getElementById("Total").innerHTML;
         var tabla = document.getElementById("Ttmp");
       //  var cantArt = (tabla.rows.length);
         var idArt, Obs, Precio, Serial;

         if(Cliente.length ==0){
             alert("Falta Cliente");
             document.getElementById("Cliente").focus();
             return false;
         }

        d={M:1,Local:Local,Cliente:Cliente,DNI:DNI,Email:Email,Control:Control,Total:Total};
        $.post("cgi/Grabar.php", d, function(result){  
            IDGraba = result; 
            console.log("ID ->" + IDGraba);
         try{
             var X= document.getElementById("Ttmp");
            for(var i = 1; i < Hay ; i++) {
                idArt = X.rows[i].getAttribute('data-id');
                Serial = X.rows[i].cells[2].innerHTML;
                Precio = parseFloat(X.rows[i].cells[1].innerHTML);
                Obs = X.rows[i].cells[3].innerHTML;
                d = {M: 2, IDGraba: IDGraba, ID: idArt, Precio: Precio, Obs: Obs, Serial: Serial};

                $.post("cgi/Grabar.php", d, function (result) {
                    console.log("Deta" + result);
                    AStock(3, idArt, 1, Local);
                });//Fin grabar articulo
            } // fin FOR / Grabado Articulos
         }
         catch (e) {
             console.log(e);
             alert("stop");
         }
            Limpiar2();
            Limpiar1(); //Limpiar Todo
         });//Fin Post
          document.getElementById("pCargar").style.display = "none";
      }// Fin if principal
  });


 $(document).ready(function() {
     $("input[type=text]").focus(function(){
            this.select();
      });
        setInterval('refrescar()', 2500);
       $("#btnAgregar").on("click",function(e){
            e.preventDefault();
            document.getElementById("pCargar").style.display = "none";
            var id=$("#ArtID").text();
            if (id>0){ Temporal();}
        });
  });
    </script>
<script>


</script>
</body>
</html>