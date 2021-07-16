<?php
require 'usuario.php';
//Registro de un nuevo usario en la base de datos

if($_SERVER['REQUEST_METHOD']=='POST')
{
	//Damos formato Json un array que usaremos para consultar los datos del usuario	
	$uname=$_POST['uname'];
	$uemail=$_POST['uemail'];
	$password=$_POST['password'];
	$web=$_POST['web'];
	$usertype=$_POST['usertype'];
	$photou=$_POST['photou'];

	//Comprobamos que está disponible el nombre de usuario que vamos a registrar
	$disponibilidad=Usuario::disponibilidadUname($uname);

	if($disponibilidad==1){
		echo "NO";
	}else{
		//Encriptamos la contraseña para almacenarla de forma segura
		
		//consultamos el  usuario en la base de datos haciendo uso del array que creamos anteriormente
		$resultado=Usuario::registrarUsuario($uname,$uemail,$password,$web,$usertype,$photou);
	
		//Comprobamos que la inserción se haya hecho mostrando el siguiente mensaje.
		if($resultado==1){		
			echo "OK";
		}else{
		
			echo "ERROR";
		}
	}
	
}


?>