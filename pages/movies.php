<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/movies.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Movies</title>
</head>
<body>
<div class="nav-bar">
        <div class="logo">
            <img src="../assets/intro-logo.png" alt="logo"  onclick="window.location.href='../index.php'">
        </div>
        <div class="content">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="movies.php">Movies</a></li>
                <li><a href="tvshow.html">Tv shows</a></li>
                <li><a href="games.php">Games</a></li>
                <li><a href="about.html">About us</a></li>
                <li><a href="news.html">News</a></li>
            </ul>
        </div>
    </div>

<?php

require_once '../services/apis/movies_api.php';
$categories = ['Trending', 'Top Rated', 'Most Popular'];
foreach ($categories as $category) {
    $data = get_movies($category);

    echo '<div class="movies">';
    echo '<div class="area-name">';
    echo '<h1><span class="title">' . ucfirst($category) . '</span></h1>';
    echo '</div>';

    echo '<div class="container">';
    foreach ($data['results'] as $movie) {
        $title = $movie['title'];
        $poster_path = "https://image.tmdb.org/t/p/w500" . $movie['poster_path'];
        $release_date = $movie['release_date'];
        $rating = $movie['vote_average'];

        $genres = $movie['genre_ids'];
        $genre_names = [];
        foreach ($genres as $genre_id) {
            $genre_name = get_genre_name($genre_id);
            if ($genre_name) {
                $genre_names[] = $genre_name;
            }
        }
        $genres_str = implode(', ', $genre_names);

        echo '<div class="movie-card">';
        echo '<a href = "review1.php?movie=' . $title . '"><img src="' . $poster_path . '" alt="movie poster"></a>';
        echo '<div class="movie-info">';
        echo '<h3 class="movie-name">' . $title . '</h3>'; 
        echo '</div>';
        echo '</div>';
    }
    echo "</div>";
    echo "</div>";
}

?>
    
</body>
</html>