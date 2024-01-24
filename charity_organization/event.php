<?php
include(__DIR__ . "/common/header.php");
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-5">
    <h2 class="text-center">Our Current Funds</h2>
    <div class="mt-3">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <div class="col">
                    <div class="card h-100 shadow">
                        <div class="card-image-container">
                            <img src="../charity_admin/uploads/<?= $row['event_image'] ?>" class=" card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["event_name"] ?></h5>
                            <p class="card-text"><?= $row["event_description"] ?></p>
                        </div>
                        <div class="card-footer p-0">
                            <a href="donate.php?id=<?= $row['id'] ?>" class="btn btn-outline-success w-100 rounded-0">Donate Here</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <!-- <div class="col">
                <div class="card h-100 shadow">
                    <div class="card-image-container">
                        <img src="https://cdn.assunnahfoundation.org/donation/flood.jpg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">General Fund</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer p-0">
                        <a href="donate.php" class="btn btn-outline-success w-100 rounded-0">Donate Here</a>
                    </div>
                </div>
            </div> -->
            <!-- <div class="col">
                <div class="card h-100 shadow">
                    <div class="card-image-container">
                        <img src="https://cdn.assunnahfoundation.org/donation/monthly.jpg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">General Fund</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer p-0">
                        <a href="donate.php" class="btn btn-outline-success w-100 rounded-0">Donate Here</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php include(__DIR__ . "/common/footer.php"); ?>