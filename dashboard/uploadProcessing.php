<?php
$title = "上傳影片";
require_once("includes/header.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/VideoProcessor.php");

if(!isset($_POST['uploadBtn'])) {
  	echo "<script> location.href='uploadVideoFile.php';
			</script>";
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
    echo "<script> location.href='showVideoList.php?show_popup=true';
			</script>";
    exit;
}
?>

<?php require_once("includes/footer.php"); ?>