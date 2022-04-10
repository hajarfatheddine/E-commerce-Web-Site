<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core
 // cette classe n est pas liee a une page comme les autres controleurs mais  
 // permet de retourner (vers une page) seulement des donnees suite a une requette (de cette page)

Class Ajax_product extends Controller

{
	
	public function index() // les valeurs sont optionnels
	{
		
		$data=file_get_contents("php://input"); 
		//pour recuperer les donnes de la requette envoyee au serveur. 
		//mais si on a utilise le format form lors de la requette, on doit recuperer la requette dans $_POST
		$data=json_decode($data);
		//json_decode($data) : conversion en objet
		//json_decode($data,true) : conversion en array
		
		$db= Database::getInstance();
		$product =$this->load_model('Product'); // Product instanciee
		// on peut ensuite utiliser les methodes du modele : add, get_all, make_table,...

		$_SESSION['error']="";

		if (is_object($data)&&isset($data->data_type))
		{
	
			if ($data->data_type == 'add_product')
			{
				
				$check = $product->add($data);

				if ($_SESSION['error'] != "") // si erreur
				{
					$arr['message']=$_SESSION['error'];
					$_SESSION['error']="";
					$arr['message_type']= "error";
					
					$arr['data']="";
					
					$arr['data_type']="add_product";

					echo json_encode($arr); // conversion array en chaine
					//$arr est la reponse preparee ici et retournee par le serveur
					//elle sera detectee par addEventListener et passee a la fonction handle (voir: products.php)
				} else
				{
					$arr['message']="produit ajouté avec succès";
					$arr['message_type']= "info";
					$_SESSION['error']="";
					
					$cats = $product->get_all();
					$cats =array_reverse($cats);
					$arr['data']=$product->make_table($cats,$product); 
					// pour afficher la nouvelle situation des products
					// et $product est passe juste pour avoir le meme nombre de parametres
					
					$arr['data_type']="add_product";

					echo json_encode($arr); // conversion array en chaine
					//$arr est la reponse preparee ici et retournee par le serveur
					//elle sera detectee par addEventListener et passee a la fonction handle (voir: products.php)
					
				}

			} else
			
			if ($data->data_type=='delete_product')
			{
				$product->delete($data->id);
				$arr['message']="produit supprimé avec succès";
				$arr['message_type']= "info";
				$_SESSION['error']="";
							
				$cats = $product->get_all(); 
				// pour afficher la nouvelle situation des products
				$cats =array_reverse($cats);
				$arr['data']=$product->make_table($cats,$product);

				$arr['data_type']="delete_product";

				echo json_encode($arr);// conversion array en chaine
				//$arr est la reponse preparee ici et retournee par le serveur
				//elle sera detectee par addEventListener et passee a la fonction handle (voir: products.php)

			} else
			
			if ($data->data_type == 'edit_product')
			{
						
				$check = $product->edit($data->id,$data);
				if ($_SESSION['error'] != "") // si erreur
				{
					$arr['message']=$_SESSION['error'];
					$_SESSION['error']="";
					$arr['message_type']= "error";
					
					$arr['data']="";
					
					$arr['data_type']="edit_product";

					echo json_encode($arr); // conversion array en chaine
					//$arr est la reponse preparee ici et retournee par le serveur
					//elle sera detectee par addEventListener et passee a la fonction handle (voir: products.php)
				} else
				{
					$arr['message']="produit modifié avec succès";
					$arr['message_type']= "info";
					$_SESSION['error']="";
					
					$cats = $product->get_all();
					$cats =array_reverse($cats);
					$arr['data']=$product->make_table($cats,$product); 
					// pour afficher la nouvelle situation des products
					// et $product est passe juste pour avoir le meme nombre de parametres
					
					$arr['data_type']="edit_product";

					echo json_encode($arr); // conversion array en chaine
					//$arr est la reponse preparee ici et retournee par le serveur
					//elle sera detectee par addEventListener et passee a la fonction handle (voir: products.php)
					
				}

			}

       	}

	}

}

?>