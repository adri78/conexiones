<?php  include 'contenido.php'; ?>
<?php
    include "cgi/config2.inc";
    $Equipos="";
$sql="SELECT `id_equi`,`Marca`,`Equipo` FROM `t_equi`,`t_marca` WHERE `MarcaID`=`idMarca`";
    $segmento = mysqli_query($conexion,$sql);
        while ($row = mysqli_fetch_array($segmento)) {
        $Equipos = $Equipos . '<option value="' . $row['id_equi'] . '">'. $row["Marca"] ." - ". $row["Equipo"] . "</option>";
    }
    mysqli_close($conexion);

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
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- ****************************************************************************************************** -->
    <style>
        .radio label{ padding-left: 10px; }
        .espa {padding-top: 10px;}
        .form-group {
             margin-bottom: -1px;
        }
        #NAPARATO{
            top: -1.2em;
        }
        .inL{ display: inline-block;}
        .SR{background: #f8fb53;}
        .Pre{background: #c23321;}
        .Repa{background: #4cae4c;}
        .Entre{background: #1ab7ea;}
        .chk{  margin: 5px 6px; }
        #lstR tbody { background: white;color: black;}
        #lstR tbody tr:hover{ background: aqua;color: black;}
        #lstR{ overflow: auto;max-height: 340px;}
    </style>
    <style>
        .zearch:focus{
            background: rgba(30, 168, 234, 0.67);
        }
        #intro .zelect {
            display: inline-block;
            background-color: white;
            min-width: 300px;
            cursor: pointer;
            line-height: 36px;
            border: 1px solid #dbdece;
            border-radius: 6px;
            position: relative;
        }
        #intro .zelected {
            font-weight: bold;
            padding-left: 10px;
        }
        #intro .zelected.placeholder {
            color: #999f82;
        }
        #intro .zelected:hover {
            border-color: #c0c4ab;
            box-shadow: inset 0px 5px 8px -6px #dbdece;
        }
        #intro .zelect.open {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }
        #intro .dropdown {
            background-color: white;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
            border: 1px solid #dbdece;
            border-top: none;
            position: absolute;
            left:-1px;
            right:-1px;
            top: 36px;
            z-index: 2;
            padding: 3px 5px 3px 3px;
        }
        #intro .dropdown input {
            font-family: sans-serif;
            outline: none;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #dbdece;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            width: 100%;
            padding: 7px 0 7px 10px;
        }
        #intro .dropdown ol {
            padding: 0;
            margin: 3px 0 0 0;
            list-style-type: none;
            max-height: 150px;
            overflow-y: scroll;
        }
        #intro .dropdown li {
            padding-left: 10px;
        }
        #intro .dropdown li.current {
            background-color: #e9ebe1;
        }
    </style>
    <!-- ****************************************************************************************************** -->
<script>                
/********************************************* */
    function pulsar(e) {
    tecla=(document.all) ? e.keyCode : e.which; 
    if (tecla==112 && e.ctrlKey){ // control + F1
         document.getElementById("Buscar").focus();
    } //78 = letra n
    if (tecla==113 && e.ctrlKey){ // control + F2
        Novo();
    }
} 
/******************************************** */
</script>


</head>
<body onkeydown="return pulsar(event)">
<?php
    include 'menu.php';
