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
                                    <th class="column-title text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>


<!--                                <tr class="even pointer p-0">-->
<!--                                    <td class="text-center align-middle">-->
<!--                                        <input type="checkbox" class="" name="">-->
<!--                                    </td>-->
<!--                                    <td class="align-baseline align-middle p-1">121000040</td>-->
<!--                                    <td class="align-baseline align-middle p-1" style="max-width: 30px;"></td>-->
<!--                                    <td class="align-baseline align-middle p-1">121000210</td>-->
<!--                                    <td class="align-baseline align-middle p-1">John Blank L</td>-->
<!--                                    <td class="align-baseline align-middle p-1">Paid</td>-->
<!--                                    <td class="align-baseline align-middle p-1">$7.45</td>-->
<!--                                    <td class="align-baseline align-middle p-1"></td>-->
<!--                                    <td class="align-baseline align-middle p-1"></td>-->
<!--                                    <td class="align-middle p-1">-->
<!--                                        <div class="d-flex justify-content-center">-->
<!--                                            <a href="#"-->
<!--                                               class="btn btn-round btn-info d-flex justify-content-center align-items-center "-->
<!--                                               style="width: 30px;height: 30px;"><i class="fas fa-info"></i></a>-->
<!--                                            <a href="#"-->
<!--                                               class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "-->
<!--                                               style="width: 30px;height: 30px;"><i class="fas fa-edit"></i></a>-->
<!--                                            <a href="#"-->
<!--                                               class="btn btn-round btn-danger d-flex justify-content-center align-items-center "-->
<!--                                               style="width: 30px;height: 30px;"><i class="fas fa-trash-alt"></i></a>-->
<!--                                        </div>-->
<!--                                    </td>-->
<!--                                </tr>-->


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

<!-- footer content -->
<footer>
    <div class="pull-right">
        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<!--  <script src="../vendors/iCheck/icheck.min.js"></script>-->
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    axios({
        method: 'post',
        url: '/project_01/dashboard/api/productList.php',
    })
        .then(function (response) {
            // console.log(response);
            let data = response.data;
            // console.log(data);
            let content;
            for(let i = 50; i < 60; i++){
                content += `
                    <tr class="even pointer p-0">
                        <td class="text-center align-middle">
                            <input type="checkbox" class="" name="">
                        </td>
                        <td class="align-baseline align-middle p-1">${data[i].sku_code}</td>
                        <td class="align-baseline align-middle p-1" style="max-width: 200px;">${data[i].product_name}</td>
                        <td class="align-baseline align-middle p-1">${data[i].sku_group}</td>
                        <td class="align-baseline align-middle p-1">${data[i].price}</td>
                        <td class="align-baseline align-middle p-1">${data[i].stock}</td>
                        <td class="align-baseline align-middle p-1">${data[i].status}</td>
                        <td class="align-baseline align-middle p-1">${data[i].upload_time}</td>
                        <td class="align-baseline align-middle p-1">${data[i].upload_time}</td>
                        <td class="align-middle p-1">
                            <div class="d-flex justify-content-center">
                                <a href="#"
                                   class="btn btn-round btn-info d-flex justify-content-center align-items-center "
                                   style="width: 30px;height: 30px;"><i class="fas fa-info"></i></a>
                                <a href="#"
                                   class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "
                                   style="width: 30px;height: 30px;"><i class="fas fa-edit"></i></a>
                                <a href="#"
                                   class="btn btn-round btn-danger d-flex justify-content-center align-items-center "
                                   style="width: 30px;height: 30px;"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                `
            }
            $('tbody').append(content);

        }).catch(function (error) {
            console.log(error);
        }
    );
</script>
</body>

</html>