<?php // /massive/src/icons/
    require("../../config/sessionVerif.php");
    $titlename = "Categorías";
    $stylename = "categories.css";
    $javascript = "categories.js";
   
    require_once("../../templates/cabecera.php");

    if($_SESSION['usuario_tipo'] == "admin"){
        require_once("../../templates/navAdmin.php");
    }else{
        header("Location:../login/login.php");
    }
    
 ?>
    
<section class="categories-body">
    <section class="categories-section">
        <div class="container">
            <div class="row">
                <div class="col-12" id="categories-list">
                    <h3>Categorías</h3>
                    <table id="categories-table">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <section class="add-categories-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="add-category" id="add-category">
                        <form>
                            <div>
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" required>
                            </div>
                            <div>
                                <label for="descripcion" >Descripción</label>
                                <input type="text" name="descripcion" id="descripcion" required>
                            </div>
                        </form>
                        <button id="add-newCategory">AGREGAR</button>
                    </div>
                    <button class="show-form" id="show-form"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </section>     
</section>
    
<?php include("../../templates/pie.php"); ?>