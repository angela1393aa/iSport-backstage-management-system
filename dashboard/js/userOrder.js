axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrder.php',
}).then(function (response) {
    // console.log(response);
    let data = response.data;
    // console.log(data);
    let content = "";
    // console.log(data);
    data.forEach((order) => {
        content += `
            <tr class="even pointer">
                <td class="align-middle">
                  <input type="checkbox" class="flat" name="table_records">
                </td>
                <td class="align-middle text-center">${order.order_date}</td>
                <td class="align-middle text-center">${order.order_id}</td>
                <td class="align-middle text-center">${order.user_account}</td>
                <td class="align-middle text-center">${order.address}</td>
                <td class="align-middle text-center">${order.paytype}</td>
                <td class="align-middle text-center">${order.order_status}</td>
                <td class="align-middle text-center"><a href="user_order_detail.php?order_id=${order.order_id}">${order.invoice_no}</a></td>
                <td class=" p-2">
                        <div class="d-flex justify-content-center">
                            <a href="user_order_update.php"
                               class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;" title="編輯"><i class="fas fa-edit"></i></a>
                            <a href="userOrderDelete.php?id=${order.order_id}"
                               class="btn btn-round btn-danger d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;" title="刪除"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
            </tr>
            `
    });
    $("tbody").append(content);

}).catch(function (error) {
    console.log(error);
});








