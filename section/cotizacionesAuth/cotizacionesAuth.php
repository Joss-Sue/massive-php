<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Autorización de cotizaciones";
    $stylename = "cotizacionesAuth.css";
    $javascript = "cotizacionesAuth.js";
   
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
    
<section class="cotizaciones-auth-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Autorización de cotizaciones</h3>
            </div>
        </div>
    </div>
</section>
<section class="cotizaciones-to-auth-section">
    <div class="container">
        <div class="row">
            <div class="col-12" id="product-table-container">
                <table id="cotizaciones-to-auth">
                    
                </table>
            </div>
        </div>
    </div>
</section>  
    
<?php include("../../templates/pie.php"); ?>