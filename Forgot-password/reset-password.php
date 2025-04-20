<?php
session_start();
    
require '../includes/db.php';

// only redirect the user if the code is verified and email is passed
if(!isset($_SESSION['email']) || !isset($_SESSION['reset-code-verified']) || !$_SESSION['reset-code-verified']){
    header('Location: enter-code.php');
    exit();
}

// resetting the password
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // passed the value of form below into new variables
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    
    // if new password and confirm password are the same
    if($newPassword == $confirmPassword){
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        
        // update new password
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->execute([$hashedPassword, $_SESSION['reset-email']]);

        // unset the variable and clear
        unset($_SESSION['reset-email']);
        unset($_SESSION['reset-code-verified']);

        // redirect to login page
        $_SESSION['success'] = 'Password successfully changed';
        header('Location: ../Login/login.php');
        exit();
    }
    else{
        $_SESSION['error'] = 'Passwords mismatch';
        header('Location: reset-password.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="forgot-code-style.css">
</head>
<body class="d-flex align-items-center justify-content-center">
    <form action="reset-password.php" method="POST" class="d-flex flex-column justify-content-center align-items-center">
        <figure class="d-flex flex-column align-items-center">
            <img src="../images/logo.png" alt="logo">
            <figcaption>Reset Password</figcaption>
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
            <input type="password" name="password" class="code-input form-control mt-2 mb-3" placeholder="Enter New Password" aria-label="Code input" aria-describedby="basic-addon1">
            <input type="password" name="confirm-password" class="code-input form-control mb-3" placeholder="Confirm New Password" aria-label="Code input" aria-describedby="basic-addon1">
            <button class="btn btn-primary">Reset</button>
        </div>
    </form>
</body>
</html>