<?php
require 'usuario.php';

//Comprobacion del usuario para hacer login
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//Capturamos los parametros que se envian
	$uname=$_POST['uname'];
	
	//Llamamos a la funcion
	$resultado=Usuario::obtenerRutaImagen($uname);

	echo $resultado;
		
};

?>