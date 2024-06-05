var session;
var total = 0;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        getCartProducts(session.usuario_carrito);
    });
    $('#payButton').prop('disabled', true);
    $('#payButton').addClass("unclickable");
});

function getCartProducts(cartId){
    $.ajax({
        type: "GET",
        url: "../../api/productosCarritoController.php/?idCarrito=" + cartId,
        success: function(response) {
            console.log(JSON.parse(response));
            JSON.parse(response).forEach(function(row) {
                $('#payButton').prop('disabled', false);
                $('#payButton').removeClass("unclickable");
                $("#product-list").append(setProduct(row.nombreProd, row.precioProd, row.cantidad));
                total += Number(row.subtotal);
            });
            $(".cart-total").append('$' + total);
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}

function finishPayment(){
    console.log('hacer compra');
    // $.ajax({
    //     type: "POST",
    //     url: "../../api/productosCarritoController.php",
    //     data: {
    //         idCarrito: session.usuario_carrito,
    //         cantidad: cantidad,
    //         productoID: Number($("#product_id").val())
    //     },
    //     success: function(data) {
    //         alert('Producto agregado al carrito');
    //     },
    //     error: function(xhr, status, error) {
    //         console.log('error');
    //         console.log(error);
    //     },
    // });
}

function setProduct(producto, precio, cantidad){
    var tag =  '<div class="product"><img src="../products/test.jpg" alt=""><div class="info-cart"><p>' + producto + '</p><p>$' + Number(precio) + '</p><button>Eliminar</button></div><div class="quantity">(' + cantidad + ')</div></div>';
    return tag;
}