<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>

<?php if (is_array($orders)) :?>
	<div style="margin-left:40px; margin-right:120px;">
		<table class="table table-striped table-advance table-hover">
			<thead>
				<tr> <p> <span style="text-align: left; font-size: 18px;"> Cliquer sur le lien en bleu pour voir les détails de la commande (<B style="color: red;"> Facture </B>) ou du client </span> <p> </tr>

				<tr><th>Commande</th><th>Client</th><th>Date</th><th>Montant</th><th>Adresse</th><th>Mobile</th><th>Paiement</th></tr>
			</thead>

			<tbody>
				<?php foreach ($orders as $order) : ?>
					<tr style="position: relative;">
						<th><a href="<?php echo ROOT?>admin/order_details/<?php echo $order->id?>/<?php echo $order->user->url_address?>"> <?php echo $order->id?> </a></th>
						<th> <a href="<?php echo ROOT?>admin/profile_url/<?php echo $order->user->url_address?>"> <?php echo $order->firstname.", ".$order->lastname;?> </a> </th>
						<th><?php echo $order->date?></th>
						<th><?php echo $order->total?></th>
						<th><?php echo $order->delivery_address?></th>
						<th><?php echo $order->mobile?></th>
						<?php $pay= $order->pay?>
						<?php if ($pay=="non") {$url="no_pay";} else {$url="all";} ?>
						<?php $id= $order->id?>
						<?php  $href=ROOT."admin/confirm_pay/".$id."/".$url; ?>
						<th> <?php if($pay=='non') { echo '<a href="'.$href.'">'.$pay.'</a>'; echo ' : Cliquer si payé';} else {echo $pay;} ?></th>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php else :?>
		
		<div class='alert-danger' style='max-width:350px;margin-left:160px;text-align:center;'>
		<h4> Aucune commande !<h4> </div>
				
<?php endif;?>

<?php $this->view("eshop/admin/footer",$data); ?>