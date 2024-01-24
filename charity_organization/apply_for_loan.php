<?php
include(__DIR__ . "/common/header.php");
if (!isset($_SESSION["email"])) {
    header("location:login.php");
}
$email = $_SESSION["email"];
$phone = $_SESSION["phone"];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$title_error = $description_error =  $amount_error = $nid_error = $bkash_error = "";
$title = $description =  $amount = $bkash = "";
if (isset($_POST["submit"])) {
    extract($_POST);
    $title = $_POST["title"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];
    $bkash = $_POST["bkash"];

    if (empty($title)) {
        $title_error = "Title is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $title)) {
            $title_error = "Only letters and white space allowed";
        } else {
            $title_error = "";
        }
    }

    if (empty($description)) {
        $description_error = "Description is required";
    } else {
        $description_error = "";
        // if (!preg_match("/^[a-zA-Z-' ]*$/", $description)) {
        //     $description_error = "Only letters and white space allowed";
        // } else {
        //     $description_error = "";
        // }
    }

    if (empty($amount)) {
        $amount_error = "Amount is required";
    } else {
        $amount_error = "";
    }

    if ($_FILES["nid"]["size"] == 0) {
        $nid_error = "Nid is required";
    } else {
        $nid_error = "";
    }

    if (empty($bkash)) {
        $bkash_error = "Phone is required";
    } else {
        $bkash_error = "";
    }


    if (empty($title_error) && empty($description_error) && empty($amount_error) && empty($nid_error) && empty($bkash_error)) {
        $sql = "INSERT INTO loans(email,phone,title,amount,description,nid,bkash) VALUES('$email','$phone','$title','$amount','$description','','$bkash')";
        if (mysqli_query($conn, $sql)) {
            $file_name = $_FILES['nid']['name'];
            $file_size = $_FILES['nid']['size'];
            $file_tmp = $_FILES['nid']['tmp_name'];
            $file_type = $_FILES['nid']['type'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $last_id = mysqli_insert_id($conn);
            $new_file_name = mysqli_insert_id($conn) . "." . $file_ext;
            move_uploaded_file($file_tmp, "uploads/loan/" . $new_file_name);
            $sql = "UPDATE loans SET nid = '$new_file_name' WHERE id = '$last_id'";
            mysqli_query($conn, $sql);
            echo "<script>
                    Toastify({
                    text: 'Applie for loan successfully completed',
                    className: 'info',
                    style: {
                        background: 'linear-gradient(to right, #00b09b, #96c93d)',
                    }
                    }).showToast();
                </script>";
            $title = $description =  $amount = $bkash = "";
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
                <a style="background-color: rgba(0,0,0,.1);" href="edit_user_profile.php?id=<?= $row['id'] ?>" class="btn btn-sm w-100 mt-2"><i class="fa-regular fa-pen-to-square"></i> Edit profile</a>
                <br>
                <a style="background-color: rgba(0,0,0,.1);" href="apply_for_loan.php" class="btn btn-sm w-100 mt-2"> Apply for loan</a>
                <a style="background-color: rgba(0,0,0,.1);" href="loan_payment.php" class="btn btn-sm w-100 mt-2"> Payment for loan</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="bg-white shadow-sm p-2 rounded">
                <h4 class="text-center">Apply for loan</h4>
                <div class="mt-2">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Why you want to take loan give an appropiate title?</label>
                            <input name="title" type="text" class="form-control" id="title" value="<?= $title ?>">
                            <span class="text-danger"><?= $title_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Describe why you need a loan?</label>
                            <input name="description" type="text" class="form-control" id="description" value="<?= $description ?>">
                            <span class="text-danger"><?= $description_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Enter amount</label>
                            <input name="amount" type="number" class="form-control" id="amount" value="<?= $amount ?>">
                            <span class="text-danger"><?= $amount_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="nid" class="form-label">Enter your nid card scan copy</label>
                            <input name="nid" type="file" class="form-control" id="nid">
                            <span class="text-danger"><?= $nid_error ?></span>
                        </div>
                        <div class="mb-3">
                            <label for="bkash" class="form-label">Enter a bkash number</label>
                            <input name="bkash" type="number" class="form-control" id="phone" value="<?= $bkash ?>">
                            <span class="text-danger"><?= $bkash_error ?></span>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/common/footer.php"); ?>