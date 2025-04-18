<?php
session_start();

// Adjust path if needed
require '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Passwords do not match';
        header('Location: signup.php');
        exit();
    }

    $stmt = $pdo->prepare('SELECT * FROM users WHERE userName = ?');
    $stmt->execute([$userName]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = 'Username already exists';
        header('Location: signup.php');
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO users (firstName, lastName, userName, email, password) VALUES (?, ?, ?, ?, ?)');

    if($stmt->execute([$firstName, $lastName, $userName, $email, $hashedPassword])){
        $_SESSION['success'] = 'Account created. You can now login.';
        header('Location: ../Login/login.php');
        exit();
    }
    else{
        echo 'There is an error';
        exit();
    }
}
?>

