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
            $("#product-list").append('<h5>No hay productos en tu carrito.</h5>');
            //$("#paypal-button-container").hide();
            $("#paypal-button-container").css({"pointer-events": "none", "opacity": ".7"});
            console.log('error');
            console.log(error);
        },
    });
}

function finishPayment(){
    console.log('hacer compra');
    $.ajax({
      type: "POST",
      url: "../../api/compraPedidoController.php",
      data: {
          idCarrito: session.usuario_carrito,
          idUsuario: session.usuario_id
      },
      success: function(data) {
          alert('Compra finalizada');
          window.location.reload();
      },
      error: function(xhr, status, error) {
          console.log('error');
          console.log(error);
      },
  });
}

function setProduct(producto, precio, cantidad){
    var tag =  '<div class="product"><img src="../products/test.jpg" alt=""><div class="info-cart"><p>' + producto + '</p><p>$' + Number(precio) + '</p><button>Eliminar</button></div><div class="quantity">(' + cantidad + ')</div></div>';
    return tag;
}

paypal.Buttons({
    createOrder: function (data, actions) {
       // Actualiza el precio antes de crear la orden
      return actions.order.create({
        purchase_units: [{
          amount: {
            currency_code: 'MXN',
            value: total.toString() // Usa el precio calculado
          }
        }]
      });
    },
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        finishPayment();
      });
    }
  }).render('#paypal-button-container')