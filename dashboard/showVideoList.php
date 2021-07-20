<?php
// $bootstrapLink = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css";
$title = "影片列表";
$style = "uploadVideo.css";
$js = "showVideoList.js";
require_once("includes/header.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/VideoTableProvider.php");

?>

<!-- page content -->
<!-- For popup -->
<div class='<?php
if(isset($_GET['show_popup'])){
	if($_GET['show_popup'] == 'true'){
		echo 'show-popup';
	}
}?>'></div>
<!-- For popup -->

<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
			<h3>影片管理</h3>
		</div>
		<div class="title_right">
			<?php
				$videoTable = new VideoTableProvider();
				echo $videoTable->createSearchInput();
			?>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="row">
		<div class="col-md-12 col-sm-12 ">
			<div class="x_panel">
                    <div class="x_title titleLine">
                        <h2 style="float: none;">影片列表</h2>
						<span class="text-dark" id="totalVideos"></span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content d-flex flex-column">
						<h6 class="text-muted" style="font-weight: 400; font-size: 15px;">點擊影片檢視或編輯</h6>
                        <div class="d-flex py-2 align-items-center justify-content-end">

							<?php
								echo $videoTable->createRowCountSelect();
							?>
							<?php
								echo $videoTable->createSelect();
							?>
                        </div>

                        <?php
							echo $videoTable->createTable();
						?>

						<nav aria-label="Page navigation example">
							<ul class="pagination" id="pagination">
								
							</ul>
						</nav>
				</div>
			</div>
		</div>
	</div>
</div>

						
<!-- page content -->
<!-- Upload Successful Popup -->
<?php
	echo $videoTable->createUploadSuccessMessage();
?>


<?php require_once("includes/footer.php"); ?>
