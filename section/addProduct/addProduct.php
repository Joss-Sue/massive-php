<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Mis productos";
    $stylename = "addProduct.css";
    $javascript = "addProduct.js";
   
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
                    <!-- $nombre, $descripcion, $cotizable, $precio, $stock, $categoria -->
                    
                    <h3>Agregar producto</h3>

                    <div class="add-product-form-container">
                        <form id="add-product-form">
                            <label for="name">Nombre del producto</label>
                            <input type="text" name="name" id="name" required>
                            <label for="description">Describe brevemente el producto</label>
                            <textarea name="description" id="description" required></textarea>
                            <div class="price-and-stock-container">
                                <div>
                                    <label for="price">Precio</label>
                                    <input type="number" name="price" id="price" step=".01" required>
                                </div>
                                <div>
                                    <label for="stock">¿Cuantos tienes disponibles?</label>
                                    <input type="number" name="stock" id="stock" step="1"  min="0" required>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="negotiable" name="negotiable" />
                                <label for="negotiable">¿El precio es negociable?</label>
                            </div>
                            <label for="category">Selecciona una categoría</label>
                            <select name="category" id="category"></select>
                            <button>Agregar producto</button>
                        </form>
                    </div>
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