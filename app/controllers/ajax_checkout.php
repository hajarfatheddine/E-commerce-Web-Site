<?php
 // les fonctionalites communes sont dans controller.php qui se trouve dans le core
 // cette classe n est pas liee a une page comme les autres controleurs mais  
 // permet de retourner (vers une page) seulement des donnees suite a une requette (de cette page)

Class Ajax_checkout extends Controller

{
	
	public function index($data_type='',$id='') // les valeurs sont optionnels
	{
		
		$id = json_decode($id);

		$countries = $this->load_model('Countries');
		$data = $countries->get_cities($id->id);
		
		$info=(object)[]; //convertir tableau vice en objet vide
		$info->data=$data;
		$info->data_type = $data_type;	
		
		echo json_encode($info);
	}

}

?>