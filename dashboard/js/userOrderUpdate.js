axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrder.php',
}).then(function (response) {
    // console.log(response);
    let userOrderData = response.data.userOrder;
    let userOrderDetailData = response.data.userOrderDetail;
    // console.log(userOrderDetailData);

    let id = $("#id").val();   // .val()取得的id是字串
    // console.log("id", id);
    // console.log("id type", typeof(id));

    userOrderData.forEach(item => {
        if (item.order_id == id) {
            $("#orderDate").text(item.order_date);
            $("#orderNum").val(item.order_no);
            $("#account").val(item.user_account);
            $("#recipient").val(item.recipient);
            $("#phone").val(item.phone);
            $("#address").val(item.address);
            $("#paytype").attr("value", `${item.paytype}`);
            $("#delivery").attr("value", `${item.delivery}`);
            $("#orderStatus").attr("value", `${item.order_status}`);
        }
    })

    userOrderDetailData.forEach(item => {
        if (item.order_id == id) {
            $("#productId").val(item.sku_code);
            // $("#productId").val(item.sku_code + "  - " + item.name);  //品名不正確
            $("#qty").val(item.qty);
        }
    })

}).catch(function (error) {
    console.log(error);
});

axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrderCreateApi.php',
}).then(function (response) {
    // console.log(response);
    let data = response.data.product;
    // console.log(data);

    let id = $("#id").val();   // .val()取得的id是字串
    console.log("id", id);
    console.log("id type", typeof(id));

    data.forEach(item => {
        if (item.order_id == id) {
            $("#productId").val(item.sku_code);
            $("#productName").val(item.name);
        }
    })

}).catch(function (error) {
    console.log(error);
});

