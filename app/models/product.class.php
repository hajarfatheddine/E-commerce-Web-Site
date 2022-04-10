<?php

Class Product
{
	public function add($DATA) //on peut l appeler create
	{

		$db= Database::getInstance();

		$arr['description'] = ucwords($DATA->description); 
		$arr['quantity'] = ucwords($DATA->quantity); 
		$arr['category'] = ucwords($DATA->category); 
		$arr['price'] = ucwords($DATA->price); 
		$arr['state'] = ucwords($DATA->state); 
		$arr['brand'] = ucwords($DATA->brand); 
		$arr['date'] = date("Y-m-d H:i:s"); 
		$arr['image'] = ucwords($DATA->image); //ici on a le lien de l image
		$arr['user_url'] = $_SESSION['user_url'];
		$arr['slag'] = $this->str_to_url($DATA->description);

		$_SESSION['error']="";
		if (!preg_match("/^[a-zA-Z 0-9\-_àéèâêîôû]+$/", trim($arr['description'])))
		{
			$_SESSION['error'].="Entrer un nom valide de produit  \n";
		}

		if (!is_numeric($arr['quantity']))
		{
			$_SESSION['error'].="Entrer une quantité valide  \n";
		}

		if (!is_numeric($arr['category']))
		{
			$_SESSION['error'].="Entrer un non valide de catégorie  \n";
		}

		if (!is_numeric($arr['price']))
		{
			$_SESSION['error'].="Entrer un prix valide  \n";
		}

		if ($arr['state']=="")
		{
			$_SESSION['error'].="Entrer neuf ou remis  \n";
		}

		if ($arr['brand']=="")
		{
			$_SESSION['error'].="Entrer un nom de marque valide  \n";
		}

		//extraire l extension du fichier a partir du path		
		$lien_image = $arr['image'];
		$extension = pathinfo($lien_image, PATHINFO_EXTENSION);

		if (($extension!="png")&&($extension!="jpeg")&&($extension!="jpg"))
		{
			$_SESSION['error'].="Entrer un nom valide d'image \n";

		}

		if (!isset($_SESSION['error']) || $_SESSION['error']=="") //aucune erreur
		{
			$query ="insert into products (user_url,description,category, price, quantity, date, image, slag,state,brand) values (:user_url, :description, :category, :price, :quantity, :date, :image, :slag, :state, :brand)";
			$check= $db->write($query,$arr);
			if ($check)
			{
				return true;

			}
		}
		return false;

	}

	public function edit($id,$DATA)
	{
		$db= Database::getInstance();

		$arr['id'] =$id;
		$arr['description'] = ucwords($DATA->description); 
		$arr['quantity'] = ucwords($DATA->quantity); 
		$arr['category'] = ucwords($DATA->category); 
		$arr['price'] = ucwords($DATA->price);
		$arr['state'] = ucwords($DATA->state); 
		$arr['brand'] = ucwords($DATA->brand);  
		$arr['date'] = date("Y-m-d H:i:s"); 
		$arr['image'] = ucwords($DATA->image); //ici on a le lien de l image
		$arr['user_url'] = $_SESSION['user_url'];
		$arr['slag'] = $this->str_to_url($DATA->description);

		$_SESSION['error']="";
		if (!preg_match("/^[a-zA-Z 0-9\-_àéèâêîôû]+$/", trim($arr['description'])))
		{
			$_SESSION['error'].="Entrer un nom valide de produit  \n";
		}

		if (!is_numeric($arr['quantity']))
		{
			$_SESSION['error'].="Entrer une quantité valide  \n";
		}

		if (!is_numeric($arr['category']))
		{
			$_SESSION['error'].="Entrer un non valide de catégorie\n";
		}

		if (!is_numeric($arr['price']))
		{
			$_SESSION['error'].="Entrer un prix valide  \n";
		}

		if ($arr['state']=="")
		{
			$_SESSION['error'].="Entrer neuf ou remis  \n";
		}

		if ($arr['brand']=="")
		{
			$_SESSION['error'].="Entrer un nom de marque valide  \n";
		}

		//extraire l extension du fichier a partir du path		
		$lien_image = $arr['image'];
		$extension = pathinfo($lien_image, PATHINFO_EXTENSION);

		if (($extension!="png")&&($extension!="jpeg")&&($extension!="jpg"))
		{
			$_SESSION['error'].="Entrer un nom valide d'image \n";

		}

		if (!isset($_SESSION['error']) || $_SESSION['error']=="") //aucune erreur
		{
			$query= "update products set user_url = :user_url, description = :description, category = :category, price = :price, quantity = :quantity, date= :date, image=:image,slag=:slag, state=:state, brand=:brand where id = :id limit 1";
			$check= $db->write($query,$arr);
			if ($check)
			{
				return true;

			}
		}
		
	}

	public function delete($id)
	{
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$id =(int)$id;
		$query= "delete from products where id = '$id' limit 1";
		$db->write($query);
	}

	public function get_all()
	{
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$data=$db->read("select * from products order by id desc");
		if ($data) //ce type de test est important sinon il genere des errurs
		{
			return $data;

		}
	
	}

	public function get_one($id)
	{
		$id=(int)$id;
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$data=$db->read("select * from categories where id = '$id' limit 1");
		if ($data) //ce type de test est important sinon il genere des erreurs
		{
			return $data[0]->category;

		}
	}

	public function make_table($cats,$model)
	//on affiche pas l etat du produit et la marque, pas necessaire et pas de place
	{
		
		$result ="";
		if (is_array($cats))
		{
			
			foreach($cats as $cat_row) {//pour chaque element $cat_row de $cats
				
				$one_cat=$model->get_one($cat_row->category); //$cat_row->category est un nombre

				$edit_args =$cat_row->id.",'".$cat_row->description."'"; 

				$info =array(); // important pour pouvoir transformer le tableau en chaine (voir ci-dessous)
				
				$info['quantity']=$cat_row->quantity; // id et description sont deja passes ($edit_args ci-dessus)
				$info['category']=$cat_row->category;
				$info['price']=$cat_row->price;
				$info['state']=$cat_row->state;
				$info['brand']=$cat_row->brand;

				//cette information $info sera passee (voir bouton info ci-dessous) 
				//une fois onclick show_edit_product sera executee et $info passee a cette fonction
				//voir dans products.php comment recuperer ces informations au sein de cette fonction
				
				$info = str_replace('"',"'",json_encode($info)); // conversion array en chaine
				
				//strtotime (voir ci-dessous) est essentielle sinon l afficage sera perturbe
				
				$result .= "<tr>"; 		
				$result .= 	'	<td><a href="basic_table.html#">'.$cat_row->id.'</a> </td>
								<td><a href="basic_table.html#">'.$cat_row->description.'</a> </td>
								<td><a href="basic_table.html#">'.$cat_row->quantity.'</a> </td>
								<td><a href="basic_table.html#">'.$one_cat.'</a> </td>
								<td><a href="basic_table.html#">'.$cat_row->price.'</a> </td>
								<td><a href="basic_table.html#">'.date("j m Y, H:m:s",strtotime($cat_row->date)).'</a> </td>
								<td><a href="basic_table.html#"><img src="'.$cat_row->image.'" style= "width:70px; height:70px;" /> </a> </td> 
     							
				                <td>    
				                      <button info="'.$info.'" onclick= "show_edit_product('.$edit_args.',event)" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
				                      <button onclick= "delete_product('.$cat_row->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
				                </td>';				
				$result .= "</tr>";
			}

		}
		return $result;
	}

	public function str_to_url($url){

		$url =preg_replace('~[^\\pL0-9_]+~u','-',$url); 
		//remplacer ces carateres par - (sera utilise dans  l url)
		$url =trim($url,"-"); 
		//Remove characters from both sides of a string 
		$url =iconv("utf-8","us-ascii//TRANSLIT",$url);
		$url =strtolower($url);
		$url =preg_replace('~[^-a-z0-9_]+~','-',$url);;
		return $url;
	}

}