<?php require_once '../../config/bd_conexion.php';
session_start();
$conexion=BD::crearInstancia();

$isFill=(!isset($_COOKIE['correo']))?false:true;


if($_SERVER['REQUEST_METHOD']=='GET' && $isFill  && (!isset($_SESSION['usuario_id']))){
    /*echo '<script>
    alert("entre aqui :c");
    </script>';*/
    $correo = $_COOKIE["correo"];
    $contrasena = $_COOKIE["contrasena"];
    

    $sql="SELECT * FROM usuarios WHERE correo=:correo";
    $sentencia = $conexion-> prepare($sql);
    $sentencia -> execute(['correo'=>$correo]);

    $usuario = $sentencia->fetch();

    if(!$usuario) {
        echo "error en correo";
        return;
    }

    if($contrasena == $usuario["pass"]){
        
        $_SESSION['usuario_id']=$usuario["iduser"];
        $_SESSION['usuario_nombre']=$usuario["nombreuser"];
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
 

if($_SERVER['REQUEST_METHOD']=='POST'){
    //print_r($_POST);

    $correo=(isset($_POST['correo']))?htmlspecialchars($_POST['correo']):null;
    $contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:null;
    //print_r($pass . "input");
    if(empty($correo) || empty($contrasena)){
        echo "debe llenar los campos";
        return;
    }
    
    $sql="SELECT * FROM usuarios WHERE correo=:correo";
    $sentencia = $conexion-> prepare($sql);
    $sentencia -> execute(['correo'=>$correo]);

    $usuario = $sentencia->fetch();
    
    $isRecordar=true;

    if(!$usuario) {
        echo "error en correo";
        return;
    }    
    
    if($contrasena == $usuario["pass"]){
        
        $_SESSION['usuario_id']=$usuario["iduser"];
        
        //$_SESSION['correo']=$usuarios["CORREO"];
        $_SESSION['usuario_nombre']=$usuario["nombreuser"];
        $_SESSION['usuario_tipo']=$usuario["tipo_usuario"];
        /*echo'<script type="text/javascript">
        alert("'.$_SESSION['usuario_tipo'].'");
        </script>';*/
        //echo $_SESSION['usuario_nombre'];
        //echo $_SESSION['usuario_id'];
        //header('Location: index.php');
        echo'<script type="text/javascript">
        alert("Inicio de sesion con exito");
        window.location.href="../dashboard/dashboard.php";
        </script>';
        if($isRecordar){
            setcookie('correo',$correo,time()+3600, "/");
            setcookie('contrasena',$contrasena,time()+3600, "/");            
        }
    }else{
        
        echo "Error en la contraseña o correo";
        //print_r($usuarios["CONTRASENA"] . "serve");
        //print_r($contrasena . "input");
    }
    //$sentencia -> bindParam(':correo',$correo);
    //$sentencia -> execute();
    //$resultado = $sentencia -> fetch();*/

}

?> 