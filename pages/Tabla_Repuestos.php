<?php  include 'contenido.php'; ?>
<?php
 /*  include "cgi/config2.inc";
   $Equipos="";

    $sql= "SELECT `idart`, `Articulo`, `Codigo` FROM `t_art`  ORDER BY Articulo;";
    $segmento = mysqli_query($conexion,$sql);
    while ($row = mysqli_fetch_array($segmento)) {
        $Equipos = $Equipos . '<option value="' . $row['idart'] . '">' . $row["Codigo"] . "-" . $row["Articulo"] . "</option>";
    }
    mysqli_close($conexion);
*/
?>
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

    <style>
        #LRes td:nth-child(1) { text-align: center; width:30px;}
        #LRes td:nth-child(6) { text-align: right;}
        #LRes td:nth-child(4) { text-align: right;}
        #LRes td:nth-child(5) { text-align: right;}
        #LRes tbody tr:hover{background: aquamarine;}
        input:focus{background: #73dba8;}
        .B{ padding: 0px;}
        .Z{z-index:102;}
        .Y{
            padding-right: 5px;
            padding-left: 5px;
            }
        .X{width: 85%;}

    </style>

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
/*********************************************/
function pulsar(e) {
    tecla=(document.all) ? e.keyCode : e.which;
  /*  if (tecla==112 && e.ctrlKey){ // control + F1
        //alert("listo");
         document.getElementById("btnGrabar").focus();

    } //78 = letra n  */
}
/******************************************** */

</script>


</head>
<body onkeydown="return pulsar(event)">
<?php
    include 'menu.php';
?>
    <div class="row">
      <label class="" id="ID">0</label>
        <div class="col-xs-2" style="margin-left: 15px;">
            <button class="btn btn-success btn-lg" style="width: 100%;">NUEVO</button>
        </div>
        <div class="col-xs-3" style="margin-left: 10px;">
            <div class="form-group input-group">
                <span class="input-group-addon B"><buton class="btn btn-danger" onclick="BtnMarca()">Marca</buton></span>
                <select name="LstMarca"  class="form-control Z" id="LstMarca" onfocus='REC1();' onblur="LoadEquipos();">
                </select>
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group input-group" style="z-index: 100;" >
                <span class="input-group-addon B"><buton class="btn btn-danger" onclick="BtnEquipo()">Model</buton></span>
                <section id="intro" >
                    <select id="LstEquipos" class="form-control" id="LstEquipos" onfocus='REC3("LstEquipos")'>
                    </select>
                </section>
            </div>
        </div>
        <br>
        <div class="col-xs-12" >
            <div id="ListaDos" >
                <table width="100%" class="table  table-bordered sortable" id="LRes">
                <thead class="Titulo"><tr><th width="40px"><buton class="btn btn-danger X" onclick="BtnRepuesto()">Repuestos</buton></th><th>V</th>
                     <th><buton class="btn btn-info X" onclick="BtnColor()">Color</buton></th><th class="TD">Costo</th><th class="TD">Precio1</th>
                         <th class="TD">Precio2</th><th class="TD">Precio3</th><th class="TD">Stock</th><th class="TD"><buton class="btn btn-danger X" onclick="BtnProvee()">Proveedor</buton></th>
                   </tr>
                </thead><tbody id="LRes3">
                <tr onclick="verR(id)">
                    <td>stock</td>
                    <td>Marca - Tipo</td>
                    <td>Equipo</td>
                    <td>P1</td>
                    <td>p2</td>
                    <td>P3</td>
                    <td>P1</td>
                    <td>p2</td>
                    <td>P3</td>
                 </tr>
                <tr>
                    <td>stock</td>
                    <td>Marca - Tipo</td>
                    <td>Equipo</td>
                    <td>P1</td>
                    <td>p2</td>
                    <td>P3</td>
                    <td>P1</td>
                    <td>p2</td>
                    <td>P3</td>
                    </tr>
                </tbody></table>
        </div> <!-- Fin ListaArt -->
        </div>
        <hr>
        <hr>
        <!-- *************************************************************************************************** -->
        <!-- *************************************************************************************************** -->
        <!-- *************************************************************************************************** -->


    <!-- fin row -->

<!-- ********************************************************************************************  -->

        <!--
          <div class="modal fade" id="HVer2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
   <div class="modal fade" id="HVer2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content" style="background: aquamarine;">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                   <h4 class="modal-title" id="myModalLabel">Ficha de Repuesto</h4>
                   <label for="" id="ID" class="NV">0</label>
               </div>
               <div class="modal-body">
                    <div class="col-xs-6 Y">
                  <div class="form-group input-group">
                      <span class="input-group-addon B"><buton class="btn btn-info" onclick="BtnRepuesto()">Repu.</buton></span>
                      <select name="LstRepuesto"  class="form-control Z" id="LstRepuesto" onfocus='REC2();'>

                      </select>
                  </div>
              </div>
                    <div class="col-xs-6 Y">
                  <div class="form-group input-group">
                      <span class="input-group-addon B"><buton class="btn btn-info" onclick="BtnColor()">Color.</buton></span>
                      <select name="LstColor"  class="form-control Z" onkeyup="DeHasta('LstColor','Costo');"  id="LstColor" onfocus='REC5();'>

                      </select>
                  </div>
              </div>
                    <div class="col-xs-6">
                  <div class="form-group input-group">
                      <span class="input-group-addon">Costo</span>
                      <input type="text" id="Costo" class="form-control TD" onkeyup="DeHasta('Costo','Precio1');">
                  </div>
              </div>
                    <div class="col-xs-6">
                  <div class="form-group input-group">
                      <span class="input-group-addon">Precio1</span>
                      <input type="text" id="Precio1" class="form-control TD" onkeyup="DeHasta('Precio1','Precio2');">
                  </div>
              </div>
                    <div class="col-xs-6">
                  <div class="form-group input-group">
                      <span class="input-group-addon">Precio2</span>
                      <input type="text" id="Precio2" class="form-control TD" onkeyup="DeHasta('Precio2','Precio3');">
                  </div>
              </div>
                    <div class="col-xs-6">
                  <div class="form-group input-group">
                      <span class="input-group-addon">Precio3</span>
                      <input type="text" id="Precio3" class="form-control TD"  onkeyup="DeHasta('Precio3','Stock');">
                  </div>
              </div>
                    <div class="col-xs-12">
                        <div class="form-group input-group">
                      <span class="input-group-addon B"><buton class="btn btn-info" onclick="BtnProvee()">Provee.</buton></span>
                      <select name="LstProvee"  class="form-control Z" id="LstProvee" onfocus='REC4();'>
                      </select>
                  </div>
              </div>
                    <div class="col-xs-6 Y">
                  <div class="form-group input-group">
                      <label for="CStock" id="LCStock" onkeyup="DeHasta('CStock','BGraba');" class="btn" onclick="document.getElementById('LCStock').classList.toggle('btn-successs');">Control de Stock
                          <input type="checkbox" id="CStock" name="CStock" class=" "></label>
                      <label for="Visible" id="Visibless"  class="btn"  >Visible
                          <input type="checkbox" id="Visible" name="Visible" class=" "></label>
                  </div>
              </div>
                    <div class="col-xs-6">
                    <div class="form-group input-group">
                      <span class="input-group-addon">STOCK</span>
                      <input type="text" id="Stock" class="form-control TC"  onkeyup="DeHasta('Stock','BGraba');">
                  </div>
                    </div></div>
              <div class="modal-footer">
                   <div style="height: 50px;">
                    <div class="col-xs-5 Y"> <a class="btn btn-success btn-block" onclick="BGrabaJS()"> Grabar </a></div>
                    <div class="col-xs-4 Y"> <a class="btn btn-warning btn-block" onclick="LimpiaRes()" id="BSalir">Nuevo/Salir </a> </div>
                    <div class="col-xs-3 Y"> <a class="btn btn-danger btn-block" onclick="BorraRes()" > Borrar </a> </div>
                </div>
              </div>
           </div>



       </div>
       <div class="modal fade" id="HVer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index: 300">

       </div>
       </div>

</div>
        <!-- ******************************************************************************************** -->




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
    <script type="text/javascript"  src="../js/sorttable.js"></script>
    <script type="text/javascript"  src="../js/zelect.js"></script>
<!-- <script src="chosen.jquery.min.js" type="text/javascript"></script>-->
<script src="../dist/js/sb-admin-2.js?1"></script>
<script>
    verRes =0;


</script>
<script>
  function BtnMarca() {
      $("#HVer").load("ListadoDinamico.php?T=M",function(a){
          $("#HVer").modal("show");
      });
  }
  function BtnRepuesto() {
        $("#HVer").load("ListadoDinamico.php?T=T",function(a){
            $("#HVer").modal("show");
        });
  }
  function BtnColor() {
      $("#HVer").load("ListadoDinamico.php?T=C",function(a){
          $("#HVer").modal("show");
      });
  }
  function BtnProvee() {
        $("#HVer").load("ListadoDinamico.php?T=P",function(a){
            $("#HVer").modal("show");
        });
  }
  function BtnEquipo() {
      var M=document.getElementById('LstMarca').value;
      $("#HVer").load("ListadoDinamico.php?T=O&D="+M,function(a){
          $("#HVer").modal("show");
      });
  }
  function LoadEquipos() {
      var M=document.getElementById('LstMarca').value;
      $("#LstEquipos").load("cgi/LDComplementa.php?T=210&D="+M,function(a){ });
      //$('#intro select').zelect({ placeholder:' Modelo ' });
  }
  function BGrabaJS() {
      var ID = document.getElementById('ID').innerHTML;
      var idMarca = document.getElementById('LstMarca').value;
      var idRepu = document.getElementById('LstRepuesto').value;
      var idEquipo = document.getElementById('LstEquipos').value;
      var idProvee = document.getElementById('LstProvee').value;
      var idColor = parseInt(document.getElementById('LstColor').value) ;
      if(idColor <1 ){idColor=1;}
      var Costo = document.getElementById('Costo').value;
      var Precio1 = document.getElementById('Precio1').value;
      var Precio2 = document.getElementById('Precio2').value;
      var Precio3 = document.getElementById('Precio3').value;
      var Stock = document.getElementById('Stock').value;
      var CStock = document.getElementById('CStock').checked;

      var d;
      d = {
          T: 80,
          ID: ID,
          Marca: idMarca,
          Repuesto: idRepu,
          Equipo: idEquipo,
          Provee: idProvee,
          Costo: Costo,
          P1: Precio1,
          P2: Precio2,
          P3: Precio3,
          Stock: Stock,
          Color: idColor,
          CStock: CStock
      };
      console.log(d);
      if (idRepu > 0) {
          $.post('cgi/LDComplementa.php', d, function (res) {
              console.log(res);
              alert("Se grabo");
              LimpiaRes();
          });
      } else {
          alert("Falta Repuesto");
      }
  }
  function LimpiaRes(){
      document.getElementById('ID').innerHTML="0";
      document.getElementById('LstMarca').value="";
      document.getElementById('LstRepuesto').value="";
      document.getElementById('LstEquipos').value="";
      document.getElementById('LstProvee').value="";
      document.getElementById('LstColor').value="1";
      document.getElementById('Costo').value="";
      document.getElementById('Precio1').value="";
      document.getElementById('Precio2').value="";
      document.getElementById('Precio3').value="";
      document.getElementById('Stock').value="";
      document.getElementById('CStock').checked="false";
  }
  function Res(id) {
      var d = {ID:id,T:91};
      $.post('cgi/LDComplementa.php', d, function (res) {
         // console.log(res);
          var Datos = res.split("|");
          document.getElementById('ID').innerHTML=Datos[0];
          $("#LstMarca").load("cgi/LDComplementa.php?T=202",function(){document.getElementById('LstMarca').value=Datos[2];});
          $("#LstEquipos").load("cgi/LDComplementa.php?T=210&D="+Datos[2], function(){document.getElementById('LstEquipos').value=Datos[1];});
          $("#LstRepuesto").load("cgi/LDComplementa.php?T=203",function(){document.getElementById('LstRepuesto').value=Datos[4];});
          $("#LstProvee").load("cgi/LDComplementa.php?T=201",function(){document.getElementById('LstProvee').value=Datos[3];});

          document.getElementById('Costo').value=Datos[5];
          document.getElementById('Precio1').value=Datos[6];
          document.getElementById('Precio2').value=Datos[7];
          document.getElementById('Precio3').value=Datos[8];
          document.getElementById('Stock').value=Datos[9];
          document.getElementById('CStock').checked=Datos[10];

          $("#LstColor").load("cgi/LDComplementa.php?T=204",function(){document.getElementById('LstColor').value=document.getElementById('LstColor').value = parseInt( Datos[11]) ;});

          $("#Costo").focus();
      });

  }
  function CargaRes() {
      var d={};
      $.post('cgi/version.php?V=8', d, function (res) {
          if (res > verRes) {
              verRes = res;
              $("#LRes2").load("cgi/LDComplementa.php?T=90", function (res) { });
          }// Fin IF
      });//
  }
  function refrescar(){
      CargaRes();
      Mensajes();
  }

  function BorraRes(){
      var ID=document.getElementById('ID').innerHTML;
      if(ID>0){
          if(confirm("Esta por borrar un Repuesto, Seguro?")){
              var d = {ID:ID,T:92};
              $.post('cgi/LDComplementa.php', d, function (res) {
                  console.log(res);
                  LimpiaRes();
              });
          }
      }
  }



  $(document).ready(function() {
      CargaRes();
      $("input[type=text]").focus(function () {
          this.select();
      });
      setInterval('refrescar()', 2500);

  });
</script>
<script>
    function E(ID,NOMBRE) {
        document.getElementById('ID').innerHTML=ID;
        document.getElementById('CambiarTV').value=NOMBRE;
        document.getElementById('ABMModificar').classList.remove("NV");
        document.getElementById('ABMNuevo').classList.add("NV");
        document.getElementById('ABMNuevoBTN').classList.add("NV");
        document.getElementById('CambiarTV').focus();
    }
    function TVNUEVO() {
        document.getElementById('ABMNuevo').classList.remove("NV");
        document.getElementById('ABMNuevoBTN').classList.add("NV");
        document.getElementById('NuevoTV').value="";
        document.getElementById('NuevoTV').focus();
    }
    function TVListo() {
        document.getElementById('ABMNuevo').classList.add("NV");
        document.getElementById('ABMModificar').classList.add("NV");
        document.getElementById('ABMNuevoBTN').classList.remove("NV");
    }
    function TVGrabar() {
        if(confirm("Grabar Elemento?")){
            var id=document.getElementById('ID').innerHTML ;
            var txt=document.getElementById('NuevoTV').value.toUpperCase();;
            var d;
            var Y;

            if(X==1){Y=4;}
            if(X==2){Y=7;}
            if(X==3){Y=10;}
            if(X==35){Y=30;}
            if(X==100) {

             var  M=document.getElementById('LstMarca').value;
                Y=101;
                d={T:Y,ID:id,N:txt,D:M};
            } else {
                d={T:Y,ID:id,N:txt};
            }

            $.post("cgi/LDComplementa.php", d, function(res){
                TVListo();
                CargaTV();
            });
        }
    }
    function TVModifcar() {
        if(confirm("Actulizar Elemento?")){
            var id=document.getElementById('ID').innerHTML ;
            var txt=document.getElementById('CambiarTV').value.toUpperCase();;
            var d;
            var Y;

            if(X==1){Y=5;}
            if(X==2){Y=8;}
            if(X==3){Y=11;}
            if(X==35){Y=31;}

            if(X==100){

             var M=document.getElementById('LstMarca').value;
                Y=102;
                d={T:Y,ID:id,N:txt,D:M};
            } else {
                d = {T: Y, ID: id, N: txt};
            }
            $.post("cgi/LDComplementa.php", d, function(res){
                console.log(res);
                TVListo();
                CargaTV();
            });
        }
    }
    function TVBORRAR() {
        if(confirm("Borrar?")){
            var id=document.getElementById('ID').innerHTML ;
            var d;
            var Y;

            if(X==1){Y=6;}
            if(X==2){Y=9;}
            if(X==3){Y=12;}
            if(X==35){Y=32;}
            if(X==100){ Y=103;}
            d={T:Y,ID:id };

            $.post("cgi/LDComplementa.php", d, function(res){
                TVListo();
                CargaTV();
            });
        }
    }
    function CargaTV() {
        var M = document.getElementById('LstMarca').value;
        $("#bodyTV").load("cgi/LDComplementa.php?T="+X +"&D="+M, function (res) { });
    }
</script>
<script>
    function REC1(){
        var tmp =document.getElementById('LstMarca').value;
        $("#LstMarca").load("cgi/LDComplementa.php?T=202",function(){document.getElementById('LstMarca').value=tmp});
    }
    function REC2(){
        var tmp =document.getElementById('LstRepuesto').value;
        $("#LstRepuesto").load("cgi/LDComplementa.php?T=203",function(){document.getElementById('LstRepuesto').value=tmp;});
    }

    function REC3(lst){
        var tmp =document.getElementById(lst).value;
        $("#"+lst).load("cgi/LDComplementa.php?T=210&D="+document.getElementById("LstMarca").value, function(){
            document.getElementById(lst).value= tmp;
        });
    }
    function REC4() {
        var tmp=document.getElementById('LstProvee').value;
        $("#LstProvee").load("cgi/LDComplementa.php?T=201",function(){document.getElementById('LstProvee').value=tmp;});
    }
    function REC5() {
        var tmp=document.getElementById('LstColor').value;
        $("#LstColor").load("cgi/LDComplementa.php?T=204",function(){document.getElementById('LstColor').value=tmp;});
    }
</script>
<script>
   function Novo() {
       $("#HVer2").modal("show");
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
            jQuery("#LRes tbody>tr").hide();
            jQuery("#LRes td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
        }
        else {
            jQuery("#LRes tbody>tr").show();
        }
    });

</script>
</body>
</html>