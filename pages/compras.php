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
    <link href="../vendor/jquery/jquery-ui.css" rel="stylesheet">
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
    <style>
        #ListaArt{
            height:79vh;
            overflow: scroll;
        }
    </style>
<script>                
/********************************************* */
function pulsar(e) {  
    tecla=(document.all) ? e.keyCode : e.which; 
    if (tecla==112 && e.ctrlKey){ Fart(0) }// control + F1
    if (tecla==113 && e.ctrlKey){ MM(0) }// control + F1

     //78 = letra n
} 
/******************************************** */

</script>


</head>
<body onkeydown="return pulsar(event)">
<?php
    include 'menu.php';
?> 
    <!-- *************************************************************************** -->
    <div class="row">
        <div class="col-lg-4 cuadro">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Compras

                    <button class="btn btn-success" style="float: right!important;margin-top: -2px;" onclick="paPedir2()">Pedir</button>
                    <button class="btn  btn-info " data-toggle="modal" data-target="#FMM" style="float: right!important;margin-top: -2px; " onclick="LimpiarMM()">
                        Mov.
                    </button>
                    <button class="btn btn-warning " onclick="Fart(0)" style="float: right!important;margin-top: -2px; ">
                        Nuevo
                    </button>
                </div>
                <div class="panel-body">
                    <div>
                        <div class="row">
                            <div id="pCargar" class="NV">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label>Articulo:</label><label class="NV" id="ArtID"></label>
                                    <h4 class="lblarticulo" id="lblarticulo"> </h4>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group "> 
                                    <label>Stock: &nbsp;</label>
                                    <h4 id="lblStock" >0</h4> 
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group  has-error"> 
                                    <label>Costo:</label>
                                    <input type="text" class="form-control TC" id="Costo1" autocomplete="off" onkeyup="calparcial()" onkeypress="DeHasta('Costo1','Cant')" title="Recuerde que el cambio definitivo se debe hacer por Ficha" >
                                </div>
                            </div>
                            <div class="col-lg-4 has-success">
                                <div class="form-group">
                                    <label>Cantidad:</label>
                                    <input class="form-control TC" id="Cant" autocomplete="off" onkeyup="calparcial()" onkeypress="DeHasta('Cant','Destino')" >
                                </div>
                            </div>
                            <div class="col-lg-4" >
                                <div class="form-group "> 
                                    <label>SubTotal:</label>
                                    <h4 id="lblParcial" >0 &nbsp;</h4> 
                                </div>
                            </div> 
                        
                            <div class="col-lg-4">
                                <button class="btn btn-outline btn-warning btn-lg" style="margin-top: 10px;" onclick="VerFicha()" id="ficha">
                                    Ficha
                                </button>
                              
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Lugar:</label>
                                    <select class="form-control" id="Destino" onkeypress="DeHasta('Destino','btnTmp')">
                                         <option value="3">Deposito</option>
                                         <option value="1">Adrogue</option>
                                         <option value="2">Burzaco</option>   
                                     </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-outline btn-primary btn-lg" style="margin-top: 10px;" id="btnTmp" >Agregar</button>
                            </div>
                       </div>   <!-- Fin pCargar -->
                    </div>
                            <!-- tabla temporal -->
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table minitabla" id="Ttmp">
                                        <thead  class="Titulo" style=" background: black; color:snow;">
                                            <tr><th>Cant.</th><th>Articulo</th><th>SubTotal</th><th>Lugar</th></tr>
                                        </thead>
                                        <tbody id="tmp"></tbody></table>
                                </div>
                                <!-- fin tabla temporal -->
                                <div class="row">
                                    <div class="col-lg-1"><h5 id="hay">0</h5></div>
                                    <div class="col-lg-7"> </div>
                                    <div class="col-lg-4"><h4 class="TD" id="Total" style="margin-right:0.75em">0.00</h4></div>
                                </div>
 
                            </div>
                        </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                    <div>
                        <div class="col-lg-8">
                          <div class="form-group input-group">
                               <span class="input-group-addon"><p class="fa fa-file-o" style="margin: 0px;"></p></span>
                               <input type="text" class="form-control TC" placeholder="Comprobante" id="Comprobante" autocomplete="off">
                          </div>
                        </div>
                        <div class="col-lg-4">
                                <input type="text" id="Fecha" size="30" class="form-control tc" placeholder="Fecha ">
 
                        </div>
                        <div class="col-lg-8">
                          <div class="form-group input-group">
                               <span class="input-group-addon"><p class="fa fa-user" style="margin: 0px;"></p></span>
                               <select name="Proveedor" id="Proveedor" class="form-control">
                                   <option value="1">Proveedor 1</option>
                                   <option value="2">Proveedor 3</option>
                                   <option value="3">Proveedor 2</option>
                                   <option value="4">Proveedor 4</option>
                               </select>
                         </div>
                            <button class="btn btn-outline btn-warning "  data-toggle="modal" data-target="#fproveedor" id="bprove">Proveedor</button>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-4 formu">
                                 <input type="text" class="form-control TC" placeholder="Pago" maxlength="9" id="Pago" autocomplete="off"> <p></p>
                                 <button class="btn btn-outline btn-success btn-lg" onclick="GraCompra()">GRABAR</button>
                         </div>                       
                    </div>
                    </div> <!-- fin row -->
                </div>
            </div>
        </div>

        <div class="col-lg-8" >
            <h5> </h5>
            <div id="ListaArt">
                <div class="col-lg-6 form-group input-group">
                    <span class="input-group-addon">Buscar:</span>
                    <input type="text" class="form-control" placeholder="Buscar" id="Buscar" autocomplete="off" >
                </div>
                <table width="100%" class="table table-striped table-bordered table-hover sortable" id="Tart"><thead class="Titulo">
                    <tr><th width="100px">Codigo</th><th>Articulo</th><th  width="150px">Categoria</th><th width="38px">Menu</th> 
                        <th class="TD" width="70px">Precio</th><th class="TD" width="50px">Stock</th></tr></thead><tbody id="Tart2"></tbody>
                </table>
             </div>               
        </div><!-- Fin col de la tabla -->
    </div>
    <!-- fin row -->

