<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles/intro.css">
	<meta charset="UTF-8">
	<title>Movie Chief</title>

</head>
<body>
<?php
require_once "services/database.php";
session_start();
$db = new Database();
$user = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : null;
$user_json = json_encode($user);
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
<nav>
	<a href=""><img src="assets/intro-logo.png"></a>
	<div id="nav-links">
		<a href="pages/home.php">Home</a>
		<a href="pages/movies.php">Movies</a>
		<a href="pages/tvshow.html">TV Shows</a> 
		<a href="pages/games.php">Games</a>
		<a href="pages/about.html">About us</a>
        <a href="pages/news.html">News</a>
	</div>
	<div id="signup" >
		<a href="pages/login.html"> Signup / Login</a>
	</div>

    <a href="pages/account_info.php">
    <div id = 'profile' style="
    width:60px;
    height: 60px;
    margin-right: 210px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    background-image: url(
    <?php
    echo "services/server/$user->path"
    ?>
    );
"> </div>

    </a>





</nav>
<main>
	<div class="word">
		<div class="letter">M</div>
		<div class="letter">O</div>
		<div class="letter">V</div>
		<div class="letter">I</div>
		<div class="letter">E</div>
		<div class="letter">C</div>
		<div class="letter">H</div>
		<div class="letter">I</div>
		<div class="letter">E</div>
		<div class="letter">F</div>
	</div>
	<form class="search-div" id ="searchForm">
		<input type="text" placeholder="Search anything.." id="searchInput" class="search">
		<a href=""><img src="assets/intro-icon.png" class="search-icon" width="40px" height="40px"></a>
	</form>
	<div id="results"></div>
	<p class="share-us">Share Us On</p>
	<div class="shares">
		<button class="twitter" onclick="window.location.href='https://www.twitter.com/1stDownstreamer'">
			Twitter
			<span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                      <path fill="#fff"
							d="M16 3.539a6.839 6.839 0 0 1-1.89.518 3.262 3.262 0 0 0 1.443-1.813 6.555 6.555 0 0 1-2.08.794 3.28 3.28 0 0 0-5.674 2.243c0 .26.022.51.076.748a9.284 9.284 0 0 1-6.761-3.431 3.285 3.285 0 0 0 1.008 4.384A3.24 3.24 0 0 1 .64 6.578v.036a3.295 3.295 0 0 0 2.628 3.223 3.274 3.274 0 0 1-.86.108 2.9 2.9 0 0 1-.621-.056 3.311 3.311 0 0 0 3.065 2.285 6.59 6.59 0 0 1-4.067 1.399c-.269 0-.527-.012-.785-.045A9.234 9.234 0 0 0 5.032 15c6.036 0 9.336-5 9.336-9.334 0-.145-.005-.285-.012-.424A6.544 6.544 0 0 0 16 3.539z"></path>
                    </svg>
                </span>
		</button>
		<button class="facebook" onclick="window.location.href='https://www.facebook.com/birehanu'">
			Facebook
			<span>
                    <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
						 fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"> <path
							d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"
							fill="white"></path>
                    </svg>
                </span>
		</button>
		<button class="telegram" onclick="window.location.href='https://www.t.me/bob452'">
			Telegram
			<span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
						 class="bi bi-telegram" viewBox="0 0 16 16"> <path
							d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.287 5.906c-.778.324-2.334.994-4.666 2.01-.378.15-.577.298-.595.442-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294.26.006.549-.1.868-.32 2.179-1.471 3.304-2.214 3.374-2.23.05-.012.12-.026.166.016.047.041.042.12.037.141-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8.154 8.154 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629.093.06.183.125.27.187.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.426 1.426 0 0 0-.013-.315.337.337 0 0 0-.114-.217.526.526 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09z"/>
                     </svg>
                </span>
		</button>
		<button class="whatsapp" onclick="window.location.href='https://www.whatsapp.com'">
			Whatsapp
			<span>
                    <svg style="color: white" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
						 fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16"> <path
							d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"
							fill="white"></path>
                     </svg>
                </span>
		</button>
	</div>
	<div class="browse">
		<a href="pages/home.php">
			<button class="browse-button">
				Browse More
			</button>
		</a>
	</div>
	<div class="desc">
		<p>Our site is a comprehensive review and rating platform that helps users make informed decisions about
			products and services. </p>
		<ul>
			<li>Detailed reviews from real users that provide valuable insights into the pros and cons of a product or
				service.
			</li>
			<li>A user-friendly interface that makes it easy to browse and search for reviews on a wide range of
				products and services.
			</li>
			<li>Regular updates and new content that keep our site freshshars and relevant.</li>
			<li>A community of like-minded users who are passionate about sharing their experiences and helping others
				make informed decisions.
			</li>
		</ul>
	</div>
