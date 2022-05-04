<?php

use LDAP\Result;

    Abstract class Content {

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