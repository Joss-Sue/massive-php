<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Autorización de cotizaciones";
    $stylename = "favorites.css";
    $javascript = "favorites.js";
   
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
    
<section class="favorites-list-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Lista de favoritos</h3>
            </div>
        </div>
    </div>
</section>
<section class="favorites-list-section">
    <div class="container">
        <div class="row">
            <div class="col-12" id="product-list">
            </div>
        </div>
    </div>
</section>  
    
<?php include("../../templates/pie.php"); ?>