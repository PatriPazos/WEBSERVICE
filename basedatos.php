<?php
require_once 'conexion.php';

/*Clase que servirá para crear los objetos PDO que usarremos para conectar la base de datos*/
class Basededatos
{    
    //Objetos PDO
     private static $pdo;//objeto que almacenará la conexion 
     private static $bd=null;//objeto de la clase Basededatos

    //Constructor de PDO
    final private function __construct()
    {
        try { /*llamamos la funcion para que nos devuelva una conexion a nuestra base de datos */         
        self::bd();
        } catch (PDOException $e) {
          echo "¡Ha ocurrido un error!: " + $this->$e;
        }

        return $pdo;
    }
    //Funcion para evitar la clonacion de objetos
    final private function __clone() 
    {
         echo("No puedes clonar este objeto, es unico");
    }

    //Comprobamos si existe una unica instancia de la clase
    public static function comprobarInstancia()
    {
        if (self::$bd === null) {
             self::$bd = new self();
            }
        
        return self::$bd;
    
    }  
    public static function bd(){
        if (self::$pdo == null) {/*comprobamos que este a null la instancia*/
            self::$pdo = new PDO('mysql:dbname=' . DATABASE . ';host=' . HOSTNAME,USERNAME,PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //habilito excepciones
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }  
        
    //Destructor del objeto PDO
    function destructor()
    {
        self::$pdo = null;
    }
}
?>