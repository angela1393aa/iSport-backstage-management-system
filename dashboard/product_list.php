<?php
$title = '商品列表';
$style = 'product-list.css';
$js = 'productList.js';
require_once("includes/header.php");
?>

<div class="submit-mask">
    <div class="py-4 rounded">
        <div class="h3 h-auto text-center">確定更新商品資料嗎?</div>
        <p class="h-auto text-center text-danger">*若有包含刪除的資料，則無法復原被刪除的資料</p>
        <hr>
        <div class="text-center text-danger">
            <i class="fas fa-exclamation-circle"></i>
        </div>
        <hr>
        <div class="d-flex justify-content-end mx-3">
            <button type="button" class="btn btn-outline-info" id="cancelUpdate">取消更新</button>
            <button type="button" class="btn btn-info" id="confirmUpdate">確定更新</button>
        </div>
    </div>
</div>

<!-- page content -->
<div class="right_col" role="main">

    <!-- Extra large modal -->

    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="myModal">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productEditPageTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="productListUpdate.php" method="post" enctype="multipart/form-data" class="row p-2" >
                        <div class="col-12 p-3">
                            <div class="row">
                                <input type="hidden" name="productId" id="productId">
                                <div class="form-group col-7 p-0 pr-1">
                                    <label for="" class="m-1 h6">商品名稱</label>
                                    <input type="text" class="form-control " id="editProductName" name="editProductName">
                                </div>
                                <div class="col-3 p-0 pr-1">
                                    <label class="d-block" class="m-1 h6">品牌<span id="id"></span></label>
                                    <input type="text" name="editBrand" class="form-control" list="editBrandList" id="editBrand">
                                    <datalist id="editBrandList">
                                    </datalist>
                                </div>
                                <div class="col-2 p-0 pr-1">
                                    <label for="" class="m-1 h6">分類</label>
                                    <select name="editProductCategory" id="editProductCategory" class="form-control">

                                    </select>
                                </div>
                                <div class="col-12 p-0">
                                    <label for="">商品介紹</label>
                                    <textarea name="editProductIntro" id="editProductIntro" cols="30" rows="10" class="form-control"></textarea>
                                </div>
                            </div>

                            <h6 class="mt-3">規格</h6>
                            <hr>
                            <div class="" id="editProductTypeBlock">
                                <div class="row mt-2">
                                    <select name="editProductType1" id="editProductType1" class="form-control col-12 m-0 editProductType text-center" disabled>

                                    </select>

                                    <div class="row col-12 m-0 p-0" id="editProductTypeValue1"></div>
                                </div>
                                <div class="row mt-2">
                                    <select name="editProductType2" id="editProductType2" class="form-control col-12 m-0 editProductType" disabled>

                                    </select>
                                    <div class="row col-12 m-0 p-0" id="editProductTypeValue2"></div>
                                </div>
                            </div>



                            <h6 class="mt-3">商品圖片</h6>
                            <hr>
                            <div class="col-12">
                                <div class="row editProductImgBlock" id="editProductImgBlock">
                                </div>

                                <div class="mb-2 row">
                                    <span class="text-danger">*</span><label for="">選擇檔案</label>
                                    <input class="" id="productPhotoUpload" type="file" name="file[]" accept="image/gif, image/jpeg, image/png" multiple />
                                </div>

                            </div>
                            <h6 class="mt-3">單品</h6>
                            <hr>
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="col-3 px-2 py-3 text-center">規格</th>
                                                <th class="col-3 px-2 py-3 text-center">貨號</th>
                                                <th class="col-2 px-2 py-3 text-center">庫存</th>
                                                <th class="col-1 px-2 py-3 text-center">價格</th>
                                                <th class="col-2 px-2 py-3 text-center">狀態</th>
                                                <th class="col-1 px-2 py-3 text-center align-middle">刪除</th>
                                            </tr>
                                        </thead>
                                        <tbody id="productSkuEditTbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                    <button type="button" class="btn btn-success" id="submitUpdateBtn">更新商品資訊</button>
                </div>
            </div>
        </div>
    </div>


    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>商品管理</h3>
            </div>
            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="搜尋關鍵字...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title d-flex justify-content-between">
                        <h2>商品列表</h2>
                        <a class="btn btn-dark text-nowrap m-0 border-0 text-white" style="border-radius:5px; font-size:14px" href="product_creat.php" type="submit"><i class="fas fa-plus mr-2"></i>新增商品</a>
                    </div>
                    <div class="x_content d-flex flex-column">
                        <p>選擇商品檢視或編輯</p>
                        <div class="d-flex py-2 align-items-center">
                            <p class="flex-grow-1 m-0" id="dataCount"></p>
                            <p class="m-0 pr-2">價格區間</p>
                            <div class="cost-filter input-group input-group-sm m-0 p-0">
                                <input id="costFilterMax" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="MAX">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"> ~ </span>
                                </div>
                            </div>
                            <div class="cost-filter-2 input-group input-group-sm m-0 pr-2">
                                <input id="costFilterMin" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="MIN">
                            </div>
                            <select id="statusFilter" class="category-filter form-control form-control-sm text-white ml-1" style="width: 120px; background-color:#2A3F54;border:none;border-radius:5px;">
                                <option value="0">所有狀態</option>
                                <option value="1">供貨中</option>
                                <option value="2">已下架</option>
                                <option value="3">缺貨中</option>
                            </select>
                            <select id="categoryFilter" class="form-control form-control-sm text-white ml-1" style="width: 120px; background-color:#2A3F54;border:none;border-radius:5px;">
                                <option value="0">所有分類</option>
                            </select>
                            <a id="filterSearch" class="filter-search btn btn-dark p-0 m-0 d-flex align-items-center justify-content-center ml-1 text-white"><i class="fas fa-search"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        
                                        <th class="px-2 py-3 text-center">分類</th>
                                        <th class="px-2 py-3 text-center">商品名稱</th>
                                        <th class="px-2 py-3 text-center">品牌</th>
                                        <th class="px-2 py-3 text-center">簡介</th>
                                        <th class="px-2 py-3" data-sort="price" id="price">價格區間</th>
                                        <th class="px-2 py-3" data-sort="stock" id="stock">總庫存</th>
                                        <th class="px-2 py-3" data-sort="stock" id="stock">總銷量</th>
                                        <th class="px-2 py-3 text-center" data-sort="upload_time" id="uploadTime">上架時間</th>
                                        <th class="px-2 py-3 text-center" data-sort="upload_time" id="updateTime">最後更新時間<i class="fas fa-sort"></i></th>
                                        <th class="px-2 py-3 text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="productTbody">
                                </tbody>
                            </table>

                        </div>
                        <div id="pageBtnGroup" class="btn-group mr-2 align-self-center" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary flex-grow-0" id="btnPrevious">
                                < </button>
                                    <button type="button" class="btn btn-secondary flex-grow-0" id="btnNext"> > </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?= require_once('includes/footer.php') ?>