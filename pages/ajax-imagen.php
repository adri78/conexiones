<?php
/**
 * Created by PhpStorm.
 * User: adri78
 * Date: 18/3/2017
 * Time: 12:45
 */

if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $nombre = $file["name"];
    $tipo = $file["type"];
    $ruta_provisional = $file["tmp_name"];
    $size = $file["size"];
    $dimensiones = getimagesize($ruta_provisional);
    $width = $dimensiones[0];
    $height = $dimensiones[1];
   // $carpeta = "";

   if ($tipo != 'image/jpg' && $tipo != 'image/jpeg' && $tipo != 'image/png' && $tipo != 'image/gif')
    {
        echo "Error, el archivo no es una imagen";
    }
    else if ($size > 1024*1024)
    {
        echo "Error, el tamaño máximo permitido es un 1MB";
    }
    else if ($width > 600 || $height > 600)
    {
        echo "Error la anchura y la altura maxima permitida es 600px";
    }
    else if($width < 60 || $height < 60)
    {
        echo "Error la anchura y la altura mínima permitida es 60px";
    }
    else
    {
        $src = "Logo.jpg";
        move_uploaded_file($ruta_provisional, $src);
        print "Actulizada";
       // echo "<img src='$src'>";
    }
}