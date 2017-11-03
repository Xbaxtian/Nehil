<?php

include_once("../CDatos/Componente/DAOFactory.php");


echo "fuck4";
class Orden {
   
   private $ID;
   private $date;
   private $limite;
   private $listadeproductos = array();
  // private $listadeproductos = array('id'=>array(),'nombre'=>array(),'descripcion'=>array(),'precio'=>array(),'stock'=>array(),'stocking'=>array() );


 //  $pBB = array("title" => array(), "type" => array());
   


    function setID($ID) {
           $this->ID = $ID;
    }
   
     function getID() {
       return $this->ID;
    }
     
    function setDate($date) {
       $this->date = $date;
    }
   
   
    function getDate() {
       return $this->date;
    }
   
    function setLimite($limite) {
       $this->limite = $limite;
    }
   
   
    function getLimite() {
       return $this->limite;
    }
    


    function setListadeproductos($listadeproductos) {
       $this->listadeproductos = $listadeproductos;
    }

   
    function getListadeproductos() {
       return $this->listadeproductos;
    }

  /*  function agregarProducto($listadeproductos){
              
              echo "fuck5";
 //   $listadeproductos[] = array('id'=>$producto->getID(),'nombre'=>$producto->getNombre(),'descripcion'=>$producto->getDescripcion(),'precio'=>$producto->getPrecio(),'stock'=>$producto->getStock(),'stocking'=>$producto->getStocking());
 
     
    //   $listadeproductos[] = ($producto);
    print_r($listadeproductos); 
    }
    */
    function Ingresar(){

  //   print_r( $this->getListadeproductos());
//
        $Cdao = new DAOFactory1();
        $iord = $Cdao->getOrdenDAO(); 
        $iord->agregarorden($this);

        echo "fuck6";
    }
    
    
    
}

