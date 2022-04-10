<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Signup extends Controller
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode
{

	public function index($a='') // les valeurs sont optionnels
	{

		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		$data['page_title']= "Signup";
		// page_title est une sorte d indice indiquant quelle donnee
		
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{

			//show($_POST);
			$user = $this->load_model("User");
			//retourne une instance de la classe User, 
			//ainsi on peut utiliser les methodes du model User (classe User)
			$user->signup($_POST); //comme la fonction signup de la classe User

		}

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/signup",$data);
		//la vue se trouve dans le dossier eshop sous le nom signup.php
	}

}

?>