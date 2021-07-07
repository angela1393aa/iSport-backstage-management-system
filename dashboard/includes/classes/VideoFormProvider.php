<?php
class VideoFormProvider {

    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function createUploadForm() {
        $titleInput = $this->createTitleInput();
        $videoFileInput = $this->createVideoFileInput();
        $descriptionInput = $this->createDescriptionInput();
        $categoryInput = $this->createCategoryInput();
        $userUploadInput = $this->createUserUploadInput();
        $uploadButton = $this->createUploadButton();

        return "<form action='uploadProcessing.php' method='POST' enctype='multipart/form-data'>
                    $titleInput
                    $videoFileInput
                    $descriptionInput
                    $categoryInput
                    $userUploadInput
                    $uploadButton
                </form>";
    }

    private function createTitleInput() {
        
    }

}

?>