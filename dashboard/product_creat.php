<?php
$title = '新增商品';
$style = 'product-creat.css';
$js = 'productCreate.js';
require_once("includes/header.php");
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>商品管理</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>新增商品</h2>
            <div class="clearfix"></div>
          </div>
          <form class="product-creat-form" action="#" method="post">
            <div class="row p-1 justify-content-center">
              <div class="col-6">
                <div class="row">
                  <div class="x_content h5">
                    商品資訊
                  </div>
                  <div class="col-6">
                    <label class="x_content h6">
                      <span class="text-danger">*</span> 商品名稱
                    </label>
                    <input type="text">
                  </div>
                  <div class="col-3">
                    <label class="x_content h6">
                      品牌
                    </label>
                    <input list="browsers" name="myBrowser" placeholder="請選擇品牌"></label>
                    <datalist id="browsers">
                      <option value="Chrome">
                      <option value="Firefox">
                      <option value="Internet Explorer">
                      <option value="Opera">
                      <option value="Safari">
                    </datalist>
                    <!-- <select name="" id="">
                      <option value="">1</option>
                      <option value="">2</option>
                      <option value="">3</option>
                    </select> -->
                  </div>
                  <div class="col-3">
                    <label class="x_content h6">
                      <span class="text-danger">*</span>分類
                    </label>
                    <select name="" id="">
                      <option value="">選擇分類</option>
                      <option value="">2</option>
                      <option value="">3</option>
                    </select>
                  </div>
                </div>
                <div class="product-creat-alert"></div>
                <hr>
                <div class="row">
                  <div class="d-flex col-12 align-items-center mb-2">
                    <label class="x_content h6">
                      規格設定
                    </label>
                    <a class="addBtn btn btn-success text-white p-0 m-0" data-toggle="tooltip" data-placement="left" title="新增規格">+</a>
                  </div>
                  <div class="d-flex col-12 row py-3 mx-2 type-config shadow-sm">
                    <select class="col-2 mr-2 bg-transparent" name="" id="">
                      <option value="">顏色</option>
                      <option value="">2</option>
                      <option value="">3</option>
                    </select>
                    <input class="col-2 bg-transparent" type="text" placeholder="ex:粉紅色">
                    <a class="addBtn btn btn-success text-white p-0 m-0">+</a>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="d-flex col-12 align-items-center mb-2">
                    <label class="x_content h6">
                      <span class="text-danger">*</span>新增單品
                    </label>
                    <a class="addBtn btn btn-success text-white p-0 m-0" data-toggle="tooltip" data-placement="left" title="新增單品">+</a>
                  </div>
                  <div class="d-flex col-12 row py-3 mx-2 type-config shadow-sm">
                    <select class="col-3 mr-2 bg-transparent" name="" id="">
                      <option value="">請選擇規格</option>
                      <option value="">2</option>
                      <option value="">3</option>
                    </select>
                    <label class="col-auto text-right text-body" for="">貨號：</label>
                    <input class="col-3 bg-transparent" type="text" placeholder="">
                    <label class="col-auto text-right text-body" for="">價格：</label>
                    <input class="col-1 bg-transparent" type="text" placeholder="">
                    <label class="col-auto text-right text-body" for="">數量：</label>
                    <input class="col-1 bg-transparent" type="text" placeholder="">
                  </div>
                </div>
              </div>
              <div class="col-6 pl-5">
                <div class="x_content h5">
                  圖片上傳
                </div>
                <p>上傳商品圖片：至少一張最多11張，第一張做為主要圖片</p>

                <div class="mb-2 row">
                  <span class="text-danger">*</span><label for="">選擇檔案</label>
                  <input class="" type="file" name="file">
                </div>

                <div class="photoUpload row">
                  <figure class="ratio ratio-1x1  col-4">
                    <img class="d-block" src="../db_img/1001-1.png" alt="">
                  </figure>
                </div>

              </div>

              <div class="col-12">
                <hr>
                <div class="x_content h6">
                  商品簡介
                </div>
                <p>簡介撰寫：可以不填寫，可以使用文字或上傳圖片。</p>
                <textarea name="" id="" cols="30" rows="10" class="scrollbar"></textarea>
              </div>
              <div class="col-4 justify-conten-center text-center">
                <button class="btn btn-success mt-3 w-50">送出</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->




<?php require_once("includes/footer.php"); ?>