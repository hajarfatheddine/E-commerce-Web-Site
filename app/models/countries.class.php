<?php

Class Countries {

	public function get_countries(){

		$db= Database::getInstance();
		$sql= "select * from countries order by id desc";
		$data=$db->read($sql);
		return $data;
	}

	
	public function get_cities($id){

		$id = (int)$id;
		$db= Database::getInstance();
		$sql= "select * from cities where parent = '$id'";
		$data=$db->read($sql);
		return $data;	
	}
	
	public function get_country($id){

		$id = (int)$id;
		$db= Database::getInstance();
		$sql= "select * from countries where id = '$id'";
		$data=$db->read($sql);
		return $data[0]->country;
	}

	
	public function get_city($id){

		$id = (int)$id;
		$db= Database::getInstance();
		$sql= "select * from cities where id = '$id'";
		$data=$db->read($sql);
		return $data[0]->city;	
	}

}