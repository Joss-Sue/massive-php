$( document ).ready(function() {
    $(".user-menu").click(function() {
        console.log('di click')
        $(this).toggleClass("show");
    });
});