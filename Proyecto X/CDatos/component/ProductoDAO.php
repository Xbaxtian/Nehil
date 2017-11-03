<?php

include_once("../CDatos/desing/IProductoDAO.php");
include_once("../CNegocio/Orden.php");
//include_once("../CNegocio/Producto.php");
include_once("../CDatos/ds/Conexion.php");


class ProductoDAO implements IProductoDAO{
   
    private $cn;
    
  /*  function __construct() {
        
    }

*/
    public function productofaltante() {
    
        
       
        try{

        $cn = new Conexion();
        echo "fuck";

        echo "fuck2";   
        
        $bd = $cn->conectar();
        
        $cProductof = $bd->selectCollection('Producto');
        echo "fuck3"." ";
        
       
        $arraypf = array('stock' => array('$lte' => 10) );
        
        if($cProductof->count() != 0){
              //  echo "rising sun".$cProductof->count();
                ProductoDAO::agregaraorden($arraypf,$cProductof);
                "fuck4";
           }
        }
        
        catch(MongoConnectionException $e){echo $e;}
    }
    
    
    public static function agregaraorden($arraypf , $cProductof){
        
        $cursor = $cProductof->find($arraypf);
        
        $orden = new Orden();

        $listadeproductos = array();
   
         while($cursor->hasNext()){
        	
               
                
                $campo=$cursor->getNext();
        	
                 $pro = new Producto();
        	 
                 $pro->setId($campo['id']);   echo "</br>";




        	       $pro->setNombre($campo['nombre']);   echo "</br>";
                 $pro->setDescripcion($campo['descripcion']);   echo "</br>";
                 $pro->setPrecio($campo['precio']);   echo "</br>";
                 $pro->setStock($campo['stock']);    echo "</br>";
                 $pro->setStocking($campo['stocking']);   echo "</br>";
        	

                array_push($listadeproductos, $pro);
                
                
    }
   
    
    $orden->setListadeproductos($listadeproductos);
    $orden->setLimite(count($listadeproductos));

    $orden->Ingresar();

}



  public function disminuirproducto($recibido){

    try{
  
           $cn = new Conexion();
           $bd = $cn ->conectar();
           echo " conectado"."</br>";

           $cProducto = $bd->selectCollection('Producto');
  //  $cProducto  = new MongoCollection($bd,'Producto');
    
            print_r($cProducto);
     
           $condicion = array('id' => $recibido);
          echo "</br>";
   
           $cursor = $cProducto -> find($condicion);

          foreach($cursor as $producto){
    //echo "foreach"; echo "</br>";
      
          $stocknuevo = $producto['stock'];
          $stocknuevo = $stocknuevo - 1;
      
           var_dump($producto);
          echo "</br>";
     }

     $nuevo = array('$set'=> array('stock' => $stocknuevo));
     $cProducto->update($condicion,$nuevo);
     ProductoDAO::productofaltante();
    

    }
    catch(MongoConnectionException $e){
        die($e->getMessage());
    }

     


  }

}
