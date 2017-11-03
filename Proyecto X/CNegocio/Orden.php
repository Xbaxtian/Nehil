<?php

include_once("../CDatos/Componente/DAOFactory.php");


echo "fuck4";
class Orden {
   
   private $ID;
   private $date;
   private $limite;
   private $listadeproductos = array();
  


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

 
    function Ingresar(){

 
        $Cdao = new DAOFactory1();
        $iord = $Cdao->getOrdenDAO(); 
        $iord->agregarorden($this);

        
    }
    
    
    
}

