<?php
session_start();

require_once 'models/User.php';
require_once 'Database.php';

function randomString($n): string
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}

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

        $image = $_FILES['image'] ?? null;
        $imagePath = 'images/default.png';

        if (!is_dir(__DIR__.'/server/images')) {
            mkdir(__DIR__.'/server/images'); }

        if ($image && $image['tmp_name']) {

            $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
            mkdir(dirname(__DIR__.'/server/'.$imagePath));
            move_uploaded_file($image['tmp_name'], __DIR__.'/server/'.$imagePath);
        }




        $data = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'username' => $_POST['username'],
            'dob' => $_POST['dob'],
            'gender' => $_POST['gender'],
            'bio' => $_POST['bio'],
            'profile_path' => $imagePath
        ];

        $user = new User();
        $user->load($data);

        $database = new Database();
        $user = $database->createUser($user);

        $_SESSION['user'] = json_encode($user);
        header('Location: ../index.php');
        exit;
    }
}
