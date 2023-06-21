<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/review.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

        h1 {
            font-size: 2.5em;
            margin-bottom: 1.5em;
            color: white;
            text-align: center;
        }


        </style>
</head>
<body>
<?php
require_once "../services/models/movie.php";
require_once "../services/models/User.php";
require_once "../services/database.php";

session_start();
$user = isset($_SESSION['user']) ? json_decode($_SESSION['user']) : null;

$user_json = json_encode($user);
$db = new Database();
$movie = new movie($_GET['movie']);
$userr= new User();
$userr->getUser($_GET['user_id']);


?>
<div id="background-container">
<h1>Reviews for <?php echo $movie->title;?></h1>
<div class="big-container" >

    <?php
    $ans = $db->getReviewsByMovieId($movie->id);



    foreach ($ans as $row ){
        $user = $db->getUserById($row['user_id']);
        $path = "../services/server/". $user['profile_path'];
        echo "
        
         <div class='review'>
            <div class='user-image'>
                <img src=".$path ." alt='User Profile'>
                 <p style='font-size: 20px; display: inline-block;'> ".  $user['username']."</p>
            </div>
           
            <p class='review-text' id='review-text'>" .$row['review_text']."</p>

            <div class='icons'>
                <i class='far fa-thumbs-up like'></i>
                <i class='far fa-thumbs-down dislike'></i>
            </div>
        </div>
        
        
        ";


    }



    ?>



    <div class="page-navigation">
        <a onclick="goBack()"><div class="page-prev">&#10094;</div></a>
        <div class="dots">
            <span class="dot"></span>
            <span class="dot active"></span>


        </div>
    </div>
    <div class="add-review">
        <i class="fas fa-plus"></i>
    </div>

    <div class="add-review-text">
        <form method ="post"  action= "">
        <textarea name = "review" placeholder="Write your review here" ></textarea>
        <button class="click">Submit</button>
        </form>
    </div>

</div>
</div>

<script>
    var imagePaths = <?php echo json_encode($movie->detail->imagePath); ?>;
    var imageIndex = 0;

    function changeBackgroundImage() {
        var imageUrl = "https://image.tmdb.org/t/p/original" + imagePaths[imageIndex];
        var backgroundContainer = document.getElementById('background-container');

        // Preload the new image
        var tempImage = new Image();
        tempImage.src = imageUrl;
        tempImage.onload = function () {
            backgroundContainer.style.backgroundImage = "url('" + imageUrl + "')";
            backgroundContainer.style.backgroundSize = "cover";
            backgroundContainer.style.backgroundPosition = "no-center";

        };

    }

    // Change the background image initially
    changeBackgroundImage();


    function goBack() {
        window.history.back();
    }

</script>
<script>

    const likeButtons = document.querySelectorAll('.like');
    const dislikeButtons = document.querySelectorAll('.dislike');


    likeButtons.forEach((likeButton) => {
        likeButton.addEventListener('click', () => {
            likeButton.classList.toggle('fas');
            likeButton.classList.toggle('selected');
            likeButton.nextElementSibling.classList.remove('selected');
            likeButton.nextElementSibling.classList.remove('fas');
        });
    });

    dislikeButtons.forEach((dislikeButton) => {
        dislikeButton.addEventListener('click', () => {
            dislikeButton.classList.toggle('fas');
            dislikeButton.classList.toggle('selected');
            dislikeButton.previousElementSibling.classList.remove('selected');
            dislikeButton.previousElementSibling.classList.remove('fas');
        });
    });

    const addReviewText = document.querySelector('.add-review-text');
    const reviewContainer = document.querySelector('.review-container');
    const addReviewButton = document.querySelector('.add-review');


    addReviewButton.addEventListener('click', () => {
        console.log("being clice");
        addReviewText.style.display = 'block';
    });


    const submitButton = addReviewText.querySelector('.click');
    submitButton.addEventListener('click', (event) => {
        event.preventDefault();
        var form = document.querySelector('form');
        let userr = <?php echo $user->id;?>;
        form.submit()
        let reviewText = addReviewText.querySelector('textarea').value;
        console.log(resss);
        if(userr !== null){
            if (reviewText.trim() !== '') {
            <?php
                if(isset($_POST['review'])){
                  //  echo "<h1>". $_POST['review']."</h1>";
                    $db->addReview($movie->id,$user->id,$_POST['review']);
                }
                else{

                }


            ?>;
            const newReview = document.createElement('div');
            newReview.classList.add('review');
            const newReviewText = document.createElement('p');
            newReviewText.classList.add('review-text');
            newReviewText.textContent = reviewText;
            const newIcons = document.createElement('div');
            newIcons.classList.add('icons');
            const newLike = document.createElement('i');
            newLike.classList.add('far', 'fa-thumbs-up', 'like');
            const newDislike = document.createElement('i');
            newDislike.classList.add('far', 'fa-thumbs-down', 'dislike');
            newIcons.appendChild(newLike);
            newIcons.appendChild(newDislike);
            newReview.appendChild(newReviewText);
            newReview.appendChild(newIcons);


            document.querySelector('.big-container').appendChild(newReview);


            addReviewText.style.display = 'none';

                form.reset();
                addReviewText.querySelector('textarea').value = '';
        }
        }
        else{
            alert("you need to login to leave reviews");
    }

    });


</script>
</body>

</html>