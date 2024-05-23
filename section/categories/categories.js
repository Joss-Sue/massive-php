$( document ).ready(function() {
    $("#add-category").slideToggle();
    getCategories();
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
        console.log(session);
        console.log(session.usuario_nombre);
    });
    $("#show-form").click(function(){
        $("#add-category").slideToggle("slow");
    });
    
    $("#add-newCategory").click(function(){
        addCategory(session.usuario_id);
    });
});

function getCategories(){
    console.log('Hola');
    $.ajax({
        type: "GET",
        url: "../../api/categoriaController.php",
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

function addCategory(createdBy){
    console.log('Agregar categorias');
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
        success: function(response) {
            $("#name").val() = '';
            $("#descripcion").val() = '';
            console.log('success');
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};