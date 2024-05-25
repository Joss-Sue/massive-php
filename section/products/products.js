$( document ).ready(function() {
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
    });
    getProducts();
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

function createProductElement(productId, productName, productDesc, productPrice){
    var col = '<div class="col-4 product-container"><img src="test.jpg" alt=""><form action="../product/product.php" method="POST"><div class="product-info-container"><input type="hidden" name="product_id" value="' + productId + '"><p class="product-title">' + productName + '</p><p class="product-desc">' + productDesc + '</p><p class="product-price">$' + productPrice + '</p><div class="product-buttons-container"><button type="button">Agregar al carrito</button><button type="submit">Más información</button></div></div></form></div>';
    return col;
}