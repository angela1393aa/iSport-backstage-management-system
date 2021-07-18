// 利用js做分頁

axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrder.php',
}).then(function (response) {
    // console.log(response);
    let data = response.data;
    // console.log(data);
    let content = "";
    // console.log(data);

    // 總訂單筆數
    $("#orderCount").text(`共有${data.length}張訂單`);
    console.log($("#orderCount").text());

    // 起始頁1~10筆資料
    for (let i = 0; i < 10; i++)
        content += `
            <tr class="even pointer">
                <!-- <td class="align-middle">
                  <input type="checkbox" class="flat" name="table_records">
                </td> -->
                <td class="align-middle text-center">${data[i].order_date}</td>
                <td class="align-middle text-center"><a href="user_order_detail.php?order_id=${data[i].order_id}">${data[i].order_no}</a></td>
                <td class="align-middle text-center">${data[i].user_account}</td>
                <td class="align-middle text-center">${data[i].phone}</td>
                <td class="align-middle text-center">${data[i].address}</td>
                <td class="align-middle text-center">${data[i].paytype}</td>
                <td class="align-middle text-center">${data[i].delivery}</td>
                <td class="align-middle text-center">${data[i].order_status}</td>
                <td class="align-middle text-center">${data[i].invoice_no}</td>
                <td class=" p-2">
                        <div class="d-flex justify-content-center">
                            <a href="user_order_update.php?id=${data[i].order_id}"
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
                                    <a href="userOrderDelete.php?id=${data[i].order_id}" type="button" class="btn btn-primary">確認</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </td>
            </tr>
            `

    // })
    $("tbody").append(content);

    // 分頁
    let pageContent = "";
    let perPage = 10;
    let totalPage = Math.ceil(data.length / perPage);
    console.log(totalPage);

    for (let i = 1; i <= totalPage; i++) {
        pageContent += `
            <li id="thisPage" class="page-item" data-page="${i}"><a id="" class="page-link">${i}</a></li>
            `
    }
    $("#previous").after(pageContent);

    $("#orderListPage").on("click", "#thisPage", function(){
        let page = $(this).data("page");   // $(this)是指pageContent的<li>
        $(this).addClass('active').siblings().removeClass('active');
        console.log(page);
        content = "";
        $("tbody").empty();
        
        let pageStart = (page - 1) * perPage;
        let pageChange = (page * perPage);
        // console.log(pageChange);

        if (page == totalPage) {
            pageChange = pageStart + data.length % perPage;
        }

        for (let i = pageStart; i < pageChange; i++) {
            content += `
            <tr class="even pointer">
                <!-- <td class="align-middle">
                  <input type="checkbox" class="flat" name="table_records">
                </td> -->
                <td class="align-middle text-center">${data[i].order_date}</td>
                <td class="align-middle text-center"><a href="user_order_detail.php?order_id=${data[i].order_id}">${data[i].order_no}</a></td>
                <td class="align-middle text-center">${data[i].user_account}</td>
                <td class="align-middle text-center">${data[i].phone}</td>
                <td class="align-middle text-center">${data[i].address}</td>
                <td class="align-middle text-center">${data[i].paytype}</td>
                <td class="align-middle text-center">${data[i].delivery}</td>
                <td class="align-middle text-center">${data[i].order_status}</td>
                <td class="align-middle text-center">${data[i].invoice_no}</td>
                <td class=" p-2">
                        <div class="d-flex justify-content-center">
                            <a href="user_order_update.php?id=${data[i].order_id}"
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
                                    <a href="userOrderDelete.php?id=${data[i].order_id}" type="button" class="btn btn-primary">確認</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    </td>
            </tr>
            `
        }
        $("tbody").append(content);
    })

}).catch(function (error) {
    console.log(error);
});
