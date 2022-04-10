<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>

<?php if (isset($slider_images)&&is_array($slider_images)) :?>
	<div style="margin-left:40px; margin-right:120px;">
		<tr> <p> <span style="text-align: left; font-size: 18px;"> Cliquer sur le lien en bleu pour mettre à jour  </span> <p> </tr>
		<?php foreach ($slider_images as $slider_image) : ?>
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr><th>Nom du slide</th><th>Nom du produit</th><th>Titre 1</th><th>Titre 2</th><th>Text</th><th>Image</th></tr>
				</thead>
				<tbody>
					<tr style="position: relative;">
						<th> <a href="<?php echo ROOT?>admin/info_slider_images/<?php echo $slider_image->id?>"> <?php echo $slider_image->slide_name?>  </a> </th>
						<th> <?php echo $slider_image->product_name?> </th>
						<th> <?php echo $slider_image->header1?> </th>
						<th> <?php echo $slider_image->header2?> </th>
						<th> <?php echo $slider_image->text?> </th>
						<th> <img src="<?php echo $slider_image->image?>" style= "width:70px; height:70px;" /> </th>
					</tr>
					<tr>
				</tbody>
			</table>
		<?php endforeach; ?>
	</div>
<?php else :?>
		
		<div class='alert-danger' style='max-width:350px;margin-left:320px;text-align:center;'>
		<h4> Aucun Lien social !<h4> </div>
				
<?php endif;?>

<?php $this->view("eshop/admin/footer",$data); ?>