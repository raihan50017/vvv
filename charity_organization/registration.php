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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body class="container-fluid" style="background-color:#2a9d8f">
    <?php
    $name_error = $email_error = $phone_error = $password_error = $confirm_password_error = "";
    $name = $email = $phone = $password = $confirm_password = "";
    if (isset($_POST["submit"])) {
        extract($_POST);
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if (empty($name)) {
            $name_error = "Name is required";
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $name_error = "Only letters and white space allowed";
            } else {
                $name_error = "";
            }
        }

        if (empty($email)) {
            $email_error = "Email is required";
        } else {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $email_error = "An user already registered with this email";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $email_error = "Invalid email format";
                } else {
                    $email_error = "";
                }
            }
        }

        if (empty($phone)) {
            $phone_error = "Phone is required";
        } else {
            if (strlen((string)$phone) < 11) {
                $phone_error = "Incorrect phone number required BD 11 digit phone number";
            } else {
                $phone_error = "";
            }
        }

        if (empty($password)) {
            $password_error = "Password is required";
        } else {
            $password_error = "";
        }

        if (empty($confirm_password)) {
            $confirm_password_error = "Confirm password is required";
        } else {
            if ($password != $confirm_password) {
                $confirm_password_error = "Confirm password not matched with password";
            } else {
                $confirm_password_error = "";
            }
        }

        if (empty($name_error) && empty($email_error) && empty($phone_error) && empty($password_error) && empty($confirm_password_error)) {
            $password = md5($password);
            $sql = "INSERT INTO users(name,email,phone,password) VALUES('$name','$email','$phone','$password')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    Toastify({
                    text: 'Registration successfull',
                    className: 'info',
                    style: {
                        background: 'linear-gradient(to right, #00b09b, #96c93d)',
                    }
                    }).showToast();
                </script>";
                $name = $email = $phone = $password = $confirm_password = "";
            }
        }
    }
    ?>
    <div class="row mt-5">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="shadow rounded p-3 text-white" style="background-color: #264653;">
                <h4 class="text-center">Register</h4>
                <div class="mt-2">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" value="<?= $name ?>">
                            <span class="text-danger"><?= $name_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="email" value="<?= $email ?>">
                            <span class="text-danger"><?= $email_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input name="phone" type="number" class="form-control" id="phone" value="<?= $phone ?>">
                            <span class="text-danger"><?= $phone_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="passowrd" value="<?= $password ?>">
                            <span class="text-danger"><?= $password_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input name="confirm_password" type="password" class="form-control" id="confirm_password" value="<?= $confirm_password ?>">
                            <span class="text-danger"><?= $confirm_password_error ?></span>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <br>
                        Already registered? <a class="text-white" href="login.php">login now</a>
                    </form>
                </div>
                <a class="text-white" href="index.php">Back to home</a>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <script src="/<?= getenv('APP_NAME') ?>./resources/bootstrap/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toast() {
            Toastify({
                text: "Registration successfull",
                className: "info",
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
            }).showToast();
        }
    </script>
</body>

</html>