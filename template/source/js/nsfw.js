$("a.nsfw-link").click( function(e) {
    // Prevent the user from going to the page
    e.preventDefault();



    // Change the modal link
    $("#modal-link").attr('href', this.href);


    // Show the modal
    $(".nsfw-modal").addClass('show');
});

// Hide the model
$(".modal-cancel").click(()=>{
    $(".nsfw-modal").removeClass('show');

})