<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> <?php echo $data['page_title']?> | eshop.ma </title>
    <!--on donne le chemin complet qu on a definie dans ASSETS voir fichier index public-->

    
    <link href="<?php echo ASSETS?>eshop/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS?>eshop/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS?>eshop/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo ASSETS?>eshop/css/price-range.css" rel="stylesheet">
    <link href="<?php echo ASSETS?>eshop/css/animate.css" rel="stylesheet">
	<link href="<?php echo ASSETS?>eshop/css/main.css" rel="stylesheet">
	<link href="<?php echo ASSETS?>eshop/css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?php echo ASSETS?>eshop/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo ASSETS?>eshop/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo ASSETS?>eshop/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo ASSETS?>eshop/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ASSETS?>eshop/images/ico/apple-touch-icon-57-precomposed.png">

    
</head><!--/head-->

<body>
	
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="http://<?php echo val_setting($settings, "site_link"); ?>"><i class="fa fa-globe"> </i> <B><?php echo val_setting($settings, "site_link"); ?></B></a></li>
								<li><a href="tel:<?php echo val_setting($settings, "phone_site"); ?>"><i class="fa fa-phone"> </i> <B><?php echo val_setting($settings, "phone_site"); ?></B></a></li>
								<li><a href="mailto:<?php echo val_setting($settings, "email_site"); ?>"><i class="fa fa-envelope"> </i> <B><?php echo val_setting($settings, "email_site"); ?></B></a></li>
								<?php if (isset($data['user_data'])) : ?>
									<li><a href="#"><i class="fa fa-user"> </i> <?php echo $data['user_data']->name ?> </a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="<?php echo val_setting($settings,"facebook_link"); ?>"><i class="fa fa-facebook"></i><B> </B></a></li>
								<li><a href="<?php echo val_setting($settings,"twitter_link"); ?>"><i class="fa fa-twitter"></i><B></B></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index"><img src="<?php echo ASSETS?>eshop/images/home/logo.png" alt="" /></a>
						</div>
						
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- ce test permet d afficher le compte seulemtemt si on est deja loge-->
								<!--on peut autoriser seulement l admin en ajoutant la condition suivante:  $data['user_data']->role=='admin'-->
								<?php  if(isset($data['user_data'])): ?>
								<li><a href="<?php echo ROOT?>profile"><i class="fa fa-user"></i> <B>Compte</B></a></li>
								<!-- ce lien fait appel au controleur de vue (de page) profile-->
								<?php endif; ?>
								<li><a href="<?php echo ROOT?>checkout"><i class="fa fa-crosshairs"></i><B>Paiement</B></B></B></a></li>
								<li><a href="<?php echo ROOT?>cart"><i class="fa fa-shopping-cart"></i> <B>Panier</a></B></li>
								<?php if (isset($data['user_data'])) : ?>
									<li><a href="<?php echo ROOT?>logout"><i class="fa fa-lock"></i> <B>Logout</B></a></li>
								<?php else : ?>
									<li><a href="<?php echo ROOT?>login"><i class="fa fa-lock"></i> <B>Login</B></a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="<?php echo ROOT?>index" class="active"><B>Accueil</B></a></li>
								<li class="dropdown"><a href="#"><B>Boutique</B><i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="<?php echo ROOT?>shop">Produits annoncés</a></li> 
										<li><a href="<?php echo ROOT?>cart">Panier</a></li> 
										<li><a href="<?php echo ROOT?>login">Login</a></li> 
                                    </ul>
                                </li> 
								
							</ul>
						</div>
					</div>
					<?php if($show_search=="yes") : ?>
						<div class="col-sm-3">
							<form method="get">
								<div class="search_box pull-right"> 
									<input name="find" type="text" placeholder="Rechercher un produit"/>
								</div>
							</form>
						</div>
				<?php endif; ?>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
