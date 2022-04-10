<?php $this->view("eshop/header",$data); ?> 
<!-- $this c est a dire la calsse Home definie dans home.php et qui herite de Controller-->
<!-- en fait chaque page a un un controleur, c est a dire une classe de type Controleur-->
<section>
	<div class="container">
		<div class="row">
			
			<?php $this->view("eshop/sidebar.categ",$data); ?>
			
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Produits annoncés</h2>
					<?php if (isset($ROWS)&&is_array($ROWS)) : ?>
					<?php $ROWS=array_reverse($ROWS); ?>
						<?php  foreach ($ROWS as $row) : ?>
							<?php $arr[0]=$row; $this->view("eshop/one_product",$arr); ?> 
						<?php endforeach; ?>
					<?php else : ?>

						<div class='alert-danger' style='max-width:350px;margin:auto;text-align:center;'>
						 <h4> Aucun produit n'est disponible ! <h4> </div>
						 	
					<?php endif; ?>
					
				</div><!--features_items-->
				
			</div>
		</div>
	</div>
</section>


<style type="text/css">
    .box_produc
    {
      
      border: 1px solid #9325BC;
      padding: 5px;
      transition: all 1s case;
    }
    .box_produc:hover
    {
      transform: scale(1.5);
    }
 </style>
	
<?php $this->view("eshop/footer",$data); ?>