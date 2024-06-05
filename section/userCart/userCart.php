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
                    <span><button id="payButton" onclick="finishPayment()">PAGAR</button></span>
                </div>
            </div>
        </div>
    </div>
</section>
    
<?php include("../../templates/pie.php"); ?>