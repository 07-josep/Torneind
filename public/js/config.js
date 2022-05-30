//CÓDIGO DE LA COOKIE.
$(document).ready(function() {
    $('.overlay_popup').delay(2000).queue(function() {
        $('.overlay_popup').addClass('popup-open')
    });
});

$.fn.popupClose = function() {
    $(".overlay_popup").removeClass("popup-open");
    return this;
};

//CÓDIGO DE PRIVACIDAD Y SALUD.
$(document).ready(function() {
    $(".faqs-container .faq-singular:first-child").addClass("active").children(".faq-answer").slideDown();//Remove this line if you dont want the first item to be opened automatically.
    $(".faq-question").on("click", function(){
        if( $(this).parent().hasClass("active") ){
            $(this).next().slideUp();
            $(this).parent().removeClass("active");
        }
        else{
            $(".faq-answer").slideUp();
            $(".faq-singular").removeClass("active");
            $(this).parent().addClass("active");
            $(this).next().slideDown();
        }
    });
});
