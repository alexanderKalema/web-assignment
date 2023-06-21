<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="../styles/movie_detail.css">


    <title>Review page</title>
</head>
<body>


<?php
require_once "../services/models/movie.php";
require_once "../services/database.php";

session_start();
$user = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : null;

$user_json = json_encode($user);
$db = new Database();
$movie = new movie($_GET['movie']);
?>
<div id="background-container"></div>
<div class="favorite-btn" id="favoriteBtn" onclick="handleLikeClick(this)">
    <i class="fas fa-heart"></i>
</div>
<div class="bookmark-movie" id="bookmark-movie">
    <div class="watchlist-btn" id="watchlistBtn">
        <i class="icon fa fa-bookmark"></i>
        <i class="check fa fa-plus"></i>
    </div>
</div>
<div class="message-box" id="messageBox"></div>
<div class="movie-info">
    <div class="left-section">
        <h1><span class="underline"><?php echo $movie->title; ?></span></h1>
        <div class="available">

            <?php
            $providerString = '<b>Available on: </b>' . implode('<span class="parallelogram"></span> ', $movie->detail->watchProviders);
            echo "<p>{$providerString}</p>";

            ?>

        </div>
        <div>
            <?php


            $initialActors = array_slice($movie->detail->actors, 0, 3);

            ?>


            <p>
                <b>Cast: </b><?php echo implode('<span class="parallelogram"></span>', $initialActors); ?>
                <button id="showcastbtn" class="showcastbtn" onclick="togglePopup()">... see more</button>
            </p>


            <div id="castPopup" class="popup" style="display: none;">

                <div class="directors">
                    <?php
                    if (!empty($movie->detail->directors)) {
                        echo '<b>Directed by: </b>';
                        echo "<span>" . implode('&nbsp;&nbsp;<span class="parallelogram"></span>&nbsp;&nbsp;', $movie->detail->directors) . "</span>";

                    }
                    ?>
                </div>
                <div class="producers">
                    <?php
                    if (!empty($movie->detail->producers)) {
                        echo '<br><b>Produced by: </b>';
                        echo "<span>" . implode('&nbsp;&nbsp;<span class="parallelogram"></span>&nbsp;&nbsp;', $movie->detail->producers) . "</span>";

                    }
                    ?>
                </div>

                <div class="cast">
                    <h2><b>Full Cast:</b></h2>
                    <p><?php echo implode(', ', $movie->detail->actors); ?></p>
                </div>

            </div>

        </div>
        <div>
            <p><b>Release Date: </b><?php echo $movie->release_date; ?> </p>
        </div>
        <h2><p id="rating-paragraph" style="font-size: 1.2rem;"><b>Rating:</b> 4.5/5</p></h2>
        <div class="tags">
            <?php
            $genreString = '<b>Genre:  </b>' . implode('<span class="parallelogram"></span> ', $movie->genres);
            echo "<p>{$genreString}</p>";


            ?>
        </div>
        <br>
        <div class="stars" id="stars">
            <button class="rate-btn"><p class="rate-text">Rate</p></button>
            <i class="star fas fa-star" data-index="0"></i>
            <i class="star fas fa-star" data-index="1"></i>
            <i class="star fas fa-star" data-index="2"></i>
            <i class="star fas fa-star" data-index="3"></i>
            <i class="star fas fa-star" data-index="4"></i>

        </div>


        <div class="desc-movie" id="desc-movie">
            <p id="textContainer"><?php echo $movie->overview; ?></p>
            <button id="seeMoreButton" style=": none;">See More</button>
        </div>


    </div>

    <div class="right-section">
        <div class="similars">
            <?php

            echo '<h2><span class="underline">Similar Movies<span></h2>';
            echo '<ul>';
            $coun = 0;

            for ($i = 0; $i < count($movie->detail->similarMovies); $i++) {
                $temp = new movie($movie->detail->similarMovies[$i]);
                $posterPath = $temp->poster_path;

                $id = $temp->id;
                if ($coun >= 4) {
                    break;
                }

                echo '<a href="movie_detail.php?movie=' . $id . '">';
                echo '<div> <img src="https://image.tmdb.org/t/p/original/' . $posterPath . '" alt="' . $id . '"></div>';

                echo '</a>';

                $coun++;
            }


            ?>
        </div>

        <div class="trailer">

            <div class="watch-trailer-btn" id="playButton">
                <i class="fas fa-play"></i>
            </div>
            <br>
            <div><b>Watch&nbsp;Trailer</b>


            </div>
        </div>
        <div class="video-container">
            <div class="video-player">


                <div class="video-frame">
                    <div id="player"></div>
                    <button class="close-btn"><b>x</b></button>
                </div>
            </div>

        </div>

    </div>
</div>
<div class="page-navigation">
    <div class="page-prev">&#10094;</div>
    <div class="dots">
        <span class="dot active"></span>
        <span class="dot"></span>


    </div>
    <a href="review.php?movie=<?php echo $movie->id?>&user_id=<?php echo $user->id?>">
        <div class="page-next">&#10095;</div>
    </a>
</div>

<script>
    var imagePaths = <?php echo json_encode($movie->detail->imagePath); ?>;
    var imageIndex = 0;
    var imageCount = imagePaths.length;

    function changeBackgroundImage() {
        console.log("hj");
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

    let user = <?php   echo $user_json; ?>;


    const watchlistBtn = document.getElementById('watchlistBtn');
    const messageBox = document.getElementById('messageBox');

    let watchclick = false;


   watchlistBtn.addEventListener('click', () => {
            console.log("no even here");
            if (user !== null) {

                const check = document.querySelector('.check');
                if (watchclick === false) {
                    let result = watchlistOperation("add");
                    if (result) {
                        check.classList.remove('fa-plus');
                        check.classList.add('fa-check');
                        showMessage('Added to watchlist');
                        watchclick = true;
                    } else {
                        showMessage("Couldn't add to watchlist");
                    }


                } else {
                    let result = watchlistOperation("remove");
                    if (result) {
                        check.classList.remove('fa-check');
                        check.classList.add('fa-plus');
                        showMessage('Removed from watchlist');
                        watchclick = false;
                    } else {
                        showMessage("Couldn't remove from watchlist");
                    }

                }
            } else {
                alert("You need to be logged in to access watchlist");
            }

        });




    async function watchlistOperation(operation) {
        try {
            let res = false;
            if (operation === "add") {
                res =  <?php  echo $db->addWatchList($user->id, $movie->id);?>;
            } else {
                res =   <?php echo $db->deleteWatchList($movie->id, $user->id);?>;
            }
            return res;
        } catch (error) {
            console.error(error);
        }
    }


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


</body>
</html>
