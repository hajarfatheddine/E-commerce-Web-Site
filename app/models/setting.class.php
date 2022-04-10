<?php

Class Setting
{

	public function get_all(){

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		$data= $db->read("select * from settings order by id desc");
		if ($data) //ce type de test est important sinon il genere des errurs
		{
			return $data;
		}
	}

	public function save($POST){

		$db= Database::getInstance(); //le cours a fait newInstance (), mais ce n est pas necessaire
		
		foreach ($POST as $key => $set) {
			//show($key); 
			//show($set);
			$setting = $key;
			$value = $set;
			$query ="update settings set value = '$value' where setting = '$setting' limit 1";
			$error= $db->write($query);
		} //die;

		return $error;

	}

}

?>