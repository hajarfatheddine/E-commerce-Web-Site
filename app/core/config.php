<?php

//definition de constantes

define('WEBSITE_TITLE', "MY SHOP");

define('DB_NAME', "eshop_dbase");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_TYPE', "mysql");
define('DB_HOST', "localhost:3307");



define('DEBUG', true); //mode d erreur

if (DEBUG)
{
 	ini_set('display_erros', 1);
} else
{
	ini_set('display_erros', 0);
}

?>