
<?php

//include_once("../CDatos/component/OrdenDAO.php");
include_once("../CDatos/component/OrdenDAO.php");
include_once("../CDatos/component/ProductoDAO.php");


class DAOFactory1 {
    
    private static $daofac;
    
    /*function __construct(){
       $daofac = new DAOFactory();
    }*/
    
    public static function getInstance(){
        
        return $daofac;
    }
    
    public function getBodegueroDAO(){
        return new BodegueroDAO();
    }
    
    public function getOrdenDAO(){
        return new OrdenDAO();
    }

    public function getProductoDAO(){

        return new ProductoDAO();
    }
}
