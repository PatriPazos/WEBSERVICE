<?php
require 'animal.php';
//Registro de un nuevo animal en la base de datos

if($_SERVER['REQUEST_METHOD']=='POST')
{

	//Datos que recibimos
	$id_user=$_POST['id_user'];
	$aname=$_POST['aname'];
	$description=$_POST['description'];
	$condicion=$_POST['condition'];
	$animaltype=$_POST['animaltype'];	
	$latitud=$_POST['latitud'];
	$longitud=$_POST['longitud'];
	$photo_decode=base64_decode($_POST['photo']);

	
	//Preparamos datos a insertar	
	$id=$id_user.uniqid();
	$directorio="img/pet";//ruta donde se almacenaran las imagenes del registro de animales
	$rutaimagen="http://lostandfoundpruebas.esy.es/";//capturo la ruta enviada desde la app
	$directorio_subida="$directorio/$id.jpeg";//indicamos el directorio de subida
	$photo=$rutaimagen.$directorio_subida;//concateno para completar la ruta y actualizar campo en la base de datos
		

	//consultamos el  usuario en la base de datos haciendo uso del array que creamos anteriormente
	$resultado=Animal::registrarAnimal($id_user,$aname,$photo,$description,$condicion,$animaltype,$latitud,$longitud);
	
	//Comprobamos que la inserción se haya hecho mostrando el siguiente mensaje.
	
	if($resultado==1){
		//Si se registra , subimos la imagen al directorio
		$subida=Animal::subirImagen($aname,$photo);
		//Paso la foto al directorio que hay en el servidor
		file_put_contents($directorio_subida,$photo_decode);
		
		if($subida)
		{
			echo "OK";
		}else{
			echo "Error subida";
		}
	}else{
		
			echo "Error registro";
		}
}
	



?>