<?php

include_once("bootstrap.php");

session_start();

// variable loggedin is used to see if user is logged in or not
if (isset($_SESSION["user"])) {
    $loggedin = true;
} else {
    $loggedin = false;
}

$audios = Content::getAllAudio();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Scharnier</title>
    <!--- bootstrap --->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--- css --->
    <link rel="stylesheet" href="css/app.css?v=<?php echo time() ?>">
</head>

<body>

    <?php include_once("Includes/nav.inc.php"); ?>
    <header class="m-4">
        <div class="card--header">
            <img class="header__img" src="./assets/imgs/defaultAudioImg.webp" alt="">
            <p class="header__top">Luister hier</p>
            <h2 class="header__title">Newest Audio</h2>
            <p class="header__desc mr-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis fuga non numquam hic soluta? Consequatur dolore tempora saepe quia facilis, repudiandae corporis minus a asperiores optio, autem, natus aperiam rem.</p>
            <a href="#" class="card__link">Ontdek meer...</a>
        </div>
    </header>
    <hr class="mx-4">
    <main>
    <div class="search__container">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Zoek..." aria-label="Search">
                <button class="btn btn--primary" type="zoeken">Search</button>
            </form>
        </div>

        <!--https://www.sourcecodester.com/tutorials/php/12672/php-simple-video-upload.html-->
        <div class="uploadedContent uploadedContent--audio m-2">
            <h2 class="mx-3 mb-4">Alle bestanden</h2>
            <?php foreach ($audios as $audio) : ?>
                <div class="card card--audio" href="#">
                    <figure class="audio--card__flex">
                        <figcaption class="card--audio__title"><?php echo $audio["title"] ?></figcaption>
                        <audio controls src="<?php echo $audio["url"] ?>">
                        </audio>
                        <a href="#" class="card__link">Meer</a>
                    </figure>
                </div>
                <?php endforeach; ?>
                <?php if ($loggedin && $_SESSION["user"]["role"] != "user") : ?>
        <a class="card card--audio card--add--audio" href="addContent.php?page=audio">
            <img class="card--audio--add__img" src="./assets/imgs/addBtn.png" alt="add">
        </a>
    <?php endif; ?>

        </div>
    </div>
    </main>

    <?php include_once("Includes/footer.inc.php"); ?>

</body>

</html>