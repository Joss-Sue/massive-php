<?php require_once '../../config/bd_conexion.php';
session_start();
$conexion=BD::crearInstancia();

if($_SERVER['REQUEST_METHOD']=='GET' && (isset($_COOKIE['correo']))  && (!isset($_SESSION['usuario_id']))){
    /*echo '<script>
    alert("entre aqui :c");
    </script>';*/
    $correo = $_COOKIE["correo"];
    $contrasena = $_COOKIE["contrasena"];
    
    matchLoginCookie($conexion, $correo, $contrasena);

}
 

if($_SERVER['REQUEST_METHOD']=='POST'){
    //print_r($_POST);

    $correo=(isset($_POST['correo']))?htmlspecialchars($_POST['correo']):null;
    $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:null;
    //print_r($pass . "input");
    if(empty($correo) || empty($contrasena)){
        echo "debe llenar los campos";
        return;
    }

    $isRecordar=true;

    matchLogin($correo, $contrasena, $conexion, $isRecordar);
    

}

function matchLogin($correo, $contrasena, $conexion, $isRecordar){
    $sql="call getUser( :correo )";
    $sentencia = $conexion-> prepare($sql);
    $sentencia -> execute(['correo'=>$correo]);

    $usuario = $sentencia->fetch();
    
    $isRecordar==true;

    if(!$usuario) {
        echo "error en correo";
       return false;
    }  

    if($contrasena == $usuario["contrasena"]){
        
        $_SESSION['usuario_id']=$usuario["iduser"];
        $_SESSION['usuario_nombre']=$usuario["nombre"];
        $_SESSION['usuario_tipo']=$usuario["tipo_usuario"];
        $_SESSION['usuario_carrito']=$usuario["carritoID"];
        $_SESSION['usuario_lista']=$usuario["listaID"];
        var_dump( $_SESSION['usuario_lista']);

        if($isRecordar){
            setcookie('correo',$correo,time()+3600, "/");
            setcookie('contrasena',$contrasena,time()+3600, "/");            
        }

        echo'<script type="text/javascript">
        alert("Inicio de sesion con exito");
        window.location.href="../dashboard/dashboard.php";
        </script>';
    }else{
        
        echo'<script type="text/javascript">
        alert("Error en contraseña o correo);
        </script>';

        return;
    }

    return true;
}

function matchLoginCookie($conexion, $correo, $contrasena){
    $sql="call getUser( :correo )";
    $sentencia = $conexion-> prepare($sql);
    $sentencia -> execute(['correo'=>$correo]);

    $usuario = $sentencia->fetch();

    if(!$usuario) {
        echo "error en correo";
        return;
    }

    if($contrasena == $usuario["contrasena"]){
        
        $_SESSION['usuario_id']=$usuario["iduser"];
        $_SESSION['usuario_nombre']=$usuario["nombre"];
        $_SESSION['usuario_tipo']=$usuario["tipo_usuario"];
        $_SESSION['usuario_carrito']=$usuario["carritoID"];
        $_SESSION['usuario_lista']=$usuario["listaID"];
        setcookie('correo',$correo,time()+3600,"/");
        setcookie('contrasena',$contrasena,time()+3600,"/");

        echo '<script>
        alert("Bienvenido de nuevo");
        window.location.href="../dashboard/dashboard.php"
        </script>';

    }else{
        echo "Error en la contraseña o correo";
    }
}

?> 