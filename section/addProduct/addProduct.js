$( document ).ready(function() {
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
    });

    getCategories();

    $("#add-product-form").submit(function(e) {
        e.preventDefault();
        addProduct(session.usuario_id);
    });
});

function getCategories(){
    $.ajax({
        type: "GET",
        url: "../../api/categoriaController.php",
        success: function(response) {
            console.log(JSON.parse(response));
            JSON.parse(response).forEach(function(row) {
                var option = '<option value=' + row.id + '>' + row.nombre + '</option>'
                $('#category').append(option);
            });
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};

function addProduct(seller){
    var name = $("#name").val();
    var description = $("#description").val();
    var price = $("#price").val();
    var stock = $("#stock").val();
    var negotiable = $("#negotiable").prop("checked") ? 1 : 0;
    var category = $("#category").val();

    $.ajax({
        type: "POST",
        url: "../../api/productosController.php",
        data: {
            nombre: name,
            descripcion: description,
            cotizable: negotiable,
            precio: price,
            stock: stock,
            vendedor: seller,
            categoria: category
        },
        success: function(data) {
            console.log(data);
            $("#name").val('');
            $("#description").val('');
            $("#price").val(0);
            $("#stock").val(0);
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};