<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Autorización de productos";
    $stylename = "productsAuth.css";
    $javascript = "productsAuth.js";
   
    require_once("../../templates/cabecera.php");

    if($_SESSION['usuario_tipo'] == "admin"){
        require_once("../../templates/navAdmin.php");
    }else{
        header("Location:../login/login.php");
    }
    
 ?>
    
<section class="products-auth-title">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Productos por autorizar</h3>
            </div>
        </div>
    </div>
</section>
<section class="products-to-auth-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table id="products-to-auth">
                    
                </table>
            </div>
        </div>
    </div>
</section>  
    
<?php include("../../templates/pie.php"); ?>