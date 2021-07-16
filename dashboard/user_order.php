<?php
$title = '訂單資訊';
$style = 'userOrder.css';
$js = 'userOrder.js';
require_once('includes/header.php');

$sql = 'SELECT * FROM user_order'; // WHERE order_status = 
$stmt = $db_host->prepare($sql);
$stmt->execute();
$count = $stmt->rowCount();
?>

<!-- page content -->
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

    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title m-0 d-flex">
            <h2 class="flex-grow-1">訂單列表<small></small></h2>
            <a class="btn btn-dark text-nowrap m-0 border-0 text-white" style="border-radius:5px; font-size:14px" href="user_order_create.php" type="submit"><i class="fas fa-plus mr-2"></i>新增訂單</a>
            <div class="clearfix"></div> <!-- 分隔線偽元素 -->
          </div>

          <div class="x_content">
            <div class="d-flex py-2 align-items-center">
              <p class="flex-grow-1 m-0">共有<?= $count ?>張訂單</p>
              <div>
                <form class="d-flex form-control border-0 m-0 p-0" style="height:33px;" action="user_order.php">
                  <input type="date" class="form-control" style="height:33px;" name="start">
                  <input type="date" class="form-control" style="height:33px;" name="end">
                  <button class="btn btn-dark text-nowrap mx-2 my-0 border-0" style="border-radius:5px; font-size:14px" type="submit">選擇</button>
                </form>
              </div>
              <select name="" id="" class="form-control text-white" style="width:120px; background:rgba(52,73,94,0.94); border-radius:5px; font-size:14px">
                <option value="0" selected>訂單狀態</option>
                <option value="1">待出貨</option>
                <option value="2">已出貨</option>
                <option value="3">取消訂單</option>
              </select>

            </div>

            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                <thead>
                  <tr class="headings">
                    <!-- <th>
                      <input type="checkbox" id="check-all" class="flat">
                    </th> -->
                    <th class="align-middle text-center">
                      訂購日
                      <i class="fas fa-sort"></i>
                    </th>
                    <th class="align-middle text-center">
                      訂單編號
                      <i class="fas fa-sort"></i>
                    </th>
                    <th class="align-middle text-center">訂購人</th>
                    <th class="align-middle text-center">連絡電話</th>
                    <th class="align-middle text-center">收件地址</th>
                    <th class="align-middle text-center">付款方式</th>
                    <th class="align-middle text-center">運送方式</th>
                    <th class="align-middle text-center"><span class="nobr">訂單狀態</span>
                    <th class="align-middle text-center">發票號碼</th>
                    </th>
                    <th class="align-middle text-center">操作</th>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr class="even pointer">
                      <td class="a-center ">
                        <input type="checkbox" class="flat" name="table_records">
                      </td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /page content -->

<!-- 彈跳視窗 -->

<?= require_once('includes/footer.php') ?>