<!--  ************************************ Modal ******************************************** -->
<!-- Modal_art -->
    <div class="modal fade" id="Fart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
                <div class="modal-content" style="width: 750px;left:-180px;">
                      <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" id="myModalLabel">Ficha Articulo</h4>
                       </div>
                       <div class="modal-body">

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="row">
   <div class="form" style="padding-left: 4px;">
        <div class="col-lg-5">
            <div class="NV"><label id="FIdArt">0</label></div>
            <div class="form-group input-group ">  
             <span class="input-group-addon"><p class="TD" style="margin: 0px;">CODIGO:</p></span>
             <input type="text" class="form-control" placeholder="Codigo" maxlength="20" id="Fcod"  onkeypress="DeHasta('Fcod','CmbCat')">
           </div>   
       </div>
       <div class="col-lg-2"></div> 
       <div class=" form-group input-group col-lg-4"> 
           <span class="input-group-addon"><p class="TD" style="margin: 0px;">Categoria:</p></span>
           <select name="CmbCat"  class="form-control" id="CmbCat"  onkeypress="DeHasta('CmbCat','Farticulo')">
                    <option value="1">Celulares</option>
                    <option value="2">Art PC</option>
                    <option value="3">Baterias</option>
                    <option value="4">Alamacenamiento</option>
                    <option value="5">Otros</option>
            </select>
            
      </div>
      <div class="form-group input-group  col-lg-9">
             <span class="input-group-addon"><p class="TD" style="margin: 0px;">Articulo:</p></span>
             <input type="text" class="form-control" id="Farticulo"  onkeypress="DeHasta('Farticulo','det')">
       </div>
       <div class="form-group col-lg-6">
            <label>Descripción</label>
            <textarea class="form-control" rows="7" id="det" onkeypress="DeHasta('det','Fcos')"></textarea>
       </div>
        <div class="col-lg-3">
            <div class="form-group input-group">
                <span class="input-group-addon"><p class="TD" style="margin: 0px;color: orangered;font-weight: 700;">Costo:</p></span>
                <input type="text" class="form-control TD" placeholder="0.00" maxlength="10" style="color: orangered;font-weight: 700;" id="Fcos" onkeypress="DeHasta('Fcos','FP1')">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><p class="TD" style="margin: 0px;">Precio1:</p></span>
                <input type="text" class="form-control TD" placeholder="0.00" maxlength="10" id="FP1" onkeypress="DeHasta('FP1','FP2')">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><p class="TD" style="margin: 0px;">Precio2:</p></span>
                <input type="text" class="form-control TD" placeholder="0.00" maxlength="10" id="FP2" onkeypress="DeHasta('FP2','FP3')">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><p class="TD" style="margin: 0px;">Precio3:</p></span>
                <input type="text" class="form-control TD" placeholder="0.00" maxlength="10" id="FP3" onkeypress="DeHasta('FP3','FS1')">
            </div>
        </div>
        <div class="col-lg-3" style="background: lightcyan; border: solid 2px black; "> 
            <div class="form-group input-group" style="margin-top: 10px;">
                <span class="input-group-addon"><p class="TD" style="margin: 0px;">Adrogue:</p></span>
                <input type="text" class="form-control TD" placeholder="0" maxlength="10" id="FS1" onkeypress="DeHasta('FS1','FS2')">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><p class="TD" style="margin: 0px;">Burzaco:</p></span>
                <input type="text" class="form-control TD" placeholder="0" maxlength="10" id="FS2" onkeypress="DeHasta('FS2','FS3')">
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon"><p class="TD" style="margin: 0px;">Deposito:</p></span>
                <input type="text" class="form-control TD" placeholder="0" maxlength="10" id="FS3" onkeypress="DeHasta('FS3','BTNGFicha')">
            </div>
            <hr style="margin: 0px;padding: 0px;">
                <h3 class="TD" style="width: 100%;color:blue;margin-top: 0px;" id="FStock">0</h3>          
        </div>
   </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                          </div>
                       <div class="modal-footer">
                           <input value="" type="checkbox" id ="CHKSeguir">Grabar y seguir
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-success" onclick="GFGraba()" id="BTNGFicha">Grabar</button>
                       </div>
                  </div>
                                    <!-- /.modal-content -->
          </div>
                                <!-- /.modal-dialog -->
    </div>
                            <!-- /.modal -->
