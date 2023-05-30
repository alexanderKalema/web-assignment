<?php
session_start();

require_once 'models/User.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database = new Database();
    $user = $database->getUserByEmailAndPassword($email, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: ../index.html');
        exit();
    } else {
        echo "<script>alert('You are not a registered user. Please register first.'); window.location.href='../pages/register.html';</script>";
    }
}
