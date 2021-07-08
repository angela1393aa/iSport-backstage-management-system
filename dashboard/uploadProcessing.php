<?php
$bootstrapLink = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css";
$title = "上傳影片";
$style = "uploadVideo";
require_once("includes/header.php");
require_once("includes/classes/VideoFormProvider.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST['uploadBtn'])) {
  echo "找不到資訊";
  exit();
}

// 1 - Create file upload data
$videoUploadData = new VideoUploadData(
                          $_POST['titleInput'],
                          $_FILES['fileInput'],
                          $_POST['descriptionInput'],
                          $_POST['categoryInput']
                        );
// 2 - Process video data (upload)
$videoProcessor = new VideoProcessor($db_host);
$wasUploaded = $videoProcessor->uploadVideoFile($videoUploadData);

if($wasUploaded) {
    echo "上傳完成";
}
?>

<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="page-title">
    <div class="title_left">
        <h3>上傳影片</h3>
    </div>
    </div>

    <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>上傳影片</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="#">Settings 1</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                  <?php  
                    $formProvider = new VideoFormProvider($db_host);
                    echo $formProvider->createUploadFileForm();
                  
                  ?>

                  
								</div>
							</div>
						</div>
					</div>
      </div>
      <!-- page content -->
<!--/////////////popup-modal/////////////////////////popup-modal//////////////////////////popup-modal/////////////////-->



<?php require_once("includes/footer.php"); ?>