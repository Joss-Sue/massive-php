$( document ).ready(function() {
    getMyProducts();
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        console.log(session);
        console.log(session.usuario_nombre);
    });
});

function getMyProducts(){
    console.log('Hola');
    $.ajax({
        type: "GET",
        url: "../../api/productosController.php",
        success: function(response) {
            console.log('success');
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};