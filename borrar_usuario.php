<?php
require 'usuario.php';
//Borrado de un usuario en lab ase de datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
    $usuario = json_decode(file_get_contents("php://input"), true);
    //Eliminamos el usuario de la base de datos con nombre de usuario uname
    $resultado = Usuario::borrarUsuario($usuario['id']);
	
	//Comprobamos mediante un mensaje que la eliminacion haya tenido exito
    if ($resultado) {
        $rjson = json_encode(array("Eliminacion" => 1,"mensaje" => "Eliminacion exitosa"));
		echo $rjson;
    } else {
        $rjson = json_encode(array("Eliminacion" => 2,"mensaje" => "No se elimino el registro"));
		echo $rjson;
    }
}
?>