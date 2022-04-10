<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Shop extends Controller 
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode
{
	
	public function index() // les valeurs sont optionnels
	{
		
		//verifier si il y a une recherche (dans barre de recherche)
		$search =false;
		$data['show_search'] = "yes"; // pour afficher la barre de recherche dans ce cas (voir header)
		if (isset($_GET['find'])){
			$find =esc($_GET['find']);
			$search =true;
		}

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
		
		
		if ($search) { // pour rechercher sur la page shop

				$find="%".$find."%";
				$ROWS=$db->read("select * from products where description like '$find' order by id desc");

		} else {

			$ROWS=$db->read("select * from products order by id desc");

		}
		
		if ($ROWS) //ce type de test est important sinon il genere des erreurs
		{
			$data['ROWS']=$ROWS;

		} else

		{

			$data['ROWS']=false;
		}

		//get categories
		$category = $this->load_model('Category');
		$categories = $category->get_all();
		$data['categories'] = $categories;
		
		$data['page_title']= "Boutique";	
		// page_title est une sorte d indice indiquant le sens de la donnee

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/shop",$data);
		//la vue se trouve dans le dossier eshop sous le nom index.php
		
	}

	public function category($categ =''){

		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)
		
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
		
		//get categories
		$category = $this->load_model('Category');
		$categories = $category->get_all();
		$data['categories'] = $categories;

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire

		$category = $category->get_id($categ); 
		//car category d un produit est un nombre (sur la base des donnees)

		$ROWS=$db->read("select * from products where category = '$category' order by id desc");
		
		if ($ROWS) //ce type de test est important sinon il genere des erreurs
		{
			$data['ROWS']=$ROWS;

		} else

		{

			$data['ROWS']=false;
		}

		$data['page_title']= "Boutique";

		//pour avoir acces aux settings  des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/shop",$data);

	}

}

?>