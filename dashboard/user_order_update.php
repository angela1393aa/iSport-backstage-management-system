<?php
$title = '修改訂單';
// $style = '';
// $js = '';
require_once('includes/header.php');
require_once('includes/config.php');

$id=$_GET["id"];

$userOrderSql = "SELECT * FROM user_order WHERE id =? AND valid = 1";
$usersSql = "SELECT id, account, address, phone FROM users WHERE valid = 1";
$userOrderStmt = $db_host->prepare($userOrderSql);
$usersStmt = $db_host->prepare($usersSql);

try{
    $userOrderStmt->execute([$id]);
    $usersStmt->execute();
    $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);
    $usersRows = $usersStmt->fetchAll(PDO::FETCH_ASSOC);

    $userOrderArr = [];
    $usersArr = [];
    
    foreach ($userOrderRows as $userOrderRow) {
        if ($id == $userOrderRow['id']) {
            $userOrderArr[$userOrderRow['id']] = $userOrderRow['user_id'];
            $userOrderArr[$userOrderRow['id']] = $userOrderRow['order_no'];
            $userOrderArr[$userOrderRow['id']] = $userOrderRow['address'];
            $userOrderArr[$userOrderRow['id']] = $userOrderRow['phone'];
            $userOrderArr[$userOrderRow['id']] = $userOrderRow['paytype'];
            $userOrderArr[$userOrderRow['id']] = $userOrderRow['delivery'];
            $userOrderArr[$userOrderRow['id']] = $userOrderRow['recipient'];
            break;
        }
    }
    
    foreach ($usersRows as $usersRow){
        if ($userOrderRow['user_id'] == $usersRow['id']) {
            $usersArr[$usersRow['id']] = $usersRow['account'];
            break;
        }
    }
    //  print_r($usersArr);

}catch(PDOException $e){
    echo "資料庫查詢失敗<br>";
    echo "Error: ".$e->getMessage(). "<br>";
    exit;
}


?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>訂單</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <!-- Form -->
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title d-flex">
                        <h2 class="flex-grow-1">修改訂單<small></small></h2>
                        <a class="btn btn-dark text-nowrap m-0 border-0 text-white" style="border-radius:5px; font-size:14px" href="user_order.php" type="submit">回訂單列表</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <h2 class="flex-grow-1 mb-2 mt-0">訂購人資料</h2>
                        <form action="userOrderUpdate.php" method="post" data-parsley-validate class="form-horizontal form-label-left">
                        
                        <input type="hidden" name="id" value="<?= $userOrderRow['id']?>"> <!-- 設定id為type="hidden", 給UPDATE抓id -->
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="orderNum" >訂單編號
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="orderNum" name="orderNum" class="form-control" value="<?=$userOrderRow['order_no']?>" readonly>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="account">訂購人
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="account" name="account" class="form-control" value="<?=$usersRow["account"]?>" readonly>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="recipient">收件人
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="recipient" name="recipient" class="form-control" value="<?=$userOrderRow['recipient']?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="phone" required>連絡電話
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="tel" id="phone" name="phone" class="form-control" value="<?=$userOrderRow['phone']?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="address">收件地址
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="tel" id="address" name="address" class="form-control" value="<?=$userOrderRow['address']?>">
                                </div>
                            </div>
                            <!-- <h2 class="flex-grow-1 mb-2">商品資訊</h2> -->
                            <!-- <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="productId" required>商品編號
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="productId" name="productId" class="form-control">
                                    <p class="align-middle m-0 py-2" id="">自動帶出品名</p>
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
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="qty">數量
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="number" id="qty" name="qty" class="form-control" value="1">
                                </div>
                            </div> -->
                            <h2 class="flex-grow-1 mb-2">付款及出貨方式</h2>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="paytype">付款方式
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control form-select" name="paytype" id="paytype" value="<?=$userOrderRow['paytype']?>">
                                        <option value="1">ATM匯款</option>
                                        <option value="2">線上刷卡</option>
                                        <option value="3">貨到付款</option>
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="delivery">運送方式
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control form-select" name="delivery" id="delivery" name="delivery" value="$userOrderRow['delivery']">
                                        <option value="1">郵寄</option>
                                        <option value="2">宅急便</option>
                                        <option value="3">超商貨到付款</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="order_status">訂單狀態
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="form-control form-select" name="order_status" id="order_status">
                                        <option value="1">待出貨</option>
                                        <option value="2">已出貨</option>
                                        <option value="3">取消訂單</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <a href="user_order.php" class="btn btn-primary" type="button">取消</a>
                                    <!-- <button class="btn btn-primary" type="reset">重設</button> -->
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