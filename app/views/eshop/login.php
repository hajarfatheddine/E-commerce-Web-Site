<?php $this->view("eshop/header",$data); ?> 
	
<section id="form"  style= "margin-top : 5px;"><!--form-->
	<div class="container">
		<div class="row" style="text-align: center;">
			<span style ="font-size:18; color:red;"> <?php check_error();?> </span>
			<div class="col-sm-4" style= "float : none; display : inline-block;">
				<div class="login-form"><!--login form-->
					<h2>Connectez-vous à votre compte</h2>
					<form method="POST"> 
						<!--precise qu on utilise post et non get, car get va envoyer les donnes dans l url et etre donc visible-->
						<!-- ce qui est ajoute en bas dans valeur permet d afficher l email si il est tape auparavant, pour eviter de le taper une deuxieme fois-->
						<input type="email" name="email" value="<?= isset($_POST['email'])? $_POST['email'] : '';?>" placeholder="Email Address" autofocus />
						<input type="password" name="password" value="<?= isset($_POST['password'])? $_POST['password'] : '' ; ?>" placeholder="Password"  />

						<button type="submit" class="btn btn-default">Login</button>
					</form>
					<!-- un lien vers signup si pas de compte-->
					<a href="<?php echo ROOT?>signup"> <br> Vous n'avez pas de compte? inscrivez-vous ici </a>
					 <!-- redirection vers le controleur de page signup-->
				</div><!--/login form-->
			</div>
			
			
		</div>
	</div>
</section><!--/form-->
	
<?php $this->view("eshop/footer",$data); ?> 

<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
