<?php
class VideoFormProvider {

    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function createUploadFileForm() {
        $titleInput = $this->createTitleInput();
        $videoFileInput = $this->createVideoFileInput();
        $descriptionInput = $this->createDescriptionInput();
        $categoriesInput = $this->createCategoriesInput();
        $uploadButton = $this->createUploadButton();

        return "<form id='uploadForm' data-parsley-validate class='form-horizontal form-label-left uploadFileForm'
                  action='uploadProcessing.php' method='POST' enctype='multipart/form-data'>
                    $titleInput
                    $videoFileInput
                    $descriptionInput
                    $categoriesInput
                    $uploadButton
                </form>";
    }

    public function createUpdateFileForm() {
        $titleInput = $this->createTitleInput();
        $videoFileInput = $this->createVideoFileInput();
        $descriptionInput = $this->createDescriptionInput();
        $categoriesInput = $this->createCategoriesInput();
        $deleteButton = $this->createDeleteButton();

        return "<form id='updateForm' data-parsley-validate class='form-horizontal form-label-left uploadFileForm'
                  action='' method='POST' enctype='multipart/form-data'>
                    $titleInput
                    $videoFileInput
                    $descriptionInput
                    $categoriesInput
                    $deleteButton
                </form>";
    }

    private function createTitleInput() {
        return "<div class='item form-group'>
					<label class='col-form-label col-md-2 col-sm-2 label-align' for='titleInput'>
                        <span class='required'>*</span>
                          影片標題：
                        </label>
					<div class='col-md-9 col-sm-9'>
                        <input type='text' id='titleInput' required='required' class='form-control' autocomplete='off' name='titleInput'>
                    </div>
                </div>";
    }

    private function createVideoFileInput() {
        return "<div class='item form-group' id='fileInputContainer'>
                    <label for='fileInput' class='col-md-9 col-sm-9 offset-md-2 offset-sm-2 forFileInput'></label>
                    <label class='col-form-label col-md-2 col-sm-2 label-align'>
                        <span class='required'>*</span>
                        影片檔案上傳：
                    </label>
                    <div class='col-md-9 col-sm-9' style='width: 100%;'>
                        <input class='form-control' type='file' id='fileInput' name='fileInput' required='required' accept='video/mp4' style='display: none;'>
                        <div id='videoPreview'>
                            <video src='' alt='Video Preview' class='video-preview__video' width='100%' loop muted></video>
                            <img class='video-preview__default-image' src='images/upload.png' alt='Click to Upload'>
                            <span class='video-preview__default-text'>點擊或拖移MP4檔案上傳</span>
                        </div>
                    </div>
                </div>";
    }
    
    private function createDescriptionInput() {
        return "<div class='item form-group'>
                    <label for='descriptionInput' class='col-form-label col-md-2 col-sm-2 label-align'>
                        <span class='required'>*</span>
                        影片說明：
                    </label>
                    <div class='col-md-9 col-sm-9'>
                        <textarea id='descriptionInput' required='required' class='form-control' name='descriptionInput'
                        ></textarea>
                    </div>
                </div>";
    }

    private function createCategoriesInput() {

        $query = $this->con->prepare("SELECT * FROM category");
        $query->execute();

        $html = "<div class='item form-group'>
                    <label class='col-form-label col-md-2 col-sm-2 label-align'>
                        <span class='required'>*</span>
                        分類：
                    </label>
                <div class='col-md-9 col-sm-9 '>
                    <select class='form-control' required='required' name='categoryInput'>";

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $name = $row['name'];
            $id = $row['id'];

            $html.= "<option value='none' disabled hidden>
                        請選擇影片分類
                    </option>
                    <option value='$id' class='categoryInput'>$name</option>";
        }
        
        $html .= "</select></div></div>";
        return $html;
    }

    private function createUploadButton() { // onclick='uploadVideo()'
        return "<div class='item form-group'>
                    <div class='col-md-2 col-sm-2 offset-md-2'>
                        <button type='submit' class='btn btn-primary' name='uploadBtn'>上傳</button>
                        <button class='btn btn-secondary' type='button' onclick='location.href=\"showVideoList.php\"'>取消</button>
                    </div>
                </div>";
    }

    private function createDeleteButton() {  // onclick='updateVideo()'
        return "<div class='item form-group'>
                    <div class='col-md-3 col-sm-3 offset-md-2'>
                        <button type='button' class='btn btn-primary' name='uploadBtn' onclick='updateVideo()'>更新</button>
                        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'>
						    刪除
					    </button>
                        <button class='btn btn-secondary' type='button' onclick='location.href=\"showVideoList.php\"'>取消</button>
                    </div>
                </div>
        ";
    }

}

?>