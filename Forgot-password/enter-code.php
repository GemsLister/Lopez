<?php

session_start();

require '../includes/db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $enteredCode = $_POST['code']; //from the form in HTML pass it in a new variable

    $email = $_SESSION['email']; //email from the forgot password page in a session

    if(!isset($_SESSION['email'])){
        $_SESSION['error'] = 'No email session found; Please try again'; //if the user access the code entered without email
        header('Location: forgot-password'); //redirect to the forgot-password
        exit();
    }
    
    // fetching code from the database
    $stmt = $pdo->prepare("SELECT resetCode FROM users WHERE email = ?");
    $stmt->execute([$email]); //call the user with the same email with a code
    $user = $stmt->fetch(PDO::FETCH_ASSOC); //store the result on a variable

    if($user){
        // checking if the code matches with the resetCode in database
        if($enteredCode === $user['resetCode']){
            // store the session in a new variables to be passed on reset pages
            $_SESSION['reset-email'] = $email;
            $_SESSION['reset-code-verified'] = true; // indication that the code is verified
            header('Location: reset-password.php');
            exit();
        }
        else{
            $_SESSION['error'] = 'Invalid code';
        }
    }
    else{
        $_SESSION['error'] = 'No email session found; Please try again';
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
    <form action="enter-code.php" method="POST" class="d-flex flex-column justify-content-center align-items-center">
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
            <input type="number" name="code" class="code-input form-control mt-3 mb-3" placeholder="Enter code..." aria-label="Code input" aria-describedby="basic-addon1">
            <button class="btn btn-primary">Verify Code</button>
        </div>
    </form>
</body>
</html>