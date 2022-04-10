<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Product_details extends Controller 
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode
{
	
	public function index($slag) // les valeurs sont optionnels
	//$slag est le slag passe lors de l appel du controleur avec : ....public/product_details/slag 
	{
		
		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		$slag = esc($slag);
		
		//pour voir si l utilisateur est loge 
		$user = $this->load_model('User');
		$user_data="";
		$user_data = $user->check_login();
		//show($user_data); ceci nous affiche $user_data sous forme d un objet
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//cette information permet d afficher le nom de l utilisateur sur la page (voir header.php)
		}

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		
		$ROWS=$db->read("select * from products where slag = '$slag'");
		//show($slag);die;

		if ($ROWS) //ce type de test est important sinon il genere des erreurs
		{
			$data['ROWS']=$ROWS[0]; // un seul produit
		} else

		{

			$data['ROWS']=false;
		}

		//get categories
		$category = $this->load_model('Category');
		$categories = $category->get_all();
		$data['categories'] = $categories;
		
		$data['page_title']= "Détails produit";
		// page_title est une sorte d indice indiquant le sens de la donnee

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/product_details",$data);
		//la vue se trouve dans le dossier eshop sous le nom product_details.php
		
	}

}

?>