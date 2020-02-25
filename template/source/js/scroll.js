let boardsSection = $("#boards");
$("#arrow").click( ()=> {


    $('html, body').animate({
        scrollTop: boardsSection.offset().top
    }, 800)

});