?> 
    <div class="row">

        <div class=" NV" id="NAPARATO"  >
            <div class="panel panel-green">
                <div class="panel-heading">
                   Ficha Equipo - <label id="ID">0</label>
                    <button class="btn btn-danger fa fa-print" style="float:right;" onclick="PrintEquipo(0);" > Reimprimir</button>
                </div>
                <div class="panel-body" style="background: #fff;">
                    <div class="col-xs-6"><!--  Div 4-6 -->
                         <div class="form-group input-group">
                                <span class="input-group-addon">N°</span>
                                <input type="text" class="form-control TC" id="NOrden"  placeholder="AUTOMATICO" autocomplete="off" onkeypress="DeHasta('NOrden','Cliente')">
                         </div>

                        <Label>Cliente</Label>
                        <input type="text" class="form-control" id="Cliente" autocomplete="off" onkeypress="DeHasta('Cliente','Equipo')">

                        <Label>Equipo</Label>
                        <input type="text" class="form-control" id="Equipo" autocomplete="off" onkeypress="DeHasta('Equipo','Tel')">

                        <div class="form-group input-group espa">
                            <span class="input-group-addon">Tel</span>
                            <input type="text" class="form-control TC" id="Tel" autocomplete="off" onkeypress="DeHasta('Tel','EMEI');">
                        </div>

                        <div class="form-group input-group espa">
                            <span class="input-group-addon">EMEI</span>
                            <input type="text" class="form-control TC" id="EMEI" autocomplete="off" onkeypress="DeHasta('EMEI','Falla');">
                        </div>

                         <Label>Falla</Label>
                         <textarea id="Falla" style="width: 100%;" required="required" onkeypress="DeHasta( 'Falla','RTecnico');"></textarea>
                        <Label>Tecnico</Label>
                        <textarea id="RTecnico" style="width: 100%;" required="required" onkeypress="DeHasta( 'RTecnico','Estado');"></textarea>


                        <label for="Estado" class="">Estado</label>
                            <select id="Estado" name="Estado"  onkeypress="DeHasta( 'Estado','Total');">
                                <option value="Espera" selected="selected">Espera</option>
                                <option value="Sin Reparación">Sin Reparación</option>
                                <option value="Re presupuestar">Re presupuestar</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Reparado">Reparado</option>
                                <option value="Entragdo">Entragdo</option>
                            </select>

                    </div> <!-- Fin Div 4-6 -->
                    <div class="col-xs-6"><!--  Div 4-6 -->
                        <fieldset class="btn-group radio" style="margin-top: 0;" >
                            <input type="checkbox" id="imprimir" name="imprimir" class="NV" onclick="chkCambia(this.id)" checked >
                            <label for="imprimir"  id="imprimir1"  style="width: 165px;" class="btn btn-danger active"> IMPRIMIR </label>
                        </fieldset>

                        <div class="form-group input-group">
                                <input type="checkbox" id="Tapa" name="Tapa" class="NV" onclick="chkCambia(this.id)"><label for="Tapa" id="T1" class="chk btn active" >TAPA </label>
                                <input type="checkbox" id="Bata" name="Bata" class="NV" onclick="chkCambia(this.id)"><label for="Bata" id="B1" class="chk btn active" >Bateria </label>
                                <input type="checkbox" id="Chip" name="Chip" class="NV" onclick="chkCambia(this.id)"><label for="Chip" id="C1" class="chk btn active" >CHIP </label>
                                <input type="checkbox" id="Memo" name="Memo" class="NV" onclick="chkCambia(this.id)"><label for="Memo" id="M1" class="chk btn active" >Memoria </label>
                        </div>

                        <div class="form-group input-group espa">
                            <span class="input-group-addon">Total:</span>
                            <input type="text" class="form-control TD" id="Total" autocomplete="off" onkeyup="Restan();" onkeypress="DeHasta('Total','Sena'); ">
                        </div>
                        <div class="form-group input-group espa">
                            <span class="input-group-addon">Seña:</span>
                            <input type="text" class="form-control TD" id="Sena" autocomplete="off" onkeyup="Restan();" onkeypress="DeHasta('Sena','BTNGraba');">
                        </div>
                        <div class="form-group input-group espa">
                            <span class="input-group-addon">Restan:</span>
                            <input type="text" class="form-control TD" id="Restan" autocomplete="off" readonly>
                        </div>
                        <div style="background: #1ab7ea;border: black 1px solid; border-radius:18px;margin: 9px 0px;" class="TC">
                            <br>
                            <p id="FechaE1"> </p>
                            <p id="FechaE2"> </p>
                            <p id="FechaE3"> </p>
                        </div>

                    </div> <!-- Fin Div 4-6 -->
                    <br>
                </div>

                <div class="panel-footer" style="height: 5em;">
                   <div class="col-xs-6">
                       <button class="btn btn-warning  btn-lg btn-block" onclick="Novo();">Cancelar</button>
                   </div>
                    <div class="col-xs-6">
                        <button class="btn btn-success btn-lg btn-block" id="BTNGraba" onclick="GraAparato()" >Grabar</button>
                    </div>
                </div>
            </div>
                </div> <!-- Fin div ficha  -->
            <!-- ******************************************************************************************** -->
            <!-- ******************************************************************************************** -->

        <div class="col-lg-12" id="FullTabla">
            <div class="col-xs-2"><button class="btn btn-info btn-block" onclick="Novo();">Nuevo</button></div>
            <div class="col-xs-3" style="width: 19%;">
                <a onclick="VerTodos();" class="btn btn-danger">Todos</a>
                <a class="btn btn-success" onclick="ML();">Respuestos</a>
            </div>
            <div class="col-xs-6 form-group input-group">
                <span class="input-group-addon">Buscar:</span>
                <input type="text" class="form-control" placeholder="Buscar" id="Buscar" autocomplete="off" >
            </div>
