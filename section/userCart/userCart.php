<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Carrito de compras";
    $stylename = "userCart.css";
    $javascript = "userCart.js";
   
    require_once("../../templates/cabecera.php");
    switch($_SESSION['usuario_tipo']){
        case "comprador":
            require_once("../../templates/nav.php");
            break;
        case "vendedor":
            require_once("../../templates/navVendedor.php");
            break;
        default:
            header("Location:../login/login.php");
            break;
    }
    
?>
    
<section class="userCart-body">
    <div class="container">
        <div class="row cart-container">
            <h1>Finaliza tu compra</h1>
            <div class="col-8" id="product-list">
            </div>
            <div class="col-4">
                <div class="carrito-resumen">
                    <span><h3>Resumen de compra</h3></span>
                    <hr>
                    <div>
                        <p>Productos</p>
                        <p class="cart-total"></p>
                    </div>
                    <div>
                        <p>Envío</p>
                        <p>Gratis</p>
                    </div>
                    <div>
                        <p>Total</p>
                        <p class="cart-total"></p>
                    </div>
                    <div id="paypal-button-container"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://www.paypal.com/sdk/js?client-id=AaDnChw9DFweiZrrGcdkl_ezFjldcnTgKPpW3uLlVzQQ9P2Ms4XN3OcBxma8Q5ALaax_zOfMmReNxoJq&currency=MXN&locale=es_MX"></script>

    
<?php include("../../templates/pie.php"); ?>