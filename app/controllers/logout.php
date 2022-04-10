<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Logout extends Controller
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode. mais ici ce n est necessaire.
{
	//chaque controleur a une methode
	public function index() // les valeurs sont optionnels
	{
		$user = $this->load_model('User');
		$user->logout();
		
	}

}

?>