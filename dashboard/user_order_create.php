<?php
$title = '新增訂單';
$style = 'userOrder.css';
$js = 'userOrderCreate.js';
require_once('includes/header.php');

$id = 2;

$productSql = "SELECT * FROM product";
$productStmt = $db_host->prepare($productSql);
$productStmt->execute();
$rows = $productStmt->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>訂單</h3>
            </div>
            <div class="title_right">
                <!-- <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="請輸入關鍵字" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Form -->
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title d-flex">
                        <h2 class="flex-grow-1">新增訂單<small></small></h2>
                        <a class="btn btn-dark text-nowrap m-0 border-0 text-white" style="border-radius:5px; font-size:14px" href="user_order.php" type="submit">回訂單列表</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <h2 class="flex-grow-1 mb-2 mt-0">訂購人資料</h2>
                        <form id="" data-parsley-validate class="form-horizontal form-label-left" action="userOrderCreate.php" method="post">
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="account" required>會員帳號
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input list="userAccount" id="account" name="account" class="form-control" placeholder="請選擇會員帳號">
                                    <datalist id="userAccount">
                                    </datalist>
                                    <small class="text-danger align-middle m-0 py-2" id="accountMsg"></small>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="email" required>E-mail
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="james@isport.com">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone" required>手機號碼
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="tel" id="phone" name="phone" class="form-control" placeholder="0955000123">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="address" required>收件地址
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="tel" id="address" name="address" class="form-control">
                                </div>
                            </div>
                            <h2 class="flex-grow-1 mb-2">商品資訊</h2>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="productId" required>商品編號
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input list="productId" id="skuCode" name="skuCode" class="form-control" placeholder="請選擇商品編號">
                                    <datalist id="productId">
                                    </datalist>
                                </div>
                            </div>
                            <!-- <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="productName" required>品名
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="productName" name="productName" class="form-control hidden" readonly>
                                </div>
                            </div> -->
                            <!-- <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="color">顏色
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="color" name="color" class="form-control" required>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="size">尺寸
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="size" name="size" class="form-control" required>
                                </div>
                            </div> -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="qty">數量
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="number" id="qty" name="qty" class="form-control" value="1">
                                </div>
                            </div>
                            <h2 class="flex-grow-1 mb-2">付款及出貨方式</h2>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="paytype">付款方式
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control form-select" name="paytype" id="paytype">
                                        <option value="1">ATM匯款</option>
                                        <option value="2">線上刷卡</option>
                                        <option value="3">貨到付款</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="delivery">運送方式
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control form-select" name="delivery" id="delivery" name="delivery">
                                        <option value="1">郵寄</option>
                                        <option value="2">宅急便</option>
                                        <option value="3">超商貨到付款</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="order_status">訂單狀態
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control form-select" name="order_status" id="order_status">
                                        <option value="1">待出貨</option>
                                        <option value="2">已出貨</option>
                                        <option value="3">取消訂單</option>
                                    </select>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a href="user_order.php" class="btn btn-primary" type="button">取消</a>
                                    <button class="btn btn-primary" type="reset">重設</button>
                                    <button type="submit" class="btn btn-success">送出</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form -->
    </div>
</div>

<?= require_once('includes/footer.php') ?>