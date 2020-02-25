$(".file").click( function(){
    // Hide spoiler message and remove boundries
    if(this.classList.contains('show')){
        // Shring the element
        $(this).removeClass("show");

        // Images
        $(this).children('img').each( (index, img) => {
            img.dataset.big = img.src;
            img.src = img.dataset.small;

        })
         // Videos
         $(this).children('video').each((index, video)=>{
            if(this.classList.contains('spoiler')){
                video.controls = false;
                // video.pause();
            }
            // I will not remove the source element for the sake of speed
        })

    } else {
        // Expand the file
        $(this).addClass("show");
        // Images
        $(this).children('img').each( (index, img) => {
            img.dataset.small = img.src;
            img.src = img.dataset.big;
        })
        // Videos
        $(this).children('video').each((index, video)=>{
            if(this.classList.contains('spoiler')){
                console.log("HERE");
                video.controls = true;
            }
            
            // Create source element
            let source = $("<source></source>").attr('src', video.dataset.src);

            // Add the source to the video
            $(video).append(source);
        })
    }
});


// Spoiler card images
$("[data-spoiler]").click(function(){
    $(this).toggleClass("spoiler");
})