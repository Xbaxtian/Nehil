<?php

 require_once("../CDatos/Componente/DAOFactory.php");
 
//include_once("../CDatos/component/ProductoDAO.php");

class Producto {
   
    private $id;
    private $nombre;
    private $Stock;
    private $descripcion;
    private $stocking;
    private $precio;
    
  // = new Orden();
       
    function __construct() {
        $ord = new Orden();
    }
            
    function getDescripcion() {
        return $this->descripcion;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

        function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getStock() {
        return $this->Stock;
    }

    function getStocking() {
        return $this->stocking;
    }

    function getPrecio() {
        return $this->precio;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setStock($Stock) {
        $this->Stock = $Stock;
    }

    function setStocking($stocking) {
        $this->stocking = $stocking;
    }

    function setPrecio($precio) {
        $this->precio = $precio;
    }

    public static  function disminuir($recibido){
        
       
        
        $recibido = (int) $recibido;

        $Cdao = new DAOFactory1();
        $iord = $Cdao->getProductoDAO(); 
        $iord->disminuirproducto($recibido);



    }

}
