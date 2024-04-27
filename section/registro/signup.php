<?php 
include "./controllerRegistro.php";
$titlename = "Registrarme";
$stylename = "singup.css"; 
include('../../templates/cabecera.php');

?>
    
    <section class="signup-body">
        <div class="container">
            <div class="row">
                <div class="col-12 form-container">
                    <h1 class="bebas black">REGISTRARSE</h1>
                    <form action="" id="myForm2" method="post">
                        <input class="input-massive" type="text" name="correo" id="" placeholder="Correo">
                        <input class="input-massive" type="text" name="contrasena" id="" placeholder="Contrasena">
                        <input class="input-massive" type="text" name="nombre" id="" placeholder="Nombre"><br>
                        <label> Te gustaria registrarte como vendedor?</label>
                        <input type="checkbox" name="vendedor" value="true"><br>

                        

                        <!--input class="input-massive" type="text" name="nombre" id="" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Fecha de Nacimiento">
                        <input class="input-massive" type="password" name="tipo" id="" placeholder="Contraseña"-->
                        <button type="submit" class="button-massive">Registrate</button>
                    </form>
                    <span class="inter">¿Ya tienes una cuenta?, <a href="../login/login.php">¡Inicia sesión!</a></span>
                </div>
            </div>
        </div>
    </section>
    
    <?php include('../../templates/pie.php'); ?>