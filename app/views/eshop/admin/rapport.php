<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>

<?php if (is_array($rapports)) :?>
	<div style="margin-left:40px; margin-right:120px;">
		<?php foreach ($rapports as $rapport) : ?>
			<h4> Rapport de vente quotidien : jour <?php echo $rapport->date?> <h4>
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr><th>Produit</th><th>Quantité</th><th>Total</th></tr>
				</thead>
				<?php foreach ($rapport->produits as $rap) : ?>
					<tbody>
						<tr style="position: relative;">							
							<th><?php echo $rap->description?></th>
							<th><?php echo $rap->quantity?></th>
							<th><?php echo $rap->total?></th>			
						</tr>
					</tbody>
				<?php endforeach; ?>					
			</table>
			<h4 style="margin-left:700px">TOTAL: <?php echo $rapport->total?></h4>
		<?php endforeach; ?>
	</div>
<?php else :?>
		
	<div class='alert-danger' style='max-width:350px;margin-left:160px;text-align:center;'>
	<h4> Aucun rapport de vente!<h4> 
	</div>
				
<?php endif;?>

<?php $this->view("eshop/admin/footer",$data); ?>