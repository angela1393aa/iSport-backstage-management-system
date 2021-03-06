<?php
$title = '商品列表';
$style = 'product-list-sku.css';
$js = 'productListSku.js';
require_once("includes/header.php");
?>

<!-- page content -->
<div class="right_col" role="main">
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
                        <h2>單品列表</h2>
                        <a class="btn btn-dark text-nowrap m-0 border-0 text-white" style="border-radius:5px; font-size:14px" href="product_creat.php" type="submit"><i class="fas fa-plus mr-2"></i>新增商品</a>
                    </div>
                    <div class="x_content d-flex flex-column">
                        <p>選擇單品檢視或編輯</p>
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
                                        <th class="text-center align-middle">
                                            <input type="checkbox" id="" class="">
                                        </th>
                                        <th class="px-2 py-3" data-sort="sku_code" id="skuCode">商品編號 <i class="fas fa-sort"></i></th>
                                        <th class="px-2 py-3 text-center">分類</th>
                                        <th class="px-2 py-3">商品名稱</th>
                                        <th class="px-2 py-3 text-center">規格</th>
                                        <th class="px-2 py-3" data-sort="price" id="price">價格 <i class="fas fa-sort"></i></th>
                                        <th class="px-2 py-3" data-sort="stock" id="stock">庫存 <i class="fas fa-sort"></i></th>
                                        <th class="px-2 py-3 text-center">狀態</th>
                                        <th class="px-2 py-3" data-sort="upload_time" id="uploadTime">上架時間 <i class="fas fa-sort"></i></th>
                                        <th class="px-2 py-3" data-sort="upload_time" id="updateTime">最後更新時間 <i class="fas fa-sort"></i></th>
                                        <th class="px-2 py-3 text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody>
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