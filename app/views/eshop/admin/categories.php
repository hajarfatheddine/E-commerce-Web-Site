
<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>
<! le contenu doit etre sidebar et footer car le debut du footer complete la fin du sidebar> 

<style type="text/css">
	
	.add_category{

		width: 500px;
		height: 180px;
		background-color: #f3eaea;
		box-shadow: 3px 3px 3px #aaa;
		position: absolute;
		padding:  6px
	}

	.edit_category{

		width: 500px;
		height: 180px;
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
      	  	  	<h4><i class="fa fa-angle-right"></i> Catégories de produits  <button class="btn btn-primary btn-xs" onclick="show_add_category(event)"><i class="fa fa-plus"></i> Ajouter</button></h4>
      	  	  
      	  	  	<! add categories>
      	  	  	<div class="add_category hide">
	      	  	  	<h4 class="mb"><i class="fa fa-angle-right"></i> Ajouter une catégorie</h4>
	          		<! cette fois on va pas utiliser post mais java script pour recuperer le formulaire>
	          		<form class="form-horizontal style-form" method="post">
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Nom</label>
		                  	<div class="col-sm-10">
		                      	<input id="category" name="category" type="text" class="form-control" autofocus>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <! permet de mettre le formulaire exactement sous le suivant>
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Parent (optionnel)</label>
		                  	<div class="col-sm-10">
		                      	<select id="parent" name="parent" type="text" class="form-control" required>  
		                  			<option> </option>
		                  			<?php if(is_array($categories_activ)) : ?>
		                  				<?php $parents=array_column($categories_activ,"parent"); ?>
		                  				<?php foreach ($categories_activ as $categ) : ?>
		                  					<?php if (($categ->parent==0)&&(in_array($categ->id, $parents))) : ?>
		                  						<option value="<?php echo $categ->id ?>"> <?php echo $categ->category ?> </option>
		                  					<?php endif; ?>
		                  				<?php endforeach;?>
		                  			<?php endif; ?>
		                  		</select>
		                  	</div>
		              	</div>
		              	<! le bouton doit etre  dans le formulaire>
		              	<! type="button" : cette partie arrete le rafraichissement de la page cause par le bouton. en fait actionner le bouton est comme le cas de submmit>
		              	<button type="button" class= "btn btn-primary" style="position:absolute; bottom: 10px;right: 10px ;" onclick="collect_add_data(event)" > Enregistrer  </button>
		              	<button type="button" class= "btn btn-warning" style="position:absolute; bottom: 10px;left: 10px ;" onclick="show_add_category(event)"> Fermer  </button>
	              	</form>
      	  	  	</div>
      	  	   <! end add categories>
      	  	   

      	  	   <! edit categories>
      	  	  	<div class="edit_category hide">
	      	  	  	<h4 class="mb"><i class="fa fa-angle-right"></i> Modifier une catégorie</h4>
	          		<! cette fois on va pas utiliser post mais java script pour recuperer le formulaire>
	          		<form class="form-horizontal style-form" method="post">
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Nom de catégorie</label>
		                  	<div class="col-sm-10">
		                      	<input id="category_edit" name="category" type="text" class="form-control" autofocus>
		                  	</div>
		              	</div> 
		              	<br style="clear: both;"> <! permet de mettre le formulaire exactement sous le suivant>
		              	<div class="form-group">
		                  	<label class="col-sm-2 col-sm-2 control-label">Parent (optionnel)</label>
		                  	<div class="col-sm-10">
		                      	<select id="parent_edit" name="parent" type="text" class="form-control" required>  
		                  			<option> </option>
		                  			<?php if(is_array($categories_activ)) : ?>
		                  				<?php foreach ($categories_activ as $categ) : ?>
		                  					<option value="<?php echo $categ->id ?>"> <?php echo $categ->category ?> </option>
		                  					
		                  				<?php endforeach;?>
		                  			<?php endif; ?>
		                  		</select>
		                  	</div>
		              	</div>
		              	<! le bouton doit etre  dans le formulaire>
		              	<! type="button" : cette instruction arrete le rafraichissement de la page cause par le bouton. en fait actionner le bouton est comme le cas de submmit>
		              	<button type="button" class= "btn btn-primary" style="position:absolute; bottom: 10px;right: 10px ;" onclick="collect_edit_data(event)" > Enregistrer  </button>
		              	<button type="button" class= "btn btn-warning" style="position:absolute; bottom: 10px;left: 10px ;" onclick="show_edit_category(0,'',0)"> Annuler  </button>
	              	</form>
      	  	  	</div>
      	  	   <! end edit categories>

      	  	  <! les proprietes de cette div sont dans add_category et hide>
      	  	  <hr>
              <thead>
              <tr>
                  <th><i class="fa fa-bullhorn"></i> Catégorie</th>
                  <th><i class="fa fa-bullhorn"></i> Parent</th>
                  <th><i class=" fa fa-edit"></i> Etat</th>
                   <th><i class=" fa fa-edit"></i> Action </th>
              </tr>
              </thead>
              <tbody id="table_body">
              	<?php
              		
					echo $data['tbl_rows']; // voir ces donnes sur category.class.php
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
	
	//declenchee si evenement: c.a.d. si onclick
	//pour cacher (hide) la fenetre visible ou le contraire
	function show_add_category(e) 
	{
	
		var show_add_box = document.querySelector(".add_category"); //classe add_category
		var category_input = document.querySelector("#category"); // cela fait reference a id="category"
		if(show_add_box.classList.contains("hide"))
		{
			show_add_box.classList.remove("hide");
			category_input.focus();//donne le focus a category_input : champs de saisi clignote
		}else
		{
			show_add_box.classList.add("hide");
			category_input.value = ""; //vider pour la prochaine saisie
		}
	}
	
	//declenchee si evenement: c.a.d. si onclick
	//pour cacher (hide) la fenetre visible ou le contraire et 
	//fait passer id et category pour etre utilises par collect_edit_data()
	function show_edit_category(id,category,parent) 
	{
	
		EDIT_ID=id; // pour qu on puisse l utiliser dans collect_edit_data() ci-dessous
		var show_edit_box = document.querySelector(".edit_category"); //classe add_category
		var category_input = document.querySelector("#category_edit"); // cela fait reference a id="category_edit"
		var parent_input = document.querySelector("#parent_edit"); 
		category_input.value = category; //  pour qu on puisse l utiliser dans collect_edit_data() ci-dessous
		parent_input.value = parent; //  pour qu on puisse l utiliser dans collect_edit_data() ci-dessous
		
		if(show_edit_box.classList.contains("hide"))
		{
			show_edit_box.classList.remove("hide");
			category_input.focus();//donne le focus a category_input : champs de saisi clignote
		}else
		{
			show_edit_box.classList.add("hide");
			category_input.value = ""; //vider pour la prochaine saisie
		}
	}

	function collect_add_data() //saisir une categorie et send it au serveur (donc au controleur ajax.php)
	{

		var category_input = document.querySelector("#category");  // cela fait reference a id="category"
		if (category_input.value.trim()=="" || !isNaN(category_input.value.trim())) //vide ou nombre
		{
			alert("Entrer un nom valide de catégorie"); //affiche le message sur une petite fenetre
		}

		var parent_input = document.querySelector("#parent");  // cela fait reference a id="category"
		if (isNaN(parent_input.value.trim())) //non un nombre
		{
			alert("Entrer un nom valide de catégorie"); //affiche le message sur une petite fenetre
		}
		
		send_data({
			category:category_input.value.trim(),
			parent:parent_input.value.trim(),
			data_type : 'add_category'
		}); // passer data sous forme d objet
	}

	function collect_edit_data() //saisir une categorie et send it au serveur (donc au controleur ajax.php)
	{

		var category_input = document.querySelector("#category_edit");  
		// cela fait reference a id="category_edit"
		if (category_input.value.trim()=="" || !isNaN(category_input.value.trim())) //vide ou nombre
		{
			alert("Entrer un nom valide de catégorie"); //affiche le message sur une petite fenetre
		}

		var parent_input = document.querySelector("#parent_edit");  
		// cela fait reference a id="category_edit"
		if (isNaN(parent_input.value.trim())) //non un nombre
		{
			alert("Entrer un nom valide de catégorie"); //affiche le message sur une petite fenetre
		}

		send_data({
			id:EDIT_ID,
			category:category_input.value.trim(), 
			parent:parent_input.value.trim(),
			data_type : 'edit_category'
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
				//responseText retourne la reponse du serveur (prepare dans le controleur ajex.php) 
				//et ce suite à l'envoi d'une requête par send (voir send ci-dessous). 
			}
		});

		ajax.open("POST","<?php echo ROOT?>ajax_category",true); //ouvrir une connexion en mode POST
		ajax.send(JSON.stringify(data));//JSON.stringify(data) : converssion en objet de data

		//envoi des donnees vers le controleur de page ajax.php specifie ci-dessus avec "<?php echo ROOT?>ajax_category" ou les donnees sont recuperees et traitees puis retournnes dans responseText 
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
			if (typeof obj.data_type != 'undefined')
			{
				if (obj.data_type=="add_category")
				{
					if (obj.message_type=="info")
					{

						var table_body = document.querySelector("#table_body"); 
						//table_body est la partie concernee par l afficahge des donnees sur la page 	
						table_body.innerHTML = obj.data; 
						//insere  les donnees retournnees et formatees (comme morceaux html)
						//dans leur place : table_body sur la page
						alert(obj.message); // c.a.d. "Catégorie ajoutée avec succès"
						show_add_category();//pour cacher (hide) la fenetre visible 
					
					} else
					{
						alert(obj.message);
					}
				}else
				if (obj.data_type=="disable_category")
				{
					var table_body = document.querySelector("#table_body"); 
					//table_body est la partie concernee par l afficahge des donnees sur la page 		
					table_body.innerHTML = obj.data;
					//insere  les donnees retournnees et formatees (comme morceaux html)
					//dans leur place : table_body sur la page 

				}else
				if (obj.data_type=="delete_category")
				{
				
					var table_body = document.querySelector("#table_body"); //comme ci-dessus				
					table_body.innerHTML = obj.data;

					alert(obj.message); // "Categorie supprimée avec succès"

				}else
				if (obj.data_type=="edit_category") //comme ci-dessus
				{
				
					var table_body = document.querySelector("#table_body"); 
					table_body.innerHTML = obj.data; 
					alert(obj.message); // c.a.d. "Catégorie modifiée avec succès"
					show_edit_category(0,'',0);//pour cacher (hide) la fenetre visible 

				}

			}
			
		}
	
	}

	function delete_category(id)
	{

		if (!confirm("êtes-vous sûr de vouloir supprimer cette catégorie?"))
		{

			return;

		}

		send_data({ // envoyer un objet
			data_type: "delete_category",
			id:id
		});

	}


	function disable_category(id,state)
	{
		

		send_data({ // envoyer un objet
			data_type: "disable_category",
			id:id,
			current_state: state
		});

	}

</script>

<?php $this->view("eshop/admin/footer",$data); ?>