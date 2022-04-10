<?php

Class Category
{
	public function add($DATA) //on peut l appeler create
	{

		$db= Database::getInstance();
		$arr['category'] = ucwords($DATA->category); 
		$arr['parent'] = ucwords($DATA->parent);
		if ($arr['parent']==''){
			$arr['parent']=0;
		} 

		if (!preg_match("/^[a-zA-Z 0-9\-_àéèâêîôû]+$/", trim($arr['category'])))
		{
			$_SESSION['error']="Entrer un nom valide de catégorie";
		}

		if (!isset($_SESSION['error']) || $_SESSION['error']=="") //aucune erreur
		{
			$query ="insert into categories (category,parent) values (:category, :parent)";
			$check= $db->write($query,$arr);
			if ($check)
			{
				return true;

			}
		}
		return false;

	}

	public function edit($data)
	{
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$arr['id'] =$data->id;
		$arr['category'] = ucwords($data->category);
		$arr['parent'] = ucwords($data->parent);
		if ($arr['parent']==''){
			$arr['parent']=0;
		} 

		if (!preg_match("/^[a-zA-Z 0-9\-_àéèâêîôû]+$/", trim($arr['category'])))
		{
			$_SESSION['error']="Entrer un nom valide de catégorie";
		}

		if (!isset($_SESSION['error']) || $_SESSION['error']=="") //aucune erreur
		{
			$query= "update categories set category = :category, parent =:parent where id = :id limit 1";
			$check= $db->write($query,$arr);
			if ($check)
			{
				return true;

			}
		}
		return false;	
	}

	public function delete($id)
	{
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$id =(int)$id;
		$query= "delete from categories where id = '$id' limit 1";
		$db->write($query);
	}

	public function get_one($id) // non utilsee
	{
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$id =(int)$id;
		$data= $db->read("select * from categories where id = '$id' limit 1");
		if ($data) //ce type de test est important sinon il genere des erreurs
		{
			return $data[0];

		}
	
	}

	public function get_id($category){
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$category =esc($category);
		$data= $db->read("select * from categories where category = '$category' limit 1");
		if ($data) //ce type de test est important sinon il genere des erreurs
		{
			return $data[0]->id;

		}

	}

	public function get_one_by_name($category) // non utilisee
	{
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$category =esc($category);
		$data= $db->read("select * from categories where category = '$category' limit 1");
		if ($data) //ce type de test est important sinon il genere des erreurs
		{
			return $data[0];

		}
	
	}

	public function get_all()
	{
		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$data= $db->read("select * from categories order by id desc");
		if ($data) //ce type de test est important sinon il genere des errurs
		{
			return $data;

		}
	
	}

	public function make_table($cats)
	{
		
		$result ="";
		if (is_array($cats))
		{
			
			foreach($cats as $cat_row) {//pour chaque element $cat_row de $cats
				
				$color = $cat_row->disabled ?  "#963549" : "#4c9c44";
				$cat_row->disabled = $cat_row->disabled ? "Désactivé" : "Activé/def";
				// disabled est par defaut = 0 (voir base de donnees). 
				// veut dire que la categorie est active par defaut.
				// = 1 : veut dire desactivee (vrai).
								
				// la chaine ci-dessous ne sera pas evaluee car entre ' et '.
				// donc on doit separer et concatener ce qui doit etre evalue	
				$args =$cat_row->id.",'".$cat_row->disabled."'"; 
				//si on a pas fixe toute la chaine avant de l utiliser, les " et ' causent probleme
				// mais pour cela il faut fixer les parties suivantes : ",'" et "'"
				//ce qui va donner comme resultat pour le 2 parametre : 'Disabled' ou 'Enabled'
				
				$edit_args =$cat_row->id.",'".$cat_row->category."',".$cat_row->parent; // comme ci-dessus
				// id : numero de categorie (donc sa ligne affichee).

				$parent="";
				foreach($cats as $cat_row2) {

					if ($cat_row->parent==$cat_row2->id) {
						$parent=$cat_row2->category;
					}
				}
				
				$result .= "<tr>"; 
				$result .= 	'	<td><a href="basic_table.html#">'.$cat_row->category.'</a>
								</td>
								<td><a href="basic_table.html#">'.$parent.'</a>
								</td>
     							<td><span onclick="disable_category('.$args.')" class="label label-info label-mini" style="cursor : pointer; background-color : '.$color.' ">'.$cat_row->disabled.'</span>
     							</td>
				                <td>    
				                      <button onclick= "show_edit_category('.$edit_args.')" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
				                      <button onclick= "delete_category('.$cat_row->id.')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
				                </td>';				
				$result .= "</tr>";
			}

		}
		return $result;
	}

}