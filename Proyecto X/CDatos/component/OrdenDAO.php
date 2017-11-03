<?php

include_once("../CDatos/desing/IOrdenDAO.php");
include_once("../CNegocio/Orden.php");
//include("../CDatos/desing/IProductoDAO.php");
include_once("ProductoMD.php");

class OrdenDAO implements IOrdenDAO{
    
    
    private $cn;
    
    public function __construct() {
      
       
    }
    
    public function agregarorden($orden) {
        
        static $ID;  

        echo $ID;

        $cn = new Conexion();
        
        $IDf = OrdenDAO::ID($ID);
        $orden->setID($IDf);
        /* @var $fecha type */
        $fecha=OrdenDAO::date();
        $orden->setDate($fecha);

        /* @var $lista type */
        $lista = $orden->getListadeproductos();

        $bd = $cn->conectar();
        
        $cOrden = $bd->selectCollection('Orden');
        
        
        if(count($lista) > 0) OrdenDAO::principal($lista,$cOrden,$orden);
        
        $ID++;
        
        echo $ID;        
        
        
    }


    public static function principal($lista,$cOrden,$orden){


         $arraydisp = array('limite' => array('$lt'=> 4) ); /// <4
       



        $cursor = $cOrden->find($arraydisp);

        $pre = count($lista);
        $eliminados = array(-1);
        foreach ($lista as $key) {

            $filtro = array('productos.id' => $key->getID());
            $proyeccion = array('productos.$' => 1);
            $c = $cOrden->find($filtro,$proyeccion); 
           
            $encontrados =$c -> count();
            

            echo "encontrados: ";
            echo $encontrados; echo "</br>";
            //$cc = $c -> getNext();
           
    
    

            $index = 0;
            if($encontrados > 0){
                



           
            $j = false;
            for($y = 0; $y < $pre;$y++){
                
                echo "eliminados: ";
                print_r($eliminados);echo "</br>"."</br>";

                foreach ($eliminados as $ver) {
                    if($ver == $y){ 
                        $j = true;
                    }
                }


                if($j == false){

                    if(($lista[$y]->getID()) == $key->getID()){
                        $index = $y;
                        array_push($eliminados, $index);
                    }
                }

                    echo "</br>";
            $j = false;

            }

            echo "index: ";
            echo $index;
            echo "</br>";

            print_r($lista);     echo "</br>";
         //   echo "what a life"."</br>"."</br>";;
            unset($lista[$index]);   echo "</br>";
           // echo "what a life"."</br>"."</br>";;
            print_r($lista);     echo "</br>";
            
            
            }


            echo "</br>";
         }
       echo "</br>";

     


        $disponibles = $cursor->count();
    //    echo $disponibles; echo "</br>";
        
        echo "lista despues de revision: ";
        print_r($lista);
        echo "</br>";
        echo "</br>";
        
      

        if($disponibles == 0){
                // lo que ya esta 
        //        echo "1 if";
        //        echo "</br>";
                if($orden->getLimite()>4){          // funcion  1

          //          echo "2 if";
           //          echo "</br>";
                    OrdenDAO::primercaso($lista,$orden,$cOrden,0);                   
                   
                }

              else { //echo "2 if else";  echo "</br>"; 
              OrdenDAO::agregar($lista,$orden,$cOrden); }  //
            }
            else{
              
       //         echo "1 if else";echo "</br>";
              
                $limite = $cursor -> getNext();
                
    //            $descartar = array();
   //             print_r($descartar = $limite['productos']);

                echo "</br>";

                echo "_id :";
                echo $limite['_id']; 
              

                echo "</br>";
                
             


                if( 4-$limite['limite'] >= $orden ->getLimite()){
        //            echo 4-$limite['limite']; echo "</br>";
         
          ///          echo "3 if";echo "</br>";
                    OrdenDAO::segundocaso($lista,$limite,$cOrden);

                }   
                else{    
          

             //           echo "3 if else"; echo "</br>";

   
               //           echo 4-$limite['limite'] + $orden ->getLimite(); echo " carry us all";echo "</br>";

                        if($limite['limite'] + $orden ->getLimite() >= 4){
                             
                              
                 //               echo  count($lista)."kkk".$orden ->getLimite();
                   //             echo "</br>";
                                
                                OrdenDAO::primercaso($lista,$orden,$cOrden,$limite); 
                                
      
                        }
                        else{
                                OrdenDAO::segundocaso($lista,$limite,$cOrden);

                        }
                           
                               
                            
                }      

         }   
                    
    }


    
    public static function ID($ID){
        
      
        echo $ID;
        $tmñ = strlen($ID);
        if ($tmñ == 1) {
            $ID = "O000" . $ID;
        }
        if($tmñ == 2){
            $ID = "O00".$ID;
        }
        if($tmñ == 3){
            $ID = "O0".$ID;
        }
        
        return $ID;
    }
            
