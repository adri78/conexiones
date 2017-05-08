<?php
    if( $_SESSION['Local1']==1){ $Lugar="Adrogue";}
    if( $_SESSION['Local1']==2){ $Lugar="Burzaco";}
    if( $_SESSION['Local1']==3){ $Lugar="Deposito";}
    if( $_SESSION['Local1']==4){ $Lugar="Admin";}
?>
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
        $Usuaios=$Usuaios.'<option value="'.$row['idver'].'">'.$row['nreal'].'</option>';
    }
?>
    <div id="wrapper">

        <!-- *************************************************************************** -->
        <!--                      Menu                                                   -->
        <!-- *************************************************************************** -->
        <style>
            #msjs .msgtext{width: 40em;padding: 10px;background: #ccf2a9;}
            #VerTmsg {background: #5ca9ea;border-radius: 10px;padding: 15px;text-align: center; }
            #VerTmsg:hover{ background:#5fb5e6; }
            #divider {padding: 0;border: 1px solid #5d5d5d;}
            .FR{float:right;}
        </style>

              <nav class="navbar navbar-default" role="navigation">

                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse"
                              data-target=".navbar-ex1-collapse">
                          <span class="sr-only">Desplegar navegación</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" >Stock 0.1 - <?php
                          if ($_SESSION['Local1'] ==4) { ?>
                                  <h4 style="position: fixed; top:0.25em;left: 110px;"> <select name="CLocales" id="CLocales" onchange="Reload();">
                                          <option value="3">Deposito </option>
                                          <option value="1"> Adrogue </option>
                                          <option value="2"> Burzaco </option>
                                      </select>
                                  </h4>
                              <script>
                                  function Reload() {
                                      Local=document.getElementById('CLocales').value;
                                      verMovil=0;
                                      verEquipos=0;
                                      refrescar();

                                  }
                              </script>
                        <?php  } else { echo $Lugar;} ?></a>
                  </div>

              <!-- /.navbar-header -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="Reparar.php"> Reparación </a></li>
               <li><a href="index.php"> Ventas </a></li>
               <li><a href="NC.php"> Señas </a></li>
               <li><a href="Garantias.php"> Cambios/Garantias </a></li>
               <li><a class="dropdown-toggle" data-toggle="dropdown" href="#" > Informes <i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="ReImprimir.php"> Re impresion Facturas</a></li>
                        <li><a href="informe1.php"> Listados e Informes</a></li>
                        <li><a href="NullFac.php"> Anular Factura</a></li>
                        <li><a href="informe1.php"> Stock Total</a></li>
                        <li><a href="informe1.php"> Stock Total</a></li>
                        <li><a href="informe1.php"> Stock Total</a></li>
                        <li><a href="informe1.php"> Stock Total</a></li>


                    </ul>
               </li>
               <?php   if( $_SESSION['Local1'] ==4) {
                 echo '<li><a class="dropdown-toggle" data-toggle="dropdown" href="#" > Compras <i class="fa fa-caret-down"></i></a><ul class="dropdown-menu dropdown-messages">';
                 echo '<li><a href = "compras.php" > Telefonos </a></li> ';
                 echo '<li><a href="repuestos.php"> Repuestos</a></li>';
                 echo '<li><a href="Tabla_Repuestos.php">Ficha Repuestos</a></li>';
                 echo '</ul></li>';
               } ?>

               <li class="dropdown" onclick='document.getElementById("NUMSJ").style.color="#000000";'>
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="NUMSJ">
                       <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
                   </a>
                   <ul class="dropdown-menu dropdown-messages" id="msjs">
                        <li class="divider"></li>
                       <li id="VerTmsg"><a href="mensajes.php" target="_blank"><strong>Leer Todos</strong> <i class="fa fa-angle-right"></i></a></li>
                   </ul>
                   <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks" id="lpedidos"  style="width: 350px;">  </ul>
    <!-- /.dropdown-tasks -->
    </li>
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><!--a href="NC.php"> Mensajes </a> -->
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#ModalMSJ">
                    Mensajero
                </button>
            </li>
            <?php   if( $_SESSION['Local1'] ==4){
              echo '<li><a href="c.php"><i class="fa fa-user fa-fw"></i> Usuarios</a></li>';
              echo ' <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a></li>';
            }
            ?>
            <li class="divider"></li>
            <li><a href="../index.php"><i class="fa fa-sign-out fa-fw"></i> Loguin</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->

    </ul>
</div>

</nav>

    </nav>
    <!-- *************************************************************************** -->
    <!--              Fin Menu                                                     -->
    <!-- *************************************************************************** -->
   <script>
    /* ****************************************** */
       var Local = <?php if( $_SESSION['Local1']!=4)  { echo $_SESSION['Local1']; } else { echo '3';} ?> ;
      // console.log("Soy el local "+ Local);
       var verMovil=0;
       var verPedidos=0;
       var MSJ=0;


 var AMSJ= <?php echo $_SESSION['AMSJ'] ;?> ;
/*$("#msjs").load("cgi/msj.php?MODO=20&A="+AMSJ,function(a){});   */
    /* ************************************** */
function Mensajes(){
        var d={};
        $.post("cgi/version.php?V=9",d,function(a) {
            if (MSJ < a) {
                console.log(MSJ +"*"+ a);
                MSJ=a;
                $("#msjs").load("cgi/msj.php?MODO=20&A=" + AMSJ, function (a) {/* cambiar color icono*/
                     document.getElementById('NUMSJ').style.color="#ff0000";
                });
            }
        });
    }
 function NoMSJ(id){
   var  d={ID:id,MODO:1}
    $.post("cgi/msj.php",d,function(r){
        Mensajes();
    });
 }

 function MSJEnviar(){
     var a=document.getElementById('AA').value;
     var de=AMSJ;
     var mensaje=document.getElementById('mensajear').value;
     var d={MODO:0,D:de,A:a,MSG:mensaje};
     $.post("cgi/msj.php",d,function(a){
         document.getElementById('mensajear').value="";
     });
 }

function resp(id){
    document.getElementById('AA').value= id ;
    $('#ModalMSJ').modal('show');
    document.getElementById('mensajear').focus;
}
    function mPedir(){var a={};$.post("cgi/version.php?V=2",a,function(a){a>verPedidos&&(verPedidos=a,$("#lpedidos").load("cgi/tabla.php?T=5&L="+Local,function(a){}))})}function BorPedido(a){var b={ID:a,M:5};confirm("Borrar pendiente de mercaderia?")&&$.post("cgi/Grabar.php?",b,function(){})}
 </script>

 <div class="modal fade" id="ModalMSJ" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content" style="background: cadetblue;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Enviar a <select name="AA" id="AA"><?php echo $Usuaios; ?> </select></h4>
                    </div>
                    <div class="modal-body">
                        <h4>Mensaje:</h4>
                        <textarea name="mensajear" id="mensajear" style="width:100% " rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="MSJEnviar()">Enviar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>