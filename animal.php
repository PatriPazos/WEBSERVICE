<?php
require 'usuario.php';

//Clase animal
class Animal{
	
	//PROPIEDADES DE LOS OBJETOS
	private $id;//identicador unico de un animal 
	private $aname;//nombre del animal
	private $photo;//fotografia del animal
	private $description;//descripcion del animal
	private $condition;//estado en el que se encuentra el animal
	private $animaltype;//tipo de animal
	
	//METODOS
	
	//constructor de la clase animal
	public function __construct(){}

	//Getters y setters

	public function setAname($aname){
		$this->aname=$aname;
	}
	public function getAname(){
		return $this->$aname;
	}

	public function setPhoto($photo){
		$this->photo=$photo;
	}
	public function getPhoto(){
		return $this->$photo;
	}

	public function setDescription($description){
		$this->description=$description;
	}
	public function getDescription(){
		return $this->$description;
	}

	public function setCondicion($condicion){
		$this->condicion=$condicion;
	}
	public function getCondition(){
		return $this->$condicion;
	}

	public function setAnimaltype($animaltype){
		$this->animaltype=$animaltype;
	}
	public function getAnimaltype(){
		return $this->$animaltype;
	}

	//Obtencion de todos los animales de la tabla pet de nuestra base de datos

	public static function obtenerAnimales(){

		$consulta="SELECT * FROM pet ";
		try{
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			$ejecutar->execute();
			
			return $ejecutar->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			
			return $e->getMessage();
		}
	}
	//Obtencion de un animal de la tabla pet de nuestra base de datos
	public static function obtenerAnimal($id_user){

		$consulta="SELECT aname FROM pet WHERE id_user=?";

		try{
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			$ejecutar->execute(array($id_user));

		}catch(PDOException $e)
		{//Personalizar los errores !
			return false;
		}
	}

	//Obtencion  de un animal de la base de datos por el nombre del animal

	public static function obtenerAnimalId($aname){
		$consulta="SELECT aname FROM pet WHERE aname=?";
		try{
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			return $ejecutar->execute(array($aname));
		}catch(PDOException $e)
		{
			return false;
		}
	}	

	//Actualización de lo datos de un animal en nuestra base de datos

	public static function actualizarAnimal($id,$aname,$photo,$description,$condicion,$animaltype){
		//almacenamos la consulta que vamos a ejecutar
		$consulta="UPDATE pet SET aname=:aname,photo=:photo,description=:description,condicion=:condicion,animaltype=:animaltype WHERE id=:id";
		//preparamos la consulta
		$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
		//Ejecutamos la sentencia		
		return $ejecutar->execute(array(':aname'=> $aname,':photo' => $photo,':description' => $description,':condicion' => $condicion,':animaltype' => $animaltype,':photou' => $photou,':id'=>$id));
	}

	//Insercción de un nuevo animal a la base de datos
	public static function registrarAnimal($id_user,$aname,$photo,$description,$condicion,$animaltype,$latitud,$longitud){
			
			//almacenarmos la consulta que vamos a ejecutar
			$consulta="INSERT INTO pet (id_user,aname,photo,description,condicion,animaltype,latitud,longitud) VALUES (?,?,?,?,?,?,?,?)";		
			//preparamos la sentencia
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			//ejecutamos la sentencia
			return $ejecutar->execute(array($id_user,$aname,$photo,$description,$condicion,$animaltype,$latitud,$longitud));
			
		
	}
	//Borrado de un animal de la tabla pet de la base de datos 

	public static function borrarAnimal($id){
		//almacenamos la consulta que vamos a ejecutar
		$consulta="DELETE FROM pet WHERE id=? ";
		
		$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			
		return $ejecutar->execute(array($id));	

	}
	//Obtencion de la ruta de la imagen para cargar en el perfil del animal
	public static function obtenerRutaImagen($aname)
	{

		//Almacenamos la consulta de nuestra función
		$consulta="SELECT photo FROM pet WHERE aname=?";
		try{
			//ejecutamos la sentencia que hemos preparado
			$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
			$ejecutar->execute(array($aname));	
			//Capturamos el resultado en la variable $row
			$row=$ejecutar->fetch(PDO::FETCH_ASSOC);
			//Devolvemos resultado
			return $row['photo'];
		
		}catch(PDOException $e){
			return $e->getMessage();
		}		
	
	}
	//Subida de la imagenes al servidor mediante la ruta relativa que apunta a la carpeta donde se encuentra la fotografia
	public static function subirImagen($aname,$photo)
	{
		//Almacenamos la consulta que necesitamos para insertar la ruta de la imagen en la base de datos
		$consulta="UPDATE pet SET photo=? WHERE aname=?";

		$ejecutar=Basededatos::comprobarInstancia()->bd()->prepare($consulta);
		
		return $ejecutar->execute(array($photo,$aname));
	}

};

?>