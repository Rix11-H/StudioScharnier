<?php

    include_once("bootstrap.php");

    session_start();

    // variable loggedin is used to see if user is logged in or not
    if (isset($_SESSION["user"])) {
        $loggedin = true;
    } else {
        $loggedin = false;
    }
    
    $texts = Content::getAllTexts();


?><!DOCTYPE html>
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
            <img class="header__img" src="<?php if(!empty($texts[0]["url"])) { echo $texts[0]["url"];} else {echo "./assets/imgs/defaultArticleImg.jpeg" ;} ?>" alt="">
            <p class="header__top">Bekijk hier</p>
            <h2 class="header__title"><?php echo $texts[0]["title"] ?></h2>
            <p class="header__desc mr-4"><?php 
                $string = $texts[0]["description"];
                if (strlen($string) > 700) {
                    $stringCut = substr($string, 0, 750);
                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')). '<a href="details.php?id=' . htmlspecialchars($texts[0]['id']) . '" class="card__link"> ... Lees meer</a>';
                }
                echo $string;
            ?></p>
            
        </div>
    </header>
    <hr class="mx-4">
    <main> <!--https://www.sourcecodester.com/tutorials/php/12672/php-simple-video-upload.html-->
    <div class="search__container">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Zoek..." aria-label="Search">
                <button class="btn btn--primary" type="zoeken">Search</button>
            </form>
        </div>
    
    <div class="uploadedContent m-2">
        <?php foreach($texts as $text): ?>
                <a class="card card--static" href="details.php?id=<?php echo htmlspecialchars($text["id"]); ?>">
                    
                    <img class="card__image" src="<?php if(!empty($text["url"])) { echo $text["url"];} else {echo "./assets/imgs/defaultArticleImg.jpeg" ;} ?>"></img>

                    <div class="card__text">
                        <h3 class="card__title"><?php echo $text["title"] ?></h3>
                    </div>
        </a>
            <?php endforeach; ?>
            <?php if ($loggedin && $_SESSION["user"]["role"] !="user") : ?>
                <a class="card card--static card--add" href="addContent.php?page=text" >
                    <img class="card--add__img" src="./assets/imgs/addBtn.png" alt="add">
                </a>
            <?php endif; ?>
        </div>
    </main>

    <?php include_once("Includes/footer.inc.php"); ?>

</body>
</html>