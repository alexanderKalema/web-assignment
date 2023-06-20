
<script>
    let user = <?php   echo $user_json; ?>;
    const favoriteBtn = document.getElementById('favoriteBtn');
    const watchlistBtn = document.getElementById('watchlistBtn');
    const messageBox = document.getElementById('messageBox');
    let favclick = false;
    let watchclick = false;



    function handleLikeClick(button) {
    button.classList.toggle("clicked");

}

    function handleDislikeClick(button) {
    button.classList.toggle("clicked");
}

    favoriteBtn.addEventListener('click', () => {
    if (favclick == false) {
    showMessage('added to favorites');
    favclick = true;
} else {
    showMessage('Removed from favorites');
    favclick = false;

}
});


    <?php $db = new Database(); ?>;


    watchlistBtn.addEventListener('click', () => {
    if(user !== null){
    console.log("clickedd");
    const check = document.querySelector('.check');
    if (watchclick == false) {
    check.classList.remove('fa-plus');
    check.classList.add('fa-check');
    console.log("clickedd");
    showMessage('Added to watchlist');
    watchclick = true;

} else {
    check.classList.remove('fa-check');
    check.classList.add('fa-plus');
    showMessage('Removed from watchlist');
    watchclick = false;
}
} else{
    alert("You need ")
}

});





    function showMessage(text) {
    messageBox.textContent = text;
    messageBox.style.display = 'block';
    setTimeout(() => {
    messageBox.style.display = 'none';
}, 2000);
}


    const stars = document.querySelectorAll('.star');
    const starsContainer = document.getElementById('stars');
    const ratingText = document.getElementById('rating-text');

    let totalrate = 4.5;
    let oldrate = 0;
    let num = 1;
    let numcheck = 1;
    let orginalrate = 4.5;
    let update = false;
    let rating = 0;


    starsContainer.addEventListener('mouseout', () => {
    if (rating === 0) {
    stars.forEach(star => star.classList.remove('filled'));
} else {
    for (let i = 0; i < rating; i++) {
    stars[i].classList.add('filled');
}
    for (let i = rating; i < stars.length; i++) {
    stars[i].classList.remove('filled');
}
}
});

    stars.forEach((star, index) => {
    star.addEventListener('mouseover', () => {
        for (let i = 0; i <= index; i++) {
            stars[i].classList.add('filled');
        }
    });


    star.addEventListener('click', () => {
    if (rating === index + 1) {
    rating = 0;
    num--;
    stars.forEach(star => star.classList.remove('filled'));
} else {
    if (rating == 0) {
    num++;
}

    for (let i = 0; i <= index; i++) {
    stars[i].classList.add('filled');
}
    for (let i = index + 1; i < stars.length; i++) {
    stars[i].classList.remove('filled');
}

    rating = index + 1;
}
    if (num > numcheck) {
    numcheck = num;
}


    if (update == false) {
    totalrate = (totalrate - oldrate + rating) / num;
    oldrate = rating;
    update = true;
} else {
    if (numcheck == num) {
    totalrate = ((totalrate * num) - oldrate + rating) / num;
    oldrate = rating;


} else {
    oldrate = 0;
    update = false;
    totalrate = orginalrate;

}
}
    numcheck = num;


    var ratingparagraph = document.getElementById("rating-paragraph");
    ratingparagraph.textContent = "Rating: " + totalrate + "/5";

});

});


</script>


