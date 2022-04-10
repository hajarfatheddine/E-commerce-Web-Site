<?php

Class Rapport {

	public function get_rapports(){

		$db= Database::getInstance();
		$sql= "select * from orders order by id desc";
		$orders=$db->read($sql);

		//show($orders); die;	
		if (is_array($orders)) {
			$order_date_p =date_create($orders[0]->date); 
			//date de la derniere commande (car select par ordre decroissant)
			$order_date_preced=$order_date_p->format("Y-m-d");

			//show($orders[0]->date);
			//show($order_date_preced);

			$rapports=array();  $i=0;
			$rapports[$i]=new stdClass(); //tous les elements sont des objets
			//sinon il affiche : warning-creating-default-object-from-empty-value
			$rapports[$i]->date=$order_date_preced;
			$rapports[$i]->produits=array();
		
			foreach ($orders as $order) {				

				//recherche des lignes de commande de chaque commande
				$order_id=$order->id;
				$data=array();
				$query="select * from order_details where order_id = '$order_id'";
				$order_details=$db->read($query);

				foreach ($order_details as $detail) { 
					array_push($rapports[$i]->produits,$detail); //ajouter les dans le tableau produits
				}
				$date_p=date_create($order->date);
				$date=$date_p->format("Y-m-d");

				//show($order->date); 
				//show($date);
				//si date differente de la precedent et si pas derniere iteration
				if ((!($date==$order_date_preced))&&($i!=(count($orders)-1))) {

					$i=$i+1;
					$rapports[$i]=new stdClass(); 
					//sinon il affiche : warning-creating-default-object-from-empty-value
				
					$rapports[$i]->date=$date;

					$rapports[$i]->produits=array();
					$order_date_preced=$date;
				}
			}

		//pour eviter d'avoir le meme produit (durant la meme periode) affiche plus d'une fois
		foreach ($rapports as $rapport) {	
		//pour chaque element du tableau $rapports

			foreach ($rapport->produits as $key1 => $produit1) { 
			//pour chaque element du tableau $rapport->produits

				foreach ($rapport->produits as $key2 => $produit2) {

					//il faut le comparer au suivant et pas a lui meme &&
					//le id du prodduit doit etre != de -1 (-1 veut dire deja traite et donc sera supprime)
					if (($key1!=$key2)&&($produit1->product_id!=-1)&&($produit1->product_id==$produit2->product_id)) {

							$produit2->product_id=-1;
							$produit1->quantity=$produit1->quantity+$produit2->quantity;
							$produit1->total=$produit1->total+$produit2->total;
					}
				}

			}

		}
		//supprimer les produits dont le id est -1
		//pour eviter d'avoir le meme produit (durant la meme periode) affiche plus d'une fois
		foreach ($rapports as $rapport) {	
		//pour chaque element du tableau $rapports

			foreach ($rapport->produits as $key => $produit) { 
			//pour chaque element du tableau $rapport->produits

					//il faut le comparer au suivant et pas a lui meme &&
					//le id du prodduit doit etre != de -1 (-1 veut dire deja traite et donc sera supprime)
					if ($produit->product_id==-1) {

							unset($rapport->produits[$key]);
					}

			}

		}
		
		foreach ($rapports as $rapport) {	
		$total=0;
			foreach ( $rapport->produits as $produit){
				$total=$total+$produit->total;
			}
			$rapport->total=$total;
		}

		//show($rapports); die;
		return $rapports;
		}
	}

	public function get_rapports_m(){

		$db= Database::getInstance();
		$sql= "select * from orders order by id desc";
		$orders=$db->read($sql);

		//show($orders); die;	
		if (is_array($orders)) {
			//pour pouvoir extraire le mois
			$order_date_preced =date_create($orders[0]->date); 
			//date de la derniere commande (car select par ordre croissant)
			$order_date_preced=$order_date_preced->format('m');
			
			$rapports=array();  $i=0;
			$rapports[$i]=new stdClass(); 
			//sinon il affiche : warning-creating-default-object-from-empty-value
			$rapports[$i]->date=$order_date_preced;
			$rapports[$i]->produits=array();
		
			foreach ($orders as $order) {				

				//recherche des lignes de commande de chaque commande
				$order_id=$order->id;
				$data=array();
				$query="select * from order_details where order_id = '$order_id'";
				$order_details=$db->read($query);

				foreach ($order_details as $detail) { 
					array_push($rapports[$i]->produits,$detail); //ajouter les dans le tableau produits
				}

				$date=date_create($order->date);
				$date=$date->format('m');

				//si date differente de la precedent et si pas derniere iteration
				if ((!($date==$order_date_preced))&&($i!=(count($orders)-1))) {

					$i=$i+1;
					$rapports[$i]=new stdClass(); 
					//sinon il affiche : warning-creating-default-object-from-empty-value
					$rapports[$i]->date=$date;
					$rapports[$i]->produits=array();
					$order_date_preced=$date;
				}
			}

		//pour eviter d'avoir le meme produit (durant la meme periode) affiche plus d'une fois
		foreach ($rapports as $rapport) {	
		//pour chaque element du tableau $rapports

			foreach ($rapport->produits as $key1 => $produit1) { 
			//pour chaque element du tableau $rapport->produits

				foreach ($rapport->produits as $key2 => $produit2) {

					//il faut le comparer au suivant et pas a lui meme &&
					//le id du prodduit doit etre != de -1 (-1 veut dire deja traite et donc sera supprime)
					if (($key1!=$key2)&&($produit1->product_id!=-1)&&($produit1->product_id==$produit2->product_id)) {

							$produit2->product_id=-1;
							$produit1->quantity=$produit1->quantity+$produit2->quantity;
							$produit1->total=$produit1->total+$produit2->total;
					}
				}

			}

		}
		//supprimer les produits dont le id est -1
		//pour eviter d'avoir le meme produit (durant la meme periode) affiche plus d'une fois
		foreach ($rapports as $rapport) {	
		//pour chaque element du tableau $rapports

			foreach ($rapport->produits as $key => $produit) { 
			//pour chaque element du tableau $rapport->produits

					//il faut le comparer au suivant et pas a lui meme &&
					//le id du prodduit doit etre != de -1 (-1 veut dire deja traite et donc sera supprime)
					if ($produit->product_id==-1) {

							unset($rapport->produits[$key]);
					}

			}

		}
        foreach ($rapports as $rapport) {	
            $total=0;
                foreach ( $rapport->produits as $produit){
                    $total=$total+$produit->total;
                }
                $rapport->total=$total;
            }

		//show($rapports); die;
		return $rapports;
		}
	}

}