<br>
            <div id="ListaArt" >
                <table width="100%" class="table  table-bordered sortable" id="LART">
                    <thead class="Titulo">
                    <tr >
                        <th style="width: 40px;"> Orden </th>
                        <th style="width: 91px;"> Fecha</th>
                        <th style="width: 51px;"> IMEI </th>
                        <th style="width: 78px;"> Dispositivo</th>
                        <th style="width: 214px;"> Falla </th>
                        <th> Cliente </th>
                        <th style="width: 80px;"> Telefono </th>
                        <th style="width: 41px;"> Restan </th>
                        <th style="width: 55px;"> Estado </th>
                        <th style="width: 120px;"> Menu </th>
                    </tr>
                    </thead>
                <tbody id="LstEquipos">
                    <tr ondblclick="E(0)">
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td ondblclick="SR(0)">7</td>
                        <td ondblclick="ER(0)">8</td>
                        <td ondblclick="N(0)">9</td>
                        <td ondblclick="R(0);">10</td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div><!-- Fin col de la tabla -->


    </div>
    <!-- fin row -->
<style>
    #lstR tbody td:nth-child(1){text-align: center;}
    #lstR tbody td:nth-child(3){text-align: right;}
    .control-sidebar-bg{position:fixed;z-index:1000;bottom:0}
    .control-sidebar{
        top:100px;
        right:10px;
        border-radius: 20px;
        padding: 5px;
        color: rgba(242,248,255,0.97);
        -webkit-transition:right .3s ease-in-out;
        -o-transition:right .3s ease-in-out;
        transition:right .3s ease-in-out;
        background: rgba(76, 105, 110, 0.88);
    }
    .control-sidebar{
        position:absolute;
        padding-top:20px;
        z-index:1010}
    @media (max-width:768px){
        .control-sidebar{padding-top:20px}
    }
</style>
<div class="NV" id="PreRes">
 <div style=" width: 100%;height: 500px; "  >
     <div class="form-group input-group" style="z-index: 100;">
         <button class="btn btn-danger btn-circle btn-xs" style="float:right; " onclick="ML();" >X</button>
         <h4 class="TC">Repuetos</h4>
         <section id="intro" style="color:black;">
             <select id="IDEqui" onchange="LRESPU(this.value)">
                 <?php echo $Equipos; ?>
             </select>
         </section>
     </div>
     <hr>
     <table class="table table-bordered sortable" id="lstR" width="100%;">
         <thead class="Titulo">
         <tr><th style="width: 20px;"> Stock </th>
             <th>Respuesto</th>
             <th style="width:21px;"> T1</th>
             <th style="width:21px;"> T2</th>
             <th style="width:21px;"> T3</th>
         </thead>
         <tbody id="LstRepus">
            <tr><td></td><td></td><td></td></tr>
         <tr>
     </table>
</div>
</div>
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
    <script src="../dist/js/sb-admin-2.js?1"></script>

