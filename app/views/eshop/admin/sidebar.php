<!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <!--<p class="centered"><a href="" class="img-circle" width="60">Admin</a></p>-->
                  <br>
                  <h4 class="centered"  style="color: #aaa;">Admin</h4>
              	  <h5 class="centered"  style="color: #000000;"><?php echo $data['user_data']->name ?> </h5>
                  <h5 class="centered" style="font-size: 12px; color: #000000;">  <?php echo $data['user_data']->email ?> </h5>
              	  	
                  <div style= "min-height: 30px;">
                  </div>

                  <li class="sub-menu">
                      <a href="<?php echo ROOT?>admin" >   <! redirection vers le controleur de page admin>
                          <i class="fa fa-dashboard fa-fw"></i>
                          <span>Tableau de bord</span>
                      </a>
                      
                  </li>
                   <li class="sub-menu">
                      <a href="<?php echo ROOT?>admin/products" >   <! vers le controleur de page admin, method products>
                          <i class="fa fa-barcode fa-fw"></i>
                          <span>Produits</span>
                      </a>
                      
                  </li>
                  <li class="sub-menu">
                       <a href="<?php echo ROOT?>admin/categories" >
                          <i class="fa fa-list-alt fa-fw"></i>
                          <span>Catégories</span>
                      </a>
                      
                  </li>  

                  <li class="sub-menu">
                       <a href="" >
                          <i class="fa fa-reorder fa-fw"></i>
                          <span>Commandes</span>
                      </a>
                      <ul class="sub">
                              <li><a  href="<?php echo ROOT?>admin/orders/no_pay">Commandes non payées</a></li>
                              <li><a  href="<?php echo ROOT?>admin/orders/all">Toutes les commandes</a></li>
                      </ul>
                  </li>  

                  <li class="sub-menu">
                       <a href="" >
                          <i class="fa fa-reorder fa-fw"></i>
                          <span>Rapports de vente</span>
                      </a>
                      <ul class="sub">
                              <li><a  href="<?php echo ROOT?>admin/rapport">Quotidiens</a></li>
                              <li><a  href="<?php echo ROOT?>admin/rapport_m">Mensuels</a></li>
                      </ul>
                  </li>  
                  
                  <li class="sub-menu">
                      <a href="" >
                          <i class="fa fa-user fa-fw"></i>
                          <span>Utilisateurs</span>
                      </a>
                      <ul class="sub">
                              <li><a  href="<?php echo ROOT?>admin/users/customers">Clients</a></li>
                              <li><a  href="<?php echo ROOT?>admin/users/admins">Admins</a></li>
                      </ul>
                  </li> 
                  <li class="sub-menu">
                       <a href="" >
                          <i class="fa fa-cogs fa-fw"></i>
                          <span>Paramètres</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="<?php echo ROOT?>admin/socials">Liens sociaux</a></li>
                          <li><a  href="<?php echo ROOT?>admin/slider_images">Images slider</a></li>
                      </ul>
                  </li>   
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <! le reste de cette partie sur le debut du footer>
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper site-min-height">
            <h3><i class="fa fa-angle-right"></i> <?php echo $data['page_title'] ?> </h3>
            <div class="row mt">
              <div class="col-lg-12">
     
      