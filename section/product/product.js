var session;
var product;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
    });
    getProduct($("#product_id").val());
});

function getProduct(productId){
    $.ajax({
        type: "GET",
        url: "../../api/productosController.php/?productId=" + productId,
        success: function(response) {
            console.log(JSON.parse(response));
            product = JSON.parse(response);
            setProduct(product.nombreProd, product.descripcionProd, product.precioProd, product.precioProd, product.cotizable);
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};

function setProduct(productTitle, productDesc, productPrice, productPreviousPrice, newPrice){
    $("#product-title").append(productTitle);
    $("#product-desc").append(productDesc);
    $("#product-price").append('$' + Number(productPrice));
    $("#product-previous-price").append('$' + (Number(productPreviousPrice) * 2));
    $("#price-title").append(productTitle);
    $("#price-desc").append(productDesc);
    $("#price-price").append('$' + Number(productPrice));
    if(!newPrice){
        $("#newPrice").hide();
    }
};

function addToCart(cantidad){
    console.log(Number(product.precioProd));
    $.ajax({
        type: "POST",
        url: "../../api/productosCarritoController.php",
        data: {
            idCarrito: session.usuario_carrito,
            cantidad: cantidad,
            productoID: Number($("#product_id").val()),
            precioCarrito: Number(product.precioProd)
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

function addToFavorites(){
    $.ajax({
        type: "POST",
        url: "../../api/listasProductosController.php",
        data: {
            idLista: session.usuario_lista,
            idProducto: Number($("#product_id").val())
        },
        success: function(data) {
            alert('Producto agregado a tu Lista de favoritos.');
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}

function newPrice(){
    $('#cotizacionModal').modal("show");;
}

function solicitarCotizacion(){
    if($('#price').val() != ''){
        $.ajax({
            type: "POST",
            url: "../../api/cotizacionesController.php",
            data: {
                idProducto: product.idProd, 
                idCliente: session.usuario_id, 
                idVendedor: product.vendedorProd, 
                precioReal: Number(product.precioProd), 
                precioSolicitado: Number($('#price').val()).toFixed(2), 
                Estatus: 0
            },
            success: function(data) {
                alert('Se solicitó el ajuste de precio.');
                $('#cotizacionModal').modal("hide");
            },
            error: function(xhr, status, error) {
                console.log('error');
                console.log(error);
            },
        });
    }
}