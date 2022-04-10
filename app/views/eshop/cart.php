<?php $this->view("eshop/header",$data); ?>

<section id="cart_items">
	<div class="container">
		
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Article</td>
						<td class="description"></td>
						<td class="price">Prix</td>
						<td class="quantity">Quantité</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php if (is_array($ROWS)) : ?>
							<?php  foreach ($ROWS as $row) : ?>
								<td class="cart_product">
									<a href=""><img style="width: 100px" src="<?php echo $row->image?>" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href=""><?php echo $row->description?></a></h4>
								</td>
								<td class="cart_price">
									<p><?php echo $row->price?> dh</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										<a class="cart_quantity_up" href="<?php echo ROOT?>add_to_cart/add_quantity/<?php echo $row->id?>"> + </a>
										<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $row->cart_quantity?>" autocomplete="off" size="2">
										<a class="cart_quantity_down" href="<?php echo ROOT?>add_to_cart/subtract_quantity/<?php echo $row->id?>"> - </a>
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price"> <?php echo $row->price*$row->cart_quantity?> dh </p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="<?php echo ROOT?>add_to_cart/remove/<?php echo $row->id?>"><i class="fa fa-times"></i></a>
								</td>
							</tr>	
							<?php endforeach; ?>
						<?php else : ?>
							<br>
							<div class='alert-danger' style='max-width:350px;margin-left:200px;text-align:center;'>
							 <h4> Aucun produit dans le panier ! <h4> </div>
							 <br>
						<?php endif; ?>
				</tbody>
			</table> 
			<div class="pull-right" style="font-size: 22px;"> Total: <?php echo number_format($sub_total)?> dh </div>
			<a class="col-md-2" href=""> </a> <!--pour laisser un peu d espace-->
			<a class="btn btn-default  update col-md-1" href="<?php echo ROOT?>shop"> <= Shopping</a>
			<a class="col-md-4" href=""> </a> <!--pour laisser un peu d espace-->
			<a class="btn btn-default check_out col-md-1" href="<?php echo ROOT?>checkout">Paiement => </a>
		</div>
		<div>
		</div>
	</div>
</section> <!--/#cart_items-->
<br>
<br>

<?php $this->view("eshop/footer",$data); ?>