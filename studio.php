<?php

include_once("bootstrap.php");

session_start();

// variable loggedin is used to see if user is logged in or not
if (isset($_SESSION["user"])) {
    $loggedin = true;
} else {
    $loggedin = false;
}

if (!isset($_GET["page"])) {
    $page = "";
} else {
    $page = $_GET["page"];
}

if($page == "audio") {
    $audios = Content::getAllAudio();
} else if($page == "video") {
    $videos = Content::getAllVideos();
} else if($page == "static") {
    $images = Content::getAllImages();
} else if($page == "text") {	
    $texts = Content::getAllTexts();
} else {
    $contents = Content::getAllContent();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel | Studio Scharnier</title>
    <link rel="icon" type="image/png" href="./assets/imgs/favicon.png">
    <!--- bootstrap --->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!--- css --->
    <link rel="stylesheet" href="css/app.css?v=<?php echo time() ?>">

</head>

<body class="">

    <?php include_once("Includes/nav_studio.inc.php"); ?>
    <div class="studioRow">
        <div class="studio studio--summary">
            <img class="studio__avatar" src="<?php if(!empty($_SESSION["user"]["avatar"])) { echo $_SESSION["user"]["avatar"]; } else { echo "./avatars/robot.png";}; ?>" alt="Profile picture" />
            <h3 class="studio__name"><?php echo $_SESSION["user"]["firstname"] . ' ' . $_SESSION["user"]["lastname"]; ?></h3>
            <small class="studio__role text-muted"><?php echo $_SESSION["user"]["role"] ?></small>
            <p class="studio__server"><?php if(!empty($_SESSION["user"]["server_name"])) { echo $_SESSION["user"]["server_name"]; } else { echo "unknown";}; ?></p>
            <div class="studio__links">
                <span class="studio__link"><a href="studio.php"  <?php if(empty($page) || $page == ""){ echo "style='color:#ef773e;text-decoration:underline;'"; } ?>>Overzicht</a> ></span>
                <span class="studio__link"><a href="studio.php?page=audio" <?php if(!empty($page) && $page == "audio"){ echo "style='color:#ef773e;text-decoration:underline;'"; } ?> >Audio</a><?php if(!empty($audio)) { echo "(" . $audio . ")" ;} else { echo "" ;} ?> ></span>
                <span class="studio__link"><a href="studio.php?page=static" <?php if(!empty($page) && $page == "static"){ echo "style='color:#ef773e;text-decoration:underline;'"; } ?>  >Beeld</a><?php if(!empty($beeld)) { echo "(" . $beeld . ")" ;} else { echo "" ;} ?> ></span>
                <span class="studio__link"><a href="studio.php?page=video" <?php if(!empty($page) && $page == "video"){ echo "style='color:#ef773e;text-decoration:underline;'"; } ?>  >Video</a><?php if(!empty($video)) { echo "(" . $video . ")" ;} else { echo "" ;} ?> ></span>
                <span class="studio__link"><a href="studio.php?page=text" <?php if(!empty($page) && $page == "text"){ echo "style='color:#ef773e;text-decoration:underline;'"; } ?>  >Tekst</a><?php if(!empty($tekst)) { echo "(" . $tekst . ")" ;} else { echo "" ;} ?> ></span>
            </div>
        </div>
        <div class="studio studio--overview">
            <h1>Overzicht</h1>
            <?php if(!isset($page) || empty($page)): ?>
            <h4>Selecteer content type</h4>
            <?php endif; ?>

            <?php if(!empty($page) && $page == "video"): ?>
            <div class="studio--videoView">
            <?php foreach($videos as $video): ?>
                <div class="studioCard studioCard--video">
                    <div class="studioCard__front">
                    <video class="studioCard__video" src="<?php echo $video['url'] ?>" controls></video>
                    <div class="card__text studioCard__text">
                            <h3 class="studioCard__title"><?php echo $video["title"] ?></h3>
                            <p class="studioCard__description"><?php echo $video["description"] ?></p>
                    </div>
                    </div>
                    <div class="studioCard__tags"></div>
                    <div class="studioCard__menu">
                        <a href="studio.php?page=video&action=edit&id=<?php echo $video["id"] ?>" class="studioCard__edit card__edit btn btn--primary--outline btn--small">Bewerk</a>
                        <a href="studio.php?page=video&action=delete&id=<?php echo $video["id"] ?>" class="studioCard__delete card__delete btn btn--danger--outline btn--small">Verwijder</a>
                        <a href="details.php?id=<?php echo htmlspecialchars($video["id"]); ?>" class="studioCard__goto btn btn--ghost--outline btn--small">Bekijk</a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($page) && $page == "static"): ?>
            <div class="studio--videoView">
            <?php foreach($images as $image): ?>
                <div class="studioCard studioCard--video">
                    <div class="studioCard__front">
                    <img class="studioCard__video" src="<?php echo $image['url'] ?>" ></img>
                    <div class="card__text studioCard__text">
                            <h3 class="studioCard__title"><?php echo $image["title"] ?></h3>
                            <p class="studioCard__description"><?php echo $image["description"] ?></p>
                    </div>
                    </div>
                    <div class="studioCard__tags"></div>
                    <div class="studioCard__menu">
                        <a href="studio.php?page=video&action=edit&id=<?php echo $image["id"] ?>" class="studioCard__edit card__edit btn btn--primary--outline btn--small">Bewerk</a>
                        <a href="studio.php?page=video&action=delete&id=<?php echo $image["id"] ?>" class="studioCard__delete card__delete btn btn--danger--outline btn--small">Verwijder</a>
                        <a href="details.php?id=<?php echo htmlspecialchars($image["id"]); ?>" class="studioCard__goto btn btn--ghost--outline btn--small">Bekijk</a>
                    </div>
            </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($page) && $page == "text"): ?>
                <div class="studio--videoView">
            <?php foreach($texts as $text): ?>
                <div class="studioCard studioCard--video">
                    <div class="studioCard__front">
                    <img class="studioCard__video" src="<?php if(!empty($text["url"])) { echo $text["url"];} else {echo "./assets/imgs/defaultArticleImg.jpeg" ;} ?>"></img>
                    <div class="card__text studioCard__text">
                            <h3 class="studioCard__title"><?php echo $text["title"] ?></h3>
                            <!-- <p class="studioCard__description"><?php echo $text["description"] ?></p> -->
                    </div>
                    </div>
                    <div class="studioCard__tags"></div>
                    <div class="studioCard__menu">
                        <a href="studio.php?page=video&action=edit&id=<?php echo $text["id"] ?>" class="studioCard__edit card__edit btn btn--primary--outline btn--small">Bewerk</a>
                        <a href="studio.php?page=video&action=delete&id=<?php echo $text["id"] ?>" class="studioCard__delete card__delete btn btn--danger--outline btn--small">Verwijder</a>
                        <a href="details.php?id=<?php echo htmlspecialchars($text["id"]); ?>" class="studioCard__goto btn btn--ghost--outline btn--small">Bekijk</a>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php if(!empty($page) && $page == "audio"): ?>
            <div class="studio--videoView">
            <?php foreach ($audios as $audio) : ?>
                <div class="studioCard studioCard--audio" href="#">
                    <figure class="audio--card__flex">
                        <figcaption class="studioCard__title"><?php echo $audio["title"] ?></figcaption>
                        <span class="studioCard__desc"><?php echo $audio["description"] ?></span>
                        <audio controls src="<?php echo $audio["url"] ?>">
                        </audio>
                        <a class="card__link" href="#">delete</a>
                    </figure>
                </div>
                <?php endforeach; ?>

            </div>
            <?php endif; ?>

        </div>
    </div>


    <?php ?>

</body>

</html>