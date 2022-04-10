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
<?php if (isset($order_info)) : ?>
	<section id="cart_items">
		<div class="container">
			<div class="step-one">			
			
				<div>
					<p> <h4> <B> Confirmer les informations ci-dessous : </B> </h4> </p>
				</div>

				<div class="details"> 	
					<div style="display: flex;">
						<?php $order_info = (object)$order_info; ?>
						<table class="table" style="flex: 1; margin: 4px;"></tr>
							<tr><th>Prénom</th> <td><?php echo $order_info->firstname?></td></tr>
							<tr><th>Nom</th> <td><?php echo $order_info->lastname?></td></tr>
							<tr><th>Mobile</th> <td><?php echo $order_info->mobile?></td></tr>
							<tr><th>Adresse de livraison</th> <td><?php echo $order_info->delivery_address?></td></tr>
						</table>
						<table class="table" style="flex: 1; margin: 4px;">
							<tr><th>Compagnie</th> <td><?php if ($order_info->company) {echo $order_info->company;} else {echo "à titre personnel";}?></td></tr>
							<tr><th>Tel</th> <td><?php if ($order_info->tel) {echo $order_info->tel;} else {echo "pas de tel fixe";}?></td></tr>
							<tr><th>Pays</th> <td><?php echo $country?></td></tr>
							<tr><th>Ville</th> <td><?php echo $city?></td></tr>
						</table>
					</div>
					
					<p style="text-align: left; font-size: 17px;"> <B> Articles commandés  </B> </p>
					<table class="table">
						<thead>
							<tr><th>Description</th><th>Prix</th><th>Quantité</th><th>Total</th></tr>
						</thead>
							<?php if (isset($order_details) && is_array($order_details)) :?>
								<tbody>
								<?php foreach ($order_details as $detail) : ?>
									<tr><th><?php echo $detail->description?></th><th><?php echo $detail->price?></th><th><?php echo $detail->cart_quantity?></th><th><?php echo $detail->total?></th></tr>
								<?php endforeach; ?>
								</tbody>
							<?php else :?>
								<div class='alert-danger' style='max-width:350px;margin:auto;text-align:center;'> <h4> Aucun détail pour cette commande !<h4> </div>
							<?php endif;?>
							</tr>
					</table>
					<div style="margin-left:120px; margin-right:70px;">
					<p style="text-align: right; color: black; font-size: 18px;">  <B> Total : <?php echo $sub_total?> dh </B> </p> 
					</div>
					<a class="col-md-2" href=""> </a> 
					<!--pour laisser un peu d espace-->
					<a class="btn btn-default  update col-md-1" href="<?php echo ROOT?>checkout"> <= Paiement</a>
					<a class="col-md-4" href=""> </a> 
					<!--pour laisser un peu d espace-->
					<form method="POST">
						<input type="submit" class="btn btn-default check_out col-md-1" value=" Confirmer =>" name="">
					</form>
				</div> 	
			</div>
		</div>
	</section> <!--/#cart_items-->
<?php endif; ?>
<br>
<br>

<?php $this->view("eshop/footer",$data); ?> 