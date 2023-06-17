<?php

      $game_id = $_GET['game_id'];
      $url = 'https://api.rawg.io/api/games/' . $game_id . '?key=c8750653a2754ea49bb6b6ff57ff592a';
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($curl);
      if (curl_error($curl)) {
          $error_msg = curl_error($curl);
      }
      curl_close($curl);
      $game = json_decode($response, true);


      $name=$game['name'];
      $description=$game['description_raw'];
      $background_image=$game['background_image'];
      $release_date = $game['released'];  
      $rating=$game['rating'];
      $genres=$game['genres'];
      $type="Genres:   ";
      foreach($genres as $genres){
           $type .= $genres['name']." . ";
        }
      $platforms=$game['platforms'];
      $plat="Platforms:   ";
      foreach($platforms as $platforms){
        $plat .=$platforms['platform']['name']." / ";
      }
      $stores=$game['stores'];
      $str="Stores:   ";
      foreach($stores as $stores){
        $str .=$stores['store']['name']." , ";
      }
      $developers=$game['developers'];
      $dev="Developers:   ";
      foreach( $developers as  $developers){
        $dev .= $developers['name']." . ";
      }
      $tags=$game['tags'];
      $tag="Tags:   ";
      foreach( $tags as  $tags){
        $tag .= $tags['name']." , ";
      }
      
   
      



    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-2o2ZQf6/6O9zjCwOo0X1nLyZGkRuGQYH+K1bJ6IrzrVbQRiPbX0Nzbp+UoT3Hp2jWU5Q3+0v+4oYNNwJGJMEWw==" crossorigin="anonymous" referrerpolicy="no-referrer"
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/game_details.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Game details</title>
    <style>
        .container {
            
            height: 100vh;
            width: 100%;
            
            
        }

        .container::before {    
            content: "";
            background-image: url(<?php echo $background_image; ?>); 
            background-repeat: no-repeat; 
            background-position: center; 
            background-size: cover;
            
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            opacity: 0.3;
        }
          
    </style>
</head>
<body class="body">
    <?php
       echo '<div class="container">';
       echo '<div class="content">';
       echo '<div class="up">';

       echo '<h1>' .$name. '</h1>';
       echo '<p>'.$type.'</p>';
       echo '<p>'.$plat.'</p>';
       echo '<p>Release_date  '.$release_date.'</p>';
       echo '<p>Rating  '.$rating.'</p>';
       echo '<p>'.$str.'</p>';
       echo '<p>'.$dev.'</p>';
       echo '<p class="tags">'.$tag.'</p>';
       echo '</div>';
       echo '<div class="down">';
       echo '<p class="rate">Rate this game:</p>';
       echo '<div id="rating">
            
             <span class="star" data-value="1">&#9733;</span>
             <span class="star" data-value="2">&#9733;</span>
             <span class="star" data-value="3">&#9733;</span>
             <span class="star" data-value="4">&#9733;</span>
             <span class="star" data-value="5">&#9733;</span>
             </div>';
       echo '<div class="clip">';
       echo '<h3>About</h3>';
       echo '<p id="clip">' .$description. '</p>';
       echo '<button class="read-more" id="read">Read more</button>';
       echo '</div>';

       
       
       
    
       echo '</div>';
       echo '</div>';





    ?>


<script src="../js/game_details.js"></script>
</body>
</html>