<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>
	
<!--details d une commande (les ligne de commande) sous forme de facture-->
<div style="margin-left:60px; margin-right:60px;" id="imprimer"> 
	<button type="button" class= "btn btn-warning" style="float: right; bottom: 10px;left: 10px ;" onclick="imprimer();"> Imprimer </button>	
	<p style="text-align: left; font-size: 18px;"> <B> Facture : </B> </p>
	<hr> <p style="text-align: center;font-size: 18px;"> Site eshop.ma - Commande #<?php echo $order->id?> </p>
	<p style="text-align: center; font-size: 16px;"> <B> Client : <?php echo $order->firstname.", ".$order->lastname;?> </B> </p>
	<hr>
	<div style="display: flex;">
		<table class="table" style="flex: 1; margin: 4px;"></tr>
			<tr><td>Date</td> <td><?php echo $order->date?></td></tr>
			<tr><td>Prénom</td> <td><?php echo $order->firstname?></td></tr>
			<tr><td>Nom</td> <td><?php echo $order->lastname?></td></tr>
			<tr><td>Mobile</td> <td><?php echo $order->mobile?></td></tr>
			<tr><td>Adresse de livraison</td> <td><?php echo $order->delivery_address?></td></tr>
		</table>
		<table class="table" style="flex: 1; margin: 4px;">
			<tr><td>Compagnie</td> <td><?php if ($order->company) {echo $order->company;} else {echo "à titre personnel";}?></td></tr>
			<tr><td>Tel</td> <td><?php if ($order->tel) {echo $order->tel;} else {echo "pas de tel fixe";}?></td></tr>
			<tr><td>Pays</td> <td><?php echo $order->country?></td></tr>
			<tr><td>Ville</td> <td><?php echo $order->city?></td></tr>
			<tr><td>Note</td> <td></td></tr>
		</table>
	</div>
	<hr> <!--ligne de separation-->
	<p style="text-align: left; font-size: 16px;"> Articles commandés </p>
	<table class="table">
		<thead>
			<tr><td>Description</td><td>Prix</td><td>Quantité</td><td>Total</td></tr>
		</thead>
			<?php if (isset($order_details) && is_array($order_details)) :?>
				<tbody>
				<?php $total =0;?>
				<?php foreach ($order_details as $detail) : ?>
					<?php $total = $total + $detail->total?>
					<tr><td><?php echo $detail->description?></td><td><?php echo $detail->price?></td><td><?php echo $detail->quantity?></td><td><?php echo $detail->total?></td></tr>
				<?php endforeach; ?>
				</tbody>
			<?php else :?>
				<div class='alert-danger' style='max-width:350px;margin:auto;text-align:center;'> <h4> Aucun détail pour cette commande !<h4> </div>
			<?php endif;?>
			</tr>
	</table>
	 	
	<div style="margin-left:120px; margin-right:70px;">
		<p style="text-align: right; color: black; font-size: 18px;">  <B> Total : <?php echo $total?> dh </B> </p> 
	</div>
<!--ce total existe deja dans : order->total. pas necessaire de faire le calcul de $total-->		
</div>


<script type="text/javascript">
	
	function imprimer() {    
		var imprimer = document.getElementById('imprimer');
		var popupcontenu = window.open('', 'height=400,width=600');
		popupcontenu.document.open();
		popupcontenu.document.write('<html><body onload="window.print()">' + imprimer.innerHTML + '</html>');
		popupcontenu.document.close();
	}
	
</script>

<?php $this->view("eshop/admin/footer",$data); ?>
						