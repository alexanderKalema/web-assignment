<?php
$user = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : null;
$user_json = json_encode($user);

if(is_null($user)){
    echo "<nav style='box-sizing: border-box; padding: 0px 50px'>
    <div id='signup'>
        <a href='../pages/login.html'>Signup / Login</a>
    </div>
    <div id='nav-links'>
        <a href='../pages/home.php'>Home</a>
        <a href='../pages/movies.php'>Movies</a>
        <a href='../pages/tvshow.html'>TV Shows</a>
        <a href='../pages/games.php'>Games</a>
        <a href='../pages/about.html'>About us</a>
        <a href='../pages/news.html'>News</a>
    </div>
    <a href='../index.php'><img src='../assets/intro-logo.png'></a>
</nav>";

}

else{
    echo "<nav style='box-sizing: border-box; padding: 0px 50px'>
    <a href='../pages/account_info.php'>
        <div id='profile' >
        <img src='../services/server/".$user->path ."' alt='Profile'  style='
    width:60px;
    height: 60px;
    margin-right: 50px;
    border-radius: 50%;
    background-size: cover;
    background-image: url(".

    '../services/server/'.$user->path .");

'>
</div>
    </a>
    <div id='nav-links'>
        <a href='../pages/home.php'>Home</a>
        <a href='../pages/movies.php'>Movies</a>
        <a href='../pages/tvshow.html'>TV Shows</a>
        <a href='../pages/games.php'>Games</a>
        <a href='../pages/about.html'>About us</a>
        <a href='../pages/news.html'>News</a>
    </div>
    <a href='../index.php'><img src='../assets/intro-logo.png'></a>
</nav>";
}

