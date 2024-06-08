<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Productos";
    $stylename = "products.css";
    $javascript = "products.js";
   
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
        if(isset($_POST['search-bar'])){
            echo '<input type="hidden" id="search-bar" value="'.$_POST["search-bar"].'">';
        }else if(isset($_POST['categoryName'])){
            echo '<input type="hidden" id="categoryName" value="'.$_POST["categoryName"].'">';
        }
    }
    
?>
    
<section class="products-body">
    <div class="container products-container">
        <h5 id="search-key"></h5>
        <h2>Productos</h2>
    </div>
</section>
    
<?php include("../../templates/pie.php"); ?>