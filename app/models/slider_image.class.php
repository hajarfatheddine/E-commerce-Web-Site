<?php

Class Slider_image
{

	public function get_all(){

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$data= $db->read("select * from slider_images order by id desc");
		if ($data) //ce type de test est important sinon il genere des errurs
		{
			return $data;
		}
	}

	public function get_one($id){

		$id=(int)$id;

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$data= $db->read("select * from slider_images where id = '$id' limit 1");
		if ($data) //ce type de test est important sinon il genere des errurs
		{
			return $data[0];
		}
	}

	public function save($POST,$id){

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		
		$id=(int)$id;

		//on etait oblige de mettre esc() pour toutes les informations pour que la requette
		//sql marche. esc() empeche l interpretation de carateres speciaux

		$product_name =esc($POST['product_name']);	
		$slag = $this->str_to_url($POST['product_name']);
		//ce slag sera passe a product_details (voir slider.php)
		//ceci nous permet de lier un slide au produit (cle etrangere)
		$header1 =esc($POST['header1']);
		$header2 =esc($POST['header2']);
		$text =esc($POST['text']);
	
		//informations sur fichier sachant son chemin complet
		$path_parts = pathinfo($POST['image']);
		//$extension = $path_parts['extension'];
		//$dirname = $path_parts['dirname'];
		$basename =  $path_parts['basename']; //nom de fichier avec extension (qui nous interesse)
		//$filename =$path_parts['filename']; //nom de fichier sans extension
	
		//ceci nous permet d enregister le lien de l image au lieu de l image (fichier lourd)
		$image = esc(ASSETS."eshop/images/sliders/".$basename);

		//show($POST); show($image); show($id);die;

		$query = "update slider_images set product_name='$product_name', slag='$slag', header1 ='$header1', header2 ='$header2', text ='$text', image ='$image' where id ='$id' limit 1";

		$error= $db->write($query);
		
		return $error;

	}

	public function str_to_url($url){

		$url =preg_replace('~[^\\pL0-9_]+~u','-',$url); //remplacer ces carateres par - (sera utilise dans  l url)
		$url =trim($url,"-"); //Remove characters from both sides of a string 
		$url =iconv("utf-8","us-ascii//TRANSLIT",$url);
		$url =strtolower($url);
		$url =preg_replace('~[^-a-z0-9_]+~','-',$url);;
		return $url;
	}

}

?>