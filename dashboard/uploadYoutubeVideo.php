<?php
// $bootstrapLink = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css";
$title = "上傳Youtube影片";
require_once("includes/header.php");

?>

      <div class="right_col" role="main">
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
									<!-- <br /> -->

								<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                  action="uploadProcessing.php" method="POST" enctype="multipart/form-data">


				  					<div class="item form-group">
					<label class="col-form-label col-md-2 col-sm-2 label-align" for="first-name">
                        <span class="required">*</span>
                          影片標題：
                        </label>
					<div class="col-md-9 col-sm-9">
                        <input type="text" id="first-name" required="required" class="form-control" autocomplete="off" name="titleInput">
                    </div>
                </div>

				<div class="item form-group">
					<label class="col-form-label col-md-2 col-sm-2 label-align" for="first-name">
                        <span class="required">*</span>
                          影片連結：
                        </label>
					<div class="col-md-9 col-sm-9">
                        <input type="text" id="first-name" required="required" class="form-control" autocomplete="off" name="titleInput">
                    </div>
                </div>

				<div class="item form-group">
                    <label for="description" class="col-form-label col-md-2 col-sm-2 label-align">
                        <span class="required">*</span>
                        影片說明：
                    </label>
                    <div class="col-md-9 col-sm-9">
                        <textarea id="description" required="required" class="form-control" name="descriptionInput"
                        ></textarea>
                    </div>
                </div>

				<div class="item form-group">
                    <label class="col-form-label col-md-2 col-sm-2 label-align">
                        <span class="required">*</span>
                        分類：
                    </label>
                <div class="col-md-9 col-sm-9 ">
                    <select class="form-control" required="required" name="categoryInput">
						<option value='none' selected disabled hidden>
                        請選擇影片分類
                    </option>
                    <option value='1'>有氧</option>
                    <option value='2'>重訓</option>
                    <option value='3'>tabata</option>
                    <option value='4'>核心</option>
                    <option value='5'>飲食</option>
					</select>
				</div>
			</div>

<div class="item form-group">
                    <div class="col-md-2 col-sm-2 offset-md-2">
                        <button type="submit" class="btn btn-success" name="uploadButton">上傳</button>
                        <button class="btn btn-danger" type="button">取消</button>
                    </div>
                </div>

								</form>
								</div>
							</div>
						</div>
					</div>
      </div>
      <!-- page content -->
<!--/////////////popup-modal/////////////////////////popup-modal//////////////////////////popup-modal/////////////////-->



<?php require_once("includes/footer.php"); ?>