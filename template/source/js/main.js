// Show and hide menus
$(".menu").click(function(e){
    e.stopPropagation();
    $(this).addClass("show");

})

$(window).click(()=>{
    $(".menu").removeClass("show");
})
