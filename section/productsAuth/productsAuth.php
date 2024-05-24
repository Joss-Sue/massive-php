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
    
<section class="productsAuth-body">
    holas
</section>
    
<?php include("../../templates/pie.php"); ?>