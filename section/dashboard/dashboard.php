<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Massive-Home";
    $stylename = "home.css";
    $javascript = "script.js";
   
    require_once("../../templates/cabecera.php");
    switch($_SESSION['usuario_tipo']){
        case "comprador":
            require_once("../../templates/nav.php");
            break;
        case "vendedor":
            require_once("../../templates/navVendedor.php");
            break;
        case "admin":
            require_once("../../templates/navAdmin.php");
            break;
        default:
            header("Location:../login/login.php");
            break;
    }
    
?>
    
<section class="home-body">
    <div class="container">
        <div class="row banner">
            <div class="col-2"></div>
            <div class="col-2">
                <img src="../../src/icons/Massive.svg" alt="" />
            </div>
            <div class="col-5 white-text bebas">
                <span>TODO,</span>
                <span>AHORA,</span>
                <span>EN TUS MANOS</span>
            </div>
            <div class="col-3"></div>
        </div>
        <!--  
        <?php
            if($_SESSION['usuario_tipo'] == "comprador"){
                echo "<div class='row cards-section'>
                    <div class='col-4 card-custom'>
                        <div class='card' style='width: 18rem;'>
                            <img class='card-img-top' src='headphones.png' alt='Card image cap' />
                            <div class='card-body'>
                                <h5 class='card-title'>Audifonos Negros</h5>
                                <p class='card-text'>ENVÍO GRATIS</p>
                                <p class='card-text'>$800</p>
                                <a class='bebas cart-button' href=''>Agregar al carrito</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-4 card-custom'>
                        <div class='card' style='width: 18rem;'>
                            <img class='card-img-top' src='shoes.png' alt='Card image cap' />
                            <div class='card-body'>
                                <h5 class='card-title'>Zapatos Negros</h5>
                                <p class='card-text'>ENVÍO GRATIS</p>
                                <p class='card-text'>$400</p>
                                <a class='bebas cart-button' href=''>Agregar al carrito</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-4 card-custom'>
                        <div class='card' style='width: 18rem;'>
                            <img class='card-img-top' src='cactus.png' alt='Card image cap' />
                            <div class='card-body'>
                                <h5 class='card-title'>Cactus</h5>
                                <p class='card-text'>ENVÍO GRATIS</p>
                                <p class='card-text'>$200</p>
                                <a class='bebas cart-button' href=''>Agregar al carrito</a>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        ?>
        -->
    </div>
</section>
<section class="weather-section">
    <div class="container">
        <div class="row">
            <div class="col-12 temperatures">
                <!-- <div id=apiContenedor>api</div> -->
                <div class="temperature">
                    <h4>Temperatura</h4>
                    <h5 id="temp"></h5>
                </div>
                <div class="temperature">
                    <h4>Máxima</h4>
                    <h5 id="max"></h5>
                </div>
                <div class="temperature">
                    <h4>Mínima</h4>
                    <h5 id="min"></h5>
                </div>
            </div>
        </div>
    </div>
</section>

    
<?php include("../../templates/pie.php"); ?>