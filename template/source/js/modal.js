$(".show-comment-modal").click( ()=>{
    $("#comment-modal").addClass("show");
} );


$(".close").click(function(){
    $(this).parent().removeClass("show");
});