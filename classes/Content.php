<?php

use LDAP\Result;

    Abstract class Content {

        public static function getContentById($id) {
            $conn = DB::getConnection();
            $statement = $conn->prepare("SELECT * FROM content where id = :id");
            $statement->bindValue(":id", $id);
            $statement->execute();
            $content = $statement->fetch();
            return $content;
        }


        public static function getAllContent() {
            $conn = DB::getConnection();
            $statement = $conn->prepare("SELECT * FROM content ");
            $statement->execute();
            $contents = $statement->fetchAll();
            return $contents;
        }

        public static function getAllVideos() {
            $conn = DB::getConnection();
            $statement = $conn->prepare("SELECT * FROM content where content_type = 'video/mp4' order by time ASC");
            $statement->execute();
            $videos = $statement->fetchAll();
            return $videos;
        }

        public static function getAllImages() {
            $conn = DB::getConnection();
            $statement = $conn->prepare("SELECT * FROM content where content_type = 'image/jpeg' OR content_type = 'image/png' OR content_type = 'image/gif' OR content_type = 'image/jpg' order by time ASC");
            $statement->execute();
            $images = $statement->fetchAll();
            return $images;
        }

        public static function getAllTexts() {
            $conn = DB::getConnection();
            $statement = $conn->prepare("SELECT * FROM content where content_type = 'text' order by time ASC");
            $statement->execute();
            $images = $statement->fetchAll();
            return $images;
        }

        public static function getAllAudio() {
            $conn = DB::getConnection();
            $statement = $conn->prepare("SELECT * FROM content where content_type = 'audio/mp3' OR content_type = 'audio/mpeg' OR content_type = 'audio/wav' OR content_type = 'audio/WAV' order by time ASC");
            $statement->execute();
            $images = $statement->fetchAll();
            return $images;
        }



        public static function uploadVideo($upload, $title, $desc, $privacy) {
            $file = $upload;

            $fileName = $_FILES['upload']['name'];
            $fileTmpName = $_FILES['upload']['tmp_name'];
            $fileSize = $_FILES['upload']['size'];
            $fileError = $_FILES['upload']['error'];
            $fileType = $_FILES['upload']['type'];
        
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
        
            $allowed = array("mp4");
        
            //table projects
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize >= 0) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'uploads/video/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
        
                        //query
        
                        $conn = DB::getConnection();
                        $statement = $conn->prepare("INSERT INTO content (title, description, time, duration, cover_img, amount_views, content_type, url, alt, privacy) VALUES (:title, :desc, :time, :duration, :cover, :views, :type, :url, :alt, :privacy)");
                        $statement->bindValue(':url', $fileDestination);
                        $statement->bindValue(':title', $title);
                        $statement->bindValue(':desc', $desc);
                        $statement->bindValue(':duration', "");
                        $statement->bindValue(':time', date('d-m-y h:i:s'));
                        $statement->bindValue(':cover', "");
                        $statement->bindValue(':views', 0);
                        $statement->bindValue(':type', $fileType);
                        $statement->bindValue(':alt', "video" . $title);
                        $statement->bindValue(':privacy', $privacy);
                        $statement->execute();
        
                        if ($statement) {
                            $uploadStatusMsg = "Project uploaded succesfully";
                            header("Location: studio.php?page=video");
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
        
        }

        public static function uploadImage($upload, $title, $desc, $privacy) {
            $file = $upload;

            $fileName = $_FILES['upload']['name'];
            $fileTmpName = $_FILES['upload']['tmp_name'];
            $fileSize = $_FILES['upload']['size'];
            $fileError = $_FILES['upload']['error'];
            $fileType = $_FILES['upload']['type'];
        
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
        
            $allowed = array("jpeg", "jpg", "png", "gif");
        
            //table projects
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 100000000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'uploads/static/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
        
                        //query
        
                        $conn = DB::getConnection();
                        $statement = $conn->prepare("INSERT INTO content (title, description, time, duration, cover_img, amount_views, content_type, url, alt, privacy) VALUES (:title, :desc, :time, :duration, :cover, :views, :type, :url, :alt, :privacy)");
                        $statement->bindValue(':url', $fileDestination);
                        $statement->bindValue(':title', $title);
                        $statement->bindValue(':desc', $desc);
                        $statement->bindValue(':duration', "");
                        $statement->bindValue(':time', date('d-m-y h:i:s'));
                        $statement->bindValue(':cover', "");
                        $statement->bindValue(':views', 0);
                        $statement->bindValue(':type', $fileType);
                        $statement->bindValue(':alt', "static" . $title);
                        $statement->bindValue(':privacy', $privacy);
                        $statement->execute();
        
                        if ($statement) {
                            $uploadStatusMsg = "Project uploaded succesfully";
                            header("Location: studio.php?page=static");
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
        
        }

        public static function uploadRadio($upload, $title, $desc, $privacy) {
            $file = $upload;
            $cover = "./assets/imgs/defaultAudioImg.webp";

            $fileName = $_FILES['upload']['name'];
            $fileTmpName = $_FILES['upload']['tmp_name'];
            $fileSize = $_FILES['upload']['size'];
            $fileError = $_FILES['upload']['error'];
            $fileType = $_FILES['upload']['type'];
        
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
        
            $allowed = array("mp3", "wav", "WAV", "MP3", "mpeg", "MPEG");
        
            //table projects
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 100000000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'uploads/audio/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
        
                        //query
        
                        $conn = DB::getConnection();
                        $statement = $conn->prepare("INSERT INTO content (title, description, time, duration, cover_img, amount_views, content_type, url, alt, privacy) VALUES (:title, :desc, :time, :duration, :cover, :views, :type, :url, :alt, :privacy)");
                        $statement->bindValue(':url', $fileDestination);
                        $statement->bindValue(':title', $title);
                        $statement->bindValue(':desc', $desc);
                        $statement->bindValue(':duration', "");
                        $statement->bindValue(':time', date('d-m-y h:i:s'));
                        $statement->bindValue(':cover', $cover);
                        $statement->bindValue(':views', 0);
                        $statement->bindValue(':type', $fileType);
                        $statement->bindValue(':alt', "audio" . $title);
                        $statement->bindValue(':privacy', $privacy);
                        $statement->execute();
        
                        if ($statement) {
                            $uploadStatusMsg = "Project uploaded succesfully";
                            header("Location: studio.php?page=radio");
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
        
        }

        public static function uploadText($upload, $title, $desc, $privacy) {
            $file = $upload;

            $fileName = $_FILES['upload']['name'];
            $fileTmpName = $_FILES['upload']['tmp_name'];
            $fileSize = $_FILES['upload']['size'];
            $fileError = $_FILES['upload']['error'];
            $fileType = $_FILES['upload']['type'];
        
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));
        
            $allowed = array("jpg", "jpeg", "png", "gif");
        
            //table projects
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 100000000000) {
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'uploads/text/' . $fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
        
                        //query
        
                        $conn = DB::getConnection();
                        $statement = $conn->prepare("INSERT INTO content (title, description, time, duration, cover_img, amount_views, content_type, url, alt, privacy) VALUES (:title, :desc, :time, :duration, :cover, :views, :type, :url, :alt, :privacy)");
                        $statement->bindValue(':url', $fileDestination);
                        $statement->bindValue(':title', $title);
                        $statement->bindValue(':desc', $desc);
                        $statement->bindValue(':duration', "");
                        $statement->bindValue(':time', date('d-m-y h:i:s'));
                        $statement->bindValue(':cover', "");
                        $statement->bindValue(':views', 0);
                        $statement->bindValue(':type', "text");
                        $statement->bindValue(':alt', "text" . $title);
                        $statement->bindValue(':privacy', $privacy);
                        $statement->execute();
        
                        if ($statement) {
                            $uploadStatusMsg = "Project uploaded succesfully";
                            header("Location: studio.php?page=text");
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
        
        }

        public static function uploadTextNoFile($title, $desc, $privacy) {
        
            $conn = DB::getConnection();
            $statement = $conn->prepare("INSERT INTO content (title, description, time, amount_views, content_type, privacy) VALUES (:title, :desc, :time, :views, :type, :privacy)");
            $statement->bindValue(':title', $title);
            $statement->bindValue(':desc', $desc);
            $statement->bindValue(':time', date('d-m-y h:i:s'));
            $statement->bindValue(':views', 0);
            $statement->bindValue(':type', "text");
            $statement->bindValue(':privacy', $privacy);
            $statement->execute();

            if ($statement) {
                $uploadStatusMsg = "Project uploaded succesfully";
                header("Location: studio.php?page=text");
            } else {
                $uploadStatusMsg = "Er is iets misgegaan, probeer het opnieuw.";
            }
        }


        public static function createThumbnail($url, $filename, $width = 150, $height = true) {
            $conn = DB::getConnection();
            $statement = $conn->prepare("SELECT * FROM content");
            $statement->execute();
            $videos = $statement->fetch();
            
            if($videos) {
                $url = $videos['url'];
                $filename = $videos['title'];
    
                // download and create gd image
                $image = ImageCreateFromString($url);
                // calculate resized ratio
                // Note: if $height is set to TRUE then we automatically calculate the height based on the ratio
                $height = $height === true ? (ImageSY($image) * $width / ImageSX($image)) : $height;
            
                // create image 
                $output = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($output, $image, 0, 0, 0, 0, $width, $height, ImageSX($image), ImageSY($image));
            
                // save image
                ImageJPEG($output, $filename, 95); 
            
                // return resized image
                return $output; // if you need to use it


                $connUp = DB::getConnection();
                $statementUp = $connUp->prepare("UPDATE content SET cover_img = :thumbnail WHERE title = :title");
                $statementUp->bindValue(':thumbnail', $output);
                $statementUp->bindValue(':title', $filename);
                $statementUp->execute();
                return $thumb = $statementUp->fetch();
            }
        }
    }