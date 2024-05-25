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
                    <button onclick="addToCart(1)">Agregar al carrito</button>
                    <button onclick="newEmail()">Negociar</button>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal" id="cotizacionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="cotizacion-header">
                <h3>Solicitud de cotización</h3>
            </div>
            <div class="cotizacion-body">
                <h1>Tennis Nike</h1>
                <p>Los mejores tennis</p>
                <div>
                    <h4>Precio original</h4>
                    <h5>$1,500</h5>
                </div>
                <div>
                    <h4>Precio solicitado</h4>
                    <input type="number" name="price" id="price" step=".01" required>
                </div>
                <div>
                    <button onclick="solicitarCotizacion()">Solicitar negociación</button>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php include("../../templates/pie.php"); ?>