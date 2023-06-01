<?php
session_start();

require_once 'models/User.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $database = new Database();
        $user = $database->getUserByEmailAndPassword($email, $password);

        if ($user) {
            $_SESSION['user'] = json_encode($user);
            header('Location: ../index.php');
            exit();
        } else {
            echo "<script>alert('You are not a registered user. Please register first.'); window.location.href='../pages/register.html';</script>";
        }
    } elseif ($action == 'register') {
        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'username' => $_POST['username'],
            'dob' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'watchList' => []
        ];

        $user = new User();
        $user->load($data);

        $database = new Database();
        $database->createUser($user);

        $_SESSION['user'] = json_encode($user);
        header('Location: ../index.php');
        exit;
    }
}
