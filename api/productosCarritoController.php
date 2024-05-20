<?php
include "../models/productosCarritoModel.php";
session_start();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        {
            //http://localhost/massivedemo/api/productosController.php/?idCarrito=1
            $productosRespuesta = ProductosCarritoClass::buscarAllProductos($_GET['idCarrito']);
                if($productosRespuesta==null){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "ningun producto en el carrito encontrado"));
                }else{
                    http_response_code(200);
                    echo json_encode($productosRespuesta);
                }
        }
        break;
    case 'POST':
        {
            /*ejemplo json{"nombre":"Azpe BP-5","descripcion":"Mochila Azpe modelo BP-5",
            "cotizable":0,"precio":259.00,"stock":25,"vendedor":2,"categoria":3}*/

            $data = json_decode(file_get_contents('php://input'), true);

                extract($data);
                
                if(empty($productoID) || empty($cantidad) || empty($idCarrito)){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "algun dato vacio"));
                }

                $resultadoFuncion = ProductosCarritoClass::registrarProducto($idCarrito,$cantidad,$productoID);

               if ($resultadoFuncion[0]){
                http_response_code(200);
                echo json_encode(array("status" => "success", "message" => $resultadoFuncion[1]));
               }else{
                http_response_code(400);
                echo json_encode(array("status" => "error", "message" => $resultadoFuncion[1]));
                }  
               break;
            }
            
    case 'PUT':
        {
            /*ejemplo json{"id":"2","nombre":"Wilson Backpack 5","descripcion":"Mochila Wilson modelo WB-03",
            "precio":499.00,"stock":30,"vendedor":"4","categoria":"3"}*/
            $dataArray = json_decode(file_get_contents('php://input'), true);
            foreach($dataArray as $data) {
                extract($data);
                
                if(empty($cantidad)||empty($id)){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "algun dato vacio"));
                   exit;
                }

                $resultadoFuncion = ProductosCarritoClass::editarProducto($id,$cantidad);
                if ($resultadoFuncion[0]==false){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "error al actualizar un producto del carrito" . $resultadoFuncion[1]));
                    exit;
                }
            }
                http_response_code(200);
                echo json_encode(array("status" => "success", "message" => "actualizado con exito"));
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

            $resultadoFuncion = ProductosCarritoClass::eliminarProducto($data['id']);
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