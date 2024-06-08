var session;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        console.log(session);
        getOrders();
    });
});

function getOrders(){
    $.ajax({
        type: "GET",
        url: "../../api/compraPedidoController.php/?idUsuario=" + session.usuario_id,
        success: function(response) {
            console.log(JSON.parse(response));
            var oders = JSON.parse(response);
            oders.forEach(function(row) {
                var order = '<div class="order">';
                var stringDate = row.fechaPedido.split(" ")[0].split("-").reverse().join("-");
                order += generalInfo(stringDate, row.totalPedido);
                order += '<hr>';
                order += '<div class="order-status"><h3>Entregado</h3><h5>El paquete ha sido entregado</h5></div>';
                var products = '';
                row.productos.forEach(function(i) {
                    products += setProduct(i.nombreProd, i.descripcionProd, i.precio);
                });
                order += products;
                order += '</div>'
                $('.orders-container').append(order);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
            $('.orders-container').append('<h4>Aún no tienes pedidos.</h4>');
        },
    });
}

function generalInfo(fecha, total){
    var tag =  '<div class="general-info"><div><h3>Fecha</h3><h4>' + fecha + '</h4></div><div><h3>Total</h3><h4>$' + Number(total) + '</h4></div></div>';
    return tag;
}

function setProduct(nombre, desc, total){
    console.log(total);
    var tag =  '<div class="products"><div class="products-info"><img src="../products/test.jpg" alt=""><div><h3>' + nombre + '</h3><h5>' + desc + '</h5><h4>$' + Number(total) + '</h4></div></div></div>';
    return tag;
}