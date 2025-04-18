<?php

session_start();

require '../includes/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    $stmt = $pdo -> prepare('SELECT * FROM users WHERE userName = ?');
    $stmt -> execute([$userName]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        header('Location: ../Dashboard/dashboard.php');
        exit();
    }
    else{
        $_SESSION['error'] = 'Invalid Username and Password';
        header('Location: login.php');
        exit();
    }
}
?>