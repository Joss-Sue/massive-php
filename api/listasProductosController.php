<?php
include "../models/listasProductosModel.php";
//session_start();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        {
            
            //http://localhost/massivedemo/api/productosController.php/?idCarrito=1
            
            $productosRespuesta = ListasProductosClass::buscarAllProductos($_GET['idLista']);
                if($productosRespuesta==null){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "ninguna lista encontrada"));
                    exit;
                }else{
                    http_response_code(200);
                    echo json_encode($productosRespuesta);
                    exit;
                }
            
            
        break;
        }
    case 'POST':
        {
            //ejemplo json{"idLista":1, "idProducto":1}

            $data = json_decode(file_get_contents('php://input'), true);

                extract($data);
               
                
                if(empty($idLista) || empty($idProducto) ){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "algun dato vacio"));
                    exit;
                }

                $resultadoFuncion = ListasProductosClass::registrarProducto($idLista, $idProducto);

               if ($resultadoFuncion[0]){
                http_response_code(200);
                echo json_encode(array("status" => "success", "message" => $resultadoFuncion[1]));
                exit;
               }else{
                http_response_code(400);
                echo json_encode(array("status" => "error", "message" => $resultadoFuncion[1]));
                exit;
                }  
               break;
            }

    case 'DELETE':
        {
            /*ejemplo json{"id":2}*/
            $data = json_decode(file_get_contents('php://input'), true);
            $id = (isset($data['id']))?($data['id']):null;
            
            if(empty($id)){
                http_response_code(400);
                echo json_encode(array("status" => "error", "message" => "id vacio"));
                exit;
            }

            $resultadoFuncion = ListasProductosClass::eliminarProducto($data['id']);
            if ($resultadoFuncion[0]){
                http_response_code(200);
                echo json_encode(array("status" => "success", "message" => $resultadoFuncion[1]));
               }else{
                http_response_code(400);
                echo json_encode(array("status" => "error", "message" => $resultadoFuncion[1]));
                }
            break;
        }
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method Not Allowed"));
        break;
}

?>