<?php // /massive/src/icons/
    $titlename = "Perfil";
    $stylename = "user-profile.css";
    include("/xampp/htdocs/massive/templates/cabecera.php");
 ?>

<section class="user-profile-body">
        <div class="container">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8 form-container">
                    <span class="bebas black"><h1>¡HOLA!,</h1><h2>José Manuel Perez</h2></span>
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
    
    <?php include("/xampp/htdocs/massive/templates/pie.php"); ?>
