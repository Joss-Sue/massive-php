var session;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
    });
    if($("#search-bar").val()){
        $("#search-key").append('Resultados para: ' + $("#search-bar").val());
        getProductsByWord($("#search-bar").val());
    }else{
        getProducts();
    }
});

function getProducts(){
    $.ajax({
        type: "GET",
        url: "../../api/productosController.php/?pagina=1",
        success: function(response) {
            console.log(JSON.parse(response));
            var htmlRow = '<div class="row">';
            JSON.parse(response).forEach(function(row) {
                htmlRow +=createProductElement(row.idProd, row.nombreProd, row.descripcionProd, row.precioProd);
            });
            htmlRow += '</div>';
            $('.products-container').append(htmlRow);
        },
        error: function(xhr, status, error) {
            alert('Error al cargar los productos del vendedor');
            console.log('error');
            console.log(error);
        },
    });
};

function getProductsByWord(palabra){
    $.ajax({
        type: "GET",
        url: "../../api/buscadorController.php/?palabra=" + palabra,
        success: function(response) {
            var htmlRow = '<div class="row">';
            JSON.parse(response).forEach(function(row) {
                htmlRow +=createProductElement(row.idProd, row.nombreProd, row.descripcionProd, row.precioProd);
            });
            htmlRow += '</div>';
            $('.products-container').append(htmlRow);
        },
        error: function(xhr, status, error) {
            alert('Error al cargar los productos del vendedor');
            console.log('error');
            console.log(error);
        },
    });
};

function createProductElement(productId, productName, productDesc, productPrice){
    var col = '<div class="col-4 product-container"><img src="test.jpg" alt=""><form action="../product/product.php" method="POST"><div class="product-info-container"><input type="hidden" name="product_id" value="' + productId + '"><p class="product-title">' + productName + '</p><p class="product-desc">' + productDesc + '</p><p class="product-price">$' + productPrice + '</p><div class="product-buttons-container"><button type="button" onclick="addToCart(1,' + productId + ')">Agregar al carrito</button><button type="submit">Más información</button></div></div></form></div>';
    return col;
};

function addToCart(cantidad, productId){
    $.ajax({
        type: "POST",
        url: "../../api/productosCarritoController.php",
        data: {
            idCarrito: session.usuario_carrito,
            cantidad: cantidad,
            productoID: productId
        },
        success: function(data) {
            alert('Producto agregado al carrito');
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}