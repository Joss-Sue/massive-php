var session;
var product;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        if(session.usuario_tipo == 'comprador'){
            getCotizacionesComprador();
        }else if(session.usuario_tipo == 'vendedor'){
            getCotizacionesVendedor();
        }
    });
});

function getCotizacionesVendedor(){
    $.ajax({
        type: "GET",
        url: "../../api/cotizacionesController.php/?vendedorId=" + session.usuario_id,
        success: function(response) {
            console.log(JSON.parse(response));
            $("#cotizaciones-to-auth").empty();
            $('#cotizaciones-to-auth').append('<tr><th>Producto</th><th>Descripción</th><th>Precio Actual</th><th>Precio Solicitado</th><th>Estatus</th><th>Acciones</th></tr>');
            JSON.parse(response).forEach(function(row) {
                productRow = '<tr>';
                productRow += '<th>' + row.nombreProd + '</th>';
                productRow += '<th>' + row.descripcionProd + '</th>';
                productRow += '<th>$' + row.PrecioProducto + '</th>';
                productRow += '<th>$' + row.PrecioSolicitado + '</th>';
                productRow += '<th>' + setStatus(row.Estatus) + '</th>';
                
                if(setStatus(row.Estatus) == 'Solicitado'){
                    productRow += '<th><button class="authButton" onclick="authProduct(' + row.idCart + ', ' + row.ProductoId + ', ' + row.PrecioSolicitado + ', ' + row.Id + ', 1)">Autorizar cotización</button><button class="rejectButton" onclick="rejectProduct(' + row.Id + ', 2)">Rechazar cotización</button></th></tr>';
                }else{
                    productRow += '<th></th></tr>';
                }
                $('#cotizaciones-to-auth').append(productRow);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}

function getCotizacionesComprador(){
    $.ajax({
        type: "GET",
        url: "../../api/cotizacionesController.php/?clientId=" + session.usuario_id,
        success: function(response) {
            console.log(JSON.parse(response));
            $("#cotizaciones-to-auth").empty();
            $('#cotizaciones-to-auth').append('<tr><th>Producto</th><th>Descripción</th><th>Precio Actual</th><th>Precio Solicitado</th><th>Estatus</th></tr>');
            JSON.parse(response).forEach(function(row) {
                productRow = '<tr>';
                productRow += '<th>' + row.nombreProd + '</th>';
                productRow += '<th>' + row.descripcionProd + '</th>';
                productRow += '<th>$' + row.PrecioProducto + '</th>';
                productRow += '<th>$' + row.PrecioSolicitado + '</th>';
                productRow += '<th>' + setStatus(row.Estatus) + '</th></tr>';
                $('#cotizaciones-to-auth').append(productRow);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
            $('#cotizaciones-to-auth').append('<h4>Aún no tienes cotizaciones.</h4>');
        },
    });

}

function authProduct(cartId, productId, price, Id, status){
    addToCart(cartId, productId, price);
    setNewStatus(Id, status);
    getCotizacionesVendedor();
}

function rejectProduct(Id, status){
    setNewStatus(Id, status);
    getCotizacionesVendedor();
}

function setStatus(status){
    switch (status) {
        case 0:
          return 'Solicitado';
        case 1:
            return 'Autorizado';
        case 2:
            return 'Rechazado';
        default:
            return 'Sin estatus';
    }
}

function addToCart(cartId, productId, price){
    $.ajax({
        type: "POST",
        url: "../../api/productosCarritoController.php",
        data: {
            idCarrito: cartId,
            cantidad: 1,
            productoID: productId,
            precioCarrito: Number(price)
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

function setNewStatus(idCotizacion, estatus){
    $.ajax({
        type: "POST",
        url: "../../api/modificarCotizaciones.php",
        data: {
            idCotizacion: idCotizacion,
            estatus: estatus
        },
        success: function(data) {
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}