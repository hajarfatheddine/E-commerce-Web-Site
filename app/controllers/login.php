<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core 

class Login extends Controller
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode
{

	public function index($a='') // les valeurs sont optionnels
	{

		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		$data['page_title']= "Login";
		// page_title est une sorte d indice indiquant quelle donnee
		if ($_SERVER['REQUEST_METHOD']=="POST") 
		{

			//show($_POST);
			$user = $this->load_model("User");
			//retourne une instance de la classe User, 
			//ainsi on peut utiliser les methodes du model User (classe User)
			$user->login($_POST);
			//on passe les donnes postees et places dans $_POST a la fonction login()
			//qui permet de rediriger vers home si tout va bien

		}
		
		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;
		
		$this->view("eshop/login",$data); //la vue se trouve dans le dossier eshop sous le nom login.php
		//une fois la page login.php (view) demandee, le controleur login.php est appele
		//il affiche la page login.php et les données du formulaire sont alors saisies et soumises 
		//au serveur, grace au bouton submit, la page login.php est donc rechargee une 2 fois, 
		//et le controleur est appele une 2 fois, ce qui permet de faire le traitement ci-dessus
		//puisque maintenant $_POST est vrai. 
		
	}

}

?>