<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Ventas";
    $stylename = "sales.css";
    $javascript = "sales.js";
   
    require_once("../../templates/cabecera.php");

    switch($_SESSION['usuario_tipo']){
        case "vendedor":
            require_once("../../templates/navVendedor.php");
            break;
        default:
            header("Location:../login/login.php");
            break;
    }
    
 ?>
    
<section class="sales-list-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Mis ventas</h3>
            </div>
        </div>
    </div>
</section>
<section class="sales-section">
    <div class="container">
        <div class="row">
            <div class="col-12 sales-container">
                <table id="sales-table">
                    
                </table>
            </div>
        </div>
    </div>
</section> 
    
<?php include("../../templates/pie.php"); ?>