<?php
class VideoUploadData {

    public $title, $videoDataArray, $description, $category;

    public function __construct($title, $videoDataArray, $description, $category) {
        $this->title = trim($title);
        $this->videoDataArray = $videoDataArray;
        $this->description = trim($description);
        $this->category = $category;
    }

}
?>