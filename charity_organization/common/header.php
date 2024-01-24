<?php
include(__DIR__ . "/config.php");
include(__DIR__ . "/connection.php");

$file_name = basename(parse_url($_SERVER['REQUEST_URI'])["path"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity App</title>
    <?php include(__DIR__ . "/resources_top.php"); ?>
</head>
<nav class="navbar navbar-expand-lg navbar-light position-static nav-bg shadow-sm">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand" href="/charity_organization">
                <img class="rounded-circle" style="width: 50px;" src="/charity_organization/resources/images/charity-logo.jpg">
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  <?php if ($file_name == 'charity_organization') echo 'nav-link-active' ?>" aria-current="page" href="/charity_organization">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?php if ($file_name == 'event.php') echo 'nav-link-active' ?>" aria-current="page" href="/charity_organization/event.php">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($file_name == 'about.php') echo 'nav-link-active' ?>" aria-current="page" href="/charity_organization/about.php">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($file_name == 'contac.php') echo 'nav-link-active' ?>" aria-current="page" href="/charity_organization/contac.php">Contac Us</a>
                </li>
            </ul>
            <form class="d-flex me-auto">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <?php if (isset($_SESSION["email"])) { ?>
                <div class="btn-group">
                    <button style="height: 40px; width:40px; background-color:#023047;" type="button" class="btn rounded-circle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <i class="fa-regular fa-user h-100 w-100 text-white"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a href="user.php" class="dropdown-item" type="button"><i class="fa-solid fa-user"></i> Profile</a></li>
                        <li><button class="dropdown-item" type="button">Another action</button></li>
                        <li><button class="dropdown-item" type="button">Something else here</button></li>
                        <li><a href="logout.php" class="dropdown-item" type="button"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <a class="fw-bold text-white ps-1" href="/charity_organization/login.php">Login</a>
            <?php } ?>
        </div>
    </div>
</nav>

<body>