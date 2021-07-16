<?php
require 'usuario.php';
//Registro de un nuevo usario en la base de datos

if($_SERVER['REQUEST_METHOD']=='POST')
{
	//Damos formato Json un array que usaremos para actualizar el usuario en la base de datos
	$uname=$_POST['uname'];
	$uemail=$_POST['uemail'];
	$password=$_POST['password'];
	
	$id=Usuario::obtenerUsuarioId($uname);
	
	//Actualizamos un usuario en la base de datos haciendo uso del array que creamos con los valores a actualizar
	$resultado=Usuario::actualizarUsuario($id,$uemail,$password);
	//Comprobamos que la inserción se haya hecho mostrando el siguiente mensaje.
	if($resultado){
		echo "OK";
	}else{
		echo "ERROR";
	}
}


?>