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
include "navbar.php";
require_once "../services/database.php";
$db = new Database();
function sendComplaint(): string
{
    if(!is_null($GLOBALS['user'])){
        if(isset($_POST['mess'])){
            $GLOBALS['db']->addComplaint($GLOBALS['user']->id, $_POST['mess']);
            return json_encode("success");
        }
        else{
            return json_encode("");
        }

    }
    else{
        return json_encode("Cant");
    }
}
?>
<main>
    <div class="slider">
        <div class="slide active">
            <img src="../assets/aquman.jpg" alt="poster">
            <div class="info">
                <h2>News 1</h2>
                <p>Marvel and DC cinematic universes might have a collab in the next movie.</p>
            </div>
        </div>
        <div class="slide">
            <img src="../assets/harley.jpg" alt="poster">
            <div class="info">
                <h2>News 2</h2>
                <p>The next Suicide Squad movie to be focused on Harley's backstory.</p>
            </div>
        </div>

        <div class="slide">
            <img src="../assets/keanu.jpg" alt="poster">
            <div class="info">
                <h2>News 3</h2>
                <p>Keanu Reeves retires at 52. His last movie 'John Wick 4' was a big hit.</p>
            </div>
        </div>
        <div class="slide">
            <img src="../assets/transs.jpg" alt="">
            <div class="info">
                <h2>News 4</h2>
                <p>The highly expected Transformers movie will hit the cinemas soon.</p>
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
    require_once '../services/models/movie.php';


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
            $poster_path = "https://image.tmdb.org/t/p/w500" .  $movie['poster_path'];
            $release_date =   $movie['release_date'];
            $popularity = $movie['popularity'];
            $genres = 'Genres:  ';
            foreach ($movie['genre_names'] as $name) {
                $genres .= $name . " · ";
            }

            echo '<div class="movie-card">';
            echo '<a href="movie_detail.php?movie='.$movie['id'] .'"><img src="' . $poster_path . '" alt="Movie Poster"></a>';
            echo '  <div class="movie-info">';
            echo '    <h1>' . $title . '</h1>';
            echo '  </div>';
            echo '  <div class="movie-ratings">';
            echo '    <p>' . $genres . '</p>';
            echo '    <p>Release Date: ' . $release_date . '</p>';
            echo '    <p>Popularity: ' . $popularity . '</p>';
            echo '  </div>';

            echo ' <a href="movie_detail.php?movie='.$movie['id'] .'"> <button>Read More &gt;</button></a>';
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
        <div class="popular-main"  style="padding-left: 240px;">
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">The Mandalorian</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">The Walking Dead</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">Naruto</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">Game of Thrones</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">Breaking Bad</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">The Wire</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">Tulsa King</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">Better Call Saul</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">Halo</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)"">
            </div>
            <div class="mandalorian">
                <a href=""><span style="transform: translateX(-140px); text-align:left">Mr Robot</span></a>
                <span><svg style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                           fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16"> <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"
                                fill="#f3da35"></path>
                    </svg> &nbsp; 0.0
                    </span>
                <hr style="width: 600px; transform:translateX(-140px)">
            </div>
        </div>
        <div class="popular-end">
            <a href="./tvshow.html">VIEW MORE</a>
        </div>

    </div>
    <h1 class="hottest">MOVIECHEIF'S TOP GAME PICKS</h1>
    <div class="game-gallery">
        <div onclick="window.location.href='game_details.php?game_id=4200'" class="game-item" style="background-image: url('../assets/portal.jpg');"></div>
        <p class="game-description">Portal 2 is a 2011 puzzle-platform video game developed by Valve for Windows, Mac OS X, Linux, PlayStation 3, and Xbox 360. The digital PC version is distributed online by Valve's Steam service, while all retail editions were distributed by Electronic Arts.</p>
        <div onclick="window.location.href='game_details.php?game_id=326243'" class="game-item" style="background-image: url('../assets/elden.jpg');"></div>
        <p class="game-description">Elden Ring is a 2022 action role-playing game developed by FromSoftware. It was directed by Hidetaka Miyazaki with worldbuilding provided by fantasy writer George R. R. Martin.</p>
        <div onclick="window.location.href='game_details.php?game_id=3498'" class="game-item" style="background-image: url('../assets/gta5.jpg');"></div>
        <p class="game-description">Grand Theft Auto V is a 2013 action-adventure game developed by Rockstar North and published by Rockstar Games. It is the seventh main entry in the Grand Theft Auto series, following 2008's Grand Theft Auto IV, and the fifteenth instalment overall. </p>
        <div onclick="window.location.href='game_details.php?game_id=28'" class="game-item" style="background-image: url('../assets/rdr2.jpg');"></div>
        <p class="game-description">Red Dead Redemption 2 is a 2018 action-adventure game developed and published by Rockstar Games. The game is the third entry in the Red Dead series and a prequel to the 2010 game Red Dead Redemption. </p>
        <div onclick="window.location.href='game_details.php?game_id=58175'" class="game-item" style="background-image: url('../assets/gow4.jpg');"></div>
        <p class="game-description">God of War is an action-adventure game developed by Santa Monica Studio and published by Sony Interactive Entertainment. It was released for the PlayStation 4 in April 2018, with a Windows port in January 2022.</p>
    </div>
</main>
<footer>
    <div class="foot">
        <div class="about-us">
            <div class="about-us-top">
                <h2>About Us</h2>
            </div>
            <div class="foot-links">
                <a href="./privacy.html">Privacy Policy</a>
                <a href="./contact.html">Contact Us</a>
                <a href="./terms.html">Terms of Service</a>
            </div>
            <div class="foot-copy">
                <p>&copy; 2023 MovieChief. All rights reserved.</p>
            </div>
        </div>
        <div class="complaint">
            <p>Any Complaints? Let us know!</p>
            <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">
                <form method="post">
                    <textarea name="mess" cols="10" rows="2" id="complaint-input"></textarea>
                </form>

                <button class="complain-button" id="complaint-button" >
                    Send
                </button>
            </div>

        </div>


    </div>
</footer>
<script>

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

    document.getElementById('complaint-button').addEventListener('click', (event) => {

        event.preventDefault();
        let message = ""+document.getElementById("complaint-input").value;
        if (message === ""){
            alert("You need to add at least one character");
        }
        else{
            let form = document.querySelector('form');
            form.submit();
            let res =  <?php echo sendComplaint();?>;
            if (res === 'success'){
                alert("We have received your complaint, we will work tirelessly to address your complaints as we value your opinion");
            }
            else if(res === 'Cant'){
                alert("You need to login to give complaints");
            }
            else{
                alert("something went wrong");
            }
        }




    });

</script>
</body>
</html>
