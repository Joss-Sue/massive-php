$( document ).ready(function() {
    var session;
    $.ajaxSetup({cache: false})
    $.get('../../api/getsession.php', function (data) {
        session = JSON.parse(data);
    });
    getProduct($("#product_id").val());
});

function getProduct(productId){
    $.ajax({
        type: "GET",
        url: "../../api/productosController.php/?productId=" + productId,
        success: function(response) {
            console.log(JSON.parse(response));
            var product = JSON.parse(response);
            setProduct(product.nombreProd, product.descripcionProd, product.precioProd, product.precioProd);
        },
        error: function(xhr, status, error) {
            console.log('error');
            console.log(error);
        },
    });
};

function setProduct(productTitle, productDesc, productPrice, productPreviousPrice){
    $("#product-title").append(productTitle);
    $("#product-desc").append(productDesc);
    $("#product-price").append('$' + Number(productPrice));
    $("#product-previous-price").append('$' + (Number(productPreviousPrice) * 2));
};