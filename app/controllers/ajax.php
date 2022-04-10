<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core
 // cette classe n est pas liee a une page comme les autres controleurs mais  
 // permet de retourner (vers une page) seulement des donnees suite a une requette (de cette page)

Class Ajax extends Controller

{
	
	public function index() // les valeurs sont optionnels
	{
		
		$data=file_get_contents("php://input"); 
		//pour recuperer les donnes de la requette envoyee au serveur. 
		//mais si on a utilise le format form lors de la requette, on doit recuperer la requette dans $_POST.
		$data=json_decode($data);
		//json_decode($data) : conversion en objet
		//json_decode($data,true) : conversion en array
		
		$db= Database::getInstance();
		$category =$this->load_model('Category'); // Category instanciee
		// on peut ensuite utiliser les methodes du modele : add, get_all, make_table,...
		if (is_object($data)&&isset($data->data_type))
		{

			$_SESSION['error']="";
			if ($data->data_type == 'add_category')
			{
				
				$check = $category->add($data);
				if ($_SESSION['error'] != "") // si erreur
				{
					$arr['message']=$_SESSION['error'];
					$_SESSION['error']="";
					$arr['message_type']= "error";
					
					$arr['data']="";
					
					$arr['data_type']="add_category";

					echo json_encode($arr); // conversion array en chaine
					//$arr est la reponse preparee ici et retournee par le serveur
					//elle sera detectee par addEventListener et passee a la fonction handle (voir: categories.php)
				} else
				{
					$arr['message']="Catégorie ajoutée avec succès";
					$arr['message_type']= "info";
					
					$cats = $category->get_all();
					$arr['data']=$category->make_table($cats); // pour afficher la nouvelle situation des categories
					
					$arr['data_type']="add_category";

					echo json_encode($arr); // conversion array en chaine
					//$arr est la reponse preparee ici et retournee par le serveur
					//elle sera detectee par addEventListener et passee a la fonction handle (voir: categories.php)
					
				}

			} else
			if ($data->data_type=='disable_category')
			{
				$disabled = ($data->current_state== "ActiverCat.") ? 1 : 0;
				$id=$data->id;
				$query ="update categories set disabled = '$disabled' where id='$id' limit 1";
				$db->write($query);
				
				$arr['message']="";
				$_SESSION['error']="";
				$arr['message_type']= "info";

				$cats = $category->get_all(); // pour afficher la nouvelle situation des categories
				$arr['data']=$category->make_table($cats);
				
				$arr['data_type']="disable_category";

				echo json_encode($arr);// conversion array en chaine
				//$arr est la reponse preparee ici et retournee par le serveur
				//elle sera detectee par addEventListener et passee a la fonction handle (voir: categories.php)


			} else
			if ($data->data_type=='delete_category')
			{
				$category->delete($data->id);
				$arr['message']="Catégorie supprimée avec succès";
				$arr['message_type']= "info";
				$_SESSION['error']="";
							
				$cats = $category->get_all(); // pour afficher la nouvelle situation des categories
				$arr['data']=$category->make_table($cats);

				$arr['data_type']="delete_category";

				echo json_encode($arr);// conversion array en chaine
				//$arr est la reponse preparee ici et retournee par le serveur
				//elle sera detectee par addEventListener et passee a la fonction handle (voir: categories.php)

			} else
			if ($data->data_type=='edit_category')
			{
				$category->edit($data->id,$data->category);
				$arr['message']="Catégorie modifiée avec succès";
				$arr['message_type']= "info";
				$_SESSION['error']="";
							
				$cats = $category->get_all(); // pour afficher la nouvelle situation des categories
				$arr['data']=$category->make_table($cats);

				$arr['data_type']="edit_category";

				echo json_encode($arr);// conversion array en chaine
				//$arr est la reponse preparee ici et retournee par le serveur
				//elle sera detectee par addEventListener et passee a la fonction handle (voir: categories.php)

			} 

       	}

	}

}

?>