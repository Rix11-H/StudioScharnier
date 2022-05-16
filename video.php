<?php

    include_once("bootstrap.php");

    session_start();

    // variable loggedin is used to see if user is logged in or not
    if (isset($_SESSION["user"])) {
        $loggedin = true;
    } else {
        $loggedin = false;
    }


    $studioView = false;

    $conn = DB::getConnection();
    $statement = $conn->prepare("SELECT * FROM content");
    $statement->execute();
    $videos = $statement->fetchAll();

    $uploadStatusMsg = "";

    //upload file to server
    if (!empty($_POST['submit'])) {
        $file = $_FILES['videoUpload'];
    
        $fileName = $_FILES['videoUpload']['name'];
        $fileTmpName = $_FILES['videoUpload']['tmp_name'];
        $fileSize = $_FILES['videoUpload']['size'];
        $fileError = $_FILES['videoUpload']['error'];
        $fileType = $_FILES['videoUpload']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('avi', 'flv', 'wmv', "mov", "mp4");
    
        //table projects
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 100000000000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'video/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);

                    //query
    
                    $conn = DB::getConnection();
                    $statement = $conn->prepare("INSERT INTO content (title, description, time, duration, cover_img, amount_views, content_type, url, alt) VALUES (:title, :desc, :time, :duration, :cover, :views, :type, :url, :alt)");
                    $statement->bindValue(':url', $fileDestination);
                    $statement->bindValue(':title', $_POST['videoTitle']);
                    $statement->bindValue(':desc', $_POST['videoDescription']);
                    $statement->bindValue(':duration', "" );
                    $statement->bindValue(':time', date('d-m-y h:i:s'));
                    $statement->bindValue(':cover', "" );
                    $statement->bindValue(':views', 0);
                    $statement->bindValue(':type', $fileType);
                    $statement->bindValue(':alt', "video" . $_POST['videoTitle']);
                    $statement->execute();
    
                    if ($statement) {
                        $uploadStatusMsg = "Project uploaded succesfully";
                        header("Refresh:0");
                        header("video.php");
                
                    } else {
                        $uploadStatusMsg = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $uploadStatusMsg = "Your file is too big!";
                }
            } else {
                $uploadStatusMsg = "Upload failed, please try again.";
            }
        } else {
            $uploadStatusMsg = "Error";
        } 
    } else {
        $uploadStatusMsg = "Nothin submitted";
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
    <header class="m-4">
        <div class="card--header">
            <img class="header__img" src="https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
            <p class="header__top">Bekijk hier</p>
            <h2 class="header__title">Recommended video title</h2>
            <p class="header__desc mr-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis fuga non numquam hic soluta? Consequatur dolore tempora saepe quia facilis, repudiandae corporis minus a asperiores optio, autem, natus aperiam rem.</p>
            <a href="#" class="card__link">Bekijk video</a>
        </div>
    </header>
    <hr class="mx-4">
    <main> <!--https://www.sourcecodester.com/tutorials/php/12672/php-simple-video-upload.html-->
    <?php if($studioView === true): ?>
        <div class="videoUploadForm ">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="videoTitle" id="videoTitle" placeholder="Title">
                <input type="text-area" name="videoDescription" id="videoDescription" placeholder="Description">
                <input type="file" name="videoUpload" id="videoUpload" placeholder="choose a video">
                <input type="submit" value="Upload" name="submit">
            </form>
        </div>
        <div class="div">
            <p><?php echo $uploadStatusMsg ?></p>
        </div>
    <?php endif; ?>
    <?php if($loggedin === false): ?>
        <p>You're not authorized to view this content.</p>
    <?php else: ?>
        <div class="uploadedContent m-2">
            <?php foreach($videos as $video): ?>
                <div class="card card--video">
                    <video class="card__video" src="<?php echo $video['url'] ?>" controls></video>
                    <div class="card__text">
                        <div class="">
                            <h3 class="card__title"><?php echo $video["title"] ?></h3>
                            <p class="card__description"><?php echo $video["description"] ?></p>
                        </div>
                        <a href="#" class="card__link">Bekijk video</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    </main>

    <?php include_once("Includes/footer.inc.php"); ?>

</body>
</html>