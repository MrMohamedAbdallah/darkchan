$("#create-thread").slideUp(0);

$("#show-create-thread").click(function(){
    $("#create-thread").slideDown(800);
})
$("#hide-create-thread").click(function(){
    $("#create-thread").slideUp(800);
})

// Hide posts/comments

$("[hide-parent]").click(function(){
    $(this).parent().parent().parent().fadeOut(500);
})