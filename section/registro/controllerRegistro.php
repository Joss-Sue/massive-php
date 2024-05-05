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
       
        /*$auxZip=(isset($_POST['zip']))?$_POST['zip']:null;

        $api = "http://localhost/apirestphp/index.php/?zip=$auxZip";
        $result= file_get_contents($api);
        $result = json_decode($result, true);

        print_r($result);*/

    
        if(empty($auxUser->correo) || empty($auxUser->contrasena) || empty($auxUser->nombre)){
            echo "debe llenar los campos";
            return;
        }
        


        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $auxUser->contrasena)) {
            echo '<script>alert("validacion pass")</script>;';
            echo "La contraseña debe tener un mínimo de 8 caracteres, una mayúscula, una 
            minúscula, un número y un carácter especial";
            return;
        }

        $auxUser->tipoUsuario=($_POST['vendedor']=="true")?1:2;
        echo '<script>alert("'.$auxUser->tipoUsuario.'")</script>;';

        $userAssoc = json_decode(json_encode($auxUser), true);
        
    
        
        $sqlInsert = 'INSERT INTO usuarios (correo,pass,nombreuser,tipo_usuario)
         VALUES (:correo,:contrasena,:nombre,:tipoUsuario)';
    
        $consultaInsert= $conexion->prepare($sqlInsert);
        $consultaInsert->execute($userAssoc);
        header("location:../login/login.php");
    }

    /*
        // Prepara la consulta
        $consulta = $conexion->prepare("INSERT INTO tabla (blob_columna) VALUES (?)");

        // Comprueba si la consulta se preparó correctamente
        if ($consulta === false) {
            die("Error: " . $conexion->error);
        }

        // Abre el archivo
        $archivo = fopen('ruta/al/archivo', 'rb');

        // Vincula los parámetros
        $consulta->bind_param('b', $archivo);

        // Ejecuta la consulta
        $consulta->execute();

        if ($consulta->affected_rows == 1) {
            echo "El BLOB se guardó correctamente.";
        } else {
            echo "No se pudo guardar el BLOB.";
        }

        // Cierra la consulta y la conexión
        $consulta->close();
        $conexion->close();
    */

?>

