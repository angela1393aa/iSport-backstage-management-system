<?php
class VideoProcessor {

    private $con;
    private $sizeLimit = 500000000; // 500MB
    /// private $allowedType = array("mp4"); // 直接在js做////////////
    private $ffmpegPath;
    private $ffprobePath;
    //= "ffmpeg/bin/ffprobe.exe";
    //= "ffmpeg/bin/ffmpeg.exe";

    public function __construct($con) {
        $this->con = $con;

        $this->ffmpegPath = realpath("ffmpeg/bin/ffmpeg.exe");
        $this->ffprobePath = realpath("ffmpeg/bin/ffprobe.exe");

    }

    public function uploadVideoFile($videoUploadData) {
        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        // var_dump($videoData);

        $finalFilePath = $targetDir . uniqid() . ".mp4";
        $finalFilePath = str_replace(" ", "_", $finalFilePath);
        // var_dump($finalFilePath);


        $isValidData = $this->processData($videoData, $finalFilePath);
        if(!$isValidData) {
            return false;
        }

        if(move_uploaded_file($videoData['tmp_name'], $finalFilePath)) {
            //If you upload file, it get store on a temporary space

            if(!$this->insertVideoData($videoUploadData, $finalFilePath)) {
                echo "Insert query fialed!";
                return false;
            }

            if(!$this->generateThumbnails($finalFilePath)) {
                echo "Generate failed!";
                return false;
            }
            return true;
        } 
    }

    private function processData($videoData, $filePath) {
        $videoType = pathinfo($filePath, PATHINFO_EXTENSION);

        if(!$this->isValidSize($videoData)) {
            echo "File too large.";
            return false;
            ///////////////////////////////////Need more info//////////////////////////
        }

        if($this->hasError($videoData)) {
            echo "Error code:" . $videoData['error'];
            return false;
        }
        return true;
    }

    private function isValidSize($data) {
        return $data['size'] <= $this->sizeLimit;
        //The size of the data has to smaller than the limit size (500MB)
    }

    private function hasError($data) {
        return $data['error'] != 0;
        //If there is any error, the number will be 1
    }

    private function insertVideoData($uploadData, $filePath) {
        $query = $this->con->prepare("INSERT INTO video_file(title, filePath, description, category) 
                                        VALUES (:title, :filePath, :description, :category)");
        
        $title = $uploadData->title;
        $filePath = $filePath;
        $description = $uploadData->description;
        $category = $uploadData->category;

        $query->bindParam(":title", $title);
        $query->bindParam(":filePath", $filePath);
        $query->bindParam(":description", $description);
        $query->bindParam(":category", $category);

        return $query->execute();
    }

    private function generateThumbnails($filePath) {

        $thumbnailSize = "210x118";
        $numThumbnails = 3;
        $pathToThumbnails = "uploads/videos/thumbnails";

        $duration = $this->getVideoDuration($filePath);
        $videoId = $this->con->lastInsertId();
        //lastInsertId() will return id
        if(!$this->updateDuration($duration, $videoId)) {
                echo "Update duration failed!";
                return false;
            }

        for($num = 1; $num <=$numThumbnails; $num++) {
            $imageName = uniqid() . ".jpg";
            $interval = ($duration * 0.8) / $numThumbnails * $num;

            $fullThumbnailPath = "$pathToThumbnails/$videoId-$imageName";

            $cmd = "$this->ffmpegPath -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $fullThumbnailPath 2>&1";

            $outputLog = array();
            exec($cmd, $outputLog, $returnCode);

            if($returnCode != 0) {
                foreach($outputLog as $line) {
                    echo $line . "<br>";
                    return false;
                }
            }
            $query = $this->con->prepare("INSERT INTO video_file_thumbnails(videoId, filePath, selected)
                                        VALUES(:videoId, :filePath, :selected)");
            $query->bindParam(":videoId", $videoId);
            $query->bindParam(":filePath", $fullThumbnailPath);
            $query->bindParam(":selected", $selected);
            $selected = ($num == 1) ? 1 : 0;

            $success = $query->execute();
            //Make sure it doesn't return once so we create variable
            if(!$success) {
                echo "Error inserting thumbnail\n";
                return false;
            }
        }
        return true;
    }

    private function getVideoDuration($filePath) {
        return (int)shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
        //This will only return output
        //Put (int) to make sure it's integer
    }

    private function updateDuration($duration, $videoId) {
        ///////////////////////////////////// Executed inside "generateThumbnail()"//////////////////
        $hours = floor($duration / 3600);
        $mins = floor(($duration - $hours * 3600) / 60);
        $secs = floor($duration % 60);

        $hours = ($hours < 1) ? "" : $hours . ":";
        $mins = ($mins < 10) ? "0" . $mins . ":" : $mins . ":";
        $secs = ($secs < 10) ? "0" . $secs : $secs;

        $duration = $hours . $mins . $secs;

        $query = $this->con->prepare("UPDATE video_file SET duration=:duration WHERE id=:videoId");
        $query->bindParam(":duration", $duration);
        $query->bindParam(":videoId", $videoId);
        $query->execute();
        if(!$query) {
            return false;
        } else {
            return true;
        }
    }
}

?>