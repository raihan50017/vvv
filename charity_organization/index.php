<?php
include(__DIR__ . "/common/header.php");
$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);
?>

<div class="container mt-3">
    <div>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./resources/images/USA.webp" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p> -->
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./resources/images/slide1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p> -->
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="./resources/images/slide3.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <!-- <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p> -->
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <h2 class="text-center mt-5">Our Current Funds</h2>
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