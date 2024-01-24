<?php
include(__DIR__ . "/common/header.php");
$id = $_GET["id"];
$sql = "SELECT * FROM events WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="container">
    <h4 class="text-center title-bg p-2">General Fund</h4>
    <div class="mt-5">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="shadow rounded">
                    <img class="w-100" src="../charity_admin/uploads/<?= $row['event_image'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="shadow p-2 rounded">
                    <p>
                        <?= $row["event_description"] ?>
                    </p>
                    <p>
                        সাধারণ দান ফাউন্ডেশনকে টিকিয়ে রাখতে সবচেয়ে বেশি সাহায্য করে। সাধারণ দানের অর্থেই মূলত: সকল কল্যানমুখী কার্যক্রম পরিচালিত হয়। সাধারণ দানের জন্য কোনো অংক নির্দিষ্ট নেই, যে কোনো পরিমাণ দান করা যায়।
                        মাসিক দাতা সদস্য: আস-সুন্নাহ ফাউন্ডেশনের মাসিক দাতা সদস্য হলেন প্রতিষ্ঠানটির স্থায়ী ডোনার। কারণ ফাউন্ডেশনের একমাত্র স্থায়ী উপার্জন হলো মাসিক দাতা সদস্যগনের নিয়মিত অনুদান। মাসিক দাতা সদস্যদের নিয়মিত দান আস-সুন্নাহ ফাউন্ডেশেনের বহুমুখী দা’ওয়াহ কার্যক্রম ও সার্বিক উন্নয়নের জন্য স্থায়ী আয়ের মাধ্যম।
                    </p>
                    <div>
                        <form action="payment.php" method="post">
                            <?php if (!isset($_SESSION["email"]) && !isset($_SESSION["phone"])) { ?>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input name="phone" type="number" class="form-control" id="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" required>
                                </div>
                            <?php } else { ?>
                                <input name="phone" type="number" hidden value="<?= $_SESSION['phone'] ?>">
                                <input name="email" type="text" hidden value="<?= $_SESSION['email'] ?>">
                            <?php } ?>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input name="amount" type="number" class="form-control" id="amount" required>
                                <input name="event_id" type="number" hidden value="<?= $row['id'] ?>">
                            </div>
                            <button type="submit" class="btn btn-success w-100">Donate now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . "/common/footer.php"); ?>