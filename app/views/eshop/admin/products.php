
<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>
<!-- le contenu doit etre sidebar et footer car le debut du footer complete la fin du sidebar--> 

<style type="text/css">
	
	.add_product{

		width: 500px;
		height: 360px;
		background-color: #f3eaea;
		box-shadow: 3px 3px 3px #aaa;
		position: absolute;
		padding:  6px
	}

	.edit_product{

		width: 500px;
		height: 360px;
		background-color: #f3eaea;
		box-shadow: 3px 3px 3px #aaa;
		position: absolute;
		padding:  6px
	}
	
	.hide {
		display: none;
	}

</style>


      <!--main content end-->
<div class="row mt">
  <div class="col-md-12">
      <div class="content-panel">
          <table class="table table-striped table-advance table-hover">
      	  	  	<h4><i class="fa fa-angle-right"></i> Produits  <button class="btn btn-primary btn-xs" onclick="show_add_product(event)"><i class="fa fa-plus"></i> Ajouter</button></h4>
      	  	  
      	  	  	<!-- add products-->
      	  	  	<div class="add_product hide">
	      	  	  	<h4 class="mb"><i class="fa fa-angle-right"></i> Ajouter un produit</h4>
	          		<!-- cette fois on va pas utiliser post mais java script pour recuperer le formulaire-->
	          		<form class="form-horizontal style-form" method="post">
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Nom</label>
		                  	<div class="col-sm-10">
		                      	<input id="description_add" name="description" type="text" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Quantié</label>
		                  	<div class="col-sm-10">
		                      	<input id="quantity" name="quantity" type="number" value="1" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Catégorie</label>
		                  	<div class="col-sm-10">
		                      	<select id="category" name="category" type="text" class="form-control" required>  
		                  			<option> </option>
		                  			<?php if(is_array($categories)) : ?>
		                  				<?php foreach ($categories as $categ) : ?>
		                  					<?php $parents=array_column($categories,"parent"); ?>
		                  					<?php if ((($categ->parent==0)&&(!in_array($categ->id, $parents)))||($categ->parent!=0)) : ?>
		                  						<option value="<?php echo $categ->id ?>"> <?php echo $categ->category ?> </option>
		                  					<?php endif; ?>
		                  				<?php endforeach;?>
		                  			<?php endif; ?>
		                  		</select>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Prix</label>
		                  	<div class="col-sm-10">
		                      	<input id="price" name="price" type="number" placeholder="0.00" step="0.01" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Etat</label>
		                  	<div class="col-sm-10">
		                      	<input id="state" name="state" type="text" placeholder="neuf ou remis" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Marque</label>
		                  	<div class="col-sm-10">
		                      	<input id="brand" name="brand" type="text" class="form-control" required>
		                  	</div>
		              	</div> 

		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Image</label>
		                  	<div class="col-sm-10">
		                      	<input id="image" name="image" type="file" class="form-control" required>
		                      	<B style="color: red;"> parcourir : eshop\public\assets\eshop\images\home</B>
		                  	</div>
		              	</div> 
		              	
		              	<!-- le bouton doit etre  dans le formulaire-->
		              	<!-- type="button" : cette partie arrete le rafraichissement de la page cause par le bouton. en fait actionner le bouton est comme le cas de submmit-->
		              	<button type="button" class= "btn btn-primary" style="position:absolute; bottom: 10px;right: 10px ;" onclick='collect_add_data("<?php echo ASSETS ?>")' > Enregistrer  </button>
		              	<button type="button" class= "btn btn-warning" style="position:absolute; bottom: 10px;left: 10px ;" onclick="show_add_product(event)"> Fermer  </button>
	              	</form>
      	  	  	</div>
      	  	   <!-- end add products-->
      	  	   

      	  	   <!-- edit products-->
      	  	  	<div class="edit_product hide">
	      	  	  	<h4 class="mb"><i class="fa fa-angle-right"></i> Ajouter un produit</h4>
	          		<!-- cette fois on va pas utiliser post mais java script pour recuperer le formulaire-->
	          		<form class="form-horizontal style-form" method="post">
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Nom</label>
		                  	<div class="col-sm-10">
		                      	<input id="description_edit" name="description_edit" type="text" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Quantité</label>
		                  	<div class="col-sm-10">
		                      	<input id="quantity_edit" name="quantity_edit" type="number" value="1" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Catégorie</label>
		                  	<div class="col-sm-10">
		                      	<select id="category_edit" name="category_edit" type="text" class="form-control" required>  
		                  			<option> </option>
		                  			<?php if(is_array($categories)) : ?>
		                  				<?php foreach ($categories as $categ) : ?>
		                  					<option value="<?php echo $categ->id ?>"> <?php echo $categ->category ?> </option>
		                  					
		                  				<?php endforeach;?>
		                  			<?php endif; ?>
		                  		</select>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Prix</label>
		                  	<div class="col-sm-10">
		                      	<input id="price_edit" name="price_edit" type="number" placeholder="0.00" step="0.01" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Etat</label>
		                  	<div class="col-sm-10">
		                      	<input id="state_edit" name="state_edit" type="text" placeholder="neuf ou remis" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Marque</label>
		                  	<div class="col-sm-10">
		                      	<input id="brand_edit" name="brand_edit" type="text" class="form-control" required>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <!-- permet de mettre le formulaire exactement sous le suivant-->
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Image</label>
		                  	<div class="col-sm-10">
		                      	<input id="image_edit" name="image_edit" type="file" class="form-control" required>
		                  	</div>
		              	</div> 
		              	
		              	<!-- le bouton doit etre  dans le formulaire-->
		              	<!-- type="button" : cette partie arrete le rafraichissement de la page cause par le bouton. en fait actionner le bouton est comme le cas de submmit-->
		              	<button type="button" class= "btn btn-primary" style="position:absolute; bottom: 10px;right: 10px ;" onclick='collect_edit_data("<?php echo ASSETS ?>")' > Enregistrer  </button>
		              	<button type="button" class= "btn btn-warning" style="position:absolute; bottom: 10px;left: 10px ;" onclick="show_edit_product(0,'')"> Fermer  </button>
	              	</form>
      	  	  	</div>
      	  	   <!-- end edit products-->

      	  	  <!-- les proprietes de cette div sont dans add_product et hide-->
      	  	  <hr>
              <thead>
              <tr>
                  <th> ID</th>
                  <th> Produit</th>
                  <th> Quantité</th>
                  <th> Catégorie</th>
                  <th> Prix</th>
                  <th> Date </th>
                  <th> Image </th>
                  <th><i class=" fa fa-edit"></i> Action </th>
              </tr>
              </thead>
              <tbody id="table_body">
              	<?php
              		
					echo $data['tbl_rows']; // voir ces donnes sur product.class.php
					//insere  les donnees retournnees et formatees (comme morceaux html)
					//dans leur place : table_body sur la page

              	?>
                          
              </tbody>
          </table>
      </div><!-- /content-panel -->
  </div><!-- /col-md-12 -->
