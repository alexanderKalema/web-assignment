<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/games.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php

    require_once '../services/apis/game_api.php';
    $categories = ['New Releases','Best of the year','All time top','All games'];
    foreach($categories as $category){
        $data=get_games($category);

        echo '<div class="games">';
        echo '<div class="area-name">';
        echo '<h1><span class="title">' . ucfirst($category) .'</span></h1>';
        echo '</div>';


        echo '<div class="container">';
        foreach($data['results'] as $game){
            $name=$game['name'];
            $background_image=$game['background_image'];
            $release_date = $game['released'];
            $rating=$game['rating'];
            $genres=$game['genres'];
            $type="Genres:  ";
            foreach($genres as $genres){
                $type .= $genres['name'].".";
            }

            echo '<div class="movie-card">';
            echo '<a href=""><img src="'. $background_image. '"alt="game poster"></a>';
            echo '<div class="game-info">';
            echo '<h1>' .$name. '</h1>';
            echo '</div>';
            echo '<div class="movie-ratings">';
            echo '<p>'.$type. '</p>';
            echo '<p>Release Date: ' .  $release_date . '</p>';
            echo '<p>Rating: ' .  $rating . '</p>';
            echo '</div>';
            echo '<div class="div-button">';
            echo '<button class="button">Read More &gt;</button>';
            echo '</div>';
            echo '</div>';
        }
        echo "</div>";
        echo "</div>";

    }
    ?>
    
</body>
</html>