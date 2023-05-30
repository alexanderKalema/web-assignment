<?php

require_once 'models/User.php';
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'username' => $_POST['username'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
        'watchList' => []
    ];

    $user = new User();
    $user->load($data);

    $database = new Database();
    $database->createUser($user);


    header('Location: ../index.html');
    exit;
}