<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
    <link rel="stylesheet" href="../styles/review1.css">
    

    <title>Review page</title>
</head>
<body>


<?php
  $movieName = $_GET['movie'];
  include 'movie_details.php';
    ?>
  <div id="background-container"></div>
    

   

        <div class="bookmark-movie" id="bookmark-movie">
            <div class="watchlist-btn" id="watchlistBtn">
                <i class="icon fa fa-bookmark"></i>
                  <i class="check fa fa-plus"></i>
            </div>
        </div>
        
        <div class="message-box" id="messageBox"></div>
         
    
    <div class="movie-info">
        <div class="left-section">
            <h1><span class="underline"><?php echo $title; ?></span></h1>
            <div class="available">

              <?php
              
              
              
              foreach ($providers as $country => $streamingProviders) {
                  
                  $uniqueProviders = array_unique($streamingProviders);
                  $limitedProviders = array_slice($uniqueProviders, 0, 3);
              
                  
                  $limitedProviders = array_filter($limitedProviders);
              
                  $providerString ='<b>Available on: </b>'. implode('<span class="parallelogram"></span> ', $limitedProviders);
                  echo "<p>{$providerString}</p>";
              }
              ?>

            </div>
            <div>
            <?php
$initialCount = 3;


$initialActors = array_slice($actors, 0, $initialCount);
$remainingActors = array_slice($actors, $initialCount);
?>



<p><b>Cast: </b><?php echo implode('<span class="parallelogram"></span>', $initialActors); ?> <button id="showcastbtn" class="showcastbtn" onclick="togglePopup()">...see more</button></p>




<div id="castPopup" class="popup" style="display: none;">
<?php 
if (!empty($directors)) {
  echo '<b>Directed by: </b>';
  echo implode('&nbsp;&nbsp;<span class="parallelogram"></span>&nbsp;&nbsp;', $directors);
  
  }
 ?>

<?php 
if (!empty($writers)) {
  echo '<br><b>Written by: </b>';
  echo implode('&nbsp;&nbsp;<span class="parallelogram"></span>&nbsp;&nbsp;', $writers);
  
  }
 ?>

  <h3>Full Cast:</h3>
  <p><?php echo implode('<span class="rectangle">    </span>', $actors); ?></p>
</div>

            </div>
            <div>
             <p>Release Date:  <?php echo $releaseDate; ?> </p>
            </div>
            <h2><p id="rating-paragraph" style="font-size: 1.2rem;"> Rating: 4.5/5</p></h2>
            <div class="tags">
              <?php
$genreString ='<b>Genre:  </b>'. implode('<span class="parallelogram"></span> ', $genreNames);
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
  <p id="textContainer"><?php echo $overview; ?></p>
  <button id="seeMoreButton">See More</button>
</div>

             
        </div>
    
        <div class="right-section">
        <div class="similars">
            <?php 
            
          echo '<h2><span class="underline">Similar Movies<span></h2>';
          echo '<ul>';
          $count = 0;
          foreach ($similarMovies as $similarMovie) {
              $posterPath = $similarMovie['poster_path'];
              $title = $similarMovie['title'];
              if ($count >= 3) {
                  break;
              }
              
              echo '<a href="review1.php?movie=' . $title . '">';
              echo '<div> <img src="https://image.tmdb.org/t/p/original/' . $posterPath . '" alt="' . $title . '"></div>';
              
              echo '</a>';
             
              $count++;
          }
          ;
            
            ?>
            </div>
         
        <div class="trailer">
              
                <div class="watch-trailer-btn" id="playButton">
                    <i class="fas fa-play"></i>
                    
                 </div><br>
                  <div><em>Watch&nbsp;Trailer</em>
                 
                  
         
               
                
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
        <a href="review2.html"><div class="page-next">&#10095;</div></a>
    </div>
    <script>
               const favoriteBtn = document.getElementById('favoriteBtn');
const watchlistBtn = document.getElementById('watchlistBtn');
const messageBox = document.getElementById('messageBox');
let favclick=false;
let watchclick=false;
function handleLikeClick(button) {
            button.classList.toggle("clicked");
            
        }
        function handleDislikeClick(button) {
            button.classList.toggle("clicked");
        }
