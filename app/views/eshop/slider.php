
<?php 	$slide1= $slider_images[0];
		$slide2= $slider_images[1];
		$slide3= $slider_images[2];
 ?>

<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
						<li data-target="#slider-carousel" data-slide-to="1"></li>
						<li data-target="#slider-carousel" data-slide-to="2"></li>
					</ol>
					
					<div class="carousel-inner">
						<div class="item active">
							<div class="col-sm-6">
								<h1><FONT face ="Comic Sans MS" color= "#267326"><?php echo $slide1->header1;?></FONT><FONT color="red"></h1>
								<h2><?php echo $slide1->header2;?> </FONT> </h2>
								<p><FONT color= "Black"> <B><?php echo $slide1->text;?></B></FONT></p>
								<button type="button" class="btn btn-fefault cart" onclick="redirect1()">
								Obtenez le => </button>
							</div>
							<div class="col-sm-6">
								<img src="<?php echo $slide1->image?>" class="girl img-responsive" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><FONT face ="Comic Sans MS" color= "#267326"><?php echo $slide2->header1;?></FONT><FONT color="red"></h1>
								<h2><?php echo $slide2->header2;?> </FONT> </h2>
								<p><FONT color= "Black"> <B> <?php echo $slide2->text;?></B></FONT></p>
								<button type="button" class="btn btn-fefault cart" onclick="redirect2()">
								Obtenez le => </button>
							</div>
							<div class="col-sm-6">
								<img src="<?php echo $slide2->image?>" class="girl img-responsive" alt="" />
							</div>
						</div>
						
						<div class="item">
							<div class="col-sm-6">
								<h1><FONT face ="Comic Sans MS" color= "#267326"><?php echo $slide3->header1;?></FONT><FONT color="red"></h1>
								<h2><?php echo $slide3->header2;?> </FONT></h2>
								<p><FONT color= "Black"> <B><?php echo $slide3->text;?></B></FONT></p>
								<button type="button" class="btn btn-fefault cart" onclick="redirect3()">
								Obtenez le => </button>
							</div>
							<div class="col-sm-6">
								<img src="<?php echo $slide3->image?>" class="girl img-responsive" alt="" />
							</div>
						</div>
						
					</div>
					
					<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
						<i class="fa fa-angle-left"></i>
					</a>
					<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
						<i class="fa fa-angle-right"></i>
					</a>
				</div>
				
			</div>
		</div>
	</div>
</section><!--/slider-->

<script>
function redirect1() {

  location.replace("<?php echo ROOT?>product_details/<?php echo $slide1->slag?>");
}
</script>

<script>
function redirect2() {

  location.replace("<?php echo ROOT?>product_details/<?php echo $slide2->slag?>");
}
</script>

<script>
function redirect3() {

  location.replace("<?php echo ROOT?>product_details/<?php echo $slide3->slag?>");
}
</script>