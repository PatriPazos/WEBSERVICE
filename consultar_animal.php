<?php
require 'animal.php';


if($_SERVER['REQUEST_METHOD']=='GET'){
	
	//llamamos a la funcion que nos devuelve todos los animales existentes en la base de datos
	$animales=Animal::obtenerAnimales();
	
	
	if($animales){
		
		//print_r($animales); 
		//print_r($animales);//devolver un json
		//print_r($json);
		$json=json_encode($animales);
		
		print_r($json);

		}else{

		}
	
		
};

?>