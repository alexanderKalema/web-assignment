<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit();
}

$user = json_decode($_SESSION['user']);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Info</title>
    <link rel="stylesheet" href="../styles/account.css">
</head>
<body>
<div class="container">
    <h1>Account Information</h1>
    <div class="info">
        <?php
    echo "<div style='display: flex; width: 100%; justify-content: center;'>";
    echo "<img src='../services/server/".$user->path ."' alt='Profile'  style='
    width:120px;
    height: 120px;
    border-radius: 50%;
    background-size: cover;

'>";
        echo "</div>";


        ?>
        <p><strong>Email:</strong> <?php echo "<br>" . "<pre>" . $user->email. "</pre>" ?> </p>
        <p><strong>Username:</strong> <?php echo "<br>" . "<pre>" . $user->username . "</pre>" ?> </p>
        <p><strong>Date of birth:</strong> <?php echo "<br>" . "<pre>" . $user->dob . "</pre>" ?> </p>
        <p><strong>Gender:</strong> <?php echo "<br>" . "<pre>" . $user->gender . "</pre>" ?> </p>
        <p><strong>Bio:</strong> <?php echo "<br>" . "<pre>" . $user->bio . "</pre>" ?> </p>

    </div>

    <button id="logout">Log out</button>
    <div>
        <button style="display: inline-block; padding: 10px 20px; background-color: #4CAF50; color: #ffffff; font-family: Arial, sans-serif; font-size: 16px; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; transition: background-color 0.3s ease;" onmouseover="this.style.backgroundColor='#45a049'" onmouseout="this.style.backgroundColor='#4CAF50'"><a href="watchlist.php"> Watch List</a></button>
    </div>


</div>
<script>
    document.getElementById("logout").addEventListener(
        "click", () => {

            fetch('../services/logout.php', {method: 'POST'})
                .then(() => {
                    window.location.href = '../index.php';
                })
                .catch((error) => {
                    console.error('Logout failed: ', error);
                });
        }
    );

</script>

</body>
</html>
