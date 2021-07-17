<?php
$bootstrapLink = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css";
$title = "編輯影片";
$style = "uploadVideo.css";
$js = "showVideo.js";
require_once("includes/header.php");
require_once("includes/classes/VideoFormProvider.php");

if(!isset($_GET['id'])) {
	exit("找不到資料");
}

?>

<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>編輯影片</h3>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
				<div class="x_title">
					<h2>影片內容</h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

					<?php
						$formProvider = new VideoFormProvider($db_host);
						echo $formProvider->createUpdateFileForm();
					?>


				</div>
			</div>
		</div>
	</div>
</div>



      <!-- page content -->
<!--/////////////popup-modal/////////////////////////popup-modal//////////////////////////popup-modal/////////////////-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content warningModal">
			<div class="modal-header warning">
				<h3 class="modal-title text-dark h3-warning" id="exampleModalLongTitle">確定要刪除影片嗎？</h3>
				<button type="button" class="close sp-warning" data-dismiss="modal" aria-label="Close">
					<span class="" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-header success">
				<h3 class="modal-title text-dark" id="exampleModalLongTitle">刪除成功</h3>
			</div>
			<div class="modal-body warning">
				<img class="img-warning" src="images/warning.png" alt="Warning!">
				<h5 class="text-dark h5-warning">此舉將不可回復，確定要刪除影片？</h5>
			</div>
			<div class="modal-body success">
				<img src="images/success.png" alt="Success!">
				<h5 class="text-dark">刪除已完成！</h5>
			</div>
			<div class="modal-footer warning">
				<button type="button" class="btn btn-primary botton-warning" data-dismiss="modal">先不要</button>
				<button type="button" class="btn btn-secondary" onclick="deleteVideo()">確定</button>
			</div>
			<div class="modal-footer success">
				<button type="button" class="btn btn-primary" onclick="location.href='showVideoList.php'">完成</button>
			</div>
		</div>
	</div>
</div>


<?php require_once("includes/footer.php"); ?>