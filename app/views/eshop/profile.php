<?php $this->view("eshop/header",$data); ?> 

<?php if (is_object($user_data)) :?>
	<div style= "min-height: 300px; max-width: 900px; margin: auto;">
		<div class="col-md-4 mb" style="background-color:   #dfdfdf; text-align: center; box-shadow: 3px 3px 3px #000000;">
		
				<div class="white-header" style="color : green;">
					<h5>Compte</h5>
				</div>
				<p><img src="<?php echo ASSETS?>eshop/admin/img/ui-zac.jpg" class="img-circle" width="80"></p>
				<p style="color : green;"><b><?php echo $data['user_data']->name ?></b></p>
				<div class="row">
					<div class="col-md-6">
						<p class="mt">Membre depuis</p>
						<p><?php echo date("Y-m-d", strtotime($data['user_data']->date)) ?></p>
					</div>
					<div class="col-md-6">
						<p class="mt">Total dépensé</p>
						<?php 	$total =0; 
								if ($orders!=false) {
									foreach ($orders as $order) {
										$total=$total+ $order->total;}
									} ?>
						<p><?php echo $total;?> dh</p>
					</div>
				</div>
				<div class="row">
					
					<a class="btn btn-default update" style="margin-left: 2px;" href="<?php echo ROOT?>profile/delete_user/<?php echo $user_data->url_address?>">Supprimer</a>
					<a class="btn btn-default update" style="margin-right: 5px;" href="<?php echo ROOT?>profile/edit_user/<?php echo $user_data->id?>">Modifier</a>

				</div>
				<br>
		</div><!-- /col-md-4 -->
	</div>
<!--fin data profile-->
	<hr>

	<?php if (is_array($orders)) :?>
		<div style="margin-left:160px; margin-right:160px;">
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr> <p> <span style="text-align: left; font-size: 18px;"> Cliquer sur le lien en bleu pour voir les détails d'une commande (<B style="color: red;">Facture</B>) </span> <p> </tr>

					<tr><th>Client</th><th>Commande</th><th>Date</th><th>Montant</th><th>Adresse</th><th>Mobile</th><th>Paiement</th></tr>
				</thead>

				<tbody>
					<?php foreach ($orders as $order) : ?>
						<tr style="position: relative;">
							<th> <?php echo $order->firstname.", ".$order->lastname;?> </th>
							<th><a href="<?php echo ROOT?>profile/order_details/<?php echo $order->id?>/<?php echo $user_data->url_address?>"> <?php echo $order->id?> </a></th>
							<th><?php echo $order->date?></th>
							<th><?php echo $order->total?></th>
							<th><?php echo $order->delivery_address?></th>
							<th><?php echo $order->mobile?></th>
							<th><?php echo $order->pay?></th>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	<?php else :?>
		
		<div class='alert-danger' style='max-width:350px;margin-left:200px;text-align:center;'>
		<h4> n'a pas encore de commande !<h4> </div>
				
	<?php endif;?>

<?php else :?>
		
	<div class='alert-danger' style='max-width:350px;margin-left:200px;text-align:center;'>
	<h4> Ce profile n'existe pas !<h4> </div>
				
<?php endif;?>

<br>
<br>

<?php $this->view("eshop/footer",$data); ?>