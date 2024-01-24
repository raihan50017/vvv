<?php
include(__DIR__ . "/common/header.php");
if (!isset($_SESSION["email"])) {
    header("location:login.php");
}
$email = $_SESSION["email"];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$due_loan = 0;
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
                <a style="background-color: rgba(0,0,0,.1);" href="edit_user_profile.php?id=<?= $row["id"] ?>" class="btn btn-sm w-100 mt-2"><i class="fa-regular fa-pen-to-square"></i> Edit profile</a>
                <br>
                <a style="background-color: rgba(0,0,0,.1);" href="apply_for_loan.php" class="btn btn-sm w-100 mt-2"> Apply for loan</a>
                <br>
                <a style="background-color: rgba(0,0,0,.1);" href="loan_payment.php" class="btn btn-sm w-100 mt-2"> Payment for loan</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="class shadow-sm bg-white p-2 rounded fw-bold">
                        <?php
                        $sql = "SELECT * FROM donations, events WHERE donations.email = '$email' AND donations.event_id = events.id";
                        $donation_result = mysqli_query($conn, $sql);
                        $sql = "SELECT SUM(amount) as donation_amount FROM donations  WHERE email = '$email' GROUP BY email";
                        $donation_amount_result = mysqli_query($conn, $sql);
                        $donation_amount_result_row = mysqli_fetch_assoc($donation_amount_result);
                        ?>
                        <h5>Donation Summary</h5>
                        <p class="m-0">Donation Count: <?= mysqli_num_rows($donation_result) ?></p>
                        <?php if (mysqli_num_rows($donation_amount_result) > 0) { ?>
                            <p>Total Amount: <?= $donation_amount_result_row["donation_amount"]  ?> <i class="fa-solid fa-bangladeshi-taka-sign"></i></p>
                        <?php
                        } else { ?>
                            <p>Total Amount: 0 <i class="fa-solid fa-bangladeshi-taka-sign"></i></p>
                        <?php
                        } ?>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="class shadow-sm bg-white p-2 rounded fw-bold">
                        <?php
                        $sql = "SELECT * FROM loans WHERE email = '$email'";
                        $loan_result = mysqli_query($conn, $sql);
                        $sql = "SELECT SUM(amount) as loan_amount FROM loans WHERE email = '$email' GROUP BY email";
                        $loan_amount_result = mysqli_query($conn, $sql);
                        $loan_amount_result_row = mysqli_fetch_assoc($loan_amount_result);
                        ?>
                        <h5>Loan Summary</h5>
                        <p class="m-0">Loan Count: <?= mysqli_num_rows($loan_result) ?></p>
                        <?php if (mysqli_num_rows($loan_amount_result) > 0) {
                            $due_loan += $loan_amount_result_row["loan_amount"]; ?>
                            <p>Total Amount: <?= $loan_amount_result_row["loan_amount"]  ?> <i class="fa-solid fa-bangladeshi-taka-sign"></i></p>
                        <?php
                        } else { ?>
                            <p>Total Amount: 0 <i class="fa-solid fa-bangladeshi-taka-sign"></i></p>
                        <?php
                        } ?>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="class shadow-sm bg-white p-2 rounded fw-bold">
                        <?php
                        $sql = "SELECT SUM(amount) as loan_pay_amount FROM loan_pay WHERE email = '$email' GROUP BY email";
                        $loan_pay_amount_result = mysqli_query($conn, $sql);
                        $loan_pay_amount_result_row = mysqli_fetch_assoc($loan_pay_amount_result);
                        ?>
                        <h5>Total Paid Loan Amount</h5>

                        <?php if (mysqli_num_rows($loan_pay_amount_result) > 0) {
                            $due_loan -= $loan_pay_amount_result_row["loan_pay_amount"]; ?>
                            <p><?= $loan_pay_amount_result_row["loan_pay_amount"]  ?> <i class="fa-solid fa-bangladeshi-taka-sign"></i></p>
                        <?php
                        } else { ?>
                            <p>0 <i class="fa-solid fa-bangladeshi-taka-sign"></i></p>
                        <?php
                        } ?>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="class shadow-sm bg-white p-2 rounded fw-bold">
                        <?php
                        $sql = "SELECT SUM(amount) as loan_pay_amount FROM loan_pay WHERE email = '$email' GROUP BY email";
                        $loan_pay_amount_result = mysqli_query($conn, $sql);
                        $loan_pay_amount_result_row = mysqli_fetch_assoc($loan_pay_amount_result);
                        ?>
                        <h5>Total Due Loan Amount</h5>
                        <p><?= $due_loan  ?> <i class="fa-solid fa-bangladeshi-taka-sign"></i></p>

                    </div>
                </div>
            </div>
            <div class="bg-white p-2 rounded p-2 shadow-sm mt-3">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Donations</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Loans</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <?php if (mysqli_num_rows($donation_result) > 0) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                        <th class="text-center" scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    while ($donation = mysqli_fetch_assoc($donation_result)) : ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $donation["event_name"] ?></td>
                                            <td><?= $donation["amount"] ?></td>
                                            <td><?= $donation["datetime"] ?></td>
                                            <td class="text-center"><a href="#" class="btn btn-sm btn-success"><i class="fa-regular fa-eye"></i> View</a></td>
                                        </tr>
                                    <?php $i++;
                                    endwhile ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <h6 class="text-center">No donation found</h6>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <?php if (mysqli_num_rows($loan_result) > 0) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th class="text-center" scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    while ($loan = mysqli_fetch_assoc($loan_result)) : ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $loan["title"] ?></td>
                                            <td><?= $loan["amount"] ?></td>
                                            <td><?= $loan["datetime"] ?></td>
                                            <?php if ($loan["status"] == "rejected") { ?>
                                                <td class="text-danger"> <?= $loan["status"] ?></td>
                                            <?php } else { ?>
                                                <td class="text-success"> <?= $loan["status"] ?></td>
                                            <?php } ?>
                                            <td class="text-center"><a href="#" class="btn btn-sm btn-success"><i class="fa-regular fa-eye"></i> View</a></td>
                                        </tr>
                                    <?php $i++;
                                    endwhile ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <h6 class="text-center">No loan found</h6>
                        <?php } ?>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/common/footer.php"); ?>