favoriteBtn.addEventListener('click', () => {
     if(favclick==false){
    showMessage('added to favorites');
    favclick=true;
     }
     else{
        showMessage('Removed from favorites');
        favclick=false;

     }
});

watchlistBtn.addEventListener('click', () => {
    const check = document.querySelector('.check');
    if(watchclick==false){
        check.classList.remove('fa-plus');
    check.classList.add('fa-check');
        showMessage('aded to watchlist');
    watchclick=true;
     }
     else{
        

    check.classList.remove('fa-check');
        check.classList.add('fa-plus');
        showMessage('Removed from watchlist');
       watchclick=false;

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

let totalrate=4.5;
let oldrate=0;
let num=1;
let numcheck=1;
let orginalrate=4.5;
let update=false;
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
        if(rating==0){ 
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
    if(num>numcheck){
        numcheck=num;
    }
   
    
    if(update==false){
    totalrate= (totalrate-oldrate+rating)/num;
    oldrate=rating;
    update=true;
    }
    else{
        if(numcheck==num){
       totalrate= ((totalrate*num)-oldrate+rating)/num;
       oldrate=rating;
    
       
       
    }
    else{
        oldrate=0;
        update=false;
        totalrate=orginalrate;
       
    }
    }
    numcheck=num;
    
    
    
    
    var ratingparagraph = document.getElementById("rating-paragraph");
    ratingparagraph.textContent = "Rating: " + totalrate + "/5";
   
  });

});

        




  






          </script>


<script>
    var imagePaths = <?php echo json_encode($imagePaths); ?>;
    var imageIndex = 0;
    var imageCount = imagePaths.length;

    function changeBackgroundImage() {
        var imageUrl = "https://image.tmdb.org/t/p/original" + imagePaths[imageIndex];
        var backgroundContainer = document.getElementById('background-container');

        var tempImage = new Image();
        tempImage.src = imageUrl;
        tempImage.onload = function() {

            var clonedContainer = backgroundContainer.cloneNode(true);
            clonedContainer.style.backgroundImage = "url('" + imageUrl + "')";

            clonedContainer.style.opacity = 0;
            clonedContainer.style.filter = "brightness(30%)";
            clonedContainer.style.transition = "opacity 2s ease, filter 2s ease";

            document.body.appendChild(clonedContainer);

            clonedContainer.offsetHeight;

            backgroundContainer.style.opacity = 0.1;
            backgroundContainer.style.transition = "opacity 2s ease";

            setTimeout(function() {
                clonedContainer.style.opacity = 0.9;
                clonedContainer.style.filter = "brightness(60%)";
            }, 10);

            setTimeout(function() {
                document.body.removeChild(backgroundContainer);
            }, 4000);
        };

        imageIndex = (imageIndex + 1) % imageCount;
    }

    changeBackgroundImage();

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

  window.onclick = function(event) {
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
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/player_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    var trailerKey = '<?php echo $trailerKey; ?>';

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

    function onPlayerReady(event) {
    }
    
document.querySelector('.close-btn').addEventListener('click', function() {
    player.pauseVideo();

    document.querySelector('.video-player').style.display = 'none';
});



document.addEventListener('DOMContentLoaded', function() {
  var descMovieDiv = document.querySelector('#desc-movie');
  var textContainer = document.querySelector('#textContainer');
  var seeMoreButton = document.querySelector('#seeMoreButton');
  var popup = null;

  seeMoreButton.addEventListener('click', function() {
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

  var clone = textContainer.cloneNode(true);
  clone.style.cssText = 'position: absolute; visibility: hidden; height: auto; width: ' + textContainer.clientWidth + 'px;';
  document.body.appendChild(clone);
  if (clone.scrollHeight > textContainer.clientHeight) {
    seeMoreButton.style.display = 'block';
  }
  document.body.removeChild(clone);

  window.addEventListener('click', function(event) {
    if (popup && !popup.contains(event.target) && event.target !== seeMoreButton) {
      document.body.removeChild(popup);
      popup = null;
    }
  });
});









</script>

    
</body>
</html>