<script>
    var verEquipos=0 ;

  function Novo(){
        document.getElementById('NAPARATO').classList.toggle('NV');
        document.getElementById('NAPARATO').classList.toggle('col-lg-4');
        document.getElementById('FullTabla').classList.toggle('col-lg-8');
        document.getElementById('FullTabla').classList.toggle('col-lg-12');
        Limpiar();
        document.getElementById('Cliente').focus();
    }
  function PrintEquipo(x){

        if(x==0) {x= parseInt(document.getElementById('ID').innerHTML ); }
            var url = "OrdenEquipo.php?ID=" + x;
            window.open(url, '', 'width=330,height=252,scrollbars=NO,statusbar=NO,left=500,top=250');

    };
  function Restan() {
        var val1 = document.getElementById('Total').value;
        var val2 = document.getElementById('Sena').value;

        if ( isNaN(val1)){
            document.getElementById('Total').value="0.00";
            val1 =0.00;
        }

        if (  isNaN(val2) ){
            document.getElementById('Sena').value="0.00";
            val2 =0.00;
        }
            document.getElementById('Restan').value=( val1 - val2 ).toFixed(2);
    }
  function Limpiar(){
        document.getElementById('ID').innerHTML="0";
        document.getElementById('NOrden').value="";
        document.getElementById('Cliente').value="";
        document.getElementById('Tel').value="";
        document.getElementById('Equipo').value="";
        document.getElementById('EMEI').value="";
        document.getElementById('Falla').value="";
        document.getElementById('RTecnico').value="";
        document.getElementById('Estado').selectedIndex="0";
        document.getElementById('Total').value="";
        document.getElementById('Sena').value="";
        document.getElementById('Restan').value="";
        chkCambia2('Tapa',0);
        chkCambia2('Bata',0);
        chkCambia2('Chip',0);
        chkCambia2('Memo',0);
        document.getElementById('FechaE1').innerHTML="";
        document.getElementById('FechaE2').innerHTML="";
        document.getElementById('FechaE3').innerHTML="";
    }
  function GraAparato(){

       var ID=document.getElementById('ID').innerHTML ;
       var Atendio="<?php echo $_SESSION['real']; ?>";
       var NOrden=document.getElementById('NOrden').value ;
       var Cliente=document.getElementById('Cliente').value.toUpperCase().trim() ;
       var Equipo= document.getElementById('Equipo').value.toUpperCase().trim() ;
       var Tel=document.getElementById('Tel').value.toUpperCase();
       var EMEI= document.getElementById('EMEI').value.trim() ;
       var Falla= document.getElementById('Falla').value.replace(/([\ \t]+(?=[\ \t])|^\s+|\s+$)/g, '');
            Falla=Falla.replace("\n"," ");
       var RTecnico= document.getElementById('RTecnico').value.replace(/([\ \t]+(?=[\ \t])|^\s+|\s+$)/g, '');
             RTecnico=RTecnico.replace("\n"," ");
       var Estado= document.getElementById('Estado').selectedIndex ;
       var Total= parseFloat(document.getElementById('Total').value).toFixed(2) ;
       var Sena= parseFloat(document.getElementById('Sena').value).toFixed(2);
       var Restan= parseFloat(document.getElementById('Restan').value).toFixed(2) ;
       var Tapa= (document.getElementById('Tapa').checked) ? 1:0 ;
       var Bata= (document.getElementById('Bata').checked) ? 1:0 ;
       var Chip= (document.getElementById('Chip').checked) ? 1:0;
       var Memo= (document.getElementById('Memo').checked) ? 1:0;

        if (isNaN(Total)){Total = 0; }
        if (isNaN(Sena)) {Sena = 0;}
        if (isNaN(Restan)) {Restan = Total-Sena;}


  // Logica
        if(Cliente.length<3){
            alert("Falta Cliente");
            document.getElementById('Cliente').focus();
            return;
        }
        if(Equipo.length<2){
            alert("Falta Equipo");
            document.getElementById('Equipo').focus();
            return;
        }
        if(EMEI.length<3){
            alert("Falta EMEI");
            document.getElementById('EMEI').focus();
            return;
        }
        if(Falla.length<3){
            alert("Describa la la Falla");
            document.getElementById('Falla').focus();
            return;
        }
  // Fin logica
   if(ID>0){ //update
       var d={M:3,ID:ID,Local:Local,User:Atendio,Cliente:Cliente,Equipo:Equipo,Tel:Tel,EMEI:EMEI,Falla:Falla,NOrden:NOrden,RTecnico:RTecnico,Estado:Estado,Total:Total,Sena:Sena,Restan:Restan,Tapa:Tapa,Bata:Bata,Chip:Chip,Memo:Memo};
   }else{
      var d={M:1,ID:ID,Local:Local,User:Atendio,Cliente:Cliente,Equipo:Equipo,Tel:Tel,EMEI:EMEI,Falla:Falla,NOrden:NOrden,RTecnico:RTecnico,Estado:Estado,Total:Total,Sena:Sena,Restan:Restan,Tapa:Tapa,Bata:Bata,Chip:Chip,Memo:Memo};
   }
        $.post("repa/FEquipo.php", d, function(result){
            console.log(result);
            if(document.getElementById('imprimir').checked){ PrintEquipo(result); }
            Limpiar();
            CerrarTodo();
        });//Fin Post
    }
  function CerrarTodo() {
      document.getElementById('NAPARATO').classList.add('NV');
      document.getElementById('NAPARATO').classList.remove('col-lg-4');
      document.getElementById('FullTabla').classList.remove('col-lg-8');
      document.getElementById('FullTabla').classList.add('col-lg-12');
      document.getElementById('Buscar').focus();
      refrescar();
  }
  function chkCambia(id){
        if(id=="Tapa"){
            document.getElementById('T1').classList.toggle('btn-success');
        }
        if(id=="Bata"){
            document.getElementById('B1').classList.toggle('btn-success');
        }
        if(id=="Chip"){
            document.getElementById('C1').classList.toggle('btn-success');
        }
        if(id=="Memo"){
            document.getElementById('M1').classList.toggle('btn-success');
        }
        if(id=="imprimir"){
            document.getElementById('imprimir1').classList.toggle('btn-warning');
            document.getElementById('imprimir1').classList.toggle('btn-danger');
           (document.getElementById('imprimir').checked)? document.getElementById('imprimir1').innerHTML="IMPRIMIR" :document.getElementById('imprimir1').innerHTML="Sin Recibo";
        }
    }
  function chkCambia2(id,modo ) {
        if(id=="Tapa"){
            if(modo==1){
                //document.getElementById('T1').classList.remove('btn-info');
                document.getElementById('T1').classList.add('btn-success');
                document.getElementById('Tapa').checked=true;
            }else{
                document.getElementById('T1').classList.remove('btn-success');
               // document.getElementById('T1').classList.add('btn-info');
                document.getElementById('Tapa').checked=false;
            }
        }
        if(id=="Bata"){
            if(modo==1){
                document.getElementById('B1').classList.add('btn-success');
                document.getElementById('Bata').checked=true;
            }else{
                document.getElementById('B1').classList.remove('btn-success');
                document.getElementById('Bata').checked=false;
            }
        }
        if(id=="Memo"){
            if(modo==1){
                document.getElementById('M1').classList.add('btn-success');
                document.getElementById('Memo').checked=true;
            }else{
                document.getElementById('M1').classList.remove('btn-success');
                document.getElementById('Memo').checked=false;
            }
        }
        if(id=="Chip"){
            if(modo==1){
                document.getElementById('C1').classList.add('btn-success');
                document.getElementById('Chip').checked=true;
            }else{
                document.getElementById('C1').classList.remove('btn-success');
                document.getElementById('Chip').checked=false;
            }
        }
    }
  function refrescar() {
      CargaEquipos();
      mPedir();
      Mensajes();
    }
  function CargaEquipos(){
        var d={};
        var url= "cgi/version.php?V=3&L=" + Local ;
      $.post(url, d, function (res) {
          if (res > verEquipos) {
                verEquipos = res;
                $("#LstEquipos").load("repa/ETabla.php?T=1&L="+Local, function (res) { });
            }// Fin IF
      });//

  }
  function VerTodos(){
         $("#LstEquipos").load("repa/ETabla.php?T=2&L="+Local, function (res) { });
   }
  function SR(ID){
        if(confirm("Entregar Equipo?")){
            CerrarTodo();
            var Atendio="<?php echo $_SESSION['real']; ?>";
            var d = {ID:ID,M:13,User:Atendio};
            $.post('repa/FEquipo.php', d, function (res) { console.log(res)});
        }

    }
  function ER(ID){

        if(confirm("Entregar equipo Reparado?")){
            CerrarTodo();
            var Atendio="<?php echo $_SESSION['real']; ?>";
            var d = {ID:ID,M:10,User:Atendio};
            $.post('repa/FEquipo.php', d, function (res) {   });
            //$(ID2).load("",d,function{});
        }

    }
  function R(ID){

        if(confirm("Marcar el Equipo como reparado?")){
            CerrarTodo();
            var Atendio="<?php echo $_SESSION['real']; ?>";
            var d = {ID:ID,M:11,User:Atendio};
            $.post('repa/FEquipo.php', d, function (res) {
                console.log(res);
            });
            //$(ID2).load("",d,function{});
        }
    }
  function N(ID){
        if(confirm("El Equipo no se puede reparar")){
            CerrarTodo();
            var Atendio="<?php echo $_SESSION['real']; ?>";
            var d = {ID:ID,M:12,User:Atendio};
            $.post('repa/FEquipo.php', d, function (res) { console.log(res)});
        }
    }
    $(document).ready(function() {
        CargaEquipos();
        setInterval('refrescar()', 2500);

    });

