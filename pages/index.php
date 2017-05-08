<?php  include 'contenido.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
         document.getElementById("Buscar").focus();
    }
    if (tecla==113 && e.ctrlKey){ // control + F2
        document.getElementById("btnGrabar").focus();
    } //
} 
/******************************************** */

</script>
    <style>
        #ListaArt{
            height:79vh;
            overflow: scroll;
        }
    </style>

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
                                    <h4 class="lblarticulo" id="lblarticulo"> </h4>
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
                                    <input class="form-control" id="Serial" onkeypress="DeHasta('Serial','txtObs')" autocomplete="off">
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
                               <input type="text" class="form-control" placeholder="Cliente" id="Cliente"  autocomplete="off"  onkeypress="DeHasta('Cliente','DNI')" >
                          </div>
                          <div class="form-group input-group">
                               <span class="input-group-addon">@</span>
                               <input type="text" class="form-control" placeholder="Email" id="Email"  autocomplete="off"  onkeypress="DeHasta('Email','Control')" >
                         </div>
                         <div class="form-group input-group has-error">
                               <span class="input-group-addon"><p class="glyphicon glyphicon-ok" style="margin: 0px;"></p></span>
                               <input type="text" class="form-control" placeholder="Controlado por" id="Control"  onkeypress="DeHasta('Control','btnGrabar')" >
                         </div>
                        </div>
                        <div class="col-lg-4 formu">
                                 <input type="text" class="form-control" placeholder="DNI" maxlength="9" id="DNI"  onkeypress="DeHasta('DNI','Email')" autocomplete="off"> <p></p>
                                 <button class="btn btn-outline btn-info btn-lg" id="btnGrabar" >GRABAR</button>
                                 <p></p>
                                 <input type="checkbox" checked name="chkprn" id="chkprn"><label for="chkprn" > &nbsp; IMPRIMIR</label>
                                <button class="btn btn-outline btn-danger" onclick="LimpiarT()">Vaciar</button>

                        </div>                       
                    </form1>
                    </div> <!-- fin row -->
                </div>
            </div>
        </div>
        <div class="col-lg-8" >
            <div class="col-lg-6 form-group input-group">
                <span class="input-group-addon">Buscar:</span>
                <input type="text" class="form-control" placeholder="Buscar" id="Buscar" autocomplete="off" >

            </div>

             <div id="ListaArt" >
                <table width="100%" class="table  table-bordered sortable" id="LART">
                    <thead class="Titulo"><tr><th width="100px">Codigo</th><th>Articulo</th>
                           <th  width="150px">Categoria</th> <th class="TD"  width="70px">Precio</th>
                         <th class="TD"  width="50px">Stock</th></tr>
                        </thead><tbody id="LART2"> </tbody></table>
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
    <script src="../js/sorttable.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js?1"></script>
   <script>

 function CA(id){
       document.getElementById("pCargar").style.display = "block";
        var d = {ID:id,H:1}; 
         $.post('cgi/Art.php', d, function (res) {
              var Datos = res.split("|");  
            $("#ArtID").text(Datos[0]);
            $(".lblarticulo").text("");
            $(".lblarticulo").text(Datos[1]);
             $("#txtObs").val("");
            $("#txtObs").val(Datos[3]);
            if (Local==1){ $("#lblStock2").text(Datos[8]);}
            if (Local==2){ $("#lblStock2").text(Datos[9]);}
            if (Local==3){ $("#lblStock2").text(Datos[10]);}   
            $("#cmbPrecio").empty();
        var fijo="DeHasta('cmbPrecio','Serial')" ;
              if(Local==1){
                  $("#cmbPrecio").append('<option value= "'+Datos[5]+'"  onkeypress="'+ fijo +'">'+Datos[5]+'</option>');
                  $("#cmbPrecio").append("<option value=\""+Datos[6]+"\">"+Datos[6]+"</option>");
                  $("#cmbPrecio").append("<option value=\""+Datos[7]+"\">"+Datos[7]+"</option>");
              }else{
                  $("#cmbPrecio").append('<option value= "'+Datos[7]+'"  onkeypress="'+ fijo +'">'+Datos[7]+'</option>');
                  $("#cmbPrecio").append("<option value=\""+Datos[6]+"\">"+Datos[6]+"</option>");
                  $("#cmbPrecio").append("<option value=\""+Datos[5]+"\">"+Datos[5]+"</option>");
              }

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
  function LimpiarT(){
      Limpiar1();
      Limpiar2();
  }
function refrescar() {
          CargaArt();
          mPedir();
          Mensajes();
   }
function CargaArt(){
           var d={};
           $.post('cgi/version.php?V=1', d, function (res) {
               if (res > verMovil) {
                   verMovil = res;
                   $("#LART2").load("cgi/tabla.php?T=1&L="+Local, function (res) { });
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
       nuevaFila+='<tr data-id="'+ $("#ArtID").text() + '" ondblclick="'+RR+'"  id="'+ Tempo2 +'"> <td>'+$("#lblarticulo").text()+'</td><td class="TD">'+ $("#cmbPrecio").val() +'</td>';
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


$( "#btnGrabar" ).click(function( e ) {
      e.preventDefault();
      var IDGraba;
      var d;
      var Hay= document.getElementById("Ttmp").rows.length;

      if( Hay >1){
         var Cliente= document.getElementById("Cliente").value;
         var DNI= document.getElementById("DNI").value;
         var Email= document.getElementById("Email").value;
         var Control= document.getElementById("Control").value;
         if(Control.length < 3 ){
             Control='<?php  echo $_SESSION['real']; ?>'  ;
         }
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
         console.log(d);
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
                        //console.log("Deta " + result);
                        AStock(3, idArt, 1, Local);
                    });//Fin grabar articulo
                } // fin FOR / Grabado Articulos

             }
             catch (e) {
                 console.log(e);
                 alert("stop");
             }

            if( document.getElementById("chkprn").checked  ){//imprimir
                var url="recibo.php?I="+IDGraba  ;
                window.open(url, '', 'width=330,height=252,scrollbars=NO,statusbar=NO,left=500,top=250');
            }

            Limpiar2();
            Limpiar1(); //Limpiar Todo
         });//Fin Post
          document.getElementById("pCargar").style.display = "none";
      }// Fin if principal
  });


 $(document).ready(function() {
     CargaArt();
     $("input[type=text]").focus(function(){
            this.select();
      });
        setInterval('refrescar()', 2500);
       $("#btnAgregar").on("click",function(e){
            e.preventDefault();
            document.getElementById("pCargar").style.display = "none";
            var id=$("#ArtID").text();
            if (id>0){ Temporal();}
           document.getElementById("Buscar").focus();
        });
  });
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
            jQuery("#LART tbody>tr").hide();
            jQuery("#LART td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
        }
        else {
            jQuery("#LART tbody>tr").show();
        }
    });


</script>
</body>
</html>