<!-- Modal Proveedor -->
    <div class="modal fade" id="fproveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
                <div class="modal-content">
                      <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" id="myModalLabel">Ficha Proveedor</h4>
                       </div>
                       <div class="modal-body">
                           <h1>  Activado proxima actulizacion</h1>
                         </div>
                       <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                            <button type="button" class="btn btn-success">Grabar</button>
                       </div>
                  </div>
                                    <!-- /.modal-content -->
          </div>
                                <!-- /.modal-dialog -->
    </div>
                            <!-- /.modal -->
<?php include 'cgi/Pedir.php'; ?>
<?php include 'cgi/MM.html'; ?>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/jquery/jquery-ui.js?02"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script> 
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../js/comun.js"></script>
    <script src="../js/sorttable.js"></script>

    <script src="../dist/js/sb-admin-2.js?1"></script>

 <script>

   function calparcial(){
       var Co=parseFloat($("#Costo1").val() );
       var Ca=parseFloat($("#Cant").val() );
       var par=(Co * Ca);
       if(isNaN(par)){par=0}
       $("#lblParcial").text(par);
   }

function CAD(id){
   var d = {ID:id,H:1};
     document.getElementById("pCargar").style.display = "block";
       $.post('cgi/Art.php', d, function (res) {
              var Datos = res.split("|");//$ID|$Articulo|$Codigo|$ObsID|$Costo|$P1|$P2|$P3|$S1|$S2|$S3|$CatID
  
            $("#ArtID").text(Datos[0]);
            $(".lblarticulo").text(Datos[1]);
            $("#Costo1").val(Datos[4]);
            $("#lblStock").text(parseInt(Datos[8]) + parseInt(Datos[9])+ parseInt(Datos[10]) ); 
            $("#Cant").val("");
            $("#Cant").focus();     
         });
}

