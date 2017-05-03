<?php
  // error_reporting(E_ERROR);

	$conexion = mysqli_connect("localhost","root","","stockcm");
  		 if (!$conexion){
  		 	die("fallo de conexion" .mysql_error());
  		 }
		if (!mysqli_set_charset($conexion, "utf8")) {
    		printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($conexion));
		}
    mysqli_set_charset($conexion,"utf8");
    ?>
