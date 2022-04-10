
<footer id="footer"><!--Footer-->
	
	<div class="footer-widget">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-1">
					
				</div>
				
				<div class="col-sm-3">
					<div class="single-widget">
						<p>							
							<?php  if(isset($data['user_data']) && $data['user_data']->role=='admin'): ?>		<a href="<?php echo ROOT?>admin"><h4><u>Admin</u><h4></a>
								<!-- ce lien fait appel au controleur de vue (de page) admin-->
								<img src="<?php echo ASSETS?>eshop/images/home/adminicon.png" alt="" />
							<?php endif; ?>
						</p>
					</div>
				</div>
				<div class="col-sm-1">
					
				</div>		

				<div class="col-sm-3">
					<div class="single-widget">
						<h4>Eshop.ma : addresse</h4>
						<ul class="nav nav-pills nav-stacked">
							<li>Quartier Nour</li>
							<li>Rue Neige N 60</li>
							<li>Casablanca</li>	
							<li>Maroc</li>
						</ul>
					</div>
				</div>
				<div class="col-sm-1">
					
				</div>
												
				<div class="col-sm-3 col-sm-offset-1">
					<div class="single-widget">
						<br>
						<li><a href="http://<?php echo val_setting($settings, "site_link"); ?>"><i class="fa fa-globe"> </i> <B><?php echo val_setting($settings, "site_link"); ?></B></a></li> 
						<br>
						<li><a href="tel:<?php echo val_setting($settings, "phone_site"); ?>"><i class="fa fa-phone"> </i> <B><?php echo val_setting($settings, "phone_site"); ?></B></a></li>
						<br>
						<li><a href="mailto:<?php echo val_setting($settings, "email_site"); ?>"><i class="fa fa-envelope"> </i> <B><?php echo val_setting($settings, "email_site"); ?></B></a></li>
					</div>
				</div>
				
				<div class="col-sm-1">
					
				</div>
				
			</div>
		</div>
	</div>
			
</footer><!--/Footer-->
	
<script src="<?php echo ASSETS?>eshop/js/jquery.js"></script>
<script src="<?php echo ASSETS?>eshop/js/jquery-1.8.3.min.js"></script>
<script src="<?php echo ASSETS?>eshop/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS?>eshop/js/jquery.scrollUp.min.js"></script>
<script src="<?php echo ASSETS?>eshop/js/price-range.js"></script>
<script src="<?php echo ASSETS?>eshop/js/jquery.prettyPhoto.js"></script>
<script src="<?php echo ASSETS?>eshop/js/main.js"></script>
</body>
</html>
