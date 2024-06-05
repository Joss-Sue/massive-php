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
            $('#cotizaciones-to-auth').append('<tr><th>Producto</th><th>Descripción</th><th>Precio Actual</th><th>Precio Solicitado</th><th>Estatus</th><th>Acciones</th></tr>');
            JSON.parse(response).forEach(function(row) {
                productRow = '<tr>';
                productRow += '<th>' + row.nombreProd + '</th>';
                productRow += '<th>' + row.descripcionProd + '</th>';
                productRow += '<th>$' + row.PrecioProducto + '</th>';
                productRow += '<th>$' + row.PrecioSolicitado + '</th>';
                productRow += '<th>' + setStatus(row.Estatus) + '</th>';
                
                if(setStatus(row.Estatus) == 'Solicitado'){
                    productRow += '<th><button action="" onclick="authProduct(' + row.ProductoId + ')">Autorizar cotización</button></th></tr>';
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

function getCotizacionesComprador(userId){
    $.ajax({
        type: "GET",
        url: "../../api/cotizacionesController.php/?clientId=" + userId,
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
        },
    });

}

function authProduct(productId){
    console.log('autorizar');
    console.log(productId);
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