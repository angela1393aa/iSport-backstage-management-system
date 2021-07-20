<?php
$bootstrapLink = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css";
$title = "影片上傳";
$style = "uploadVideo.css";
$js = "uploadVideo.js";
require_once("includes/header.php");
require_once("includes/classes/VideoFormProvider.php");

?>

<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>影片上傳</h3>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
				<div class="x_title">
					<h2>上傳內容</h2>
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
<!--/////////////popup-modal/////////////////////////popup-modal//////////////////////////popup-modal///////////////// -->
<div class="modal fade bs-example-modal-lg" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content loadingModal">
            <div class="modal-body">
                <h3 class="text-dark">影片上傳中</h3>
                <img src="images/Bars-2s.gif" alt="Loading...">
            </div>
        </div>
    </div>
</div>

<?php require_once("includes/footer.php"); ?>
