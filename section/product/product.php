<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Productos";
    $stylename = "product.css";
    $javascript = "product.js";
   
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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_id = $_POST["product_id"];
        echo '<input type="hidden" id="product_id" value="'.$product_id.'">';
    } else {
        echo "No se recibieron datos del formulario.";
    }
    
?>
    
<section class="product-body">
    <div class="container">
        <div class="row product-container">
            <div class="col-6 image-container">
                <img src="../products/test.jpg" alt="">
            </div>
            <div class="col-6 product-info-container">
                <h2 id="product-title"></h2>
                <h4 id="product-desc"></h4>
                <div class="price-container">
                    <p id="product-price"></p>
                    <p id="product-previous-price"></p>
                </div>
                <div class="buttons-container">
                    <button>Agregar al carrito</button>
                    <button><i class="fa fa-heart-o"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>
    
<?php include("../../templates/pie.php"); ?>