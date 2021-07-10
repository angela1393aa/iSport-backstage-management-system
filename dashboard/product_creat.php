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
          <form class="product-creat-form" action="#" method="get" enctype="multipart/form-data">
            <div class="row p-1 justify-content-center">
              <div class="col-12 mb-3">
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
                    <input list="brandList" name="myBrand" placeholder="請選擇品牌"></label>
                    <datalist id="brandList">
                    </datalist>
                  </div>
                  <div class="col-3">
                    <label class="x_content h6">
                      <span class="text-danger">*</span>分類
                    </label>
                    <select name="" id="categoryList">
                      <option value="0">選擇分類</option>
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
                  </div>
                  <div class="d-flex col-12 row py-3 mx-2 my-1 type-config shadow-sm typeList" data-type="1">
                    <select class="col-1 mr-2 bg-transparent typeListSelect" name="" id="">
                      <option value="0">規格種類</option>
                    </select>
                    <input class="col-1 bg-transparent typeInput" type="text" placeholder="ex:粉紅色">
                    <a class="addBtn btn btn-success text-white p-0 my-0 mx-1 typeListAdd" id="">+</a>
                  </div>
                  <div class="d-flex col-12 row py-3 mx-2 my-1 type-config shadow-sm typeList" data-type="2">
                    <select class="col-1 mr-2 bg-transparent typeListSelect" name="" id="typeList">
                      <option value="0">規格種類</option>
                    </select>
                    <input class="col-1 bg-transparent typeInput" type="text" placeholder="ex: XL">
                    <a class="addBtn btn btn-success text-white p-0 my-0 mx-1 typeListAdd" id="">+</a>
                  </div>
                </div>
                <hr>
                <div class="row" id="addItem">
                  <div class="d-flex col-12 align-items-center mb-2">
                    <label class=" h6 flex-grow-1">
                      <span class="text-danger">*</span>新增單品
                    </label>
                    <span class="mx-2">可以添加1項單品</span>
                    <a class="addBtn btn btn-success text-white p-0 m-0" data-toggle="tooltip" data-placement="bottom" title="新增單品" id="addItemBtn">+</a>
                  </div>
                  <div class="itemInput d-flex col-12 row py-3 mx-2 type-config shadow-sm my-1">
                    <label class="text-body" for="">規格：</label>
                    <select class="col-2 mr-2 bg-transparent newSkuTypeList" name="" id="newSkuTypeList">
                      <option value="0">無</option>
                    </select>
                    <label class="col-auto text-right text-body ml-3" for="">貨號：</label>
                    <input class="col-3 bg-transparent" type="text" placeholder="">
                    <label class="col-auto text-right text-body ml-3" for="">價格：</label>
                    <input class="col-1 bg-transparent" type="text" placeholder="">
                    <label class="col-auto text-right text-body ml-3" for="">數量：</label>
                    <input class="col-1 bg-transparent" type="text" placeholder="">
                  </div>
                </div>
              </div>

              <div class="col-12 mb-3">
                <hr>
                <div class="x_content h5">
                  圖片上傳
                </div>
                <p>上傳商品圖片：至少一張最多11張，第一張做為主要圖片</p>
                <div class="mb-2 row">
                  <span class="text-danger">*</span><label for="">選擇檔案</label>
                  <input class="" id="productPhotoUpload" type="file" name="file" accept="image/gif, image/jpeg, image/png" multiple />
                </div>
                <div class="photoUpload row" id="previewPhoto">
                  <p>目前沒有圖片</p>
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
                <button class="btn btn-success mt-3 w-50" id="submitBtn">送出</button>
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