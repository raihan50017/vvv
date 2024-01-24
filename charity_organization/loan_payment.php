<?php
include(__DIR__ . "/common/header.php");
if (!isset($_SESSION["email"])) {
    header("location:login.php");
}
$email = $_SESSION["email"];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$sql = "SELECT * FROM loans WHERE email = '$email'";
$loan_result = mysqli_query($conn, $sql);
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
            <div class="bg-white p-2 rounded p-2 shadow-sm mt-3">
                <div>
                    <h4 class="text-center">Loans</h4>
                    <?php if (mysqli_num_rows($loan_result) > 0) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                    <th class="text-center" scope="col">Pay</th>
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
                                        <?php if ($loan["status"] == "paid") { ?>
                                            <td><button class="btn btn-sm btn-success w-100" disabled>Paid</button></td>
                                        <?php } else { ?>
                                            <td class="text-center">
                                                <form action="payment_loan.php" method="post">
                                                    <input name="email" type="text" hidden value="<?= $_SESSION['email'] ?>">
                                                    <input name="loan_id" type="number" hidden value="<?= $loan["id"] ?>">
                                                    <input name="amount" type="text" hidden value="<?= $loan["amount"] ?>">
                                                    <button type="submit" class="btn btn-sm btn-success w-100">Pay</button>
                                                </form>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php $i++;
                                endwhile ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <h6 class="text-center">No loan found</h6>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/common/footer.php"); ?>