<?php

session_start();
include "../app/init.php";
// inclure tous les fichiers necessaires

// Ces constantes sont des informations du serveur en cours, donnees par affichage de $_SERVER
$path = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];
//show($_SERVER);die;
$path = str_replace("index.php","", $path);

define('ROOT', $path); // devient une constante
//show (ROOT);

define('ASSETS', $path."assets/"); // devient une constante
//show(ASSETS); die;
//show(ASSETS); // show () : on l a defini pour afficher certains choses et verifier le programme




$app = new App(); // instantiation de la classe App


//App est une classe qui joue le role du routeur.
//Quelle que soit la page demandée, elle est instantiee
//elle permet d envoyer la demande de page web au bon contrôleur.

//Les URL des pages sont conçues pour faciliter le routage comme suit : 
//http://url_du_site/controleur/methode/Parameter1/ Parameter1/…

//Le moteur de réécriture de l’adresse URL la transforme comme suit :
//http://url_du_site/index.php?url=controleur/methode/param1/ param2/…

//Le routeur, grâce à la méthode GET, va récupérer url et la dissocier 
//pour déterminer ses composants : controleur, methode , param1, param2…

//dans notre cas : on a URL= ROOT concatene a url 
// avec ROOT=url_du_site= http://localhost/echop/public/ 
// et url = controleur/methode/Parameter1..... (les controleurs se trouvent dans controllers)

?>