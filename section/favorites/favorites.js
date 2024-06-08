var session;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        getFavorites();
    });
});

function getFavorites(){
    $.ajax({
        type: "GET",
        url: "../../api/listasProductosController.php/?idLista=" + session.usuario_lista,
        success: function(response) {
            $("#product-list").empty();
            JSON.parse(response).forEach(function(row) {
                $("#product-list").append(setProduct(row.nombreProd, row.descripcionProd, row.precioProd, row.idProd, row.id));
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
            $('#product-list').append('<h4>Aún no tienes favoritos.</h4>');
        },
    });
}

function setProduct(producto, desc, precio, idProd, id){
    var tag =  '<div class="product"><div class="left"><img src="../products/test.jpg" alt=""><div class="info-cart"><p>' + producto + '</p><p>' + desc + '</p><p>$' + precio + '</p><button onclick="deleteFromFavorites(' + id + ')">Eliminar</button></div></div><div class="right"><button onclick="addToCart(' + idProd + ')"><img src="../../src/icons/blackCart.svg" alt=""></button></div></div>';
    return tag;
}

function deleteFromFavorites(id){
    $.ajax({
        type: "DELETE",
        url: "../../api/listasProductosController.php",
        data: JSON.stringify({ id: id }),
        success: function(data) {
            alert('Producto eliminado de favoritos');
            location.reload();
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}

function addToCart(productId){
    $.ajax({
        type: "POST",
        url: "../../api/productosCarritoController.php",
        data: {
            idCarrito: session.usuario_carrito,
            cantidad: 1,
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