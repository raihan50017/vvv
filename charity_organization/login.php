<?php
include(__DIR__ . "/common/config.php");
include(__DIR__ . "/common/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity App</title>
    <link rel="stylesheet" href="/<?= getenv('APP_NAME') ?>./resources/bootstrap/bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/<?= getenv('APP_NAME') ?>./resources/fontawesome/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="stylesheet" href="/<?= getenv('APP_NAME') ?>./resources/css/style.css">
</head>

<body class="container-fluid" style="background-color:#2a9d8f">

    <?php
    $login_error = "";
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION["email"] = $user_data["email"];
            $_SESSION["phone"] = $user_data["phone"];
            echo "<script> window.location='user.php'; </script>";
        } else {
            $login_error = "Incorrect email or password";
        }
    }
    ?>

    <div class="row mt-5">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="shadow rounded p-3 text-white" style="background-color: #264653;">
                <h4 class="text-center">Login</h4>
                <div class="mt-2">
                    <h6 class="text-center text-danger"><?= $login_error ?></h6>
                    <form method="post" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="passowrd">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <br>
                        Not registered? <a class="text-white" href="registration.php">register now</a>
                    </form>
                </div>
                <a class="text-white" href="index.php">Back to home</a>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <script src="/<?= getenv('APP_NAME') ?>./resources/bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>