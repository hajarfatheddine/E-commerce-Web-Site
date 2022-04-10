<?php


// c est le routeur 
class App 
{
	
	protected $controller="home"; // attribut avec home par defaut
	protected $method="index"; // attribut avec index par defaut
	protected $params;

	function __construct() 
	{

		$url = $this->parseURL(); // la fonction appartient a cette meme classe
		// show($url);
		if (file_exists("../app/controllers/".strtolower($url[0]).".php")) // le point permet une concatenation
		{
			$this->controller=strtolower($url[0]);
			unset($url[0]); //unset() détruit la variable (qui dispaqrit dans la varaible url)
		}
			
		require "../app/controllers/".$this->controller.".php";
		$this->controller = new $this->controller;
		// show($this->controller);
		// ici l attribut controleur devient un objet de type classe dont le nom est celui donne par le parametre $url[0]
		// et la classe se trouve sur un fichier de meme nom $url[0] dans le doosier controleurs 
		
		if (isset($url[1])) 
		{
			$url[1]=strtolower($url[1]);
			if (method_exists($this->controller,$url[1]))
			{

				$this->method=$url[1];
				unset($url[1]); //unset() détruit la variable (qui dispaqrit dans la varaible url)
			}

		}
		
		$this->params= (count($url)>0) ? array_values($url) : ["home"]; 
		// params contient les parametres restants, autres que le nom de la classe controleur et de la methode du controleur
		call_user_func_array([$this->controller,$this->method],$this->params); 
		//appel de le methode du controleur avec des params
		
	}

	
	private function parseURL()
	{
		$url = isset($_GET['url']) ? $_GET['url'] : "home"; 
		//isset détermine si une variable est définie et est différente de NULL
		// $_GET['url'] permet de recuperer les informations = url, c est a dire
		// les parametres qui viennent apres le lien de lq page demande 
		return explode("/",trim($url,"/"));
		//explode permet de prendre une chaîne et la couper en petits morceaux, 
		//trim supprime les espaces (ou d'autres caractères, ici le caractere /) en début et fin de chaîne

		//morceeau1: nom du : controller
		//morceeau2: nom de : method
		//morceeau3: nom du parametre pour recuperer des donnes de la base des donnees
		//morceeau4: nom du parametre pour recuperer des donnes de la base des donnees....


	}


}

?>