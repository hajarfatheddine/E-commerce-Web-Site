<?php

class Controller  	// classe conteant les fonctions de base des controleurs
					//chaque controlleur sera definie dans le dossier controleurs
{

	public function view($path,$data = []) // valeur optionnelle
	{
		
		extract($data);
		// cela permet d acceder directemet aux variables du tableau
		// ainsi : si $data['name'] contient ahmed alors : $name contient aussi ahmed
		// donc on peut utiliser soit l une soit l autre

		if (file_exists("../app/views/".$path.".php")) 	// le point . permet une concatenation
		//cette fonction affiche la page : la vue specifiee par le chemin complet
		{												

			include "../app/views/".$path.".php"; 	
		} else
		{

			include "../app/views/"."eshop/"."404.php";	
		}


	}
	

	public function load_model($model) // valeur optionnelle
	{
		if (file_exists("../app/models/".strtolower($model).".class.php")) 	// le point . permet une concatenation
		//cette fonction affiche la page : la vue specifiee par le chemin complet
		{												

			include_once "../app/models/".strtolower($model).".class.php"; //include_once : pour pouvoir appeler cette methode load_model plusieurs fois dans un meme endroit sinon => des doubles declarations 
			return $a=new $model;
				
		}
		return false;

	}

}


?>