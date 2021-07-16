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
                <!-- <td class="align-middle">
                  <input type="checkbox" class="flat" name="table_records">
                </td> -->
                <td class="align-middle text-center">${order.order_date}</td>
                <td class="align-middle text-center"><a href="user_order_detail.php?order_id=${order.order_id}">${order.order_no}</a></td>
                <td class="align-middle text-center">${order.user_account}</td>
                <td class="align-middle text-center">${order.phone}</td>
                <td class="align-middle text-center">${order.address}</td>
                <td class="align-middle text-center">${order.paytype}</td>
                <td class="align-middle text-center">${order.delivery}</td>
                <td class="align-middle text-center">${order.order_status}</td>
                <td class="align-middle text-center">${order.invoice_no}</td>
                <td class=" p-2">
                        <div class="d-flex justify-content-center">
                            <a href="user_order_update.php?id=${order.order_id}"
                               class="btn btn-round btn-secondary d-flex justify-content-center align-items-center"
                               style="width: 30px;height: 30px;" title="編輯"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-round btn-danger d-flex justify-content-center align-items-center text-white"
                               style="width: 30px;height: 30px;" id="delete" title="刪除" data-toggle="modal" data-target="#exampleModal">
                               <i class="fas fa-trash-alt"></i>
                               </a>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">確認刪除訂單?</h5>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    一經刪除無法復原 !
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-secondary text-white" data-dismiss="modal">取消</a>
                                    <a href="userOrderDelete.php?id=${order.order_id}" type="button" class="btn btn-primary">確認</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </td>
            </tr>
            `
    })
    $("tbody").append(content);

}).catch(function (error) {
    console.log(error);
});
