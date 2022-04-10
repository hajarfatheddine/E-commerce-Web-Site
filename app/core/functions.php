<?php


function show($data)
{

	echo "<pre>"; // pour mieux voir le tableau de chaines
	print_r($data);
	echo "</pre>";

}


function check_error()
{

	if ((isset($_SESSION['error'])) && ($_SESSION['error']!=""))
	{

		echo $_SESSION['error'];
		unset($_SESSION['error']);
	} //pour l effacer

}

function esc($data)
{
	return addslashes($data);
}

function val_setting($arr_of_obj,$setting){

	foreach ($arr_of_obj as $obj) {
		if ($obj->setting==$setting) {
			return $obj->value;
		}
	}

}

?>