</script>
<script>
    function CE(ID) {
        var d = {ID:ID,M:2};
        $.post('repa/FEquipo.php', d, function (res) {
            //console.log(res);
            document.getElementById('NAPARATO').classList.remove('NV');
            document.getElementById('NAPARATO').classList.add('col-lg-4');
            document.getElementById('FullTabla').classList.add('col-lg-8');
            document.getElementById('FullTabla').classList.remove('col-lg-12');
            document.getElementById('Sena').focus();
            var Datos = res.split("|");
            document.getElementById('ID').innerHTML=Datos[0];
            document.getElementById('NOrden').value=Datos[1];
            document.getElementById('Cliente').value=Datos[2];
            document.getElementById('Equipo').value=Datos[3];
            document.getElementById('Tel').value=Datos[4];
            document.getElementById('EMEI').value=Datos[5];
            document.getElementById('Falla').value=Datos[6];
            document.getElementById('RTecnico').value=Datos[7];
            document.getElementById('Total').value=Datos[8];
            document.getElementById('Sena').value=Datos[9];
            document.getElementById('Restan').value=Datos[10];
            chkCambia2('Tapa',Datos[11]);
            chkCambia2('Bata',Datos[12]);
            chkCambia2('Chip',Datos[13]);
            chkCambia2('Memo',Datos[14]);
            document.getElementById('FechaE1').innerHTML= Datos[15]+'<br>'+Datos[16];
            if(Datos[18].length >3){
                document.getElementById('FechaE2').innerHTML= Datos[17]+'<br>'+Datos[18];
            }else{
                document.getElementById('FechaE2').innerHTML=" ";
            }
            if(Datos[20].length >3){
                document.getElementById('FechaE3').innerHTML= Datos[19]+'<br>'+Datos[20];
            }else{
                document.getElementById('FechaE3').innerHTML=" ";
            }
            document.getElementById('Estado').selectedIndex=Datos[21];

        });
    }

    function ML() {
            document.getElementById('PreRes').classList.toggle("control-sidebar");
            document.getElementById('PreRes').classList.toggle("NV");
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
            jQuery("#LART tbody>tr").hide();
            jQuery("#LART td:contiene-palabra('" + jQuery(this).val() + "')").parent("tr").show();
        }
        else {
            jQuery("#LART tbody>tr").show();
        }
    });

</script>
<script>
    $(setup)

    function setup() {
        $('#intro select').zelect({ placeholder:'Equipo ' })
    }

</script>
<script>
    function LRESPU(id){
        $("#LstRepus").load("cgi/LDComplementa.php?T=70&D="+id,function (){});
    }
</script>

</body>
</html>