<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>

<div style="margin-left:40px; margin-right:120px;">
	<form method="post">
		<table class="table table-striped table-advance table-hover">
			<thead>
				<tr> <p> <span style="text-align: left; font-size: 18px;"> Entrer informations </span> <p> </tr>
				<tr><th>Nom: <?php echo $slider_image->slide_name?></th><th>Valeurs</th></tr>
			</thead>
			<tbody>
					<tr>
						<th>Nom du produit: </th>
						<th><input  name="product_name" class="form-control" type="text" value="<?php echo $slider_image->product_name?>" required/> <B style="color: red;">le nom de produit qui apparait dans la liste des produits </B> </th>
					</tr>
					<tr>
						<th> Titre 1:</th>
						<th><input  name="header1" class="form-control" type="text" value="<?php echo $slider_image->header1?>" required/></th>
					</tr>
					<tr>
						<th>Titre 2:</th>
						<th><input  name="header2" class="form-control" type="text" value="<?php echo $slider_image->header2?>" required/></th>
					</tr>
					<tr>
						<th>Text: </th>
						<th><input  name="text" class="form-control" type="text" value="<?php echo $slider_image->text?>" required/></th>
					</tr>
					<tr>
						<th>Image: </th>
						<th><input  name="image" class="form-control" type="file" value="<?php echo $slider_image->image?>" required/> <B style="color: red;"> parcourir le dossier : eshop/public/assets/eshop/images/sliders </B></th>
					</tr>
			</tbody>
		</table>
		<input type="submit" value="Enregistrer les paramètres" class="btn btn-warning" style="float: right; margin-right: 120px;">
			<br>
	</form>
</div>

<?php $this->view("eshop/admin/footer",$data); ?>