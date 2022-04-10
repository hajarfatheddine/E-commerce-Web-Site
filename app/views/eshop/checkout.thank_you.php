<?php $this->view("eshop/header",$data); ?> 

<div class="register-req" style="text-align: center;">
					<p> <h2> <B> Merci d’avoir fait du shopping avec nous !</B> </h2> </p>
					<p> <h4> <B> - votre commande a réussi -</B> </h4> </p>
</div><!--/register-req-->

<div style="text-align: center;"> 
<p> <h4> <B> Que voulez-vous faire ensuite ? </B> </h4> </p> 

<a class="btn btn-default  update " href="<?php echo ROOT?>shop"> <= continue shopping</a>
				
<a class="btn btn-default  update " href="<?php echo ROOT?>profile">Voir vos commandes =></a>

<br>
<br>

<?php $this->view("eshop/footer",$data); ?> 