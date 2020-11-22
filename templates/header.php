<?php
$title = $title ?? "My blog";
$menu_item = $menu_item ?? "";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <title><?= $title; ?></title>


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="css/style_header.css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/hamburgers.min.css" type="text/css"/>
        <link rel="stylesheet" href="css/style.css" type="text/css"/>

    </head>
    <body>



        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">My Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php" <?= $menu_item === "home" ? 'class="active"' : ""; ?>>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php" <?= $menu_item === "about" ? 'class="active"' : ""; ?>>About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php" <?= $menu_item === "blog" ? 'class="active"' : ""; ?>>Blog</a>
                    </li>
                    <?php if (validate_user()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php" <?= $menu_item === "login" ? 'class="active"' : ""; ?>> Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php" <?= $menu_item === "register" ? 'class="active"' : ""; ?>>Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php" <?= $menu_item === "login" ? 'class="active"' : ""; ?>>Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
                <form class="form-inline my-2 my-lg-0">
                 
                    <?php if (validate_user()): ?>
                    <form class="form-inline my-2 my-lg-0">
                        <div class="user-say-hi">
                            <span class="form-control mr-sm-2">Hi, <?= $_SESSION['user_name']; ?></span>
                            <?php if (!empty($_SESSION['user_image'])): ?>
                                <img src="uploads/<?= $_SESSION['user_image']; ?>" alt="Profile picture of <?= $_SESSION['user_name']; ?>">
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </nav>

        </header>


        <main>