<?php
//include "../models/valoracionesModel.php";
require_once '../config/bd_conexion.php';
session_start();


switch ($_SERVER['REQUEST_METHOD']) {
    
    case 'GET':
        {
                if (isset($_GET['id']) || isset($_GET['tipo'])) {
                    //$id = intval($_GET['id']);
                    //$tipo = $_GET['tipo'];
                    $conexion=BD::crearInstancia();
                    $contarRespuesta=contarFilasByID($_GET['tipo'],$_GET['id'], $conexion);
                    if($contarRespuesta==null){
                        http_response_code(400);
                        echo json_encode(array("status" => "error", "message" => "ningun usuario encontrado"));
                        exit;
                        break;
                    }else{
                        http_response_code(200);
                        echo json_encode($contarRespuesta);
                        break;
                    }
            

                }elseif (isset($_GET['tipo'])) {

                     $conexion=BD::crearInstancia();
                    $contarRespuesta=contarFilas($_GET['tipo'],$conexion);
                    if($contarRespuesta==null){
                        http_response_code(400);
                        echo json_encode(array("status" => "error", "message" => "ningun usuario encontrado"));
                        break;
                    }else{
                        http_response_code(200);
                        echo json_encode($contarRespuesta);  
                        break;
                    }       
                }
                

        }
    
        
    
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method Not Allowed"));
        break;
}


function contarFilas($tipo,$conexion){
        
   
    $arraySentencias=array("productosByAll"=>"select count(*) as filas from productos where activoProd = 1",
                            "productosByAllAdmin"=>"select count(*) as filas from productos where activoProd = 1 and estaListadoProd = 0",
                            );
    $sentencia = $conexion-> prepare($arraySentencias["$tipo"]);
    $sentencia -> execute([]);

    $producto = $sentencia->fetch(PDO::FETCH_ASSOC);
    

    if(!$producto) {
       return null;
    }else{
        return $producto;
    }
}

function contarFilasByID($tipo,$id,$conexion){
    
    
    $arraySentencias=array("productosByVendedor"=>"select count(*) as filas from productos where activoProd = 1 and vendedorProd = :id",
                            "productosByAdmin"=>"select count(*) as filas from productos where activoProd = 1 and adminAutoriza = :id",
                            );
    //$sqlSelect = "select count(*) as filas from productos where activoProd = 1 and vendedorProd = :id";
    $sentencia = $conexion-> prepare($arraySentencias[$tipo]);
    $sentencia->bindValue(':id', $id, PDO::PARAM_INT);
    $sentencia -> execute();

    $producto = $sentencia->fetch(PDO::FETCH_ASSOC);
    

    if(!$producto) {
       return null;
    }else{
        return $producto;
    }
}

?>