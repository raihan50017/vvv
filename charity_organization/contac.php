<?php
include(__DIR__ . "/common/header.php");
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">

    <div class="">
        <div class="card" style="width: 100%;">
            <div class="card-body">
                <h5 class="card-title">Contact Us</h5>
                <p><b>Phone: </b>+88017137274</p>
                <p><b>Email: </b>charity@gmail.com</p>
                Dhaka 1230
                Bangladesh
            </div>
        </div>
    </div>

</div>

<?php include(__DIR__ . "/common/footer.php"); ?>