    public static function date(){
        
        date_default_timezone_set('America/Bogota');
        
        $d=date("d");
        $m=date("m");
        $año=date("Y");
        $fecha =$d."/".$m."/".$año;
        return $fecha;
    }
    
    public static function agregar($lista,$orden,$cOrden){
        

        $Ordenf= array();
        
        $Ordenf['id']=$orden->getID();
        $Ordenf['Fecha']=$orden->getDate();
        $Ordenf['limite']=$orden->getLimite();
        


        
        $productos=array();
        $productos = OrdenDAO:: convertir($lista,$productos);
        



        $Ordenf['productos']=$productos;
        $cOrden -> insert($Ordenf);
 
    }

  

    public static function primercaso($lista,$orden,$cOrden,$par){
              
       
        if($par == 0){ 
      //      $final = $final - 1;
        
            $inicio = $par;
        }
        else{

            $inicio = $par['limite'];
        }
                
         $sig = array();

                    echo "inicio desde la orden: ";
                    echo $inicio;
                    echo "</br>";
                  //  echo "jajajajajaja";echo "</br>";
                   for($inicio ; $inicio<4;$inicio++){
                        
                    array_push($sig,array_pop($lista));
                     echo count($lista);
                    }
                    echo "</br>";
                    echo "Ingresar al que ya existe: ";
                    print_r($sig);
                    echo "</br>";
         
         if($inicio == 0){
                    
                    $orden -> setLimite(count($lista));
                    $auxorden = new Orden();
                    $auxorden -> setLimite(count($sig));
                    $auxorden -> setListadeproductos($sig);
                    $auxorden -> Ingresar();

                   
                    
                    
                    
        }
        
        else{


                    $idpush = $par['_id'];

                    echo "id donde va a pushear:";
                    echo $idpush;
                    echo "</br>";            
                    
      //              echo "skyyyyy";
     //                      //
     //          
                    $sig1 = array();
                    $sig1 = OrdenDAO::convertir($sig,$sig1);
                    
                    echo "ingresar convertido: ";
                    print_r($sig1);
                    echo "</br>"; 
                   // echo  $par['limite'];

                    $condicion = array('_id' => $idpush);
                    echo "</br>"; 
                    $new =$par['limite']+count($sig1);
                    
                    echo "nuevo limite :";
                    echo $new;                                      //
                    echo "</br>";                                       //
                    $actlim = array('$set' => array('limite' => $new ));
                    $arraypush = array('$pushAll' => array('productos'=>$sig1));
                    $cOrden->update($condicion,$arraypush);
                    $cOrden->update($condicion,$actlim);

        }

         $orden->setLimite(count($lista));

        OrdenDAO::agregar($lista,$orden,$cOrden);


    }




    public static function segundocaso($lista,$limite,$cOrden){


                    echo "segundo caso";  
                    echo "</br>";


                    $idpush = $limite['_id'];
                    
                    echo "id de pusheo";
                    echo $idpush;                       //
                    echo "segundo caso";                                        //

                    $productos = array();                                           // FUNCION 2
     
                    $productos = OrdenDAO::convertir($lista,$productos);
    

                    $condicion = array('_id' => $idpush);

                    $new =$limite['limite']+count($productos);
                    
                    echo "nuevo limite :";
                    echo $new;                                      //
                    echo "</br>";                                       //
                    $actlim = array('$set' => array('limite' => $new ));
                    $arraypush = array('$pushAll' => array('productos'=>$productos));
                    $cOrden->update($condicion,$arraypush);
                    $cOrden->update($condicion,$actlim);

    }

    public static function convertir($lista,$productos){

  //      print_r($lista);
  
        foreach($lista as $productosDB){
            $p= new ProductoMD();
            $p->id=$productosDB->getID();
            $p->descripcion=$productosDB->getDescripcion();
            $p->nombre=$productosDB->getNombre();
            $p->stock=$productosDB->getStock();
            $p->stocking=$productosDB->getStocking();
            $p->precio=$productosDB->getPrecio();
            array_push($productos, $p);
  
            }
            
  //      print_r($productos);
        return $productos;
    }     

    public function listarordenes() {
        
    }

}


