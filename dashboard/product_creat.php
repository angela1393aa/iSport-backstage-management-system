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
          <div class="x_title d-flex justify-content-between">
            <h2>新增商品</h2>
            <a class="btn btn-dark text-nowrap m-0 border-0 text-white" style="border-radius:5px; font-size:14px" href="product_list_sku.php" type="submit">回商品列表</a>
          </div>
          <form class="product-creat-form" action="productCreate.php" method="post" enctype="multipart/form-data">
            <div class="row p-1 justify-content-center">
              <div class="col-12 mb-3">
                <div class="row">
                  <div class="x_content h5">
                    商品資訊
                  </div>
                  <div class="col-6">
                    <label class="x_content h6 d-flex">
                      <span class="text-danger p-0">*</span> 商品名稱<span class="text-right flex-grow-1 align-self-right" id="productNameCount">0/100</span>
                    </label>
                    <input type="text" name="productName" id="productName">
                  </div>
                  <div class="col-3">
                    <label class="x_content h6 d-flex justify-content-between">
                      品牌 <p id="brandAlert" class="text-danger m-0"></p>
                    </label>
                    <input list="brandList" name="brand" id="brand" placeholder="請選擇品牌"></label>
                    <datalist id="brandList">
                    </datalist>
                  </div>
                  <div class="col-3">
                    <label class="x_content h6">
                      <span class="text-danger">*</span>分類
                    </label>
                    <select name="category" id="categoryList">
                      <option value="">選擇分類</option>
                    </select>
                  </div>
                </div>
                <div class="product-creat-alert"></div>
                <hr>
                <div class="row">
                  <div class="row col-12 align-items-center mb-2">
                    <label class="x_content h6 col-auto">
                      規格設定
                    </label>
                    <select name="" id="typeConfig" class="col-1">
                      <option value="0">無規格</option>
                      <option value="1">有規格</option>
                    </select>
                  </div>
                  <div class="d-flex col-12 row py-3 mx-2 my-1 type-config shadow-sm typeList" data-type="1">
                    <select class="col-1 mr-2 bg-transparent typeListSelect" name="type[]" id="" disabled>
                      <option value="0">規格種類</option>
                    </select>
                    <input class="col-1 bg-transparent typeInput" type="text" placeholder="ex:粉紅色" name="typeValue1[]" readonly>
                    <a class="addBtn btn btn-success text-white p-0 my-0 mx-1 typeListAdd" id="">+</a>
                  </div>
                  <div class="d-flex col-12 row py-3 mx-2 my-1 type-config shadow-sm typeList" data-type="2">
                    <select class="col-1 mr-2 bg-transparent typeListSelect" name="type[]" id="" disabled>
                      <option value="0" >規格種類</option>
                    </select>
                    <input class="col-1 bg-transparent typeInput" type="text" placeholder="ex: XL" name="typeValue2[]" readonly>
                    <a class="addBtn btn btn-success text-white p-0 my-0 mx-1 typeListAdd" id="">+</a>
                  </div>
                </div>
                <hr>
                <div class="row" id="addItem">
                  <div class="d-flex col-12 align-items-center mb-2">
                    <label class=" h6 flex-grow-1">
                      <span class="text-danger">*</span>新增單品
                    </label>
                    <span id="addSkuAlert" class="text-danger"></span>
                    <span class="mx-2">可以添加1項單品</span>
                    <a class="addBtn btn btn-success text-white p-0 m-0" data-toggle="tooltip" data-placement="bottom" title="新增單品" id="addItemBtn">+</a>
                  </div>
                  <div class="itemInput d-flex col-12 row py-3 mx-2 type-config shadow-sm my-1">
                    <label class="text-body" for="">規格：</label>
                    <select class="col-2 mr-2 bg-transparent newSkuTypeList sku-group" id="newSkuTypeList" name="skuGroup[0]">
                      <option value="0">無</option>
                    </select>
                    <label class="col-auto text-right text-body ml-3" for="">貨號：</label>
                    <input class="col-3 bg-transparent sku-code" type="text" placeholder="" name="skuCode[0]">
                    <label class="col-auto text-right text-body ml-3" for="">價格：</label>
                    <input class="col-1 bg-transparent sku-price" type="text" placeholder="" name="skuPrice[0]">
                    <label class="col-auto text-right text-body ml-3" for="">數量：</label>
                    <input class="col-1 bg-transparent stock" type="text" placeholder="" name="stock[0]">
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
                  <input class="" id="productPhotoUpload" type="file" name="file[]" accept="image/gif, image/jpeg, image/png" multiple />
                </div>
                <div class="photoUpload row" id="previewPhoto">
                  <p>目前沒有圖片</p>
                </div>
              </div>

              <div class="col-12 row">
                
                <div class="x_content h6 col-12">
                  <hr>
                  商品簡介
                </div>
                <div class="d-flex justify-content-between p-0 col-12">
                  <p>簡介撰寫：可以不填寫,請使用文字。</p>
                  <p id="introInputCount">0/1000</p>
                </div>
                
                <textarea name="intro" cols="30" rows="10" class="scrollbar" id="introInput"></textarea>
              </div>
              <div class="submitAlert text-danger col-12 p-3">
              </div>
              <div class="col-4 justify-content-center text-center">
                <button class="btn btn-success m-0 w-50" id="submitBtn">送出</button>
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