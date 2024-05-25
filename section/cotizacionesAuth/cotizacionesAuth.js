var session;
var product;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        if(session.usuario_tipo == 'comprador'){
            getCotizacionesComprador(session.usuario_id);
        }else if(session.usuario_tipo == 'vendedor'){
            getCotizacionesVendedor(session.usuario_id);
        }
    });
});

function getCotizacionesVendedor(userId){
    $.ajax({
        type: "GET",
        url: "../../api/cotizacionesController.php/?vendedorId=" + userId,
        success: function(response) {
            console.log(JSON.parse(response));
            $("#cotizaciones-to-auth").empty();
            $('#cotizaciones-to-auth').append('<tr><th>Producto</th><th>Descripción</th><th>Precio Actual</th><th>Precio Solicitado</th><th>Acciones</th></tr>');
            JSON.parse(response).forEach(function(row) {
                productRow = '<tr>';
                productRow += '<th>' + row.nombreProd + '</th>';
                productRow += '<th>' + row.descripcionProd + '</th>';
                productRow += '<th>$' + row.PrecioProducto + '</th>';
                productRow += '<th>$' + row.PrecioSolicitado + '</th>';
                productRow += '<th><button action="" onclick="authProduct()">Autorizar producto</button></th></tr>';
                $('#cotizaciones-to-auth').append(productRow);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}

function getCotizacionesComprador(userId){
    $.ajax({
        type: "GET",
        url: "../../api/cotizacionesController.php/?clientId=" + userId,
        success: function(response) {
            console.log(JSON.parse(response));
            $("#cotizaciones-to-auth").empty();
            $('#cotizaciones-to-auth').append('<tr><th>Producto</th><th>Descripción</th><th>Precio Actual</th><th>Precio Solicitado</th></tr>');
            JSON.parse(response).forEach(function(row) {
                productRow = '<tr>';
                productRow += '<th>' + row.nombreProd + '</th>';
                productRow += '<th>' + row.descripcionProd + '</th>';
                productRow += '<th>$' + row.PrecioProducto + '</th>';
                productRow += '<th>$' + row.PrecioSolicitado + '</th></tr>';
                $('#cotizaciones-to-auth').append(productRow);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });

}

function authProduct(){
    console.log('autorizar');
}