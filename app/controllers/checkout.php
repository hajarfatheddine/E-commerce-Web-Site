<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Checkout extends Controller 
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode
{
	
	public function index() 
	{
		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		//pour voir si l utilisateur est loge 
		$user = $this->load_model('User');
		$user_data="";
		$user_data = $user->check_login(true);
		//si on met rien comme parametre tout visiteur peut acceder
		//show($user_data); ceci nous affiche $user_data sous forme d un objet
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//cette information permet d afficher le nom de l utilisateur sur la page (voir header.php)
		}

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		
		//mettre les donnees du panier dans $ROWS
		$prod_ids=array();

		if (isset($_SESSION['CART'])){ // si des produits sont dans le panier 
			$prod_ids=array_column($_SESSION['CART'], "id");
			$ids_str="'".implode("','", $prod_ids)."'"; // les affiche comme par exemple : 10,45,10
			$ROWS=$db->read("select * from products where id in ($ids_str)");
		} else

		{
			$ROWS=false;
		}

		$data['ROWS']=$ROWS;

		if (is_array($ROWS)){

			foreach ($ROWS as $key => $row) {
				foreach ($_SESSION['CART'] as $item) { 
				//$item : les produits ajoutes au panier et mis a jour dans add_to_cart.php
					if ($row->id==$item['id']) { 
					//si le id du produit dans la base des donnees = le id du produit ajoute au panier
						$ROWS[$key]->cart_quantity=$item['quantity'];
						//$key : position de l element $row
						//la quantite du produit ajoute au panier est place dans cart_quantity de $row
						//puis passe a la vue cart pour traitemet et calcul, mais non passe a la base des donnees
						break;}
									
				}				

			}

		}

		$data['sub_total']=0;
		if (is_array($ROWS)){
			foreach ($ROWS as $key => $row) {
				$mytotal = $row->price*$row->cart_quantity;
				$ROWS[$key]->total=$mytotal;
				$data['sub_total'] += $mytotal;
			}
		}
		
		$data['page_title']= "Paiement";	
		// page_title est une sorte d indice indiquant le sens de la donnee

		$countries = $this->load_model('Countries');
		$data['countries'] = $countries->get_countries();

		//verifier si ancien post data existe // non necessaire
		/*if (isset($_SESSION['POST_DATA'])) {

			$data['POST_DATA']=$_SESSION['POST_DATA'];
		}*/

		if(count($_POST) > 0){

			$order = $this->load_model('Order');
			$order->validate($_POST);

			$data['errors']=$order->errors;

			$_SESSION['POST_DATA'] = $_POST; //mettre les informations  saisis du client dans la session
			$data['POST_DATA'] = $_POST; //pour pouvoir les passer a la vue checkout par la suite
			//et pour pouvoir les utiliser aussi dans la methode summary ci-dessous (une fois appelee par l url ci-dessous : ROOT."checkout/summary")

			if (count($order->errors)==0) {

				header("Location:".ROOT."checkout/summary");
			}

		}

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/checkout",$data);
		//la vue se trouve dans le dossier eshop sous le nom index.php
		
	}

	public function summary()  {

		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		//pour voir si l utilisateur est loge 
		$user = $this->load_model('User');
		$user_data="";
		$user_data = $user->check_login(true);
		//si on met rien comme parametre tout visiteur peut acceder
		//show($user_data); ceci nous affiche $user_data sous forme d un objet
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//cette information permet d afficher le nom de l utilisateur sur la page (voir header.php)
		}

		$data['page_title']= "Paiement Résumé";

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		
		//mettre les donnees du panier dans $ROWS
		$prod_ids=array();

		if (isset($_SESSION['CART'])){ // si des produits sont dans le panier 
			$prod_ids=array_column($_SESSION['CART'], "id");
			$ids_str="'".implode("','", $prod_ids)."'"; // les affiche comme par exemple : 10,45,10
			$ROWS=$db->read("select * from products where id in ($ids_str)");
		} else

		{
			$ROWS=false;
		}

		$data['ROWS']=$ROWS;

		if (is_array($ROWS)){

			foreach ($ROWS as $key => $row) {
				foreach ($_SESSION['CART'] as $item) { 
				//$item : les produits ajoutes au panier et mis a jour dans add_to_cart.php
					if ($row->id==$item['id']) { 
					//si le id du produit dans la base des donnees = le id du produit ajoute au panier
						$ROWS[$key]->cart_quantity=$item['quantity'];
						//$key : position de l element $row
						//la quantite du produit ajoute au panier est place dans cart_quantity de $row
						//puis passe a la vue cart pour traitemet et calcul, mais non passe a la base des donnees
						break;}
									
				}				

			}

		}

		$data['sub_total']=0;
		if (is_array($ROWS)){
			foreach ($ROWS as $key => $row) {
				$mytotal = $row->price*$row->cart_quantity;
				$ROWS[$key]->total=$mytotal;
				$data['sub_total'] += $mytotal;
			}
		}

		$data['order_details'] = $ROWS;

		if (isset($_SESSION['POST_DATA'])) {
			$data['order_info'] = $_SESSION['POST_DATA'];
			//pour recuperer les chaines au lieu des id de : city et country
			$order_info = (object)$data['order_info'];
			$country_info = $order_info->country;
			$city_info = $order_info->city;
			$countries = $this->load_model('Countries');
			$data['country'] = $countries->get_country($country_info); 
			//lui passer le id de country pour retourner la chaine
			$data['city'] = $countries->get_city($city_info); 
			//lui passer le id de city pour retourner la chaine
		}
		

		//ceci n est possible que si on a confirme les informations (voir formulaire dans
		//checkout.summary.php), dans ce cas on va sauvagarder la commande sur la base de donnees
		if(($_SERVER['REQUEST_METHOD']=="POST")&&(isset($_SESSION['POST_DATA']))) {

			$session_id = session_id();
			
			//$user_url =""; // si on veut autoriser d acceder sans login on laisse cette initialisation

			if (isset($_SESSION['user_url'])){

				$user_url =$_SESSION['user_url'];

			}

			$order = $this->load_model('Order');
			$order->save_order($_SESSION['POST_DATA'],$data['sub_total'],$ROWS,$user_url,$session_id);
			//$_POST : contient les informations de facturation et de livraison
			//$ROW : contient les produits du panier et leurs quantites
			//$_SESSION['user_id'] : l utilisateur

			$data['errors']=$order->errors;
			if (count($order->errors)==0) {
				unset($_SESSION['CART']); // effacer les donnees de la session (infos panier)
				unset($_SESSION['POST_DATA']); //effacer les donnees de la session (infos client)
				header("Location:".ROOT."checkout/thank_you");
			}

		}

		//pour avoir acces aux settings  des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;
		
		$this->view("eshop/checkout.summary",$data); //page appelee checkout.summary.php
		//la vue se trouve dans le dossier eshop

	}

	public function thank_you(){

		$data['show_search'] = "no"; // pour ne pas afficher la barre de recherche dans ce cas (voir header)

		//pour voir si l utilisateur est loge 
		$user = $this->load_model('User');
		$user_data="";
		$user_data = $user->check_login(true);
		//si on met rien comme parametre tout visiteur peut acceder
		//show($user_data); ceci nous affiche $user_data sous forme d un objet
		if(is_object($user_data))
		{

			$data['user_data'] =$user_data;
			//cette information permet d afficher le nom de l utilisateur sur la page (voir header.php)
		}

		$data['page_title']= "Merci";

		//pour avoir acces aux settings  des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/checkout.thank_you",$data);

	}

}

?>