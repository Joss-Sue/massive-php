$( document ).ready(function() {
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        getProductsToAuth(session.usuario_id);
    });
});

function getProductsToAuth(userId){
    $.ajax({
        type: "GET",
        url: "../../api/productosController.php/?pagina=1",
        success: function(response) {
            console.log(JSON.parse(response));
            $("#products-to-auth").empty();
            $('#products-to-auth').append('<tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Disponibles</th><th>Estatus</th><th>Acciones</th></tr>');
            JSON.parse(response).forEach(function(row) {
                productRow = '<tr>';
                productRow += '<th>' + row.nombreProd + '</th>';
                productRow += '<th>' + row.descripcionProd + '</th>';
                productRow += '<th>$' + row.precioProd + '</th>';
                productRow += '<th>' + row.stockProd + '</th>';
                productRow += '<th>' + getStatus(row.estaListadoProd) + '</th>';
                productRow += '<th><button action="" onclick="authProduct(' + row.idProd + ', ' + userId + ')">Autorizar producto</button></th></tr>';
                $('#products-to-auth').append(productRow);
            });
        },
        error: function(xhr, status, error) {
            var noProducts = '<p>No hay productos por autorizar</p>';
            $('#products-to-auth').append(noProducts);
            console.log('error');
            console.log(error);
        },
    });
};

function getStatus(status){
    return status == 0  ? 'Sin Autorizar' : 'Autorizado';
}

function authProduct(productId, userId){
    console.log('Auth product');
    $.ajax({
        type: "PUT",
        url: "../../api/productosController.php",
        data: {
            idProducto: productId,
            idAdmin: userId
        },
        success: function(response) {
            console.log(response);
            alert('¡Producto autorizado correctamente!');
            getProductsToAuth(userId);
        },
        error: function(xhr, status, error) {
            alert('Error al autorizar el producto.');
            console.log('error');
            console.log(error);
        },
    });
}