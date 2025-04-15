
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup-style.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
    <main class="d-flex justify-content-center align-items-center">
        <form action="" class="d-flex flex-column justify-content-center align-items-center">
            <!-- Logo -->
            <figure class="d-flex flex-column align-items-center">
                <img src="../images/logo.png" alt="logo" class="logo">
            </figure>

            <div class="input-containers d-flex flex-column justify-content-center align-items-center">
                <!-- First and Last Name div -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="firstName" placeholder="First Name" aria-label="First Name">
                    <input type="text" class="form-control" name="lastName" placeholder="Last Name" aria-label="Last Name">
                </div>
                
                <!-- Username div -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
                </div>

                <!-- Email div -->
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Email" aria-describedby="basic-addon1">
                </div>

                <!-- Password div -->
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
                </div>

                <!-- Confirm Password div -->
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1">
                </div>                
                <hr>
                <button class="btn btn-primary mt-2 mb-2">Sign up</button>
            </div>
        </form>
    </main>
</body>
</html>