// 利用js做分頁

// ***************************************userOrder列表***************************************
let tableShowLoop = (startNum, endNum, data) => {
    let content = "";

    // 總訂單筆數
    $("#orderCount").empty();
    $("#orderCount").append(`
        <p class="text-20 m-0" style="font-size:16px;">共有${data.length}張訂單</p>
    `);
    console.log($("#orderCount").text());

    for (let i = startNum; i < endNum; i++) {
        if (!data[i]) break;    // 資料筆數未滿perPage筆數
        content += `
            <tr class="even pointer">
                <!-- <td class="align-middle">
                  <input type="checkbox" class="flat" name="table_records">
                </td> -->
                <td class="align-middle text-center">${data[i].order_date}</td>
                <td class="align-middle text-center">
                    <!--<a href="user_order_detail.php?order_id=${data[i].order_id}">${data[i].order_no}</a>-->
                    <!-- 拔掉user_order_detail -->
                    ${data[i].order_no}
                </td>
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
                            style="width: 30px;height: 30px;" data-id="${i}" id="delete" title="刪除" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-trash-alt"></i>
                            </a>
                    </div>
                </td>
            </tr>
            `;
        }
        $('tbody').empty();
        $('tbody').append(content);
}



axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrder.php',
}).then(function (response) {
    // ***************************************設定API資料變數***************************************
    console.log("response: ", response);
    let data = response.data;
    // console.log(data);
    let content = "";
    // console.log(data);

    // ***************************************製作分頁按鈕***************************************
    let perPage = 10;         // ************設置分頁長度變數
    let firstPageContent = "";
    let pageContent = "";
    let lastPageContent = "";

    let firstPage = 1;
    let totalPage = Math.ceil(data.length / perPage);
    console.log("totalPage: ", totalPage);

    for (let i = 1; i <= totalPage; i++) {
        if (i == firstPage) {
            firstPageContent = `
            <li id="thisPage" class="page-item" id="previous" data-page="${i}">
                <a class="page-link" aria-label="Previous">
                    <i class="fa fa-angle-double-left text-secondary"></i>
                </a>
            </li>
            `;
        }
        pageContent += `
        <li id="thisPage" class="page-item" data-page="${i}"><a id="" class="page-link">${i}</a></li>
        `
        if (i == totalPage) {
            lastPageContent = `
                <li id="thisPage" class="page-item" data-page="${i}">
                    <a class="page-link" aria-label="Next">
                        <i class="fa fa-angle-double-right text-secondary"></i>
                    </a>
                </li>
            `;
        }
    };
    $("#orderListPage").append(firstPageContent);
    $("#orderListPage").append(pageContent);
    $("#orderListPage").append(lastPageContent);

    // ***************************************分頁按鈕綁定事件***************************************
    $("#orderListPage").on("click", "#thisPage", function(){
        let page = $(this).data("page");   // $(this)是指pageContent的<li>
        let startNum = (page - 1) * perPage;
        let endNum = page * perPage;
        $(this).addClass('active').siblings().removeClass('active');
        console.log("page: ", page);
        console.log("endNum: ", endNum);

        tableShowLoop(startNum, endNum, data);
    });
    
    // ***************************************刪除按鈕***************************************
    $("#userOrderTbody").on("click", "#delete", function() {
        let id = ($(this).data("id"));   // $(this)是指的<a>
        $("#deleteConfirm").text(`${data[id].order_no}`);
        $("#yesDelete").attr("href", `userOrderDelete.php?id=${data[id].order_id}`);
        console.log("id", id);
    })

    // ***************************************顯示userOrder列表首頁(無分頁按鈕)***************************************
    tableShowLoop(0, perPage, data);


}).catch(function (error) {
    console.log(error);
});
