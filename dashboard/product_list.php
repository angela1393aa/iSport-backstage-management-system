<?php
$title = '商品列表';
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
                    <div class="x_title">
                        <h2>商品列表<small>所有商品</small></h2>
                        <ul class="nav navbar-right panel_toolbox" style="min-width: 20px;">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        <p>選擇商品檢視或編輯</p>

                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                <tr class="headings">
                                    <th class="text-center">
                                        <input type="checkbox" id="" class="">
                                    </th>
                                    <th class="column-title">商品編號</th>
                                    <th class="column-title">商品名稱</th>
                                    <th class="column-title">規格</th>
                                    <th class="column-title">價格</th>
                                    <th class="column-title">庫存</th>
                                    <th class="column-title">狀態</th>
                                    <th class="column-title">上架時間</th>
                                    <th class="column-title">最後更新時間</th>
                                    <th class="column-title">操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                try {
                                $stmt->execute();
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) {
                                ?>
                                <tr class="even pointer ">
                                    <td class="text-center">
                                        <input type="checkbox" class="" name="">
                                    </td>
                                    <td class=" ">121000040</td>
                                    <td class="text-truncate" style="max-width: 30px;"><?= $row['name'];} ?></td>
                                    <td class=" ">121000210 </td>
                                    <td class=" ">John Blank L</td>
                                    <td class=" ">Paid</td>
                                    <td class=" ">$7.45</td>
                                    <td class=""></td>
                                    <td class=" "></td>
                                    <td class="d-flex justify-content-center m-0 p-1">
                                        <a href="#" class="btn btn-round btn-secondary d-flex justify-content-center align-items-center p-0" style="width: 30px;height: 30px;"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-round btn-danger d-flex justify-content-center align-items-center p-0" style="width: 30px;height: 30px;"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php

                                }catch (PDOException $e) {
                                    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
                                    exit();
                                }
                                ?>


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


<?php require_once("includes/footer.php"); ?>
