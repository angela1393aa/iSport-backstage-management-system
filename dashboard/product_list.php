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
                                    <th class="text-center align-middle">
                                        <input type="checkbox" id="" class="">
                                    </th>
                                    <th class="px-2 py-3">商品編號</th>
                                    <th class="px-2 py-3">商品名稱</th>
                                    <th class="px-2 py-3 text-center">規格</th>
                                    <th class="px-2 py-3">價格</th>
                                    <th class="px-2 py-3">庫存</th>
                                    <th class="px-2 py-3 text-center">狀態</th>
                                    <th class="px-2 py-3">上架時間</th>
                                    <th class="px-2 py-3">最後更新時間</th>
                                    <th class="px-2 py-3 text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
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
<script src="/project_01/dashboard/js/productList.js"></script>
</body>

</html>