<?php

    include_once("bootstrap.php");

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
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <?php include_once("Includes/nav.inc.php"); ?>
    <!-- <header>
        <h1>Videos</h1>
        <div class="recommendedBox">
            <img style="width:280px;" src="https://images.pexels.com/photos/1117132/pexels-photo-1117132.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
            <div>
                <h2>Recommended video title</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis fuga non numquam hic soluta? Consequatur dolore tempora saepe quia facilis, repudiandae corporis minus a asperiores optio, autem, natus aperiam rem.</p>
            </div>
        </div>
    </header> -->
    <main> <!--https://www.sourcecodester.com/tutorials/php/12672/php-simple-video-upload.html-->
        <div class="videoUploadForm">
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
        <div class="uploadedContent">
            <?php foreach($videos as $video): ?>
                <div class="card card--video">
                    <video class="card__video" src="<?php echo $video['url'] ?>" controls></video>
                    <div class="card__text">
                        <h3 class="card__title"><?php echo $video["title"] ?></h3>
                        <p class="card__description"><?php echo $video["description"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once("Includes/footer.inc.php"); ?>

</body>
</html>