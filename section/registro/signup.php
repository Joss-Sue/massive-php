<?php
    include "./apiControl.php";
    include "./controllerRegistro.php";
    $titlename = "Registrarme";
    $stylename = "signup.css"; 
    include('../../templates/cabecera.php');
    include('../../templates/empty-nav.php');
    $javascript = '';
?>
    
<section class="signup-body">
    <div class="container">
        <div class="row">
            <div class="col-12 form-container">
                <h1 class="bebas black">REGISTRATE</h1>
                <form action="" id="myForm2" method="post">
                    <input class="input-massive" type="text" name="correo" id="" placeholder="Correo">
                    <input class="input-massive" type="text" name="contrasena" id="" placeholder="Contraseña">
                    <input class="input-massive" type="text" name="nombre" id="" placeholder="Nombre"><br>
                    <div class="seller-checkbox">
                        <input type="checkbox" name="vendedor" value="true"><br>
                        <label> Soy vendedor</label>
                    </div>
                    <input class="input-massive" type="text" name="nombre" id="zipcode" placeholder="Codigo postal"><br>
                    <textarea name="textoapi" id="textoapi" cols="50" rows="6"></textarea>
                    <!--input class="input-massive" type="text" name="nombre" id="" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Fecha de Nacimiento">
                    <input class="input-massive" type="password" name="tipo" id="" placeholder="Contraseña"-->
                    <button type="submit" class="button-massive">Registrate</button>
                </form>
                <span class="inter">¿Ya tienes una cuenta?, <a href="../login/login.php">¡Inicia sesión!</a></span>
            </div>
            <div>

            </div>
        </div>
    </div>
</section>
    
<?php include('../../templates/pie.php'); ?>