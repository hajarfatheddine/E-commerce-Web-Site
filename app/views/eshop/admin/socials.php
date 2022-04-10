<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>

<?php if (isset($settings)&&is_array($settings)) :?>
	<div style="margin-left:40px; margin-right:120px;">
		<form method="post">
			<table class="table table-striped table-advance table-hover">
				<thead>
					<tr> <p> <span style="text-align: left; font-size: 18px;"> Entrer informations
					 </span> <p> </tr>
					<tr><th>Paramètre</th><th>valeur</th></tr>
				</thead>
				<tbody>
					<?php foreach ($settings as $setting) : ?>
						<tr style="position: relative;">
							<th> <?php echo str_replace("_", " ", $setting->setting);?> </th>
							<th><input  name="<?php echo $setting->setting?>" class="form-control" type="text" value="<?php echo $setting->value?>" required/></th>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<br>
			<input type="submit" value="Enregistrer les paramètres" class="btn btn-warning" style="float: right; margin-right: 120px;">
			<br>
		</form>
	</div>
<?php else :?>
		
		<div class='alert-danger' style='max-width:350px;margin-left:320px;text-align:center;'>
		<h4> Aucun Lien social !<h4> </div>
				
<?php endif;?>

<?php $this->view("eshop/admin/footer",$data); ?>