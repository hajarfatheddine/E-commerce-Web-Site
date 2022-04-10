<?php $this->view("eshop/header",$data); ?> 
	
<section>
	<div class="container">
		<div class="row">
			
			<?php $this->view("eshop/sidebar.categ",$data); ?>
			
			<div class="col-sm-9 padding-right">	
				<?php if ($ROWS) : ?> 
				<div class="product-details"><!--product-details-->
					<div class="col-sm-5">
						<div class="view-product">
							<img src="<?php echo $ROWS->image?>" style="width: 300px; height: 300px" alt="" />
						</div>
					</div>
					<div class="col-sm-7">
						<div class="product-information"><!--/product-information-->
							
							<h2><?php echo $ROWS->description?></h2>
							<span>
								<span><?php echo $ROWS->price?> dh</span>
								<label>Quantité: </label>
								<input type="text" value="3" />
								<button type="button" class="btn btn-fefault cart" onclick="redirect()">
									<i class="fa fa-shopping-cart"></i>
									Ajouter au panier
								</button>
							</span>
							<p><b>Disponibilité:</b> <?php echo $ROWS->quantity?> articles </p>
							<p><b>Etat:</b> <?php echo $ROWS->state?></p>
							<p><b>Marque:</b> <?php echo $ROWS->brand?></p>
							<!--<a href=""><img src="<?php echo ASSETS?>eshop/images/product-details/share.png" class="share img-responsive"  alt="" /></a>-->
						</div><!--/product-information-->
					</div>
				</div><!--/product-details-->	
			</div>
		</div>
		<?php else : ?>
					<div class='alert-danger' style='max-width:350px;margin:auto;text-align:center;'>
					 <h4> Ce produit n'est pas disponible ! <h4> </div>
					 	
		<?php endif;?>
	</div>
</section>

<style type="text/css">
    .box_product
    {
     
  		height: 100%;
  		width: 100%;
      	border: 1px solid #9325BC;
      	padding: 5px;
    }
    
 </style>

<script>
function redirect() {
  location.replace("<?php echo ROOT?>add_to_cart/<?php echo $ROWS->id?>");
}
</script>

<?php $this->view("eshop/footer",$data); ?>