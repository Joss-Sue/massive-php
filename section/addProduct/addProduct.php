<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Mis productos";
    $stylename = "addProduct.css";
    $javascript = "";
   
    require_once("../../templates/cabecera.php");

    if($_SESSION['usuario_tipo'] == "vendedor"){
        require_once("../../templates/navVendedor.php");
    }else{
        header("Location:../login/login.php");
    }
    
 ?>
    
<section class="add-product-body">
    <section class="add-product-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Agregar producto</h3>
                </div>
            </div>
        </div>
    </section>
    <section class="my-products-section">
        <div class="container">
            <div class="row">
                <div class="col-12">

                </div>
            </div>
        </div>
    </section>     
</section>
    
<?php include("../../templates/pie.php"); ?>