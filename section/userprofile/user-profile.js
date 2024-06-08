var session;

$( document ).ready(function() {
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        getUser();
    });
});

function getUser(){
    $.ajax({
        type: "GET",
        url: "../../api/usuariosController.php/?id=" + session.usuario_id,
        success: function(response) {
            console.log(JSON.parse(response));
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
}