<?php

	include './IBodegueroDAO.php';
	include './Conexion.php';
	include './BodegueroTO.php';
	
	



class BodegueroDAO implements IBodegueroDAO{

	private $cn;

	public function __construct(){

		$cn = new Conexion();
	}

	public function listabodeguero(){
		$db = $cn -> conectar();
		$c_bodeguero = $db -> selectCollection("Bodeguero");
		

	}


}

	


?>