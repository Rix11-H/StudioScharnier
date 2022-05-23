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
    <main class="main--detail"> <!--https://www.sourcecodester.com/tutorials/php/12672/php-simple-video-upload.html-->
        <h1><?php echo htmlspecialchars($detail["title"]); ?></h1>
        <?php if($detail["content_type"] == "video/mp4"): ?>
            <video width="50%" height="auto" controls src="<?php echo htmlspecialchars($detail["url"]); ?>">
            />
        <?php else: ?>
                <img src="<?php echo $detail["url"]; ?>" alt="<?php echo htmlspecialchars($detail["alt"]); ?>">
        <?php endif; ?>
    
        </main>

    <?php include_once("Includes/footer.inc.php"); ?>

</body>
</html>