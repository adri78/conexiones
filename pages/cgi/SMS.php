<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 4/4/2017
 * Time: 08:49
 */
?>

<!-- Modal_Pedido -->
<div class="modal fade" id="Fsms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #61c9d4;border-radius: 20px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Solicitar :</h4>
            </div>
            <div class="modal-body" style="height: 120px;">
                <p  class="NV" id="IdArtp">0</p>
                <div class="col-xs-8"><h3 id="ArtP" class="lblarticulo">Articulo</h3></div><div class="col-xs-4"><h4 class="TD">Stock:<span id="StockP" class="lblarticulo"></span></h4></div>
                <div class="col-xs-5">
                    <div class="form-group input-group ">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">Pedir:</p></span>
                        <input class="form-control TC" placeholder="Cantidad" maxlength="20" id="CantP" onkeypress="DeHasta('CantP','CmbLugar')" type="text">
                    </div>
                </div>
                <div class="col-xs-7">
                    <div class=" form-group input-group ">
                        <span class="input-group-addon"><p class="TD" style="margin: 0px;">A:</p></span>
                        <select name="CmbLugar" class="form-control" id="CmbLugar" onkeypress="DeHasta('CmbLugar','btnGpedidos')">
                            <option value="0">Proxima Compra</option>
                            <option value="1" id="padro">Adrogue</option>
                            <option value="2" id="pburza">Burzaco</option>
                            <option value="3" id="pDepo">Deposito</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-info" onclick="btnGpedidos()" >Grabar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--                                      Fin Modal                                         -->
<script>
  function paPedir2(){var a=parseInt($("#ArtID").text());console.log(a),a>0&&Vpedir(a)}function Vpedir(a){var b={ID:a,H:1};$.post("cgi/Art.php",b,function(a){var b=a.split("|");$("#Fpedir").modal("show"),$("#IdArtp").text(b[0]),$("#ArtP").text(b[1]),$("#padro").text("Adrogue : "+b[8]),$("#pburza").text("Burzaco : "+b[9]),$("#pDepo").text("Deposito : "+b[10]),document.getElementById("CantP").value="",1==Local&&$("#StockP").text(b[8]),2==Local&&$("#StockP").text(b[9]),3==Local&&$("#StockP").text(b[10]),$("#CantP").focus()})}function btnGpedidos(){var a=parseInt($("#ArtID").text()),b=parseInt($("#CantP").val()),c=parseInt($("#CmbLugar").val()),d={M:6,ID:a,Total:b,Local:Local,Cliente:c};$.post("cgi/Grabar.php",d,function(a){$("#Fpedir").modal("hide")})}
</script>