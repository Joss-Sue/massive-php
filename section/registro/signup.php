<?php 
$titlename = "Registrarme";
$stylename = "singup.css"; 
include('../../templates/cabecera.php')
?>
    <nav>
        <div class="header">
            <div class="one-col"></div>
            <div class="two col name-page">
                <img src="./../Massive.svg" alt="">
                <span class="bebas white-text">MASSIVE</span>
            </div>
            <div class="six-col"></div>
            <div class="two col cart-user">
                <img src="./../cart.svg" alt="">
                <img src="./../user.svg" alt="">
            </div>
            <div class="one-col"></div>
        </div>
    </nav>
    <section class="signup-body">
        <div class="container">
            <div class="row">
                <div class="col-12 form-container">
                    <h1 class="bebas black">REGISTRARSE</h1>
                    <form action="" id="myForm2" >
                        <input class="input-massive" type="text" name="" id="user" placeholder="Usuario">
                        <input class="input-massive" type="text" name="" id="name" placeholder="Nombre completo">
                        <input class="input-massive" type="text" name="" id="fecha" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Fecha de Nacimiento">
                        <input class="input-massive" type="password" name="" id="password" placeholder="Contraseña">
                        <button type="submit" class="button-massive">Registrate</button>
                    </form>
                    <span class="inter">¿Ya tienes una cuenta?, <a href="">¡Inicia sesión!</a></span>
                </div>
            </div>
        </div>
    </section>
    
    <?php include('../../templates/pie.php'); ?>