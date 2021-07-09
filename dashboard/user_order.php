<?php 
$title="訂單資訊";
// $style="orderCss";
require_once("includes/header.php");
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
    <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title">
              <h2>訂單列表<small>檢視或編輯訂單</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#">Settings 1</a>
                      <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>

            <div class="x_content">

              <p>您的訂單</p>

              <div class="table-responsive">
                <table class="table table-striped jambo_table bulk_action">
                  <thead>
                    <tr class="headings">
                      <th>
                        <input type="checkbox" id="check-all" class="flat">
                      </th>
                      <th class="px-2 py-3 text-center">訂購日</th>
                      <th class="px-2 py-3 text-center">訂單編號</th>
                      <th class="px-2 py-3 text-center">使用者</th>
                      <!-- <th class="px-2 py-3 text-center">訂單總額</th> -->
                      <th class="px-2 py-3 text-center">付款方式</th>
                      <th class="px-2 py-3 text-center">發票號碼</th>
                      <th class="px-2 py-3 text-center"><span class="nobr">詳細資訊</span>
                      </th>
                      <th class="bulk-actions" colspan="7">
                        <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
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
</div>
<!-- /page content -->


<script>
    axios({
        method: 'post',
        url: '/project_01/dashboard/api/userOrder.php',
    }).then(function (response) {
        // console.log(response);
        let data=response.data;
        // console.log(data);
        let content="";
        // console.log(data);
        data.forEach((order)=>{
        content+=`
            <tr class="even pointer">
                <td class="a-center ">
                  <input type="checkbox" class="flat" name="table_records">
                </td>
                <td class="text-center">${order.order_date}</td>
                <td class="text-center">${order.order_id}</td>
                <td class="text-center">${order.user_id}</td>
                // <td class="text-center">${order.total}</td>
                <td class="text-center">${order.paytype}</td>
                <td class="text-center">${order.invoice_no}</td>
                <td class="text-center"><a href="user_order_detail.php?order_id=${order.order_id}">詳細資訊</a></td>
            </tr>
            `
        })
        $("tbody").append(content);

      }).catch(function (error) {
          console.log(error);
      });



    // 你$order->id應該已經是獨一無二的了。我建議使用
    // $order->order_no = $d->format('Ymd').$order->id
    // 不涉及restaurant_id這種方式，
    // 您將很容易知道前 8 個字符 ( YYYYmmdd)之後的部分是從數據庫中查找的訂單 ID。
</script>
<?= require_once('includes/footer.php') ?>



