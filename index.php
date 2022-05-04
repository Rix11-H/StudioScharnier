<?php

include_once("bootstrap.php");


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Scharnier</title>
    <!--- bootstrap --->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--- css --->
    <link rel="stylesheet" href="css/app.css?v=<?php echo time() ?>">
</head>
<body>

    <?php include_once("Includes/nav.inc.php"); ?>

    <main class="landing">
        <img src="./assets/imgs/istockphoto-659020452-170667a.png" alt="paal">
    </main>

    <?php include_once("Includes/footer.inc.php"); ?>

</body>
</html>