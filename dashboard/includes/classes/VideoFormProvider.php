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
        $videoFileDisplay = $this->createVideoFileDisplay();
        $thumbnailInput = $this->createThumbnailInput();
        $titleInput = $this->createTitleInput();
        $descriptionInput = $this->createDescriptionInput();
        $categoriesInput = $this->createCategoriesInput();
        $deleteButton = $this->createDeleteButton();

        return "<form id='updateForm' data-parsley-validate class='form-horizontal form-label-left uploadFileForm'
                        action='' method='POST' enctype='multipart/form-data'>
                    $videoFileDisplay
                    $thumbnailInput
                    $titleInput
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
					<div class='col-md-9 col-sm-9 position-relative'>
                        <input type='text' id='titleInput' required='required' class='form-control' autocomplete='off' name='titleInput'>
                        <i class='fas fa-times-circle position-absolute' id='titleInvalid' style='top: 10px; right: 22px; font-size: 20px; color: #9d0208; display: none'></i>
                        <i class='fas fa-check-circle position-absolute' id='titleValid' style='top: 10px; right: 22px; font-size: 20px; color: #52b69a; display: none'></i>
                        <h4 class='position-absolute' id='titleInvalidMessage' style='top: 10px; right: 48px; color: #9d0208; display: none; font-weight: 400;'>標題需介於5～40字</h4>
                    </div>
                </div>";
    }

    private function createVideoFileInput() {
        return "<div class='item form-group' id='fileInputContainer'>
                    <label for='fileInput' class='col-md-9 col-sm-9 offset-md-2 offset-sm-2 forFileInput'></label>
                    <label class='col-form-label col-md-2 col-sm-2 label-align'>
                        <span class='required'>*</span>
                        影片檔案：
                    </label>
                    <div class='col-md-9 col-sm-9' style='width: 100%;'>
                        <input class='form-control' type='file' id='fileInput' name='fileInput' required='required' accept='video/mp4' style='display: none;'>
                        <div id='videoPreview' data-value='false'>
                            <video src='' alt='Video Preview' class='video-preview__video' width='100%' loop muted></video>
                            <img class='video-preview__default-image' src='images/upload.png' alt='Click to Upload'>
                            <span class='video-preview__default-text'>點擊或拖移MP4檔案上傳</span>
                            <span class='video-preview__default-warning'>檔案類型錯誤</span>
                            <span class='video-preview__default-necessary'>請上傳影片檔案</span>
                        </div>
                    </div>
                </div>";
    }

    private function createVideoFileDisplay() {
        return "<div class='item form-group' id='fileInputContainer'>
                    <label class='col-form-label col-md-2 col-sm-2 label-align'>
                    </label>
                    <div class='col-md-9 col-sm-9 d-flex justify-content-center mb-3' style='width: 100%;'>
                        <video src='' alt='Video Preview' class='video-preview__video' width='70%' controls  controlsList='nodownload' muted></video>
                    </div>
                </div>";
    }

    private function createThumbnailInput() {
        return "<div class='item form-group' id='thumbnailInputContainer'>
                    <label class='col-form-label col-md-2 col-sm-2 label-align'>
                        <span class='required'>*</span>
                        影片縮圖：
                    </label>
                    <div class='col-md-9 col-sm-9'>
                        <div class='thumbnailsContainer'>
                            <div class='col-md-4 col-sm-4' id='selectedThumbnailContainer'>
                                <img src='' alt='Thumbnail Image-selected' id='selectedThumbnailPreview' data-id=''>
                            </div>
                            <div class='col-md-8 col-sm-8' id='thumbnails'>
                                <span style='width: 100%'>點擊變更縮圖</span>
                                <img src='' alt='Thumbnail Image-1' id='thumbnailImage-1' class='thumbnailImage-img thumbnailImage-img-1' data-id=''>
                                <img src='' alt='Thumbnail Image-2' id='thumbnailImage-2' class='thumbnailImage-img thumbnailImage-img-2' data-id=''>
                                <img src='' alt='Thumbnail Image-3' id='thumbnailImage-3' class='thumbnailImage-img thumbnailImage-img-3' data-id=''>
                            </div>
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
                        <textarea id='descriptionInput' required='required' class='form-control position-relative' name='descriptionInput'
                        ></textarea>
                        <i class='fas fa-times-circle position-absolute' id='descriptionInvalid' style='top: 98px; right: 22px; font-size: 20px; color: #9d0208; display: none'></i>
                        <i class='fas fa-check-circle position-absolute' id='descriptionValid' style='top: 98px; right: 22px; font-size: 20px; color: #52b69a; display: none'></i>
                        <h4 class='position-absolute' id='descriptionInvalidMessage' style='top: 99px; right: 48px; color: #9d0208; display: none; font-weight: 400;'>影片說明需介於10～200字</h4>
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
                        <button type='submit' class='btn btn-primary' name='uploadBtn' id='uploadBtn' disabled>上傳</button>
                        <button class='btn btn-secondary' type='button' onclick='location.href=\"showVideoList.php\"'>取消</button>
                    </div>
                </div>";
    }

    private function createDeleteButton() {  // onclick='updateVideo()'
        return "<div class='item form-group'>
                    <div class='col-md-3 col-sm-3 offset-md-2'>
                        <button type='button' class='btn btn-primary' name='updateBtn'  id='updateBtn' onclick='updateVideo()'>更新</button>
                        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#exampleModalCenter'>
						    刪除
					    </button>
                        <button class='btn btn-secondary' type='button' onclick='location.href=\"showVideoList.php\"'>回列表</button>
                    </div>
                </div>
        ";
    }

}

?>