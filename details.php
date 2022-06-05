<?php

include_once("bootstrap.php");

session_start();

// variable loggedin is used to see if user is logged in or not
if (isset($_SESSION["user"])) {
    $loggedin = true;
} else {
    $loggedin = false;
}

if (!isset($_GET["id"])) {
    $getId = "notfound";
} else {
    $getId = $_GET["id"];
    $detail = Content::getContentById($getId);
}

$contents = Content::getAllContent();



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
    <div class="backdiv">
    <a class="back m-4" href="javascript:history.go(-1)">< Terug</a>
    </div>
    <div class="flex--detail m-4">
        <div class="main--detail">
            <!--https://www.sourcecodester.com/tutorials/php/12672/php-simple-video-upload.html-->
            <div class="main__visual">
                <?php if ($detail["content_type"] == "video/mp4") : ?>
                    <video width="100%" height="auto" controls src="<?php echo htmlspecialchars($detail["url"]); ?>">
                        />
                    <?php else : ?>
                        <img src="<?php if(!empty($detail["url"])){ echo $detail["url"];} else { echo $detail["cover_img"];}; ?>" alt="<?php echo ($detail["alt"]); ?>">
                    <?php endif; ?>
            </div>
            <div class="main__description">
            <h1><?php echo htmlspecialchars($detail["title"]); ?></h1>
            <p class="text-muted mb-2">Beschrijving</p>    
            <p><?php echo htmlspecialchars($detail["description"]); ?></p>
            </div>
        </div>
        <div class="aside--detail">
            <h2>Ook interessant</h2>
            <div class="aside__box">
                <?php foreach (array_slice($contents, 0, 5) as $content) : ?>
                    <?php if ($content["content_type"] != ("audio/mp3")) : ?>
                        <div class="aside__item">
                            <a href="details.php?id=<?php echo $content["id"]; ?>">
                                <?php if ($content["content_type"] == "video/mp4") : ?>
                                    <video width="100%" height="auto" controls src="<?php echo htmlspecialchars($content["url"]); ?>">
                                        />
                                    <?php else : ?>
                                        <img class="detail__img" src="<?php if (!empty($content["cover_img"])) {
                                                                    echo $content["cover_img"];
                                                                } else {
                                                                    echo $content["url"];
                                                                } ?>" alt="<?php echo htmlspecialchars($content["alt"]); ?>">
                                    <?php endif; ?>
                            </a>
                            <h3><?php echo htmlspecialchars($content["title"]); ?></h3>
                        </div>
                    <?php else : ?>
                        <figure class="audio--card__flex">
                            <figcaption class="card--audio__title"><?php echo $audio["title"] ?></figcaption>
                            <audio controls src="<?php echo $audio["url"] ?>">
                            </audio>
                            <a href="#" class="card__link">Meer</a>
                        </figure>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php include_once("Includes/footer.inc.php"); ?>

</body>

</html>