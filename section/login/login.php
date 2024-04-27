<?php 
    include('./control_user.php');
    $titlename = "Iniciar Sesion";
    $stylename = "login.css"; 
    include('../../templates/cabecera.php');
    include('../../templates/empty-nav.php')
?>

    <section class="login-body">
        <div class="container">
            <div class="row form-image-container">
                <div class="col-xl-6 col-lg-6 col-0 image-section">
                    <img src="../../src/images/RecievingPackageBlue.png" alt="">
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 form-section">
                    <h1 class="bebas">INICIAR SESIÓN</h1>
                    <form action="" id="myForm" method="post"  >
                        <input class="input-massive" type="text" name="correo" id="correo" placeholder="correo">
                        <input class="input-massive" type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
                        <button type="submit" class="button-massive">Ingresar</button>
                    </form>
                    <span class="inter">¿No tienes una cuenta?, <a href="../registro/signup.php">¡Registrate!</a></span>
                </div>
            </div>
        </div>
    </section>
    
    <?php include('../../templates/pie.php'); ?>