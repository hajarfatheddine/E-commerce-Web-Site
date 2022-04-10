<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Profile extends Controller
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode
{
	
	public function index() // les valeurs sont optionnels
	{
		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login();
		//si on met rien comme parametre tout visiteur peut acceder
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data; 
			//show($user_data); die;
		}

		$order = $this->load_model('Order');
		$orders = $order->get_orders_by_user($user_data->url_address); 
		//sur la base de donnees est appelle : url_address et non user_url

		if (is_array($orders)) {

			foreach ($orders as $key => $row) {
				//ces deux lignes permettent d avoir avec chaque commande ses details
				$details = $order->get_order_details($row->id);
				$orders[$key]->details = $details;
				//mais cette methode n est pas utilisee. 
				//la methode utilsee est ci-dessous: order_details($id,$url_address)
				
				//ces deux lignes permettent d avoir avec chaque commande son client (important)
				$user_k = $user->get_user($row->user_url);
				$orders[$key]->user = $user_k;
			}
			
		}

		$data['orders']= $orders;
		//show($orders);

		$data['page_title']= "Profile personnel";
		// page_title est une sorte d indice indiquant le sens de la donnee

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/profile",$data);
		//la vue se trouve dans le dossier eshop sous le nom profile.php
		
	}

	public function order_details($id,$url_address) {

		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		$order = $this->load_model('Order');
		$data['order'] = $order->get_one($id);
		$data['order_details']=  $order->get_order_details($id);	

		//show($orders);

		$data['page_title']= "Détails commande";
		// page_title est une sorte d indice indiquant le sens de la donnee
		
		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/order_details",$data);
		//la vue se trouve dans le dossier eshop sous le nom profile.php
	}

	public function delete_user($url_address){
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$query= "delete from users where url_address = '$url_address' limit 1";
		$db->write($query);
		header("Location:".ROOT);

	}

	public function edit_user($id){
		
		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		$data['page_title']= "Signup edit";
		// page_title est une sorte d indice indiquant quelle donnee

		//recherche des anciens name et email et aussi l ancienne url_address
		$user = $this->load_model("User");
		$USER =$user->get_user_by_id($id);
		$data['name']= $USER->name;
		$data['email']= $USER->email;
		$url_old = $USER->url_address;
		
		if ($_SERVER['REQUEST_METHOD']=="POST")
		{

			//show($_POST);
			$user = $this->load_model("User");
			//retourne une instance de la classe User, 
			//ainsi on peut utiliser les methodes du model User (classe User)
			$user->signup_edit($_POST,$id,$url_old); //comme la fonction signup de la classe User

		}

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/signup_edit",$data);
		//la vue se trouve dans le dossier eshop sous le nom signup.php

	}

}

?>