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
                <td class="text-center">${order.total}</td>
                <td class="text-center">${order.paytype}</td>
                <td class="text-center">${order.invoice_no}</td>
                <td class="text-center"><a href="user_order_detail.php?order_id=${order.order_id}">詳細資訊</a></td>
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