</div><!-- /row -->



<script type="text/javascript">

	var EDIT_ID=0; //devient globale en javascript

	function show_add_product(e) 
	//declenchee si evenement: c.a.d. si onclick
	//pour cacher (hide) la fenetre visible ou le contraire

	{
	
		var show_add_box = document.querySelector(".add_product"); //classe add_product voir plus haut
		var description_input = document.querySelector("#description_add"); // cela fait reference a id="product"
		
		if(show_add_box.classList.contains("hide"))
		{
			show_add_box.classList.remove("hide");
			description_input.focus();//donne le focus a description_input : champs de saisi clignote
		}else
		{
			show_add_box.classList.add("hide");
			description_input.value = ""; //vider pour la prochaine saisie
		}
	}

	function show_edit_product(id,description,event) 
	//declenchee si evenement: c.a.d. si onclick
	//pour cacher (hide) la fenetre visible ou le contraire et 
	//fait passer id et description pour etre utilises par collect_edit_data() ci-dessous

	{
	
		EDIT_ID=id; // devient global ici : pour qu on puisse l utiliser dans collect_edit_data() ci-dessous
		var show_edit_box = document.querySelector(".edit_product"); //classe add_product
		
		// pour qu on puisse l utiliser dans collect_edit_data() ci-dessous 
		var description_edit_input = document.querySelector("#description_edit"); // cela fait reference a id="description_edit"
		description_edit_input.value = description;
		
		if(show_edit_box.classList.contains("hide"))
		{
			show_edit_box.classList.remove("hide");
			description_edit_input.focus();//donne le focus a product_input : champs de saisi clignote
		}else
		{
			show_edit_box.classList.add("hide");
			description_edit_input.value = ""; //vider pour la prochaine saisie
		}
		
		// pour qu on puisse les utiliser dans collect_edit_data() ci-dessous 
		var a =event.currentTarget.getAttribute("info");
		var info = JSON.parse(a.replaceAll("'",'"'));

		var quantity_edit_input = document.querySelector("#quantity_edit");
		quantity_edit_input.value = info.quantity;
		
		var category_edit_input = document.querySelector("#category_edit");
		category_edit_input.value = info.category;

		var price_edit_input = document.querySelector("#price_edit");
		price_edit_input.value = info.price;

		var state_edit_input = document.querySelector("#state_edit");
		state_edit_input.value = info.state;

		var brand_edit_input = document.querySelector("#brand_edit");
		brand_edit_input.value = info.brand;
		
	}

	function collect_add_data(ASSETS) 
	//saisir les champs d un produit et send it au serveur (donc au controleur ajax.php)
	{

		var description_input = document.querySelector("#description_add");  
		if (description_input.value.trim()=="" || !isNaN(description_input.value.trim())) //vide ou nombre
		{
			alert("Entrer un nom valide de produit"); //affiche le message sur une petite fenetre
			return;
		}

		var quantity_input = document.querySelector("#quantity");
		if (quantity_input.value.trim()=="" || isNaN(quantity_input.value.trim())) //vide ou non un nombre
		{
			alert("Entrer une quantité valide"); //affiche le message sur une petite fenetre
			return;
		}

		var category_input = document.querySelector("#category");
		if (category_input.value.trim()=="" || isNaN(category_input.value.trim())) //vide ou non un nombre
		{
			alert("Entrer un nom valide de catégorie"); //affiche le message sur une petite fenetre
			return;
		}

		var price_input = document.querySelector("#price");
		if (price_input.value.trim()=="" || isNaN(price_input.value.trim())) //vide ou non un nombre
		{
			alert("Entrer un prix valide"); //affiche le message sur une petite fenetre
			return;
		}

		var state_input = document.querySelector("#state");  
		if ((state_input.value.trim()!="neuf")&&(state_input.value.trim()!= "remis"))
		{
			alert("Entrer neuf ou remis"); //affiche le message sur une petite fenetre
			return;
		}

		var brand_input = document.querySelector("#brand");  
		if (brand_input.value.trim()=="" || !isNaN(brand_input.value.trim())) //vide ou nombre
		{
			alert("Entrer un nom de marque valide"); //affiche le message sur une petite fenetre
			return;
		}

		var image_input = document.querySelector("#image");
		if (image_input.value.trim()=="") //vide 
		{
			alert("Entrer un nom valide d'image"); //affiche le message sur une petite fenetre
			return;
		}

		//ces deux lignes permettent d extraire le nom du fichier a partir du chemin en javascript
		fullPath=image_input.value.trim();
		var filename = fullPath.replace(/^.*[\\\/]/, '');
		
		//ceci nous permet d enregister le lien de l image au lieu de l image (fichier lourd)
		lien_image = ASSETS+"eshop/images/home/"+filename;

		send_data({
			description:description_input.value.trim(),
			quantity:quantity_input.value.trim(),
			category:category_input.value.trim(),
			price:price_input.value.trim(),
			state:state_input.value.trim(),
			brand:brand_input.value.trim(),
			image:lien_image,
			data_type : 'add_product'
		}); // passer data sous forme d objet
	}

	function collect_edit_data(ASSETS) 
	//saisir les champs d un produit et send it au serveur (donc au controleur ajax.php)
	{
		var description_edit_input = document.querySelector("#description_edit");  
		if (description_edit_input.value.trim()=="" || !isNaN(description_edit_input.value.trim())) //vide ou nombre
		{
			alert("Entrer un nom valide de produit"); //affiche le message sur une petite fenetre
			return;
		}

		var quantity_edit_input = document.querySelector("#quantity_edit");
		if (quantity_edit_input.value.trim()=="" || isNaN(quantity_edit_input.value.trim())) //vide ou non un nombre
		{
			alert("Entrer une quantité valide"); //affiche le message sur une petite fenetre
			return;
		}

		var category_edit_input = document.querySelector("#category_edit");
		if (category_edit_input.value.trim()=="" || isNaN(category_edit_input.value.trim())) //vide ou non un nombre
		{
			alert("Entrer un nom valide de catégorie"); //affiche le message sur une petite fenetre
			return;
		}

		var price_edit_input = document.querySelector("#price_edit");
		if (price_edit_input.value.trim()=="" || isNaN(price_edit_input.value.trim())) //vide ou non un nombre
		{
			alert("Entrer un prix valide"); //affiche le message sur une petite fenetre
			return;
		}

		var state_edit_input = document.querySelector("#state_edit");
		if ((state_edit_input.value.trim()!="neuf")&&(state_edit_input.value.trim()!= "remis"))
		{
			alert("Entrer neuf ou remis"); //affiche le message sur une petite fenetre
			return;
		}

		var brand_edit_input = document.querySelector("#brand_edit");
		if (brand_edit_input.value.trim()=="" || !isNaN(brand_edit_input.value.trim())) //vide ou non un nombre
		{
			alert("Entrer un nom de marque valide"); //affiche le message sur une petite fenetre
			return;
		}

		var image_edit_input = document.querySelector("#image_edit");
		console.log(image_edit_input.value.trim());
		if (image_edit_input.value.trim()=="") //vide 
		{
			alert("Entrer un nom valide d'image"); //affiche le message sur une petite fenetre
			return;
		}

		//ces deux lignes permettent d extraire le nom du fichier a partir du chemin en javascript
		fullPath=image_edit_input.value.trim();
		var filename = fullPath.replace(/^.*[\\\/]/, '');
		
		//ceci nous permet d enregister le lien de l image au lieu de l image (fichier lourd)
		lien_image = ASSETS+"eshop/images/home/"+filename;

		send_data({
			id:EDIT_ID,
			description:description_edit_input.value.trim(),
			quantity:quantity_edit_input.value.trim(),
			category:category_edit_input.value.trim(),
			price:price_edit_input.value.trim(),
			state:state_edit_input.value.trim(),
			brand:brand_edit_input.value.trim(),
			image:lien_image,
			data_type : 'edit_product'
		}); // passer data sous forme d objet
	}

	function send_data(data={})//valeur par defaut est un objet vide
	{
	
		//pour envoyer une requête HTTP, on crée un objet XMLHttpRequest
		var ajax = new XMLHttpRequest(); //on peut donc utiliser les methodes et attributs de l objet ajax
		//cas ajax: le serveur ne retourne pas une page html mais des donnees ou codes
		
		//addEventListener : detecte l evenement et execute alors : function
		//permet de recevoir la reponse en retour du serveur (du controleur ajax.php) apres la requette
		ajax.addEventListener('readystatechange', function(){
			if (ajax.readyState == 4 && ajax.status ==200) 
			// 200 : aucune erreur serveur et 4 pas d erreur d etat
			{
				//alert(ajax.responseText);// affiche data recu dus erveur ou erreurs eventuelles
				handle_result(ajax.responseText);//voir en bas handle-result
				//responseText retourne la reponse du serveur (prepare dans le controleur ajqx.php) 
				//et ce suite à l'envoi d'une requête par send (voir send ci-dessous). 
			}
		});

		ajax.open("POST","<?php echo ROOT?>ajax_product",true); //ouvrir une connexion en mode POST
		ajax.send(JSON.stringify(data));//JSON.stringify(data) : converssion en objet de data

		//envoi des donnees vers le controleur de page ajax.php specifie ci-dessus avec "<?php echo ROOT?>
		//ajax_product" ou les donnees sont recuperees et traitees puis retournnes dans responseText 
		//vers la page client sans envoyer de page html. le resultat recu est passe a la fonction 
		//handle_result pour etre traite comme ci-dessous 
			
	}

	function handle_result(result) 
	//result contient les donnees en retour du controleur ajax.php (donnees provenant du serveur)
	{
		console.log(result); //affiche resultat sur la console (il faut : inspecter)
		if (result!="") 
		{
			var obj = JSON.parse(result);//transforme une chaîne JSON en un objet JavaScript.
			//show(result);
			if (typeof obj.data_type != 'undefined')
			{
				if (obj.data_type=="add_product")
				{
					if (obj.message_type=="info")
					{

						var table_body = document.querySelector("#table_body"); 
						//table_body est la partie concernee par l afficahge des donnees sur la page 	
						table_body.innerHTML = obj.data; 
						//insere  les donnees retournnees et formatees (comme morceaux html)
						//dans leur place : table_body sur la page
						alert(obj.message); // c.a.d. "Produit ajouté avec succès"
						show_add_product();//pour cacher (hide) la fenetre visible 
					
					} else
					{
						alert(obj.message);
					}
				}else
				if (obj.data_type=="disable_product")
				{
					var table_body = document.querySelector("#table_body"); 
					//table_body est la partie concernee par l afficahge des donnees sur la page 		
					table_body.innerHTML = obj.data;
					//insere  les donnees retournnees et formatees (comme morceaux html)
					//dans leur place : table_body sur la page 

				}else
				if (obj.data_type=="delete_product")
				{
				
					var table_body = document.querySelector("#table_body"); //comme ci-dessus				
					table_body.innerHTML = obj.data;

					alert(obj.message); // "Produit supprimée avec succès"

				}else
				if (obj.data_type=="edit_product") //comme ci-dessus
				{
					if (obj.message_type=="info")
					{

						var table_body = document.querySelector("#table_body"); 
						//table_body est la partie concernee par l afficahge des donnees sur la page 	
						table_body.innerHTML = obj.data; 
						//insere  les donnees retournnees et formatees (comme morceaux html)
						//dans leur place : table_body sur la page
						alert(obj.message); // c.a.d. "Produit ajouté avec succès"
						show_edit_product(0,'');//pour cacher (hide) la fenetre visible 
					
					} else
					{
						alert(obj.message);
					} 

				}

			}
			
		}
	
	}

	function delete_product(id)
	{

		if (!confirm("êtes-vous sûr de vouloir supprimer ce produit?"))
		{

			return;

		}

		send_data({ // envoyer un objet
			data_type: "delete_product",
			id:id
		});

	}

</script>

<?php $this->view("eshop/admin/footer",$data); ?>


