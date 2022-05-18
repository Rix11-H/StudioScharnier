<?php

include_once("bootstrap.php");

session_start();

// variable loggedin is used to see if user is logged in or not
if (isset($_SESSION["user"])) {
    $loggedin = true;
} else {
    $loggedin = false;
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

    <?php include_once("Includes/nav.inc.php"); ?>
    <div class="accountRow">
        <div class="account account--summary">
            <img class="account__avatar" src="<?php if(!empty($_SESSION["user"]["avatar"])) { echo $_SESSION["user"]["avatar"]; } else { echo "./avatars/robot.png";}; ?>" alt="Profile picture" />
            <h3 class="account__name"><?php echo $_SESSION["user"]["firstname"] . ' ' . $_SESSION["user"]["lastname"]; ?></h3>
            <p class="account__server"><?php if(!empty($_SESSION["user"]["server_name"])) { echo $_SESSION["user"]["server_name"]; } else { echo "unknown";}; ?></p>
            <div class="account__links">
                <span class="account__link"><a href="#" >Radio</a><?php if(!empty($radio)) { echo "(" . $radio . ")" ;} else { echo "" ;} ?> ></span>
                <span class="account__link"><a href="#" >Beeld</a><?php if(!empty($beeld)) { echo "(" . $beeld . ")" ;} else { echo "" ;} ?> ></span>
                <span class="account__link"><a href="#" >Video</a><?php if(!empty($video)) { echo "(" . $video . ")" ;} else { echo "" ;} ?> ></span>
                <span class="account__link"><a href="#" >Tekst</a><?php if(!empty($tekst)) { echo "(" . $tekst . ")" ;} else { echo "" ;} ?> ></span>
            </div>
        </div>
        <div class="account account--overview">
            <h1>Overview</h1>
            <h4>Selecteer content type</h4>
        </div>
    </div>
</body>

</html>