<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Catégories</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<?php $parents = array_column($categories,"parent"); ?>
		<?php if (isset($categories)&& is_array($categories)) : ?> 
		<?php $categories=array_reverse($categories); ?> <!--pour inverser l ordre des elements-->
		<!--avec sous categories-->
				<?php foreach ($categories as $cat) : ?>
					<?php if (in_array($cat->id, $parents)) : ?> 
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo preg_replace("/\s+/","", $cat->category);?>">
										<!--pour eliminer les espaces-->
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										<?php echo $cat->category;?>
									</a>
								</h4>
							</div>
							<div id="<?php echo preg_replace("/\s+/","", $cat->category);?>" class="panel-collapse collapse"> <!--pour eliminer les espaces-->
								<div class="panel-body">
									<ul>
									<?php foreach ($categories as $sub_cat) : ?> 
										<?php if ($sub_cat->parent==$cat->id): ?>
											<?php $href =ROOT."shop/category/".$sub_cat->category ?>
											<li><a href="<?php echo $href ?>"><?php echo $sub_cat->category ?></a></li>
										<?php endif; ?>
									<?php endforeach; ?>	
									</ul>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			<!--sans sous categories-->
				<?php foreach ($categories as $cat) : ?>
					<?php if (!in_array($cat->id, $parents)&&($cat->parent==0)) : ?> 
						<?php $href =ROOT."shop/category/".$cat->category ?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title"><a href="<?php echo $href ?>"><?php echo $cat->category ?></a></h4>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>	
		<?php endif; ?>
		</div><!--/category-products-->
	
		<div class="shipping text-center"><!--shipping-->
			
		</div><!--/shipping-->

		<!--<div class="shipping text-center">
			<img src="<?php echo ASSETS?>eshop/images/home/shipping.jpg" alt="" />
		</div>-->

		<div class="shipping text-center"><!--shipping-->
			
		</div><!--/shipping-->
		<div class="shipping text-center"><!--shipping-->
			
		</div><!--/shipping-->
		<div class="shipping text-center"><!--shipping-->
			
		</div><!--/shipping-->
	</div>
</div>