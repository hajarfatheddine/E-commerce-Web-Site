<?php

Class Order extends controller //pour pouvoir acceder a load_model par le mot cle : this
{
	
	public $errors = array();

	public function validate($POST){

		$this->errors = array();
		foreach ($POST as $key => $value) {
			if ($key=="country") { //si $key est = l indice country
				if (($value=="")||($value=="-- Pays --")) { //c.a.d vide ou aucun choix
					$this->errors[] ="Entrer le nom de pays";
				}
			}

			if ($key=="city") { //si $key est = l indice city
				if (($value=="")||($value=="-- Ville --")) { //c.a.d vide ou aucun choix
					$this->errors[] ="Entrer le nom de ville";
				}
			}

			if ($key=="delivery_address") { //si $key est = l indice city
				if (empty($value)) { //c.a.d vide ou aucun choix
					$this->errors[] ="Entrer l'adresse de livraison";
				}
			}

			if ($key=="mobile") { //si $key est = l indice city
				if (empty($value)) { //c.a.d vide ou aucun choix
					$this->errors[] ="Entrer le numero de mobile";
				}
			}
			if ($key=="firstname") { //si $key est = l indice city
				if (empty($value)) { //c.a.d vide ou aucun choix
					$this->errors[] ="Entrer le prenom";
				}
			}
			if ($key=="lastname") { //si $key est = l indice city
				if (empty($value)) { //c.a.d vide ou aucun choix
					$this->errors[] ="Entrer le nom";
				}
			}
		}

	}
	public function save_order($POST,$total,$ROWS,$user_url,$session_id)
	{

		$db= Database::getInstance();

		//sauvegarder les commandes : orders
		if (is_array($ROWS)&&count($this->errors)==0) {
			$data=array();
			$data['user_url'] = $user_url;
			$data['delivery_address'] = $POST['delivery_address'];
			$data['total'] =$total;
			$data['tax'] =0;
			$data['shipping_cost'] =0;
			$data['date'] =date("Y-m-d H:i:s");
			$data['session_id'] =$session_id;
			$data['mobile'] =$POST['mobile'];
			$data['tel'] =$POST['tel'];
			$data['firstname'] =$POST['firstname'];
			$data['lastname'] =$POST['lastname'];
			$data['company'] =$POST['company'];

			$countries = $this->load_model('Countries');
			$data['country'] = $countries->get_country($POST['country']); 
			//lui passer le id de country pour retourner la chaine
			$data['city'] = $countries->get_city($POST['city']); 
			//lui passer le id de city pour retourner la chaine

			$query="insert into orders (user_url,delivery_address,total,tax,shipping_cost,date,session_id,mobile,tel,firstname,lastname,company,country,city) 
			values (:user_url,:delivery_address,:total,:tax,:shipping_cost,:date,:session_id,:mobile,:tel,:firstname,:lastname,:company,:country,:city)";

			$result=$db->write($query,$data);
		}

		//sauvegarder les details des commandes : orders details (lignes de commande)
		if (is_array($ROWS)&&count($this->errors)==0) {
			$data=array();
			$data['order_id'] = 0;
			$query="select id from orders order by id desc limit 1";
			$result=$db->read($query);
			if (is_array($result)){

				$order_id = $result[0]->id;
			}

			foreach ($ROWS as $row) {
				$data = array();
				$data['order_id'] = $order_id;
				$data['quantity'] = $row->cart_quantity;
				$data['description'] = $row->description;
				$data['price'] = $row->price;
				$data['total'] = $row->price*$row->cart_quantity;
				$data['product_id'] = $row->id;

				$query = "insert into order_details (order_id,quantity,description,price,total,product_id) values (:order_id,:quantity,:description,:price,:total,:product_id)";
				$result=$db->write($query,$data);
			}

		}

	}

	public function get_orders_by_user($user_url) {
		$db= Database::getInstance();
		$user_url = esc($user_url);
		$query="select * from orders where user_url = '$user_url'";
		$orders =$db->read($query);
		return $orders;

	}

	public function get_orders_count($user_url) {
		$db= Database::getInstance();
		$user_url = esc($user_url);
		$query="select * from orders where user_url = '$user_url'";
		$orders =$db->read($query);
		
		if ($orders) {
			return count($orders);
		} else
		{

		return 0;
		}

	}

	public function get_all_orders($url_address='') {
		$orders =false;
		$db= Database::getInstance();
		//show($url_address); die;
		if ($url_address=='all') { 
			
			$query="select * from orders order by id desc";
			$orders =$db->read($query);
			return $orders;
		} else if ($url_address=='no_pay') { 
			//remarque : si on appelle le controleur depuis sidebar.php avec :  ..../admin/orders
			//c est la methode orders qui sera executee avec comme parametre $url_address=home (vide)
			//mais ici on comme parametre la valeur: pay
			
			$query="select * from orders where pay = 'non'";
			$orders =$db->read($query);
			return $orders;
		} else {
			
			$query="select * from orders where user_url= '$url_address'";
			$orders =$db->read($query);
			return $orders;

		}

	}

	public function get_one($id) {
		$id = (int)$id;
		$order =false;
		$db= Database::getInstance();
		$query="select * from orders where  id = '$id' limit 1";
		$order =$db->read($query);
		return $order[0];

	}

	public function get_order_details($id) {
		$id = (int)$id;
		$details =false;
		$db= Database::getInstance();
		$query="select * from order_details where order_id = '$id' order by id desc";
		$details =$db->read($query);
		return $details;

	}

	public function change_url_address($url_address,$url_old){

		$db= Database::getInstance();
		$query="update orders set user_url= '$url_address' where user_url='$url_old'";
		$db->write($query);
		
	}

}

?>
