<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core  

class Add_to_cart extends Controller 
// prepare $data pour la passer a la vue a afficher
//chaque controleur est liee a une page et a aumoins une methode
{
	
	private $redirect_to="";

	public function index($id='') // les valeurs sont optionnels
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

		$this->set_redirect();
		$id=esc($id);
		
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		
		$ROWS=$db->read("select * from products where id = '$id' limit 1");
		//$ROWS va servir a chercher si le produit exsite dans la base des donnees
		if ($ROWS) //ce type de test est important sinon il genere des erreurs
		{
			$ROW =$ROWS[0];
			if (isset($_SESSION['CART'])){ // si on a deja un produit dans le panier 

				$ids=array_column($_SESSION['CART'], "id"); //placer les produits du panier selon id dand $ids
				if(in_array($ROW->id, $ids)){
					$key=array_search($ROW->id, $ids); //retourner sa position dans $_SESSION['CART'] (=$ids)
					$_SESSION['CART'][$key]['quantity']++; //incrementer sa quantite si le produit id existe deja
				}else
				{
					$arr=array();
					$arr['id']=$ROW->id;
					$arr['quantity']=1;
					$_SESSION['CART'][]=$arr; 
					//mettre le produit ajoute au panier dans la position suivante du tableau $_SESSION['CART'][]
					//la premiere position est 0
				}
			} else{
				$arr=array();
				$arr['id']=$ROW->id;
				$arr['quantity']=1;
				$_SESSION['CART'][]=$arr; 
				//mettre le produit ajoute au panier dans la position suivante du tableau $_SESSION['CART'][]
				//la premiere position est 
			}

		}
		header("Location:".ROOT."shop");
		
	}

	public function add_quantity($id='') // les valeurs sont optionnels
	{
		
		$this->set_redirect();
		$id=esc($id);
		if (isset($_SESSION['CART'])){
			foreach ($_SESSION['CART'] as $key => $item) {
				if ($item['id']==$id) {
					$_SESSION['CART'][$key]['quantity']++;
					break;	
				}
			}

		}
		$this->redirect();
	}

	public function subtract_quantity($id='') // les valeurs sont optionnels
	{
		$this->set_redirect();
		$id=esc($id);
		if (isset($_SESSION['CART'])){
			foreach ($_SESSION['CART'] as $key => $item) {
				if ($item['id']==$id) {
					$_SESSION['CART'][$key]['quantity']--;
					break;	
				}
			}

		}
		$this->redirect();
	}

	public function remove($id='') // les valeurs sont optionnels
	{
		$this->set_redirect();
		$id=esc($id);
		if (isset($_SESSION['CART'])){
			foreach ($_SESSION['CART'] as $key => $item) {
				if ($item['id']==$id) {
					unset($_SESSION['CART'][$key]);
					$_SESSION['CART']=array_values($_SESSION['CART']); 
					//The returned array will have the numeric keys, starting at 0 and increase by 1.
					show($_SESSION['CART']);
					break;	
				}
			}

		}
		$this->redirect();
	}


	private function redirect(){

		header("Location:".$this->redirect_to);

	}

	private function set_redirect(){
		if (isset($_SERVER['HTTP_REFERER'])&&($_SERVER['HTTP_REFERER']!="")) {
			$this->redirect_to = $_SERVER['HTTP_REFERER']; //url de la page qui a appelle la presente page
		}else {
			$this->redirect_to = ROOT."shop";
		}
		
	}
}

?>