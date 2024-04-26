<?php 
include('./control_user.php');
$titlename = "Iniciar Sesion";
$stylename = "login.css"; 
include('../../templates/cabecera.php')
?>

    <section class="login-body">
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-5">
                    <h1 class="bebas black">INICIAR SESIÓN</h1>
                    <form action="" id="myForm" method="post"  >
                        <input class="input-massive" type="text" name="correo" id="correo" placeholder="correo">
                        <input class="input-massive" type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
                        <button type="submit" class="button-massive">Ingresar</button>
                    </form>
                    <span class="inter">¿No tienes una cuenta?, <a href="">¡Registrate!</a></span>
                </div>
                <div class="col-5"></div>
            </div>
        </div>
    </section>
    
    <?php include('../../templates/pie.php'); ?>