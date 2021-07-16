<?php
require 'basedatos.php';

//Clase usuario
class Usuario{
	//PROPIEDADES DE LOS OBJETOS
	private $uname;//identicador unico de un animal 
	private $uemail;//nombre del animal
	private $password;//fotografia del animal
	private $web;//descripcion del animal
	private $usertype;//estado en el que se encuentra el animal
	private $photou;//tipo de animal
	//METODOS

	//constructor de la clase usuario
	
	public function __construct(){}

	//Getters y setters
	public function setUname($uname){
		$this->uname=$uname;
	}
	public function getUname(){
		return $this->$uname;
	}
	public function setUemail ($uemail){
		$this->uemail=$uemail;
	}
	public function getUemail()
	{
		return $this->$uemail;
	}
	public function setPassword($password){
		$this->password=$password;
	}
	public function getPassword(){
		return $this->$password;
	}
	public function setWeb($web)
	{
		$this->web=$web;
	}
	public function getWeb()
	{
		return $this->$web;
	}
	public function setUsertype($usertype){
		$this->usertype=$usertype;
	}
	public function getUsertype(){
		return $this->$usertype;
	}
	public function setPhotou($photou){
		$this->photou=$photou;
	}
	public function getPhotou(){
		return $this->$photou;
	}
	
	//Obtencion de todos los usuarios de la tabla user de nuestra base de datos
	public static function obtenerUsuarios(){

		$consulta="SELECT * FROM user";
		try{
			$ejecutar=Basededatos::comprobarInstancia()->prepare($consulta);
			$ejecutar->execute();

		}catch(PDOException $e)
		{//Personalizar los errores !
			return false;
		}
	}
	//Obtencion de un usuario de la base de datos por el nombre de usuario

	public static function obtenerUsuarioId($uname){
		//Almacenamos la consulta de nuestra función
		$consulta="SELECT id FROM user WHERE uname=?";
		try{
			//ejecutamos la sentencia que hemos preparado
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			$ejecutar->execute(array($uname));	
			//Capturamos el resultado en la variable $row
			$row=$ejecutar->fetch(PDO::FETCH_ASSOC);
			//Devolvemos resultado
			return $row['id'];			
			
		}catch(PDOException $e){
			return $e->getMessage();
		}		
	}	

	//Actualización de lo datos de un usuario

	public static function actualizarUsuario($id,$uemail,$password){
		//almacenamos la consulta que vamos a ejecutar
		$consulta="UPDATE user SET uemail=?,password=? WHERE id=?";
		try{
			
			//preparamos la consulta
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			//Ejecutamos la sentencia
			return $ejecutar->execute(array($uemail,$password,$id));

		}catch(PDOException $e)	{
			return $e->getMessage();
		}
	}

	//Insercción de un nuevo usuario a la base de datos

	public static function registrarUsuario($uname,$uemail,$password,$web,$usertype,$photou){
				
			//almacenarmos la consulta que vamos a ejecutar
			$consulta="INSERT INTO user (uname,uemail,password,web,usertype,photou) VALUES (:uname,:uemail,:password,:web,:usertype,:photou)";
				
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
		
			return $ejecutar->execute(array(':uname'=> $uname,':uemail' => $uemail,':password' => $password,':web' => $web,':usertype' => $usertype,':photou' => $photou));
			
	}
	//Borrado de un usuario de la base de datos
	public static function borrarUsuario($id){
		//almacenamos la consulta que vamos a ejecutar
		$consulta="DELETE FROM user WHERE id=? ";
		
		$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			
		return $ejecutar->execute(array($id));	

	}
	//Login del usuario
	public static function loginUsuario($uname,$password)
	{		
		//almacenarmos la consulta que vamos a ejecutar
		$consulta="SELECT id FROM user WHERE uname=? AND password=? COLLATE utf8_bin";
		try{
			//ejectuarmos la sentencia preparada
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			$ejecutar->execute(array($uname,$password));
			
			//Capturamos las filas del resultado si es que hay algun usuario
			if($row = $ejecutar->fetch(PDO::FETCH_ASSOC)){
				return 1;
				
			}else{
				return 0;
			}
            
		}catch(PDOException $e){
			return $e->getMessage();
		}						
	

	}
	//Ontencion de la ruta relativa de la imagen del usuario
	public static function obtenerRutaImagen($uname)
	{

		//Almacenamos la consulta de nuestra función
		$consulta="SELECT rutaimagen FROM user WHERE uname=?";
		try{
			//ejecutamos la sentencia que hemos preparado
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			$ejecutar->execute(array($uname));	
			//Capturamos el resultado en la variable $row
			$row=$ejecutar->fetch(PDO::FETCH_ASSOC);
			//Devolvemos resultado
			return $row['rutaimagen'];
		
		}catch(PDOException $e){
			return $e->getMessage();
		}		
	
	}
	//Comprobamos la disponibilidad para el registro de un nuevo usuario que uname no esté ya registrado
	public static function disponibilidadUname($uname)
	{
		$consulta="SELECT id FROM user WHERE uname=?";
		try{
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);		
			$ejecutar->execute(array($uname));

			//Capturamos las filas del resultado si es que hay algun usuario
			if($row = $ejecutar->fetchAll(PDO::FETCH_ASSOC)){
				return 1;//si ya existe un usuario con ese uname
			}else{
				return 0;//si está disponible el nombre de usuario
			}

		}catch(PDOException $e){
			return $e->getMessage();
		}	
		
	}
	//Subida de la imagen de perfil mediante una ruta relativa que apunta a la carpeta donde realmente esta la fotografia
	public static function subirImagenPerfil($uname,$rutaimagen)
	{
		//Almacenamos la consulta que necesitamos para insertar la ruta de la imagen en la base de datos
		$consulta="UPDATE user SET rutaimagen=? WHERE uname=?";

		$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
		
		return $ejecutar->execute(array($rutaimagen,$uname));
	}
	//Obtencion del tipo de usuario (particula o protectora de animales)
	public static function obtenerTipoUsuario($uname)
	{
		//Almacenamos la consulta de nuestra función
		$consulta="SELECT usertype FROM user WHERE uname=?";
		try{
			//ejecutamos la sentencia que hemos preparado
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			$ejecutar->execute(array($uname));	
			//Capturamos el resultado en la variable $row
			$row=$ejecutar->fetch(PDO::FETCH_ASSOC);
			//Devolvemos resultado
			return $row['usertype'];
		
		}catch(PDOException $e){
			return $e->getMessage();
		}	

	}
};

?>