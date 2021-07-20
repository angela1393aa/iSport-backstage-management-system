<?php
$title = '訂單資訊';
$style = 'userOrder.css';
$js = 'userOrder.js';
require_once('includes/header.php');
// require_once('userOrderPage.php');


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
                    <form action="user_order.php" method="get" class="d-flex">
                        <div class="input-group">
                            <!-- <input type="text" class="form-control" placeholder="請輸入關鍵字" name="search"> -->
                            <!-- <input type="search" class="form-control light-table-filter" data-table="order-table" placeholder="請輸入關鍵字"> -->
                            <span class="input-group-btn">
                                <!-- <button id="searchButton" class="btn btn-default" >Go!</button> -->
                            </span>
                        </div>
                    </form>
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
                            <p class="flex-grow-1 m-0" id="orderCount"></p>
                            <div>
                                <!-- <form class="d-flex form-control border-0 m-0 p-0" style="height:33px;" action="user_order.php">
                                    <input type="date" class="form-control" style="height:33px;" name="start">
                                    <input type="date" class="form-control" style="height:33px;" name="end">
                                    <button class="btn btn-dark text-nowrap mx-2 my-0 border-0" style="border-radius:5px; font-size:14px" type="submit">選擇</button>
                                </form> -->
                            </div>
                            <!-- <select name="" id="" class="form-control text-white" style="width:120px; background:rgba(52,73,94,0.94); border-radius:5px; font-size:14px">
                                <option value="0" selected>訂單狀態</option>
                                <option value="1">待出貨</option>
                                <option value="2">已出貨</option>
                                <option value="3">取消訂單</option>
                            </select> -->

                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <!-- <th><input type="checkbox" id="check-all" class="flat"></th> -->
                                        <th class="align-middle text-center">
                                            訂購日
                                            <!-- <i class="fas fa-sort"></i> -->
                                        </th>
                                        <th class="align-middle text-center">
                                            訂單編號
                                            <!-- <i class="fas fa-sort"></i> -->
                                        </th>
                                        <th class="align-middle text-center">訂購人</th>
                                        <th class="align-middle text-center">連絡電話</th>
                                        <th class="align-middle text-center">收件地址</th>
                                        <th class="align-middle text-center">付款方式</th>
                                        <th class="align-middle text-center">運送方式</th>
                                        <th class="align-middle text-center">訂單狀態</th>
                                        <th class="align-middle text-center">發票號碼</th>
                                        <th class="align-middle text-center">操作</th>
                                    </tr>
                                </thead>
                                <tbody id="userOrderTbody">
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
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center" id="orderListPage">
                                <!-- <li class="page-item" id="previous">
                                    <a class="page-link" href="user_order.php" aria-label="Previous">
                                        <i class="fa fa-angle-double-left text-secondary"></i>
                                    </a>
                                </li>
                                <li class="page-item text-secondary"><a class="page-link" href="#">1</a></li>
                                <li id="thisPage" class="page-item" data-page="${i}">
                                    <a class="page-link" aria-label="Next">
                                        <i class="fa fa-angle-double-right text-secondary"></i>
                                    </a>
                                </i> -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->

<!-- 彈跳視窗 -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center">
            <div class="modal-header">
                <h5 class="modal-title h4" id="exampleModalLabel">刪除訂單</h5>
                </button>
            </div>
            <div class="modal-body" style="font-size: 18px;">
                確認刪除<span class="text-danger" style="font-size: 22px;" id="deleteConfirm"></span>這張訂單?<br>
                一經刪除無法復原 !
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary text-white" data-dismiss="modal">取消</a>
                <a href="" id="yesDelete" type="button" class="btn btn-primary">確認</a>
            </div>
        </div>
    </div>
</div>
<!-- /彈跳視窗 -->

<?= require_once('includes/footer.php') ?>