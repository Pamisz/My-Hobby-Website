
$(document).ready(function() {
    // najwyższy punkt nawigacji
       var stickyNavTop = $('.nav').offset().top;
       
       // definicja pozycji nav
       var stickyNav = function(){
        var scrollTop = $(window).scrollTop(); // aktualna pozycja nav
             
        // jeżeli zescrollujemy w dół pozcyja zmieni się na sticky
        // w innym wypadku wróci do fixed
        if (scrollTop > stickyNavTop) { 
            $('.nav').addClass('sticky');
        } else {
            $('.nav').removeClass('sticky'); 
        }
    };

    stickyNav();
    // funkcja powtarza się przy każdym scrollu
    $(window).scroll(function() {
        stickyNav();
    });
});

   