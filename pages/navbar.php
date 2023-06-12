<?php
$user = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : null;
$user_json = json_encode($user);
echo "<nav>
	
	<div id='signup' >
		<a href='../pages/login.html'> Signup / Login</a>
	</div>
	  <a href='../pages/account_info.php'>
    <div id = 'profile' style='
    width:60px;
    height: 60px;
    margin-right: 50px;
    border-radius: 50%;
    background-size: cover;
    background-image: url(".

    '../services/server/'.$user->path .");


'> </div></a>
	<div id='nav-links'>
		<a href='../pages/home.php'>Home</a>
		<a href='../pages/movies.php'>Movies</a>
		<a href='../pages/tvshow.html'>TV Shows</a>
		<a href='../pages/games.php'>Games</a>
		<a href='../pages/about.html'>About us</a>
	</div>
	

   
    <a href='../index.php'> <img src='../assets/intro-logo.png'></a>

  





</nav>
";
?>
























