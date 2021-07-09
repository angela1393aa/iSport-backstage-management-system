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
                <td class="align-middle">
                  <input type="checkbox" class="flat" name="table_records">
                </td>
                <td class="align-middle text-center">${order.order_date}</td>
                <td class="align-middle text-center">${order.order_id}</td>
                <td class="align-middle text-center">${order.user_account}</td>
                <td class="align-middle text-center">${order.paytype}</td>
                <td class="align-middle text-center">${order.order_status}</td>
                <td class="align-middle text-center"><a href="user_order_detail.php?order_id=${order.order_id}">${order.invoice_no}</a></td>
                <td class=" p-2">
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
        });
        $("tbody").append(content);

      }).catch(function (error) {
          console.log(error);
      });



    // 你$order->id應該已經是獨一無二的了。我建議使用
    // $order->order_no = $d->format('Ymd').$order->id
    // 不涉及restaurant_id這種方式，
    // 您將很容易知道前 8 個字符 ( YYYYmmdd)之後的部分是從數據庫中查找的訂單 ID。




