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

        return "<form id='demo-form2' data-parsley-validate class='form-horizontal form-label-left'
                  action='uploadProcessing.php' method='POST' enctype='multipart/form-data'>
                    $titleInput
                    $videoFileInput
                    $descriptionInput
                    $categoriesInput
                    $uploadButton
                </form>";
    }

    // public function createUploadLinkForm() {
    //     $titleInput = $this->createTitleInput();
    //     $videoLinkInput = $this->createVideoLinkInput();
    //     $descriptionInput = $this->createDescriptionInput();
    //     $categoriesInput = $this->createCategoriesInput();
    //     $uploadButton = $this->createUploadButton();

    //     return "<form id='demo-form2' data-parsley-validate class='form-horizontal form-label-left'
    //               action='uploadProcessing.php' method='POST' enctype='multipart/form-data'>
    //                 $titleInput
    //                 $videoLinkInput
    //                 $descriptionInput
    //                 $categoriesInput
    //                 $uploadButton
    //             </form>";
    // }

    private function createTitleInput() {
        return "<div class='item form-group'>
					<label class='col-form-label col-md-2 col-sm-2 label-align' for='first-name'>
                        <span class='required'>*</span>
                          影片標題：
                        </label>
					<div class='col-md-9 col-sm-9'>
                        <input type='text' id='first-name' required='required' class='form-control' autocomplete='off' name='titleInput'>
                    </div>
                </div>";
    }

    private function createVideoFileInput() {
        return "<div class='item form-group'>
                    <label for='formFile' class='col-form-label col-md-2 col-sm-2 label-align'>
                        <span class='required'>*</span>
                        影片檔案上傳：
                    </label>
                    <div class='col-md-9 col-sm-9'>
                        <input class='form-control' type='file' id='formFile' name='fileInput' style='height: 100%;' required='required'>
                    </div>
                </div>";
    }

    // private function createVideoLinkInput() {
    //     return "<div class='item form-group'>
	// 				<label class='col-form-label col-md-2 col-sm-2 label-align' for='first-name'>
    //                     <span class='required'>*</span>
    //                       影片連結：
    //                     </label>
	// 				<div class='col-md-9 col-sm-9'>
    //                     <input type='text' id='first-name' required='required' class='form-control' autocomplete='off' name='titleInput'>
    //                 </div>
    //             </div>";
    // }
    
    private function createDescriptionInput() {
        return "<div class='item form-group'>
                    <label for='description' class='col-form-label col-md-2 col-sm-2 label-align'>
                        <span class='required'>*</span>
                        影片說明：
                    </label>
                    <div class='col-md-9 col-sm-9'>
                        <textarea id='description' required='required' class='form-control' name='descriptionInput'
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

            $html.= "<option value='none' selected disabled hidden>
                        請選擇影片分類
                    </option>
                    <option value='$id'>$name</option>";
        }
        
        $html .= "</select></div></div>";
        return $html;
    }

    private function createUploadButton() {
        return "<div class='item form-group'>
                    <div class='col-md-2 col-sm-2 offset-md-2'>
                        <button type='submit' class='btn btn-success' name='uploadBtn'>上傳</button>
                        <button class='btn btn-danger' type='button'>取消</button>
                    </div>
                </div>";
    }

}

?>