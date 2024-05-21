<?php
include "../models/usuarioModel.php";
session_start();
$isFill=(isset($_COOKIE['correo']))?true:false;


switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        {
            /*if((isset($_COOKIE['correo']))  && (!isset($_SESSION['usuario_id']))){

                $correo = $_COOKIE["correo"];
                $contrasena = $_COOKIE["contrasena"];
                
                UsuarioClass::matchLoginCookie($correo, $contrasena);

            }*/
            //http://localhost/massivedemo/api/UsuariosController.php/?id=1
            if (isset($_GET['id'])) {
                $usuarioRespuesta=UsuarioClass::buscarUsuarioByID($_GET['id']);
                if(UsuarioClass::buscarUsuarioByID($_GET['id'])==null){
                    http_response_code(400);
                    echo json_encode(array("status" => "error", "message" => "ningun usuario encontrado"));
                }else{
                    http_response_code(200);
                    echo json_encode($usuarioRespuesta);
                }
            }
        }
        break;
    case 'POST':
        {
            
            $data = json_decode(file_get_contents('php://input'), true);

            if(isset($_SERVER['HTTP_ACTION']) && $_SERVER['HTTP_ACTION'] == 'Login'){
               
                $correo=(isset($data['correo']))?htmlspecialchars($data['correo']):null;
                $contrasena=(isset($data['contrasena']))?$data['contrasena']:null;
                $isRecordar=(isset($data['checkSesion']))?true:false;
    
                if(empty($correo) || empty($contrasena)){
                    echo "debe llenar los campos";
                    exit;
                }

                 UsuarioClass::matchLogin($correo, $contrasena, $isRecordar);
             
            }else{
                //ejemplo json {"correo": "gato@animal.com","contrasena": "123","nombre": "CAT","tipoUsuario":"vendedor","direccion":"calle 123"}
                
                extract($data);

                if(empty($correo) || empty($contrasena) || empty($nombre) || empty($tipoUsuario) || empty($direccion))

                $resultadoFuncion = UsuarioClass::registrarUsuario($correo, $contrasena, $nombre, $tipoUsuario, $direccion);

               if ($resultadoFuncion[0]){
                http_response_code(200);
                echo json_encode(array("status" => "success", "message" => $resultadoFuncion[1]));
               }else{
                http_response_code(400);
                echo json_encode(array("status" => "error", "message" => $resultadoFuncion[1]));
                }
               }
               break;
            }
    case 'PUT':
        {
            //ejemplo json {"id":"3","correo": "gato@animal.com","contrasena": "234","nombre": "CAT","direccion":"calle 123"}
            $data = json_decode(file_get_contents('php://input'), true);
            
            extract($data);

            if(empty($correo) || empty($contrasena) || empty($id || empty($nombre) || empty($direccion))){
                echo "error en correo o contra o id";
                exit;
            }

            $resultadoFuncion = UsuarioClass::editarUsuario($id, $correo, $contrasena, $nombre, $direccion);
            if ($resultadoFuncion[0]){
                http_response_code(200);
                echo json_encode(array("status" => "success", "message" => $resultadoFuncion[1]));
               }else{
                http_response_code(400);
                echo json_encode(array("status" => "error", "message" => $resultadoFuncion[1]));
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

            $resultadoFuncion = UsuarioClass::eliminarUsuario($data['id']);
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