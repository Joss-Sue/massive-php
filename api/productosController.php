<?php
include "../models/productosModel.php";


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        {
            
            //http://localhost/massivedemo/api/productosController.php/?id=3&pagina=1
            if (isset($_GET['pagina']) && isset($_GET['id'])){//arreglar usando headers
                $productosRespuesta = ProductoClass::buscarAllProductosWithID($_GET['pagina'],$_GET['id']);
                if($productosRespuesta==null){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "ningun usuario encontrado"));
                }else{
                    http_response_code(200);
                    echo json_encode($productosRespuesta);
                }exit; 
            }
            elseif (isset($_GET['id'])) {
                $productosRespuesta = ProductoClass::buscarProductoByID($_GET['id']);
                if($productosRespuesta==null){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "ningun usuario encontrado"));
                }else{
                    http_response_code(200);
                    echo json_encode($productosRespuesta);
                }exit;
            }elseif (isset($_GET['pagina'])){
                //http://localhost/massivedemo/api/productosController.php/?pagina=1
                $productosRespuesta = ProductoClass::buscarAllProductos($_GET['pagina']);
                if($productosRespuesta==null){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "ningun usuario encontrado"));
                }else{
                    http_response_code(200);
                    echo json_encode($productosRespuesta);
                }exit;
            }
            http_response_code(400);
            echo json_encode(array("status" => "error", "message" => "ningun usuario encontrado"));
        }
        break;
    case 'POST':
        {
            /*ejemplo json{"nombre":"Azpe BP-5","descripcion":"Mochila Azpe modelo BP-5",
            "cotizable":0,"precio":259.00,"stock":25,"vendedor":2,"categoria":3}*/

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cotizable = $_POST['cotizable'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $vendedor = $_POST['vendedor'];
            $categoria = $_POST['categoria'];

            $data = json_decode(file_get_contents('php://input'), true);
            
            if(empty($nombre) || empty($descripcion) || empty($precio) || empty($vendedor)){
                http_response_code(400);
                echo json_encode(array("status" => "error", "message" => "algun dato vacio"));
            }

            $resultadoFuncion = ProductoClass::registrarProducto($nombre, $descripcion, $cotizable, $precio, $stock, $vendedor, $categoria);

            if ($resultadoFuncion[0]){
                http_response_code(200);
                $json_response = ["success" => true];
                echo json_encode($json_response);
            }else{
                http_response_code(400);
                $json_response = ["error" => true];
                echo json_encode($json_response);
            }
            exit;
        }
            
    case 'PUT':
        {
            /*ejemplo json{"id":"2","nombre":"Wilson Backpack 5","descripcion":"Mochila Wilson modelo WB-03",
            "precio":499.00,"stock":30,"vendedor":"4","categoria":"3"}*/
            parse_str(file_get_contents("php://input"),$sent_vars);

            if(isset($_SERVER['HTTP_ACTION'])){
                extract($data);
            
                if(empty($nombre) || empty($descripcion) || empty($precio) || empty($id)){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "algun dato vacio"));
                    exit;
                }

                $resultadoFuncion = ProductoClass::editarProducto($id, $nombre, $descripcion, $precio, $stock, $vendedor, $categoria);
                if ($resultadoFuncion[0]){
                    http_response_code(200);
                    echo json_encode(array("status" => "success", "message" => $resultadoFuncion[1]));
                   }else{
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => $resultadoFuncion[1]));
                }
                break;

            }else{
                //ejemplo json{"idProducto":"2", "idAdmin":"1"}
                
                $idProducto = (int)$sent_vars['idProducto'];
                $idAdmin = (int)$sent_vars['idAdmin'];
            
                if(empty($idProducto) || empty($idAdmin)){
                    http_response_code(400);
                    $json_response = ["error" => true];
                    echo json_encode($json_response);
                    exit;
                }

                $resultadoFuncion = ProductoClass::autorizarAdmin($idProducto, $idAdmin);
                if ($resultadoFuncion[0]){
                    http_response_code(200);
                    $json_response = ["success" => true];
                    echo json_encode($json_response);
                   }else{
                    http_response_code(400);
                    $json_response = ["error" => true];
                    echo json_encode($json_response);
                }
                exit;
            }            
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

            $resultadoFuncion = ProductoClass::eliminarProducto($data['id']);
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