<script>
    var imagePaths = <?php echo json_encode($movie->detail->imagePath); ?>;
    var imageIndex = 0;
    var imageCount = imagePaths.length;

    function changeBackgroundImage() {
    var imageUrl = "https://image.tmdb.org/t/p/original" + imagePaths[imageIndex];
    var backgroundContainer = document.getElementById('background-container');

    // Preload the new image
    var tempImage = new Image();
    tempImage.src = imageUrl;
    tempImage.onload = function () {
    // Create a clone of the background container
    var clonedContainer = backgroundContainer.cloneNode(true);
    clonedContainer.style.backgroundImage = "url('" + imageUrl + "')";

    // Set initial opacity and contrast for animation
    clonedContainer.style.opacity = 0;
    clonedContainer.style.filter = "brightness(30%)";
    clonedContainer.style.transition = "opacity 2s ease, filter 2s ease";

    // Append the cloned container to the body
    document.body.appendChild(clonedContainer);

    // Trigger reflow to ensure the cloned container is rendered
    clonedContainer.offsetHeight;

    // Fade out the original container
    backgroundContainer.style.opacity = 0.1;
    backgroundContainer.style.transition = "opacity 2s ease";

    // Fade in the cloned container
    setTimeout(function () {
    clonedContainer.style.opacity = 0.9;
    clonedContainer.style.filter = "brightness(60%)";
}, 10);

    // Remove the original container after the transition ends
    setTimeout(function () {
    document.body.removeChild(backgroundContainer);
}, 4000);
};

    // Update the image index for the next change
    imageIndex = (imageIndex + 1) % imageCount;
}

    // Change the background image initially
    changeBackgroundImage();

    // Change the background image every 5 seconds
    setInterval(changeBackgroundImage, 7000);
</script>


<script>
    function togglePopup() {
    var popup = document.getElementById("castPopup");
    if (popup.style.display === "none") {
    popup.style.display = "block";
} else {
    popup.style.display = "none";
}
}

    // Close the popup when clicked outside the frame
    window.onclick = function (event) {
    var popup = document.getElementById("castPopup");
    var showCastBtn = document.getElementById("showcastbtn");
    if (!event.target.closest('.popup') && event.target !== showCastBtn) {
    popup.style.display = "none";
}
};
</script>

<script src="https://www.youtube.com/iframe_api"></script>

<script>

    const watchTrailerBtn = document.querySelector('.watch-trailer-btn');
    const videoPlayer = document.querySelector('.video-player');
    const closeBtn = document.querySelector('.close-btn');

    watchTrailerBtn.addEventListener('click', () => {
    videoPlayer.style.display = 'flex';
});
    // Load the IFrame Player API code asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // Replace 'YOUR_TRAILER_KEY' with the actual trailer key from the PHP variable.
    var trailerKey = '<?php echo $movie->detail->trailerKey; ?>';

    // Create an <iframe> (and YouTube player) after the API code downloads.
    var player;

    function onYouTubePlayerAPIReady() {
        player = new YT.Player('player', {
            height: '400',
            width: '600',
            videoId: trailerKey,
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    // The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        // You can add custom event listeners here, e.g., play, pause, etc.
    }

    document.querySelector('.close-btn').addEventListener('click', function () {
        // Pause the video when the close button is clicked
        player.pauseVideo();

        // Hide the video player container or perform any other action you want
        document.querySelector('.video-player').style.display = 'none';
    });


    document.addEventListener('DOMContentLoaded', function () {
        var descMovieDiv = document.querySelector('#desc-movie');
        var textContainer = document.querySelector('#textContainer');
        var seeMoreButton = document.querySelector('#seeMoreButton');
        var popup = null;

        seeMoreButton.addEventListener('click', function () {
        if (!popup) {
        popup = document.createElement('div');
        popup.className = 'my-popup';
        popup.textContent = textContainer.textContent;
        document.body.appendChild(popup);
    } else {
        document.body.removeChild(popup);
        popup = null;
    }
    });

        // Check if the content overflows the div on page load
        var clone = textContainer.cloneNode(true);
        clone.style.cssText = 'position: absolute; visibility: hidden; height: auto; width: ' + textContainer.clientWidth + 'px;';
        document.body.appendChild(clone);
        if (clone.scrollHeight > textContainer.clientHeight) {
        seeMoreButton.style.display = 'block';
    }
        document.body.removeChild(clone);

        // Remove popup when clicked outside the frame
        window.addEventListener('click', function (event) {
        if (popup && !popup.contains(event.target) && event.target !== seeMoreButton) {
        document.body.removeChild(popup);
        popup = null;
    }
    });
    });


</script>