$('#btnTmp').on("click",function(e){
      e.preventDefault();
      var cant,costo,Idart,subtotal,lugar,nlugar, Art ;
      Idart=parseInt( document.getElementById("ArtID").innerHTML);
      if( Idart>1){
          cant=parseInt(document.getElementById("Cant").value);
          console.log("Cant: "+ cant);
          if((cant < 1)||( isNaN(cant ))){
              alert("La cantidad No puede ser menor a 1.");
              document.getElementById("Cant").focus();
              return false;
          }

          document.getElementById("pCargar").style.display = "none";
            Art= document.getElementById("lblarticulo").innerHTML;

            if(isNaN(cant)){ cant=0;}
            costo=parseFloat(document.getElementById("Costo1").value);
            Idart=parseInt( document.getElementById("ArtID").innerHTML);
            subtotal=parseFloat(document.getElementById("lblParcial").innerHTML)  ;
            lugar= document.getElementById("Destino").options[document.getElementById("Destino").selectedIndex].innerHTML;
            nlugar= document.getElementById("Destino").value;

            var nuevaFila=""; 
            var Tempo2 = "I" + (Math.floor(+new Date()/1000));
            var RR="RR2('"+Tempo2 +"')"; 
            nuevaFila+='<tr data-id="'+ Idart + '" ondblclick="'+RR+'" data-costo="'+ costo +'" id="'+ Tempo2 +'" data-des="'+ nlugar +'" >';
            nuevaFila+='<td class="TD">'+ cant +'</td><td >'+ Art +'</td><td class="TD">'+ subtotal+'</td><td>'+lugar+'</td></tr>' ;
            $("#Ttmp tbody").append(nuevaFila);
            Limpiar1();
            calcular();
      }
});

function Limpiar1(){
       document.getElementById("lblarticulo").innerHTML="" ;
       document.getElementById("Cant").value="";  
       document.getElementById("Costo1").value="";
       document.getElementById("ArtID").innerHTML="";
       document.getElementById("lblParcial").innerHTML="0.00";
}

function calcular(){
    var tabla=document.getElementById("Ttmp"); 
    var cantArt = (tabla.rows.length);
    var total = 0;
    var hay=0; 
    for(var i = 1; i < cantArt ; i++) { 
            total += parseFloat(tabla.rows[i].cells[2].innerHTML);
            hay += parseFloat(tabla.rows[i].cells[0].innerHTML); 
    } 
    document.getElementById("Total").innerHTML= total;
    document.getElementById("hay").innerHTML = hay;
}

function Fart(id){
  if(id==0){
            $("#FIdArt").text("0");
            $("#Farticulo").val("");
            $("#Fcod").val("");
            $("#det").val("");
            $("#Fcos").val("");
            $("#FP1").val("");
            $("#FP2").val("");
            $("#FP3").val("");
            $("#FS1").val("");
            $("#FS2").val("");
            $("#FS3").val(""); 
            $("#FStock").text("0");
           $("#Fart").modal("show");
           setTimeout(function(){$("#Fcod").focus()}, 600);  
            
  }else{
     var d = {ID:id,H:1}; 
         $.post('cgi/Art.php', d, function (res) {
              var Datos = res.split("|"); 
            $("#Fart").modal("show");
            $("#FIdArt").text(Datos[0]);
            $("#Farticulo").val(Datos[1]);
            $("#Fcod").val(Datos[2]);
            $("#det").val(Datos[3]);
            $("#Fcos").val(Datos[4]);
            $("#FP1").val(Datos[5]);
            $("#FP2").val(Datos[6]);
            $("#FP3").val(Datos[7]);
            $("#FS1").val(Datos[8]);
            $("#FS2").val(Datos[9]);
            $("#FS3").val(Datos[10]);
            $("#CmbCat").val(Datos[11]);

            var t= parseInt(Datos[8]) + parseInt(Datos[9])+ parseInt(Datos[10]);
             if(isNaN(t)){t=0}
            $("#FStock").text(t);
            setTimeout(function(){$("#Fcos").focus();}, 1000);   
        });// Fin Post
    }// Fin if
}

function GFGraba(){
         var ID,COD,ART,COS,P1,P2,P3,S1,S2,S3,CAT,DET,d;
         ART = $("#Farticulo").val();
         if(ART.length>3){
             COD = $("#Fcod").val();
             ID= $("#FIdArt").text();
             DET=$("#det").val();
             COS= parseFloat($("#Fcos").val());
             P1= parseFloat($("#FP1").val());
             P2= parseFloat($("#FP2").val());
             P3= parseFloat($("#FP3").val());
             S1= parseInt($("#FS1").val());
             S2= parseInt($("#FS2").val());
             S3= parseInt($("#FS3").val());
             CAT=$("#CmbCat").val();
             d={H:2,ID:ID,Art:ART,Obs:DET,Cos:COS,P1:P1,P2:P2,P3:P3,S1:S1,S2:S2,S3:S3,Cat:CAT,Cod:COD};
             $.post("cgi/Art.php", d, function(result){
                 console.log(result);
                 if( document.getElementById("CHKSeguir").checked){
                     Fart(0);
                 }else{
                     $("#Fart").modal("hide");
                 }
             });
         }
     }

