<?php

$usuario = substr ( $_POST['nn'],0,8);
$pass = md5( substr (  $_POST['np'],0,8));

if(empty($usuario) || empty($pass)){
	header("Location: ../index.php");
	exit();
}

mysql_connect('localhost','root','') or die("Error al conectar " . mysql_error());
mysql_select_db('stockcm') or die ("Error al seleccionar la Base de datos: " . mysql_error());

$result = mysql_query("SELECT * from ver where (( U='" . $usuario . "') and (P='".$pass."'));");

if($row = mysql_fetch_array($result)){
	if($row['P'] ==  $pass ){
		session_start();
		$_SESSION['usuario'] = $usuario;
        $_SESSION['ok1'] = 1;
        $_SESSION['Local1'] =$row['L'];
        $_SESSION['real'] =$row['nreal'];
        $_SESSION['AMSJ']=$row['idver'];
		header("Location: ../pages/index.php");

	}else{
		header("Location: ../index.php");
		exit();
	}
}else{
	header("Location: ../index.php");
	exit();
}


// SELECT `idver`, `U`, `P`, `L`, `A` FROM `ver` WHERE 1
/*
header("Location: ../index.php");
session_start();
$_SESSION['usuario'] = $usuario;
$_SESSION['ok1'] = 1;
$_SESSION['Local1'] =2;
header("Location: ../pages/index.php");
*/

/*
  // CIERRE DE SESIONES POR INACTIVIDAD

    $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");

    if(isset($_SESSION['usuario'])){
    $fechaGuardada = $_SESSION['ultimoAcceso'];
    $ahora = date("Y-n-j H:i:s");
    $tiempoTranscurrido = (strtotime($ahora)-strtotime($fechaGuardada);
    if($tiempo_transcurrido >= 2000) {   // 2 minutos
        session_destroy();
      header("Location: logout.php");
    }
    else {
        $_SESSION['ultimoAcceso'] = $ahora;
    }
    }

// FIN CIERRE DE SESIONES POR INACTIVIDAD
 *
 */
?>