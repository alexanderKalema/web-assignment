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
        <p><strong>Email:</strong> <?php echo "<br>" . "<pre>" . $user->email . "</pre>" ?> </p>
        <p><strong>Username:</strong> <?php echo "<br>" . "<pre>" . $user->username . "</pre>" ?> </p>
        <p><strong>Date of birth:</strong> <?php echo "<br>" . "<pre>" . $user->dob . "</pre>" ?> </p>
        <p><strong>Gender:</strong> <?php echo "<br>" . "<pre>" . $user->gender . "</pre>" ?> </p>
    </div>

    <button id="logout">Log out</button>


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
