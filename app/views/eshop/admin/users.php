<?php $this->view("eshop/admin/header",$data); ?>
<?php $this->view("eshop/admin/sidebar",$data); ?>

<?php if (isset($users)&&is_array($users)) :?>
	<div style="margin-left:40px; margin-right:120px;">
		<table class="table table-striped table-advance table-hover">
			<thead>
				<tr> <p> <span style="text-align: left; font-size: 18px;"> Cliquer sur le lien en bleu pour voir les détails: <B style="color: red"> le client et ses commandes </B></span> <p> </tr>
				<tr><th>Client</th><th>Email</th><th>Date</th><th>nombre de commandes</th></tr>
			</thead>

			<tbody>
				<?php foreach ($users as $user) : ?>
					<tr style="position: relative;">
					<th> <a href="<?php echo ROOT?>admin/profile_url/<?php echo $user->url_address?>"> <?php echo $user->name?> </a> </th>
					<th><?php echo $user->email?></th>
					<th><?php echo $user->date?></th>
					<th><?php echo $user->orders_count?></th>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else :?>
		
		<div class='alert-danger' style='max-width:350px;margin-left:200px;text-align:center;'>
		<h4> Aucun utilisateur !<h4> </div>
				
<?php endif;?>


<?php $this->view("eshop/admin/footer",$data); ?>