<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Admin extends Controller
{
	//chaque controleur a aumoins une methode
	public function index() // les valeurs sont optionnels
	{
		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //verifier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data; 
		}

		$data['page_title']= "Admin";
		// page_title est une sorte d indice indiquant le sens de la donnee
		
		$this->view("eshop/admin/index",$data);
		//la vue se trouve dans le dossier eshop/admin sous le nom index.php

	}

	public function categories() // les valeurs sont optionnels
	{
		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue

		}
		
		$db= Database::getInstance();
		$categories = $db->read("select * from categories order by id desc");
		$categories_activ = $db->read("select * from categories where disabled = 0 order by id desc");

		$categories=array_reverse($categories);

		$category =$this->load_model('Category'); 
		$tbl_rows = $category->make_table($categories);
		//prepare les donnees retournees sous forme de morceaux html
		//pour qu on puisse les placer dans : table_body sur la page categories
		$data['tbl_rows'] =$tbl_rows;
		//ceci permet d utiliser $tbl_rows une fois $data sera passe a la vue
		$data['categories_activ'] =array_reverse($categories_activ); 
		//ceci permet d utiliser $categories_activ une fois $data sera passe a la vue
		
		$data['page_title']= "Admin - categories"; 
		// page_title est une sorte d indice indiquant le sens de la donnee
		//ceci permet d utiliser $page_title une fois $data sera passe a la vue
		
		$this->view("eshop/admin/categories",$data);
		//la vue se trouve dans le dossier eshop/admin sous le nom categories.php
	}

	public function products() // les valeurs sont optionnels
	{
		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}
		
		$db= Database::getInstance();
		$products = $db->read("select * from products order by id desc");
		
		$categories = $db->read("select * from categories where disabled = 0 order by id desc");
		$data['categories'] =array_reverse($categories);
		//ceci permet d utiliser $categories une fois $data sera passe a la vue

		$product =$this->load_model('Product'); 
		// ce modele est aussi passe pour qu on puisse utiliser get_one() du modele

		$products=array_reverse($products);

		$tbl_rows =$product->make_table($products,$product); 
		//prepare les donnees retournees sous forme de morceaux html
		//pour qu on puisse les placer dans : table_body sur la page products
		$data['tbl_rows'] =$tbl_rows;
		//ceci permet d utiliser $tbl_rows une fois $data sera passe a la vue
		
		$data['page_title']= "Admin - produits"; 
		// page_title est une sorte d indice indiquant le sens de la donnee
		//ceci permet d utiliser $page_title une fois $data sera passe a la vue
		$this->view("eshop/admin/products",$data);
		//la vue se trouve dans le dossier eshop/admin sous le nom products.php
	}

	public function orders($url_address=''){
		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}

		//show($url_address); die;
		$order = $this->load_model('Order');
		$orders = $order->get_all_orders($url_address); 

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

		$data['page_title']= "Admin - commandes";
		$this->view("eshop/admin/orders",$data);
	}
	
	//confirme paiement d une commande
	public function confirm_pay($id,$url){ 
		$id=(int)$id;
		$pay="oui";
		$db= Database::getInstance();
		$query="update orders set pay= '$pay' where id='$id'";
		$db->write($query);
		$this->orders($url);

	}

	public function order_details($id,$url_address) {

		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}

		$order = $this->load_model('Order');
		$data['order'] = $order->get_one($id);
		$data['order_details']=  $order->get_order_details($id);	

		//show($orders);

		$data['page_title']= "Détails commande";
		// page_title est une sorte d indice indiquant le sens de la donnee
		
		$this->view("eshop/admin/order_details",$data);
		//la vue se trouve dans le dossier eshop sous le nom profile.php
	}

	public function users($type){

		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}
	
		if ($type=="admins") {
			
			$users = $user->get_admins();
		} else
		{

			$users = $user->get_customers();
		}
		

		$order = $this->load_model('Order');
		
		if ($users!=false){
			foreach ($users as $key => $user) {
				
				$users[$key]->orders_count = $order->get_orders_count($user->url_address);
				//nombre de commandes 
			}
			
			$data['users']= array_reverse($users);
			//show($users);
			//die;
		}
		
		$data['role']=$type;

		if ($type == "admins") {
			$data['page_title']= "Admin - admins";
		} else {
			$data['page_title']= "Admin - clients";
		}


		$this->view("eshop/admin/users",$data);
	}

	public function socials() { 

		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}
		
		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=array_reverse($settings);
		
		$data['page_title']= "Admin - Liens sociaux";

		if (count($_POST)) {
			$error= $setting->save($_POST);
			header("Location:".ROOT."admin/socials");

		}
		
		$this->view("eshop/admin/socials",$data);	

	}

	public function slider_images() { 

		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}

		//pour avoir acces aux settings des images sliders
		$slider_image = $this->load_model('Slider_image');
		$slider_images = $slider_image->get_all();
		$data['slider_images']=array_reverse($slider_images);
		
		$data['page_title']= "Admin - Images slider";
		
		$this->view("eshop/admin/slider_images",$data);	

	}

	public function info_slider_images($id=''){
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}

		//pour avoir acces aux settings d un image slider
		$slider_image = $this->load_model('Slider_image');
		$slider_image_one = $slider_image->get_one($id);
		$data['slider_image']= $slider_image_one;
		
		$data['page_title']= "Admin - Images slider";

		if (count($_POST)) {
			$error= $slider_image->save($_POST,$id);
			header("Location:".ROOT."admin/slider_images");
		}
		
		$this->view("eshop/admin/info_slider_images",$data);	

	}

	public function profile_url($url_address){
		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}
		

		$order = $this->load_model('Order');
		$orders = $order->get_all_orders($url_address); 

		$data['user_data_client']=$user->get_user($url_address);

		$data['orders']= $orders;
		//show($orders);

		$data['page_title']= "Admin - profile client";
		$this->view("eshop/admin/profile_url",$data);

	}

	public function delete_user($url_address){
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$query= "delete from users where url_address = '$url_address' limit 1";
		$db->write($query);
		header("Location:".ROOT."admin");
	}

	public function rapport () // les valeurs sont optionnels
	{
		
		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}

		$rapport = $this->load_model('Rapport');
		$rapports = $rapport->get_rapports(); 

		$data['rapports']= $rapports;
		//show($rapports);
		
	
		$data['page_title']= "Admin - Rapport de vente quotidien";
		$this->view("eshop/admin/rapport",$data);

	}

	public function rapport_m () // les valeurs sont optionnels
	{
		
		//pour voir si l utilisateur s est loge 
		$user = $this->load_model('User');
		$user_data = $user->check_login(true,["admin"]); //veirier si loge et si admin
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//ceci permet d utiliser $user_data une fois $data sera passe a la vue
		}

		$rapport = $this->load_model('Rapport');
		$rapports = $rapport->get_rapports_m(); 

		$data['rapports']= $rapports;
		//show($rapports);
		
	
		$data['page_title']= "Admin - Rapport de vente mensuel";
		$this->view("eshop/admin/rapport_m",$data);

	}

}	

?>