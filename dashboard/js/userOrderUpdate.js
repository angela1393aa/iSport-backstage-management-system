axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrder.php',
}).then(function (response) {
    // console.log(response);
    let data = response.data;
    console.log(data);

    let id = $("#id").val();   // .val()取得的id是字串
    console.log("id", id);
    console.log("id type", typeof(id));

    data.forEach(item => {
        if (item.order_id == id) {
            $("#orderDate").text(item.order_date);
            $("#orderNum").val(item.order_no);
            $("#account").val(item.user_account);
            $("#recipient").val(item.recipient);
            $("#phone").val(item.phone);
            $("#address").val(item.address);
            $("#paytype").attr(value, `${item.paytype}`);
            $("#delivery").val(item.delivery);
        }
    })

}).catch(function (error) {
    console.log(error);
});

// axios({
//     method: 'post',
//     url: '/project_01/dashboard/api/userOrderCreateApi.php',
// }).then(function (response) {
//     // console.log(response);
//     let data = response.data.product;
//     console.log(data);

//     let id = $("#id").val();   // .val()取得的id是字串
//     console.log("id", id);
//     console.log("id type", typeof(id));

//     data.forEach(item => {
//         if (item.order_id == id) {
//             $("#orderDate").text(item.order_date);
//             $("#orderNum").val(item.order_no);
//         }
//     })

// }).catch(function (error) {
//     console.log(error);
// });

