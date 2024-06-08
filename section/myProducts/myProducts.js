$( document ).ready(function() {
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        getMyProducts(session.usuario_id);
    });
});

function getMyProducts(userId){
    $.ajax({
        type: "GET",
        url: "../../api/productosController.php/?id=" + userId + "&pagina=1",
        success: function(response) {
            $("#products-table").empty();
            $('#products-table').append('<tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Disponibles</th><th>Estatus</th><th>Acciones</th></tr>');
            JSON.parse(response).forEach(function(row) {
                productRow = '<tr>';
                productRow += '<th>' + row.nombreProd + '</th>';
                productRow += '<th>' + row.descripcionProd + '</th>';
                productRow += '<th>$' + row.precioProd + '</th>';
                productRow += '<th>' + row.stockProd + '</th>';
                productRow += '<th>' + getStatus(row.estaListadoProd) + '</th>';
                productRow += '<th></th></tr>';
                $('#products-table').append(productRow);
            });
        },
        error: function(xhr, status, error) {
            $('.products-table-container').append('<h4>Aún no tienes productos.</h4>');
            console.log('error');
            console.log(error);
        },
    });
};

function getStatus(status){
    return status == 0  ? 'Sin Autorizar' : 'Autorizado';
}