</main>
<footer>

	<div class="complaint">
		<span>Any complaints? Let us know!</span>
        <form method="post" >
		<input type="text" name="mess" class="complain" id = "complaint-input">
		<button class="complain-button" id="complaint-button" >
                        Send
		</button>
        </form>
	</div>
	<p class="end">&copy 2023 MovieChief. All rights reserved.</p>
</footer>

<script>

 document.getElementById('complaint-button').addEventListener('click', (event) => {

   //  event.preventDefault();
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
document.getElementById('searchInput').addEventListener('input', function(e) {
    handleSearch(e.target.value);
});
const maxResultsPerCategory = 3;

function handleSearch(query) {
    if (query.length > 0) {
        clearResults();
        searchMovies(query);
        searchTVShows(query);
        searchGames(query);
    } else {
        clearResults();
    }
}

function clearResults() {
    const resultsContainer = document.getElementById('results');
    resultsContainer.innerHTML = '';
}

function searchMovies(query) {
    fetch(`https://api.themoviedb.org/3/search/movie?api_key=04a11c37bed080ebfdae72a810bd376e&query=${query}`)
        .then(response => response.json())
        .then(data => {
            const results = data.results.slice(0, maxResultsPerCategory);
			results.forEach(result => {
                result.category = 'Movies';
            });
            addResultsToPage('Movies', results);
        });
}

function searchTVShows(query) {
    fetch(`https://api.themoviedb.org/3/search/tv?api_key=04a11c37bed080ebfdae72a810bd376e&query=${query}`)
        .then(response => response.json())
        .then(data => {
            const results = data.results.slice(0, maxResultsPerCategory);
			results.forEach(result => {
                result.category = 'Tv Show';
            });
            addResultsToPage('TV Shows', results);
        });
}

function searchGames(query) {
    fetch(`https://api.rawg.io/api/games?key=c8750653a2754ea49bb6b6ff57ff592a&search=${query}`)
        .then(response => response.json())
        .then(data => {
            const results = data.results.slice(0, maxResultsPerCategory);
            results.forEach(result => {
                result.category = 'Games';
            });
            addResultsToPage('Games', results);
        });
}


function addResultsToPage(category, results) {
    const resultsContainer = document.getElementById('results');
    const categoryContainer = document.createElement('div');
    categoryContainer.className = 'category-container';
    categoryContainer.innerHTML = `<a id="title-a"><h2 style="color:white; font-size: 38px">${category}</h2></a>`;
    
    if (results.length === 0) {
        categoryContainer.innerHTML += '<p style="color:white">No results found.</p>';
    } else {
        results.forEach(result => {
			let link;
        if (result.category === 'Movies') {
            link = `./pages/review1.php?movie=${result.name || result.title}`;
        } else if (result.category === 'Games') {
            link = `./pages/game_details.php?game_id=${result.id}`; 
        }
        categoryContainer.innerHTML += `<a class="result-link" href="${link}"><p class="result-text" style="color:white; font-size: 17px">${result.name || result.title}</p></a>`;
    });
        };
    
    resultsContainer.appendChild(categoryContainer);

    categoryContainer.style.display = 'inline-block';
    categoryContainer.style.verticalAlign = 'top';
    categoryContainer.style.marginRight = '50px';
	categoryContainer.style.cursor = "default";

	document.querySelectorAll('.result-text').forEach(text => {
  text.addEventListener('mouseover', () => {
    text.style.color = 'red';
  });
  
  text.addEventListener('mouseout', () => {
    text.style.color = 'white';
  });
});


}
  
  
</script>
<script>

        let user = <?php echo $user_json; ?>;

        if (user) {
            document.getElementById("signup").style.display = "none";
            document.getElementById("profile").style.display = "block";
        }
        else {
            document.getElementById("profile").remove();
        }



</script>
</body>
</html>
