<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Massive-Home";
    $stylename = "home.css";
    require_once("../../templates/cabecera.php");
    require_once("../../templates/nav.php");
    
 ?>
    
<section class="home-body">
        <div class="container">
            <div class="row banner">
                <div class="col-2"></div>
                <div class="col-2">
                    <img src="../../src/icons/Massive.svg" alt="">
                </div>
                <div class="col-5 white-text bebas">
                    <span>TODO,</span>
                    <span>AHORA,</span>
                    <span>EN TUS MANOS</span>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row cards-section">
                <div class="col-4 card-custom">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="headphones.png" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">Audifonos Negros</h5>
                        <p class="card-text">ENVÍO GRATIS</p>
                        <p class="card-text">$800</p>
                        <a class="bebas cart-button" href="">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 card-custom">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="shoes.png" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">Zapatos Negros</h5>
                        <p class="card-text">ENVÍO GRATIS</p>
                        <p class="card-text">$400</p>
                        <a class="bebas cart-button" href="">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 card-custom">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="cactus.png" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">Cactus</h5>
                        <p class="card-text">ENVÍO GRATIS</p>
                        <p class="card-text">$200</p>
                        <a class="bebas cart-button" href="">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php include("../../templates/pie.php"); ?>