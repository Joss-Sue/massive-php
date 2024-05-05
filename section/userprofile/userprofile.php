<?php // /massive/src/icons/
    session_start();
    $titlename = "Perfil";
    $stylename = "user-profile.css";
    $javascript = "";
    include("../../templates/cabecera.php");
    include("../../templates/nav.php");
    $tipo = '';
    if($_SESSION['usuario_tipo']==2){
        $tipo = "comprador";
    }else if($_SESSION['usuario_tipo']==1){
        $tipo= "vendedor";
    }else{
        $tipo= "administrador";
    }
 ?>

<section class="user-profile-body">
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 form-container">
                    <span class="bebas black"><h1>¡HOLA!,<?= $tipo ?></h1><h2><?= $_SESSION['usuario_nombre'] ?></h2></span>
                    <form action="">
                        <input class="input-massive" type="text" name="" id="" placeholder="Usuario">
                        <input class="input-massive" type="text" name="" id="" placeholder="Nombre completo">
                        <input class="input-massive" type="text" name="" id="" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Fecha de Nacimiento">
                        <input class="input-massive" type="password" name="" id="" placeholder="Contraseña">
                        <button class="button-massive">Modificar</button>
                    </form>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
    </section>
    
    <?php include("../../templates/pie.php"); ?>
