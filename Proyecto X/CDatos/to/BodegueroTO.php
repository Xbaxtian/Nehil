<?php
 
	class BodegueroTO {

		private $id;
		private $contraseña;
		private $nombre;
		private	$apellido;
		private $dni;


		public function getId() {
		return $this->edad;
		}
		
		public function setId($id){
		$this->id = $id;
		}	

		public function getContraseña() {
		return $this->contraseña;
		}
		
		public function setContraseña($contraseña){
		$this->contraseña = $contraseña;
		}	

		public function getNombre() {
		return $this->nombre;
		}
		
		public function setNombre($nombre){
		$this->nombre = $nombre;
		}	

		public function getApellido() {
		return $this->nombre;
		}
		
		public function setApellido($apellido){
		$this->apellido = $apellido
		}	

		public function getDni() {
		return $this->dni;
		}
		
		public function setDni($dni){
		$this->dni = $dni;
		}	

	}
?>