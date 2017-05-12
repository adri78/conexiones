<?php

 if(isset($_GET["T"])){ $modo=$_GET["T"]; }
 if(isset($_GET["D"])){ $D=$_GET["D"]; }
    $Actuliza=" Proveedores";

    if($modo=='P'){ //Proveedores
        $x=1;
        $Actuliza=" Proveedores";
    }
    if($modo=='M'){ //Marca
        $x=2;
        $Actuliza=" Marcas";
    }
    if($modo=='T'){ //Tipo
        $x=3;
        $Actuliza=" Respuesto";
    }
if($modo=='C'){ //Color
    $x=35;
    $Actuliza=" Color";
}
   if($modo=='O'){ //Modelo /id de Marca
        $x=100;
        $Actuliza=" Modelo";
    }
?>

<script>

 function cmbReload () {
    var m= <?php echo "'".$modo."'";  ?> ;

    if(m=='P'){REC4();}
    if(m=='C'){REC5();}
    if(m=='M'){REC1();}
    if(m=='T'){REC2();}
    if(m=='O'){REC3();}
 }
</script>



 <!-- Modal-->

 <style>
    #TV tbody tr{padding:0px;margin-left: 15px;}
    #TV tbody tr:hover{ background: #10f7a9;}
    #TV tbody tr:nth-child(odd) {background: #61c9d4;}
    #TV tbody tr:nth-child(odd):hover{ background: #10f7a9;}
    #TV {overflow: auto; height: 280px;}
     .B{margin: 0px;padding: 0px;}
     tr{height: 1.1em;}
</style>
            <!--           <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> -->
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="cmbReload()">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">ABM de <?php echo $Actuliza; ?></h4>
                                <label for="" id="ID" class="NV">0</label>
                            </div>
                            <div class="modal-body">
                                <button class="btn btn-success btn-lg" id="ABMNuevoBTN" onclick="TVNUEVO()">Nuevo</button>
                                <div class="ABMNuevo NV" id="ABMNuevo">
                                    <div class="form-group input-group">
                                        <input type="text" id="NuevoTV" class="form-control" >
                                        <span class="input-group-addon B"> <a class="btn btn-info" onclick="TVGrabar()">Grabar</a></span>
                                    </div>
                                </div>
                                <div class="ABMModificar NV" id="ABMModificar">
                                    <div class="form-group input-group">
                                        <input type="text" id="CambiarTV" class="form-control" >
                                        <span class="input-group-addon B"><a class="btn btn-info" onclick="TVModifcar()">Modificar</a>  <a class="btn btn-danger"  onclick="TVBORRAR()">Eliminar</a></span>

                                    </div>
                                </div>

                                <hr>

                                <div class="table-responsive table-bordered table-hover" style="height: 260px; overflow: auto;">
                                    <table class="table" id="TV">
                                        <tbody id="bodyTV">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cmbReload()">SALIR</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->


            <!--</div>
             /.modal -->
                </div>
                <!-- /.col-lg-12 -->
</div><!-- fin row -->

<script>
            var X= <?php echo $x; ?> ;
 </script>
<script>(function() {CargaTV();})();
</script>