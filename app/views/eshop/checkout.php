<?php $this->view("eshop/header",$data); ?> 

<?php
	if ((isset($errors)) && count($errors) > 0) {
		echo "<div>";
		foreach ($errors as $error) {
			echo "<div class='alert-danger' style='max-width:350px;margin-left:200px;text-align:center;'> <h4> $error ! <h4> </div>";
		}
		echo "</div> <br>";
	}
 ?>
	<section id="cart_items">
		<div class="container">
			<div class="step-one">			
			
			<!-- pour garder trace des valeurs precedentes sans les resaisir-->
			<?php if(is_array($ROWS)) :
				
				$firstname ="";
				$lastname ="";
				$mobile = "";
				$delivery_address = "";
				$company ="";
				$tel ="";?> 

				<!--<?php if (isset($POST_DATA)){extract($POST_DATA);}?>-->

				<div>
						<p> <h4> <B> Entrer les informations de livraison et de facturation </B> (les champs avec * sont obligatoires) :</h4> </p>
				</div>
				<br>
				<form method="post">
				<div class="shopper-informations">
					<div class="row">
						<div class="col-sm-3">
							
						</div>
						<div class="col-sm-5 clearfix">
							<div class="bill-to">
								
								<div class="form-one">
									Prénom * :<input name ="firstname" value="<?php echo $firstname ?>" class="form-control" type="text" required  autofocus> 
									<br>
									Nom * :<input name ="lastname" value="<?php echo $lastname ?>" class="form-control" type="text" required> 
									<br>
									Mobile * :<input name ="mobile" value="<?php echo $mobile ?>" class="form-control" type="text" required> 
									<br>
									Adresse de livraison * :<input name ="delivery_address" value="<?php echo $delivery_address ?>" class="form-control" type="text" required>
								</div>
								<div class="form-two">
									Nom de société :<input name ="company" value="<?php echo $company ?>" class="form-control" type="text"> 
									<br>
									Tel:<input name ="tel" value="<?php echo $tel ?>" class="form-control" type="text"> 
									<br>
									Choisir * :<select name="country" class="js-country form-control" oninput="get_cities(this.value)"  required>
										<option> -- Pays -- </option>
										<?php if (isset($countries) && is_array($countries)) : ?>
											<?php  foreach ($countries as $row) : ?>
												<option value="<?php echo $row->id ?>"> <?php  echo $row->country?> </option>
											<?php endforeach;?>
										<?php endif; ?>
									</select> 
									<br>
									Choisir * :<select name="city" class="js-city form-control" required>
										<!--cette partie sera insere par handleresult() voir plus bas-->
										<option> -- Ville -- </option>
									</select> 
									<br>
								</div>
							</div>
						</div>	
					</div>
					<br>
					<a class="col-md-2" href=""> </a> 
					<!--pour laisser un peu d espace-->
					<a class="btn btn-default  update col-md-1" href="<?php echo ROOT?>cart"> <= Panier</a>
					<a class="col-md-4" href=""> </a> 
					<!--pour laisser un peu d espace-->
					<input type="submit" class="btn btn-default check_out col-md-1" value="Paiement =>" name="">
					</div>
				</form>

			<?php else :?>
				<div class='alert-danger' style='max-width:350px;margin-left:200px;text-align:center;'>
							 <h4> Aucun produit dans le panier ! <h4> </div>
				<a style="margin-left:320px;" class="btn btn-default update col-md-1" href="<?php echo ROOT?>shop"> <= Shopping</a>
				<br>
			<?php endif; ?>

	</section> <!--/#cart_items-->
	<br>
	<br>

<script>

function get_cities(id){
	
	send_data({
			id:id.trim()},
			"get_cities"); // passer data sous forme d objet et data_type = get_cities

}

function send_data(data={},data_type)//valeur par defaut est un objet vide
	{
	
		//pour envoyer une requête HTTP, on crée un objet XMLHttpRequest
		var ajax = new XMLHttpRequest(); //on peut donc utiliser les methodes et attributs de l objet ajax
		//cas ajax: le serveur ne retourne pas une page html mais des donnees ou codes
		
		//addEventListener : detecte l evenement et execute alors : function
		//permet de recevoir la reponse en retour du serveur (du controleur ajax_checkout.php) apres la requette
		ajax.addEventListener('readystatechange', function(){
			if (ajax.readyState == 4 && ajax.status ==200) 
			// 200 : aucune erreur serveur et 4 pas d erreur d etat
			{
				//alert(ajax.responseText);// affiche data recu dus erveur ou erreurs eventuelles
				handle_result(ajax.responseText);//voir en bas handle-result
				//responseText retourne la reponse du serveur (prepare dans le controleur ajax_checkout.php) 
				//et ce suite à l'envoi d'une requête par send (voir send ci-dessous). 
			}
		});

		ajax.open("POST","<?php echo ROOT?>ajax_checkout/"+data_type+"/"+JSON.stringify(data),true); 
		//ouvrir une connexion en mode POST
		//JSON.stringify(data) : converssion en objet de data

		ajax.send();
		//envoi des donnees vers le controleur de page ajax_checkout.php specifie ci-dessus avec "<?php echo ROOT?>
		//ajax_checkout" ou les donnees sont recuperees et traitees puis retournnes dans responseText 
		//vers la page client sans envoyer de page html. le resultat recu est passe a la fonction 
		//handle_result pour etre traite comme ci-dessous 
			
	} 

	function handle_result(result) 
	//result contient les donnees en retour du controleur ajax_checkout.php (donnees provenant du serveur)
	{
		console.log(result); //affiche resultat sur la console (il faut : inspecter)
		if (result!="") 
		{
			var obj = JSON.parse(result);//transforme une chaîne JSON en un objet JavaScript.
			//show(result);
			if (typeof obj.data_type != 'undefined')
			{
				if (obj.data_type=="get_cities") {

					var select_input = document.querySelector(".js-city");
					select_input.innerHTML = "<option> -- Ville -- </option>";
					for (var i = 0; i < obj.data.length; i++) {
						select_input.innerHTML += "<option value='"+obj.data[i].id+"'>"+obj.data[i].city+"</option>";

					console.log(select_input.innerHTML);
					}

				}
			}
		}
	}

</script>

<?php $this->view("eshop/footer",$data); ?> 