<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Cart extends Controller 
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
				$data['sub_total'] += $mytotal;
			}
		}
		
		$data['page_title']= "Panier";	
		// page_title est une sorte d indice indiquant le sens de la donnee

		//pour avoir acces aux settings des liens sociaux
		$setting = $this->load_model('Setting');
		$settings = $setting->get_all();
		$data['settings']=$settings;

		$this->view("eshop/cart",$data);
		//la vue se trouve dans le dossier eshop sous le nom index.php
		
	}

}

?>