var session;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        console.log(session);
        getSales();
    });
});

function getSales(){
    $.ajax({
        type: "GET",
        url: "../../api/ventasController.php/?idUsuario=" + session.usuario_id,
        success: function(response) {
            console.log(JSON.parse(response));
            $("#sales-table").empty();
            $('#sales-table').append('<tr><th>Producto</th><th>Fecha</th><th>Precio</th><th>Vendidos</th><th>Total</th></tr>');
            JSON.parse(response).forEach(function(row) {
                saleRow = '<tr>';
                saleRow += '<th>' + row.nombreProd + '</th>';
                saleRow += '<th>' + row.fechaVenta.split(" ")[0].split("-").reverse().join("-") + '</th>';
                saleRow += '<th>$' + row.precio + '</th>';
                saleRow += '<th>' + row.articulosTotales + '</th>';
                saleRow += '<th>$' + row.total + '</th></tr>';
                $('#sales-table').append(saleRow);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
            $('.sales-container').append('<h4>Aún no tienes ventas.</h4>');
        },
    });
}