<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../styles/watchlist.css">
</head>
<body>
<div class="container">
    <h1>My Watchlist</h1>

    <?php
    require_once "../services/database.php";
    require_once "../services/models/movie.php";
    session_start();
    $user = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : null;
    $user_json = json_encode($user);

    $db = new Database();
    if ($user == null){
        echo "no userrr";
    }

    $savedMovies = $db->loadWatchList($user->id);

    foreach ($savedMovies as $index){
        $watchMovie = new movie($index[0]);
        $poster_path = "https://image.tmdb.org/t/p/w500" .  $watchMovie->poster_path;
      echo "  <div class='movie-card'>
        <img class='movie-image' src='$poster_path' alt='Movie Image'>
        <div class='movie-info'>
            <h2 class='movie-title'>".$watchMovie->title."</h2>
            <p>Saved Date:  ".$index[1]. "</p>
            <p>Likes:  200</p>
            <button id='button' onclick='remove( $user->id,$watchMovie->id)'  class='remove-button'>Remove from Watchlist</button>
        </div>
    </div>";

    }
    ?>

</div>
<script>

   function remove(userid, movieid)
   {


   }




</script>
</body>
</html>
