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
                    <button onclick="addToFavorites(1)"><svg id="Capa_1" data-name="Capa 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800"><defs><style>.cls-1{fill:#fff;}</style></defs><title>menuArtboard 1 copy</title><path class="cls-1" d="M735.38,113.63a221.53,221.53,0,0,0-313.25.17l-21.87,21.88L378,113.46A221.25,221.25,0,0,0,0,269.83C0,329,23.24,384.48,65.13,426.37l318.5,318.51a22.74,22.74,0,0,0,32.23.17L735,427.05a221.92,221.92,0,0,0,.34-313.42Zm-32.56,281L399.75,696.54,97.35,394.15A175.57,175.57,0,1,1,345.64,145.86L384,184.19a22.85,22.85,0,0,0,32.4,0l38-38A175.69,175.69,0,0,1,702.82,394.66Z"/></svg></button>
                </div>
                <div class="buttons-second-container">
                    <button onclick="newPrice()">Negociar</button>
                </div>
                <div>

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
                <h1 id="price-title"></h1>
                <p id="price-desc"></p>
                <div>
                    <h4>Precio original</h4>
                    <h5 id="price-price"></h5>
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