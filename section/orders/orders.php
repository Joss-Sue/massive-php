<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Autorización de cotizaciones";
    $stylename = "orders.css";
    $javascript = "orders.js";
   
    require_once("../../templates/cabecera.php");

    switch($_SESSION['usuario_tipo']){
        case "comprador":
            require_once("../../templates/nav.php");
            break;
        default:
            header("Location:../login/login.php");
            break;
    }
    
?>
    
<section class="orders-list-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Mis pedidos</h3>
            </div>
        </div>
    </div>
</section>
<section class="orders-section">
    <div class="container">
        <div class="row">
            <div class="col-12 orders-container">
            </div>
        </div>
    </div>
</section>
    
<?php include("../../templates/pie.php"); ?>