<?php

Class Database
{
	public static $con; //utilise pour pour etablir une connexion  
	//static: appartient a toute la classe, pour avoir une seule connection a la base de donnees
	public static $instance;
	public function __construct()
	{

		try
		{
			$string=DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME;
			self::$con=new PDO($string,DB_USER,DB_PASS);

			//self:: est utilsee a la place de this-> dans le cas d un attribut static
			//PHP Data Objects (PDO) est une extension définissant l'interface pour accéder à une base de données //avec PHP. Elle est orientée objet, la classe s’appelant PDO. PDO constitue une couche d'abstraction //qui intervient entre l'application PHP et le système (SGDB) tel que MySQL 

		}
		catch (PDOException $e)
		{

				die($e->getMessage());
				//La fonction die() affiche un message et permet de quitter le script en cours.
		}
	}

	public static function getInstance() 
	{
		if (isset($instance)) //pour ne pas creer une connexion qui existe deja
		{

			return self::$instance; //retourne une instance de Database, la connexion est etablie : $con
		}

		
		return $instance= new self(); //retourne une instance de Database en etablissant une connexion : $con
	}
	
	public static function newInstance() 
	{
		return $instance= new self(); //retourne une instance de Database en etablissant une connexion : $con
	}

	//lire a partir de la base de donnees
	public function read($query, $data=array())
	{

		$stm=self::$con->prepare($query); //preparer la requette, ici on utilise la connexion self::$con
		$result=$stm->execute($data);//executer la requette
		if ($result)
		{
			$data=$stm->fetchAll(PDO::FETCH_OBJ); //rechercher les donnees
			if (is_array($data)&&count($data)>0) //un tableau et non vide
			{
				return $data;
			}

		return false;

		}
	}

	//ecrire dans la base de donnees
	public function write($query, $data=array())
	{
		$stm=self::$con->prepare($query); //preparer la requette, ici on utilise la connexion self::$con
		$result=$stm->execute($data);//executer la requette
		if ($result) // retourne true en cas de succes
		{
			return true;
		}

		return false;

	}
}

$db= Database::getInstance(); 
//:: acces a la fonction getInstance static
//qui retourne une instance de la basse de donnees 
//ce qui permet d acceder aux methodes de la classe Database

$data=$db->read("describe users"); //requette pour decrire les utilisateurs


?>