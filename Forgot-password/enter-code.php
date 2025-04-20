<?php

session_start();

require '../includes/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $resetCode = rand(100000, 999999);

        $update = $pdo->prepare('UPDATE users SET resetCode = ? WHERE email = ?');
        $update->execute([$resetCode, $email]);

        $_SESSION['email'] = $email;
        
        $email = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMAuth = true;
            $mail->Username = 'jameslesterlopez@gmail.com';
            $mail->Password = 'myPassword123';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->setFrom('jameslesterlopez@gmail.com', 'James Lester Lopez');
            $mail->addAddress($email, 'This is your client');
            
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Code';

            $mail->Body = '<p>This is your password reset code: {$reset-code}</p>';
            $mail->send();

            $_SESSION['email-sent'] = true;
            $_SESSION['success'] = 'A verification code has been sent to your email';
            header('Location: enter-code.php');
            exit();        
        }
        catch (Exception$e) {
            $_SESSION['error'] = 'Message could not be sent';
            header('Location: forgot-password.php');
            exit();
        }
    }
    else{
        $_SESSION['error'] = 'No user found with that email';
        header('Location: forgot-password.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="forgot-code-style.css">
</head>
<body class="d-flex align-items-center justify-content-center">
    <form action="" method="POST" class="d-flex flex-column justify-content-center align-items-center">
        <figure class="d-flex flex-column align-items-center">
            <img src="../images/logo.png" alt="logo">
            <figcaption>Code Configuration</figcaption>
        </figure>
        <?php
            if(isset($_SESSION['success'])){
                echo '<div class="alert alert-success text-center">' . $_SESSION['success'] . '</div>';
            }

            if(isset($_SESSION['error'])){
                echo '<div class="alert alert-danger text-center">' . $_SESSION['error'] . '</div>';
            }
        ?>
        <div class="input-button d-flex flex-column">
            <input type="email" class="code-input form-control mt-3 mb-3" placeholder="@email.com" aria-label="Code input" aria-describedby="basic-addon1">
            <button class="btn btn-primary">Verify Code</button>
        </div>
    </form>
</body>
</html>