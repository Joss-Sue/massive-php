$( document ).ready(function() {
    $("#add-category").slideToggle();
    getCategories();
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
    });
    $("#show-form").click(function(){
        $("#add-category").slideToggle("slow");
    });
    
    $("#add-newCategory").click(function(){
        addCategory(session.usuario_id);
    });
});

function getCategories(){
    $.ajax({
        type: "GET",
        url: "../../api/categoriaController.php",
        success: function(response) {
            $("#categories-table").empty();
            $('#categories-table').append('<tr><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr>');
            JSON.parse(response).forEach(function(row) {
                messageHTML = '<tr>';
                messageHTML += '<th>' + row.nombre + '</th>';
                messageHTML += '<th>' + row.descripcion + '</th>';
                messageHTML += '<th></th></tr>';
                $('#categories-table').append(messageHTML);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};

function addCategory(createdBy){
    var nombre = $("#name").val();
    var descripcion = $("#descripcion").val();
    $.ajax({
        type: "POST",
        url: "../../api/categoriaController.php",
        data: {
            nombre: nombre,
            descripcion: descripcion,
            createdBy: createdBy
        },
        success: function(data) {
            $("#name").val('');
            $("#descripcion").val('');
            $("#add-category").slideToggle("slow");
            getCategories();
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};