function VerFicha(){
         var id= parseInt($("#ArtID").text());
         Fart(id);
  }

 function GraCompra(){
         var IDGraba,d;
         var Hay= document.getElementById("Ttmp").rows.length;
         if( Hay >1){
             var Comprobante= document.getElementById("Comprobante").value;

             if(Comprobante.length < 2 ){
                alert("Falta N° Comprobante");
                 $("#Comprobante").focus();
                return 0;
             }
             var Fecha= FechaSQL(document.getElementById("Fecha").value);
             var Proveedor= document.getElementById("Proveedor").value;
             var Pago=parseFloat( document.getElementById("Pago").value);
             var Total= document.getElementById("Total").innerHTML;
             var tabla = document.getElementById("Ttmp");
             //  var cantArt = (tabla.rows.length);
             var idArt, Costo, cantidad, Lugar;

             d={M:7,ID:Proveedor,Fecha:Fecha,Precio:Pago,Total:Total,Serial:Comprobante};
             $.post("cgi/Grabar.php", d, function(result){
                 IDGraba = result;
                 try{
                     var X= document.getElementById("Ttmp");
                     for(var i = 1; i < Hay ; i++) {
                         idArt = X.rows[i].getAttribute('data-id');
                         Costo = parseFloat( X.rows[i].getAttribute('data-costo'));
                         Lugar = X.rows[i].getAttribute('data-des');
                         cantidad = X.rows[i].cells[0].innerHTML;
                         d = {M: 8, IDGraba: IDGraba, ID: idArt, Precio: Costo, Stock: cantidad,Local:Lugar};
                        // console.log(d);
                         $.post("cgi/Grabar.php", d, function (result) {
                             console.log("Deta" + result);
                             AStock(4, idArt, cantidad, Lugar);
                         });//Fin grabar articulo
                     } // fin FOR / Grabado Articulos
                 }
                 catch (e) {
                    // console.log(e);
                     alert("stop");
                 }
                  alert("Grabado");
                 document.getElementById("Comprobante").value="";
                  document.getElementById("Pago").value="";
                 // Limpiar1(); //Limpiar Todo
                 $("#tmp tr").remove(); // vacia tabla
             });//Fin Post
             document.getElementById("pCargar").style.display = "none";
         }// Fin if principal
   }

 function CargaArt(){
       var d={};
       $.post('cgi/version.php?V=1', d, function (res) {
           if (res > verMovil) {
               verMovil = res;
               $("#Tart2").load("cgi/tabla.php?T=2", function (res) {
                  // $('#Tart').DataTable();
               });
           }// Fin IF
       });//
   }// Fin */

 function RR2(id){
       var IDS="#"+ id +"";
       var IDART = $(IDS).attr("data-id");
       CAD(IDART);
       document.getElementById("Costo1").value = $(IDS).attr('data-costo');
       document.getElementById("Destino").value= $(IDS).attr('data-des');
       document.getElementById("Cant").value =$(IDS).find("td").eq(0).html();
       calparcial();
       document.getElementById("Cant").value =$(IDS).find("td").eq(0).html();
       document.getElementById("Cant").select;
       $(IDS).closest('tr').remove();
   }

 function refrescar() {
       CargaArt();
       mPedir();
   }


    $(document).ready(function() {
        CargaArt();
        setInterval('refrescar()', 2500);
        $("#ficha").on("click",function(e){
            e.preventDefault();
        });
        $("#Costo1").tooltip();

        $("#bprove").on("click",function(e){
            e.preventDefault();
        });       
        $( "#Fecha" ).datepicker();
        $('#dataTables-example').DataTable( );
        $("input[type=text]").focus(function(){ this.select(); });
    });


 function Limpiar3(){

 }
</script>
<script>
    $("#Buscar").keyup(function () {/* ******************    Motor del Buscador      ******************************************** */
        if (jQuery(this).val() != "") {
            jQuery("#Tart tbody>tr").hide();
            jQuery("#Tart td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
        }
        else {
            jQuery("#Tart tbody>tr").show();
        }
    });

    jQuery.extend(jQuery.expr[":"],
        {
            "contiene-palabra": function (elem, i, match, array) {
                return (elem.textContent || elem.innerText || jQuery(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
        });
</script>
</body>

</html>