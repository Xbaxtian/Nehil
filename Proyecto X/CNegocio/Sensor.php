<?php

	
	include_once("Producto.php");



	class Sensor{

		private $recibido;


		public function __construct($recibido){
		
		$this->recibido = $recibido;

		Producto::disminuir($this->recibido);

		}


	}

	


?>