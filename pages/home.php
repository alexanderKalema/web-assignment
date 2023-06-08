<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styles/home.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Home Page</title>
</head>
<body>

<?php
session_start();
$user = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : null;
$user_json = json_encode($user);
include "navbar.php"
?>
<main>

    <div class="slider">
        <div class="slide active">
            <img src="../assets/game (48).jpg" alt="">
            <div class="info">
                <h2>News 1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="slide">
            <img src="../assets/game (138).jpg" alt="">
            <div class="info">
                <h2>News 2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>
        </div>

        <div class="slide">
            <img src="../assets/game (8).jpg" alt="">
            <div class="info">
                <h2>News 3</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>
        </div>
        <div class="slide">
            <img src="../assets/demon_slayer.jpg" alt="">
            <div class="info">
                <h2>News 4</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua.</p>
            </div>
        </div>

        <div class="navigation">
            <i class="fas fa-chevron-left prev-btn"></i>
            <i class="fas fa-chevron-right next-btn"></i>
        </div>
        <div class="navigation-visibility">
            <div class="slide-icon active"></div>
            <div class="slide-icon"></div>
            <div class="slide-icon"></div>
            <div class="slide-icon"></div>
        </div>
    </div>


    <?php

    require_once '../services/apis/movie_api.php';

    $categories = ['popular', 'top_rated', 'upcoming'];

    echo "<div style=' padding-top: 650px;'> </div>";
    foreach ($categories as $category) {
        $data = get_movies($category);


        echo "<div class='trending'>";
        echo "<div class = 'trending-top'>";
        echo "<span class='trending-title'>" . ucfirst(str_replace('_', ' ', $category)) . " Movies </span>";
        echo "</div>";


        echo "<div class='wrapper'>";
        echo "<div class='cards'>";
        foreach ($data['results'] as $movie) {
            $title = $movie['title'];
            $poster_path = "https://image.tmdb.org/t/p/w500" . $movie['poster_path'];
            $release_date = $movie['release_date'];
            $popularity = $movie['popularity'];
            $genres = 'Genres:  ';
            foreach ($movie['genre_names'] as $name) {
                $genres .= $name . " · ";
            }

            echo '<div class="movie-card">';
            echo '  <a href=""><img src="' . $poster_path . '" alt="Movie Poster"></a>';
            echo '  <div class="movie-info">';
            echo '    <h1>' . $title . '</h1>';
            echo '  </div>';
            echo '  <div class="movie-ratings">';
            echo '    <p>' . $genres . '</p>';
            echo '    <p>Release Date: ' . $release_date . '</p>';
            echo '    <p>Popularity: ' . $popularity . '</p>';
            echo '  </div>';

            echo '  <button>Read More &gt;</button>';
            echo '</div>';
        }

        echo "</div>";
        echo "</div>";


        echo "</div>";
    }


    ?>


    <div class="popular">
        <div class="popular-top">
            <h1 class="popular-title">MOST POPULAR SHOWS ON MC</h1>
        </div>
        <div class="popular-main">
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
            <div class="mandalorian">
                <a href=""><span>The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr>
            </div>
        </div>
        <div class="popular-end">
            <a href="">VIEW MORE</a>
        </div>

    </div>
    <h1 class="hottest">MOVIECHEIF'S TOP GAME PICKS</h1>
    <div class="game-gallery">
        <div class="game-item" style="background-image: url('../assets/gotg3.jpeg');"></div>
        <p class="game-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi asperiores omnis
            pariatur possimus saepe sapiente ipsam aspernatur. Earum, numquam, dolores ut distinctio aut pariatur,
            eligendi quas blanditiis perspiciatis ratione ipsum.</p>
        <div class="game-item" style="background-image: url('../assets/gotg3.jpeg');"></div>
        <p class="game-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi asperiores omnis
            pariatur possimus saepe sapiente ipsam aspernatur. Earum, numquam, dolores ut distinctio aut pariatur,
            eligendi quas blanditiis perspiciatis ratione ipsum.</p>
        <div class="game-item" style="background-image: url('../assets/gotg3.jpeg');"></div>
        <p class="game-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi asperiores omnis
            pariatur possimus saepe sapiente ipsam aspernatur. Earum, numquam, dolores ut distinctio aut pariatur,
            eligendi quas blanditiis perspiciatis ratione ipsum.</p>
        <div class="game-item" style="background-image: url('../assets/gotg3.jpeg');"></div>
        <p class="game-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi asperiores omnis
            pariatur possimus saepe sapiente ipsam aspernatur. Earum, numquam, dolores ut distinctio aut pariatur,
            eligendi quas blanditiis perspiciatis ratione ipsum.</p>
        <div class="game-item" style="background-image: url('../assets/gotg3.jpeg');"></div>
        <p class="game-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi asperiores omnis
            pariatur possimus saepe sapiente ipsam aspernatur. Earum, numquam, dolores ut distinctio aut pariatur,
            eligendi quas blanditiis perspiciatis ratione ipsum.</p>
    </div>
</main>
<script>

    let user = <?php echo $user_json; ?>;

    if (user) {
        document.getElementById("signup").style.display = "none";
        document.getElementById("profile").style.display = "block";
    }
    else {
        document.getElementById("profile").remove();
    }



    const slider = document.querySelector(".slider");
    const nextBtn = document.querySelector(".next-btn");
    const prevBtn = document.querySelector(".prev-btn");
    const slides = document.querySelectorAll(".slide");
    const slideIcons = document.querySelectorAll(".slide-icon");
    const numberOfSlides = slides.length;
    var slideNumber = 0;

    //image slider next button
    nextBtn.addEventListener("click", () => {
        slides.forEach((slide) => {
            slide.classList.remove("active");
        });
        slideIcons.forEach((slideIcon) => {
            slideIcon.classList.remove("active");
        });

        slideNumber++;

        if (slideNumber > (numberOfSlides - 1)) {
            slideNumber = 0;
        }

        slides[slideNumber].classList.add("active");
        slideIcons[slideNumber].classList.add("active");
    });

    //image slider previous button
    prevBtn.addEventListener("click", () => {
        slides.forEach((slide) => {
            slide.classList.remove("active");
        });
        slideIcons.forEach((slideIcon) => {
            slideIcon.classList.remove("active");
        });

        slideNumber--;

        if (slideNumber < 0) {
            slideNumber = numberOfSlides - 1;
        }

        slides[slideNumber].classList.add("active");
        slideIcons[slideNumber].classList.add("active");
    });

    //image slider autoplay
    var playSlider;

    var repeater = () => {
        playSlider = setInterval(function () {
            slides.forEach((slide) => {
                slide.classList.remove("active");
            });
            slideIcons.forEach((slideIcon) => {
                slideIcon.classList.remove("active");
            });

            slideNumber++;

            if (slideNumber > (numberOfSlides - 1)) {
                slideNumber = 0;
            }

            slides[slideNumber].classList.add("active");
            slideIcons[slideNumber].classList.add("active");
        }, 4000);
    }
    repeater();

    //stop the image slider autoplay on mouseover
    slider.addEventListener("mouseover", () => {
        clearInterval(playSlider);
    });

    //start the image slider autoplay again on mouseout
    slider.addEventListener("mouseout", () => {
        repeater();
    });
</script>
</body>
</html>
