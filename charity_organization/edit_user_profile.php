<?php
include(__DIR__ . "/common/header.php");
if (!isset($_SESSION["email"])) {
    header("location:login.php");
}
$email = $_SESSION["email"];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$id = $_GET["id"];
?>



<?php
$name_error = $phone_error = $address_error = $nid_error = $job_details_error = $monthly_income_error = "";
$name = $row["name"];
$phone = $row["phone"];
$address = $row["address"];
$nid = $row["nid"];
$job_details = $row["job_details"];
$monthly_income = $row["monthly_income"];
if (isset($_POST["submit"])) {
    extract($_POST);
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $nid = $_POST["nid"];
    $job_details = $_POST["job_details"];
    $monthly_income = $_POST["monthly_income"];

    if (empty($name)) {
        $name_error = "Name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $name_error = "Only letters and white space allowed";
        } else {
            $name_error = "";
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

    if (empty($address)) {
        $address_error = "Address is required";
    } else {

        $phone_error = "";
    }

    if (empty($nid)) {
        $nid_error = "NID is required";
    } else {

        $nid_error = "";
    }

    if (empty($job_details)) {
        $job_details_error = "NID is required";
    } else {

        $job_details_error = "";
    }

    if (empty($monthly_income)) {
        $monthly_income_error = "Monthly income is required";
    } else {

        $monthly_income_error = "";
    }

    if (empty($name_error) && empty($phone_error) && empty($address_error) && empty($nid_error) && empty($job_details_error) && empty($monthly_income_error)) {
        $sql = "UPDATE users SET name = '$name', phone='$phone', address = '$address', nid='$nid', job_details='$job_details', monthly_income='$monthly_income' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    Toastify({
                    text: 'Updated successfull',
                    className: 'info',
                    style: {
                        background: 'linear-gradient(to right, #00b09b, #96c93d)',
                    }
                    }).showToast();
                </script>";
        }
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="shadow-sm bg-white rounded p-2">
                <div class="d-flex">
                    <div style="width: 30%;">
                        <img src="https://t4.ftcdn.net/jpg/02/14/74/61/360_F_214746128_31JkeaP6rU0NzzzdFC4khGkmqc8noe6h.jpg" class="w-100 rounded">
                    </div>
                    <div class="ps-2">
                        <p class="m-0"><?= $row["name"] ?></p>
                        <p class="m-0"><?= $row["email"] ?></p>
                    </div>
                </div>
                <a style="background-color: rgba(0,0,0,.1);" href="#" class="btn btn-sm w-100 mt-2"><i class="fa-regular fa-pen-to-square"></i> Edit profile</a>
                <br>
                <a style="background-color: rgba(0,0,0,.1);" href="apply_for_loan.php" class="btn btn-sm w-100 mt-2"> Apply for loan</a>
                <a style="background-color: rgba(0,0,0,.1);" href="loan_payment.php" class="btn btn-sm w-100 mt-2"> Payment for loan</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="bg-white p-2 rounded p-2 shadow-sm mt-3">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="name" value="<?= $name ?>">
                        <span class="text-danger"><?= $name_error ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input name="phone" type="number" class="form-control" id="phone" value="<?= $phone ?>">
                        <span class="text-danger"><?= $phone_error ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input name="address" type="text" class="form-control" id="address" value="<?= $address ?>">
                        <span class="text-danger"><?= $address_error ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="nid" class="form-label">Nid</label>
                        <input name="nid" type="number" class="form-control" id="nid" value="<?= $nid ?>">
                        <span class="text-danger"><?= $nid_error ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="job_details" class="form-label">job Details</label>
                        <input name="job_details" type="text" class="form-control" id="job_details" value="<?= $job_details ?>">
                        <span class="text-danger"><?= $job_details_error ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="monthly_incocme" class="form-label">Monthly Income</label>
                        <input name="monthly_income" type="number" class="form-control" id="monthly_income" value="<?= $monthly_income ?>">
                        <span class="text-danger"><?= $monthly_income_error ?></span>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/common/footer.php"); ?>