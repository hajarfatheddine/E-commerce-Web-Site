<!-- un seul produit -->

<!-- on a utilise $data car dans controller.php on a $data, et $data[0] car le controlleur recoit un tableau-->

<div class="col-sm-4">
	<div class="product-image-wrapper">
		<div class="single-products">
				<div class="productinfo text-center">
				<a href="<?php echo ROOT?>product_details/<?php echo $data[0]->slag?>">
					<!--appel au controleur product_details qui lui appel la vue-->
					<div class="box_produc">
						<img src="<?php echo $data[0]->image?>" alt=""/>
					</div>
				</a>
					<h2><?php echo $data[0]->price." dh"?></h2>
					<p><?php echo $data[0]->description ?></p>
					<a href="<?php echo ROOT?>add_to_cart/<?php echo $data[0]->id?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Ajouter au panier</a>
				</div>
		</div>
		
	</div>
</div> <!--fin de : un seul produit-->