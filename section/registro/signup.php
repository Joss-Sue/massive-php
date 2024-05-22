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
                <form action="" id="myForm2" method="post" style="display: flex; flex-direction: column; align-items:center">
                    <input class="input-massive" type="text" name="correo" id="" placeholder="Correo">
                    <input class="input-massive" type="text" name="contrasena" id="contrasena" placeholder="Contraseña" onkeyup="stoppedTyping()">
                    <input class="input-massive" type="text" name="nombre" id="" placeholder="Nombre"><br>
                    <div class="seller-checkbox">
                        <input type="checkbox" name="vendedor" value="true"><br>
                        <label> Soy vendedor</label>
                    </div>
                    <input class="input-massive" type="text" name="zip" id="" placeholder="Codigo postal"><br>
                    <input class="input-massive" type="text" name="direccion" id="" placeholder="Codigo postal"><br>
                    <textarea name="textoapi" id="textoapi" cols="50" rows="6"><?php $result ?></textarea>
                    <!--input class="input-massive" type="text" name="nombre" id="" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Fecha de Nacimiento">
                    <input class="input-massive" type="password" name="tipo" id="" placeholder="Contraseña"-->
                    <button type="submit" class="button-massive" id="button-massive">Registrate</button>
                </form>
                <span class="inter">¿Ya tienes una cuenta?, <a href="../login/login.php">¡Inicia sesión!</a></span>
            </div>
            <div>

            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('button-massive').disabled = true;
    document.getElementById('button-massive').style.backgroundColor = "#006d7780";
    function stoppedTyping(){
        console.log('ola');
        let password = document.getElementById('contrasena').value;
        console.log(password);
        var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        document.getElementById('button-massive').disabled = true;
        if(reg.test(password)){
            document.getElementById('button-massive').disabled = false;
            document.getElementById('button-massive').style.backgroundColor = "#006D77";
            console.log('Sí cumple');
        }else{
            console.log('no cumple');
            document.getElementById('button-massive').disabled = true;
            document.getElementById('button-massive').style.backgroundColor = "#006d7780";
        }
    }
</script>
    
<?php include('../../templates/pie.php'); ?>