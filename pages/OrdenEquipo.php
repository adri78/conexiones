<?php
/* ********************************************************************** */

include 'cgi/config2.inc';
mysqli_set_charset($conexion,"utf8");
if (!mysqli_set_charset($conexion, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
}

$Local=0;
$N=0;
$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
//$formatter->formatCurrency( $row["Precio"], 'USD'), PHP_EOL

if(isset($_GET["ID"])){ $ID=$_GET["ID"]; }
if(isset($_GET["L"])){ $Local=$_GET["L"];}
if(isset($_GET["N"])){ $N=$_GET["N"]; }



$sql="SELECT `idEqui`, `Cliente`, `Telefono`, `Equipo`, `Emai`, `Num`, `Monto`, `Senia`, `Restan`, `UE`, `UT`, `UV`, `Falla`, `Tecnico`, `FE`, `FT`, `FV`, `Chip`, `Tapa`, `Bateria`, `Memo`, `Local`, `Estado` FROM `t_equipo`";

if ($ID>0){
    $sql=$sql." WHERE `idEqui`='".$ID."' ;";
}else{
    if ($Local<1){ $Local=$_SESSION['Local1'];}
    $sql=$sql." WHERE ((`Local`= '".$Local."') AND( `Num`='".$N."')) ;";
}

$segmento = mysqli_query($conexion,$sql);

while ($row = mysqli_fetch_array($segmento)){

    $Cliente=$row["Cliente"];
    $ID=$row['idEqui'];
    $Tel= $row["Telefono"];
    $Equipo= $row["Equipo"];
    $EMAI= $row["Emai"];
    $NOrden=str_pad( $row["Num"] , 5, "0", STR_PAD_LEFT);
    $Costo= $formatter->formatCurrency( $row["Monto"], 'USD') ;
    $Sen= $formatter->formatCurrency( $row["Senia"], 'USD');
    $Retan= $formatter->formatCurrency( $row["Restan"], 'USD')  ;
    $UE= $row["UE"] ;
    $UT= $row["UT"] ;
    $UV= $row["UV"] ;
    $Falla= $row["Falla"] ;
    $Obs= $row["Tecnico"] ;
    $FE=  substr ($row["FE"],0,10);
    $FT= $row["FT"] ;
    $FV= $row["FV"] ;
    $Chip= ($row["Chip"])? "SI": "NO";
    $Tapa= ($row["Tapa"])? "SI": "NO" ;
    $Bate=($row["Bateria"])? "SI": "NO" ;
    $Memo= ($row["Memo"])? "SI": "NO" ;
    $Local= $row["Local"] ;
    $Estado= $row["Estado"] ;

    switch ($Estado) {
        case 0:
            $Clase="";
            $esta="ESPERA";
            break;
        case 1:
            $Clase="Pre";
            $esta="Sin Reparación";
            break;
        case 3:
            $Clase="SR";
            $esta="Represupuestar";
            break;
        case 4:
            $Clase="Repa";
            $esta="Aprobado";
            break;
        case 5:
            $Clase="Entre";
            $esta="Entragado";
            break;
    } //Categoria

    if ($Local==1){
        $Local="SALTA 1391 (ADROGUE) TEL: 4236-3568";
        $Loc="Adrogue";
    }
    if ($Local==2){
        $Local="R. Rojas 973 (Burzaco) Tel:3535-6767";
        $Loc="Burzaco";
    }
    if ($Local==3){
        $Local="Deposito";
        $Loc="Deposito";
    }

}// Fin while tabla ventas

/* ********************************************************************* */

?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
		body { font-size:12px;}
		
		hr {
			border:0px;
			border-bottom:1px solid #ccc;
		}
		
		table.table td {
			border-collapse: collapse;
			border:1px solid #ccc;
			padding: 4px;
			vertical-align: top 
		}
		a{text-decoration: none;}
		table td {
		vertical-align: top
		}
        .TJ{text-align: justify;}
        .ma {
            float:right;z-index:-1;position: absolute;padding-top: 5%;left: 1%;font-size: 1.5em;
        }

        .ma h1 {
            transform: rotate(-65deg);-webkit-transform: rotate(-65deg); opacity: 0.21;font-size: 2.4em;
        }
		</style>
	</head>

	<body onload="window.print()" onmouseover="window.close();">
		<table style="width:100%">
			
				<tbody><tr>
					<td style="width:45%; ">
					
					<div style="font-size:1em">
					
					<h2 style="text-align: center;"><strong>CONEXIONES MOVILES</strong></h2>
										<p style="text-align: center;"><?php echo $Local;?></p>
					
<p style="text-align: center;"><span style="font-size: 11pt;text-align: center;">SEGUI EL ESTADO DE TU REPARACION EN <b><a>WWW.CONEXIONESMOVILES.COM.AR</a></b></span> CON EL <b>N° DE ORDEN Y SERIE</b> QUE FIGURAN EN ESTE COMPROBANTE.

</p></div>

	<div style="font-size:0.6em;text-align: justify;">
					<p><strong><em><u>(IMPORTANTE: </u></em></strong><strong><em><u>NO SE ENTREGAN EQUIPOS SIN ESTE RECIBO)</u></em></strong></p>
<p>Sres.: Compañía de Radiocomunicaciones Móviles, Ciudad autónoma de Buenos Aires. Quien suscribe la presente, 
les informa, en carácter de declaración jurada, que el equipo cuyos datos figuran en 
la presente que solicito conectar el servicio de telefonía móvil y/o reparación que ustedes 
prestan, es de mi propiedad. Por medio de la firma al pie, el propietario del equipo se declaras 
en pleno conocimiento de lo siguiente: <u>Todo aparato dejado en el tallera efectos de ser reparado 
y/o confeccionar presupuesto, deberá ser retirado dentro de los 90 días a partir de la fecha, 
reparado o no, caso contrario se considera abandonado por su dueño</u>, Art. 2525 y 2526 del Código 
Civil, por lo que el taller dispondrá del aparato como crea conveniente, renunciando el propietario 
a exigir suma alguna en concepto de compensación y/o indemnización. Se deja constancia que las garantías 
de las reparaciones es de 30 días a partir del contrato y es solo por el trabajo realizado, no pudiendo el 
propietario hacer valer la misma si el aparato hubiese sido  abierto, desarmado, adulterado por personas ajenas 
a CONEXIONES MOVILES Ubicado en Salta 1391 San José (Adrogue) No tendrán Garantía si la faja de  seguridad 
de  reparación con fecha y nombre de  (Conexiones) se encuentra violada. <strong>LOS EQUIPOS INGRESADOS MOJADOS, 
SULFATADOS O CON RASTROS DE MOJADO, NO TENDRAN GARANTIA POR SU REPARACION.</strong> A tal efecto se declara 
conforme al recibir este documento y firma al pie de este, a todos los efectos, por los que se libran dos 
ejemplares del mismo tenor y a un solo efecto.</p>
						
					</div>
					</td>
					<td>
						<table style="width:100%" cellpadding="10">
							<tbody><tr>
								<td style="width:35%;vertical-align:top;padding-left: 0px;padding-right: 0px;">
									<h4 style="margin-bottom:5px; padding:0px 0px 0px 10px;">ORDEN DE SERVICIO</h4>
										 <div class="well" style=" background: #fff; padding:5px;">

									 	<table class="table" style="width:100%">
									 		<tbody><tr>
									 			<td>
									 				<b>Tapa:</b> <?php echo $Tapa; ?>
									 				<hr>
									 				<b>Bateria:</b> <?php echo $Bate; ?>
									 				<hr>
									 				<b>Chip:</b> <?php echo $Chip; ?>
									 				<hr>
									 				<b>Memoria:</b><?php echo $Memo; ?>
									 			</td>
									 		</tr>
									 	
									 	</tbody></table>
											 											
									</div>
																		
								</td>
																
									<td style="width:60% !important; vertical-align:top">
										
									<table style="width:100%">
										<tbody><tr>
											<td style="width:50%; text-align:right">
												<span style="Float: right;">Fecha: <span style="font-size:0.8em"><?php echo $FE; ?></span></span>
												<br>
												<span style="font-size:1.3em">N°ORDEN <?php echo $NOrden; ?></span>
											</td>
										</tr>
									</tbody></table>

									<div style="position: relative" >

										<table class="table" style="width:100%">
                                            <div class="ma">
                                                <h1><?php echo $Loc;?></h1>
                                            </div>
											<tbody><tr>
												<td>
													<b>Cliente:</b><?php echo $Cliente; ?> <hr>
													<b>Telefono:</b><?php echo $Tel; ?>
													<hr>
													<b>Dispositivo:</b><?php echo $Equipo; ?> <hr>
													<span style="font-size:1.2em">
													<b>N° SERIE:</b><?php echo $EMAI; ?>
													</span>
												</td>
											</tr>
										</tbody></table>
									</div>
								</td>
							</tr>
    <!--                    <tr><td colspan="2"><b>Falla:</b><?php echo $Falla; ?><hr><b>Obs:</b> <?php echo $Obs; ?> </td></tr> -->
                            <tr><td colspan="2"><b>Falla:</b><?php echo $Falla; ?><b></td></tr>
                            <tr><td colspan="2"><b>Obs:</b> <?php echo $Obs; ?> </td></tr>
                            <tr><td colspan="2" style="border: 1px solid black;"><b>Costo:</b><?php echo $Costo; ?><b style="padding-left: 30px;">/Seña:</b><?php echo $Sen; ?><b style="padding-left: 30px;">/Restan:</b><?php echo $Retan; ?></td></tr>
							<tr>
								<td colspan="2">
								  <div class="well" style=" background: #fff; padding-left:5px;">
								     <b>FIRMA: <span style="padding-left:144px; "> DNI:</span> </b>
						 				<hr>
                                      <b>ACLARACION:</b>
					 				</div>
								
								</td>
							
							</tr>
						
						</tbody></table>
			
					</td>
				</tr>
			
			</tbody></table>
        <div  style="width:100%;top:130mm;position: absolute;">
            <hr><hr>
            <br>
            <hr><hr><br>


	<!-- ******************************************************************************************************** -->
        <table> <!--  style="width:100%;top:167mm;" -->

            <tbody><tr>
                <td style="width:45%; ">
                    <div style="font-size:1em">

                        <h2 style="text-align: center;"><strong>CONEXIONES MOVILES</strong></h2>
                        <p style="text-align: center;"><?php echo $Local;?></p>

                        <p style="text-align: center;"><span style="font-size: 11pt;text-align: center;">SEGUI EL ESTADO DE TU REPARACION EN <b><a>WWW.CONEXIONESMOVILES.COM.AR</a></b></span> CON EL <b>N° DE ORDEN Y SERIE</b> QUE FIGURAN EN ESTE COMPROBANTE.

                        </p></div>

                    <div style="font-size:0.6em;text-align: justify;">
                        <p><strong><em><u>(IMPORTANTE: </u></em></strong><strong><em><u>NO SE ENTREGAN EQUIPOS SIN ESTE RECIBO)</u></em></strong></p>
                        <p>Sres.: Compañía de Radiocomunicaciones Móviles, Ciudad autónoma de Buenos Aires. Quien suscribe la presente,
                            les informa, en carácter de declaración jurada, que el equipo cuyos datos figuran en
                            la presente que solicito conectar el servicio de telefonía móvil y/o reparación que ustedes
                            prestan, es de mi propiedad. Por medio de la firma al pie, el propietario del equipo se declaras
                            en pleno conocimiento de lo siguiente: <u>Todo aparato dejado en el tallera efectos de ser reparado
                                y/o confeccionar presupuesto, deberá ser retirado dentro de los 90 días a partir de la fecha,
                                reparado o no, caso contrario se considera abandonado por su dueño</u>, Art. 2525 y 2526 del Código
                            Civil, por lo que el taller dispondrá del aparato como crea conveniente, renunciando el propietario
                            a exigir suma alguna en concepto de compensación y/o indemnización. Se deja constancia que las garantías
                            de las reparaciones es de 30 días a partir del contrato y es solo por el trabajo realizado, no pudiendo el
                            propietario hacer valer la misma si el aparato hubiese sido  abierto, desarmado, adulterado por personas ajenas
                            a CONEXIONES MOVILES Ubicado en Salta 1391 San José (Adrogue) No tendrán Garantía si la faja de  seguridad
                            de  reparación con fecha y nombre de  (Conexiones) se encuentra violada. <strong>LOS EQUIPOS INGRESADOS MOJADOS,
                                SULFATADOS O CON RASTROS DE MOJADO, NO TENDRAN GARANTIA POR SU REPARACION.</strong> A tal efecto se declara
                            conforme al recibir este documento y firma al pie de este, a todos los efectos, por los que se libran dos
                            ejemplares del mismo tenor y a un solo efecto.</p>

                    </div>
                </td>
                <td>
                    <table style="width:100%" cellpadding="10">
                        <tbody><tr>
                            <td style="width:35%;vertical-align:top;padding-left: 0px;padding-right: 0px;">
                                <h4 style="margin-bottom:5px; padding:0px 0px 0px 10px;">ORDEN DE SERVICIO</h4>
                                <div class="well" style=" background: #fff; padding:5px;">

                                    <table class="table" style="width:100%">
                                        <tbody><tr>
                                            <td>
                                                <b>Tapa:</b> <?php echo $Tapa; ?>
                                                <hr>
                                                <b>Bateria:</b> <?php echo $Bate; ?>
                                                <hr>
                                                <b>Chip:</b> <?php echo $Chip; ?>
                                                <hr>
                                                <b>Memoria:</b><?php echo $Memo; ?>
                                            </td>
                                        </tr>

                                        </tbody></table>

                                </div>

                            </td>

                            <td style="width:60% !important; vertical-align:top">

                                <table style="width:100%">
                                    <tbody><tr>
                                        <td style="width:50%; text-align:right">
                                            <span style="Float: right;">Fecha: <span style="font-size:0.8em"><?php echo $FE; ?></span></span>
                                            <br>
                                            <span style="font-size:1.3em">N°ORDEN <?php echo $NOrden; ?></span>
                                        </td>
                                    </tr>
                                    </tbody></table>

                                <div style="position: relative">
                                    <table class="table" style="width:100%">
                                        <div class="ma">
                                            <h1><?php echo $Loc;?></h1>
                                        </div>
                                        <tbody><tr>
                                            <td>

                                                <b>Cliente:</b><?php echo $Cliente; ?> <hr>
                                                <b>Telefono:</b><?php echo $Tel; ?>
                                                <hr>
                                                <b>Dispositivo:</b><?php echo $Equipo; ?> <hr>
                                                <span style="font-size:1.2em">
													<b>N° SERIE:</b><?php echo $EMAI; ?>
													</span>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </div>
                            </td>
                        </tr>
      <!--                 <tr><td colspan="2"><b>Falla:</b><?php echo $Falla; ?><hr><b>Obs:</b> <?php echo $Obs; ?> </td></tr>-->
                        <tr><td colspan="2"><b>Falla:</b><?php echo $Falla; ?><b></td></tr>
                        <tr><td colspan="2"><b>Obs:</b> <?php echo $Obs; ?> </td></tr>
                        <tr><td colspan="2" style="border: 1px solid black;"><b>Costo:</b><?php echo $Costo; ?><b style="padding-left: 30px;">/Seña:</b><?php echo $Sen; ?><b style="padding-left: 30px;">/Restan:</b><?php echo $Retan; ?></td></tr>
                        <tr>
                            <td colspan="2">
                                <div class="well" style=" background: #fff; padding-left:5px;">
                                    <b>FIRMA: <span style="padding-left:144px; "> DNI:</span> </b>
                                    <hr>
                                    <b>ACLARACION:</b>
                                </div>

                            </td>

                        </tr>

                        </tbody></table>

                </td>
            </tr>

            </tbody></table>
        </div>

	</body></html>