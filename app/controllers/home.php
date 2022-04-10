<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Home extends Controller 
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
			//show($find); die;
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
		
		$data['page_title']= "Home";	
		// page_title est une sorte d indice indiquant le sens de la donnee

		//get categories
		$category = $this->load_model('Category');
		$categories = $category->get_all();
		$data['categories'] = $categories;

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		//pour avoir acces aux settings des images sliders
		$slider_image = $this->load_model('Slider_image');
		$slider_images = $slider_image->get_all();
		$data['slider_images']=array_reverse($slider_images);
		
		if ($search && $ROWS){
			$this->view("eshop/shop",$data);
		} else 
		{
			$this->view("eshop/index",$data);
		//la vue se trouve dans le dossier eshop sous le nom index.php
		}
	}

}

?>