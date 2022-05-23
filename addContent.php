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

$uploadStatusMsg = "";

//upload file to server
if (!empty($_POST['submitFile'])) {
    if($page == "video"){
        $upload = $_FILES['upload'];
        Content::uploadVideo($upload, $_POST['title'], $_POST['description'], $_POST['radio']);
    } else if($page == "static") {
        $upload = $_FILES['upload'];
        Content::uploadImage($upload, $_POST['title'], $_POST['description'], $_POST['radio']);
    } else if($page == "audio"){
        $upload = $_FILES['upload'];
        Content::uploadRadio($upload, $_POST['title'], $_POST['description'], $_POST['radio']);
    } else if($page == "text"){
        if(!empty($_POST['upload'])){
            Content::uploadText($upload, $_POST['title'], $_POST['description'], $_POST['radio']);
        } else {
            Content::uploadTextNoFile($_POST['title'], $_POST['description'], $_POST['radio']);
        }
    }
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
            <img class="studio__avatar" src="<?php if (!empty($_SESSION["user"]["avatar"])) {
                                                    echo $_SESSION["user"]["avatar"];
                                                } else {
                                                    echo "./avatars/robot.png";
                                                }; ?>" alt="Profile picture" />
            <h3 class="studio__name"><?php echo $_SESSION["user"]["firstname"] . ' ' . $_SESSION["user"]["lastname"]; ?></h3>
            <small class="studio__role text-muted"><?php echo $_SESSION["user"]["role"] ?></small>
            <p class="studio__server"><?php if (!empty($_SESSION["user"]["server_name"])) {
                                            echo $_SESSION["user"]["server_name"];
                                        } else {
                                            echo "unknown";
                                        }; ?></p>
            <div class="studio__links">
                <span class="studio__link"><a href="studio.php" <?php if (empty($page) || $page == "") {
                                                                    echo "style='color:#ef773e;text-decoration:underline;'";
                                                                } ?>>Overzicht</a> ></span>
                <span class="studio__link"><a href="studio.php?page=radio" <?php if (!empty($page) && $page == "radio") {
                                                                                echo "style='color:#ef773e;text-decoration:underline;'";
                                                                            } ?>>Audio</a><?php if (!empty($radio)) {
                                                                                                echo "(" . $radio . ")";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?> ></span>
                <span class="studio__link"><a href="studio.php?page=static" <?php if (!empty($page) && $page == "static") {
                                                                                echo "style='color:#ef773e;text-decoration:underline;'";
                                                                            } ?>>Beeld</a><?php if (!empty($beeld)) {
                                                                                                echo "(" . $beeld . ")";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?> ></span>
                <span class="studio__link"><a href="studio.php?page=video" <?php if (!empty($page) && $page == "video") {
                                                                                echo "style='color:#ef773e;text-decoration:underline;'";
                                                                            } ?>>Video</a><?php if (!empty($video)) {
                                                                                                echo "(" . $video . ")";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?> ></span>
                <span class="studio__link"><a href="studio.php?page=text" <?php if (!empty($page) && $page == "text") {
                                                                                echo "style='color:#ef773e;text-decoration:underline;'";
                                                                            } ?>>Tekst</a><?php if (!empty($tekst)) {
                                                                                                echo "(" . $tekst . ")";
                                                                                            } else {
                                                                                                echo "";
                                                                                            } ?> ></span>
            </div>
        </div>
        <div class="studio studio--overview">
            <?php if (!empty($page) && $page == "video") : ?>
                <div class="studio--videoView">
                    <h1>Upload een nieuwe video</h1>
                </div>
            <?php endif; ?>
            <?php if (!empty($page) && $page == "static") : ?>
                <div class="studio--videoView">
                    <h1>Uplaod een nieuwe afbeelding</h1>
                </div>
            <?php endif; ?>
            <?php if (!empty($page) && $page == "text") : ?>
                <div class="studio--videoView">
                    <h1>Upload een nieuw artikel</h1>
                </div>
            <?php endif; ?>
            <?php if (!empty($page) && $page == "audio") : ?>
                <div class="studio--videoView">
                    <h1>Upload een nieuw audiobestand</h1>
                </div>
            <?php endif; ?>

            <div class="videoUploadForm form--add">

                <?php if (!empty($uploadStatusMsg)) :  ?>
                    <p class="alert alert-danger w-100"><?php echo $uploadStatusMsg  ?></p>
                <?php endif; ?>
                <form action="" method="POST" enctype="multipart/form-data" class="form--add">
                    <div class="form-group custom-file my-2">
                        <label class="custom-file-label" for="validatedCustomFile"><?php if($page != ("text" || "static" )){ echo "Kies bestand";} else if($page == "audio") { echo "Kies audiobestand" ;} else { echo "Kies afbeelding";} ?></label>
                        <input type="file" name="upload" id="upload" class="custom-file-input" placeholder="choose a video">
                    </div>
                    <div class="form-group">
                        <label for="videoTitle" class="form--add__label">Titel</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Titel">
                    </div>
                    <div class="form-group">
                        <label for="videoDescription" class="form--add__label"><?php if($page != "text"){ echo "Beschrijving";} else { echo "Schrijf je artikel hier.";} ?></label>
                        <textarea type="text" name="description" id="description" class="form-control" placeholder="Beschrijving" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="custom-radio" class="form--add__label mr-4">Zichtbaarheid</label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radioPublic" name="radio" class="custom-control-input">
                            <label class="custom-control-label" for="radioPublic">Iedereen</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input checked type="radio" id="radioMembers" name="radio" class="custom-control-input">
                            <label class="custom-control-label" for="radioMembers">Leden</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="radioPrivate" name="radio" class="custom-control-input">
                            <label class="custom-control-label" for="radioPrivate">Privé</label>
                        </div>

                    </div>
                    <div class="form-group">
                        <input type="submit" value="Upload" class="btn btn--primary" name="submitFile">
                    </div>

                </form>
            </div>

        </div>
    </div>


    <?php ?>

</body>

</html>