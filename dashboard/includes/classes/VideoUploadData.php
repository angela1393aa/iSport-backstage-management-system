<?php
class VideoUploadData {

    public $title, $videoDataArray, $description, $category;

    public function __construct($title, $videoDataArray, $description, $category) {
        $this->title = $title;
        $this->videoDataArray = $videoDataArray;
        $this->description = $description;
        $this->category = $category;
    }

}
?>