<?php

    echo "si sirvo :c";
    require_once '../../config/bd_conexion.php';
    require "./modelUsuario.php";

    $conexion=BD::crearInstancia();

    if($_SERVER["REQUEST_METHOD"]=='POST'){
        echo "entre al if";
        $auxUser = new Usuario();
        $auxUser->correo=(isset($_POST['correo']))?$_POST['correo']:null;
        $auxUser->contrasena=(isset($_POST['contrasena']))?$_POST['contrasena']:null;
        $auxUser->nombre=(isset($_POST['nombre']))?$_POST['nombre']:null;
        $auxUser->tipoUsuario=($_POST['vendedor']=="true")?1:2;
       
    
        if(empty($auxUser->correo) || empty($auxUser->contrasena) || empty($auxUser->nombre)){
            echo "debe llenar los campos";
            return;
        }
    
        $userAssoc = json_decode(json_encode($auxUser), true);
    
        $sqlInsert = 'INSERT INTO usuarios (correo,pass,nombreuser,tipo_usuario)
         VALUES (:correo,:contrasena,:nombre,:tipoUsuario)';
    
        $consultaInsert= $conexion->prepare($sqlInsert);
        $consultaInsert->execute($userAssoc);
        header("location:../login/login.php");
    }

?>