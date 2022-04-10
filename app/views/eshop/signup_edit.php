<?php $this->view("eshop/header",$data); ?> 
	
<section id="form"  style= "margin-top : 5px;"><!--form-->
	<div class="container">
		<div class="row" style="text-align: center;">
			<span style ="font-size:18; color:red;"> <?php check_error();  ?> </span>
			<div class="col-sm-4" style= "float : none; display : inline-block;">
				<div class="signup-form"><!--sign up form-->
					<h2>Modification compte utilisateur!</h2>
					<form method="post">
						<input name="name" value="<?= isset($_POST['name']) ?  $_POST['name'] : $name;?>" type="text"  placeholder="Name"  autofocus/>
						<input name="email" value="<?= isset($_POST['email'])? $_POST['email'] : $email;?>" type="email" placeholder="Email Address"  />
						<input name="password" type="password" placeholder="Password"/>
						<input name="password2" type="password" placeholder="Retype Password"/>
						<button type="submit" class="btn btn-default"> Modifier </button>
					</form>
				</div><!--/sign up form-->
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
