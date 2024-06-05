var session;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        getFavorites(session.usuario_lista);
    });
});

function getFavorites(listId){
    $.ajax({
        type: "GET",
        url: "../../api/listasProductosController.php/?idLista=" + listId,
        success: function(response) {
            JSON.parse(response).forEach(function(row) {
                $("#product-list").append(setProduct(row.nombreProd, row.descripcionProd, row.precioProd, row.idProd));
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}

function setProduct(producto, desc, precio, idProd){
    var tag =  '<div class="product"><div class="left"><img src="../products/test.jpg" alt=""><div class="info-cart"><p>' + producto + '</p><p>' + desc + '</p><p>$' + precio + '</p><button onclick="deleteFromFavorites(' + idProd + ')">Eliminar</button></div></div><div class="right"><button onclick="addToCart(' + idProd + ')"><img src="../../src/icons/blackCart.svg" alt=""></button></div></div>';
    return tag;
}

function deleteFromFavorites(productId){
    console.log(productId);
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