<?php
require 'usuario.php';

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$id=uniqid();

	$directorio="img";//ruta donde se almacenaran las imagenes

	$image=base64_decode($_POST["image"]);//la imagen a subir codificada
	$uname=$_POST["uname"];//capturo el nombre de usuario

	$rutaimagen="http://lostandfoundpruebas.esy.es/";//capturo la ruta enviada desde la app
	$directorio_subida="$directorio/$id.jpeg";//indicamos el directorio de subida

	$rutaimagen=$rutaimagen.$directorio_subida;//concateno para completar la ruta y actualizar campo en la base de datos

	file_put_contents($directorio_subida,$image);


	$resultado=Usuario::subirImagenPerfil($uname,$rutaimagen);

	if(resultado)
	{
		echo "OK";
	}else
	{
		echo "ERROR";
	}

	}

?>