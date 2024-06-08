<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Mis productos";
    $stylename = "myProducts.css";
    $javascript = "myProducts.js";
   
    require_once("../../templates/cabecera.php");

    if($_SESSION['usuario_tipo'] == "vendedor"){
        require_once("../../templates/navVendedor.php");
    }else{
        header("Location:../login/login.php");
    }
    
 ?>
    
<section class="myProducts-body">
    <section class="add-product-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Mis productos</h3>
                    <a href="../addProduct/addProduct.php"><i class="fa fa-plus-circle"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="my-products-section">
        <div class="container">
            <div class="row">
                <div class="col-12 products-table-container">
                    <table id="products-table">
                    </table>
                </div>
            </div>
        </div>
    </section>     
</section>
    
<?php include("../../templates/pie.php"); ?>