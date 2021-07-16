<?php
require 'usuario.php';

//Comprobacion del usuario para hacer login
if($_SERVER['REQUEST_METHOD']=='POST')
{
	//Damos formato Json un array que usaremos para consultar los datos del usuario	
	$uname=$_POST['uname'];
	$password=$_POST['password'];

	//consultamos el  usuario en la base de datos haciendo uso del array que creamos anteriormente
	$resultado=Usuario::loginUsuario($uname,$password);

	//Comprobamos que se loguea el usuario en la base de datos mostrando el siguiente mensaje
	if($resultado==1)
	{
		$tipo_usuario=Usuario::obtenerTipoUsuario($uname);
		echo $tipo_usuario;

	}else{

		echo "No se ha podido loguear";
		
	}
	
};

?>