<?php



class Conexion
{
    
    
    function conectar(){
    
    try{
        $mongo = new Mongo();
        $db = $mongo -> selectDB("Sasb");
       
    }
    catch(MongoConnectionException $e){
        die($e->getMessage());
    }
    
    
    return $db;
    }
    
}





?>