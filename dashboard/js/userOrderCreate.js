// 加入判斷帳號是否存在
$("#account").on({
    "change": function() {
        // console.log("change");
        $("#accountMsg").text("");
        let account = $(this).val();  //取值
        console.log("account: ", account);
        let formdata = new FormData();
        formdata.append("account", account);

        axios.post('/project_01/dashboard/api/userOrderCheck.php', formdata)
        .then(function(response) {
            // console.log(response);
            if (response.data.count === 0) {
                $("#accountMsg").text("沒有這個帳號, 請確認會員帳號");
            }
        })
        .catch(function(error) {
            console.log(error);
        });
    },
});

// 把product_sku資料表的sku_code打到UI上
axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrderCreateApi.php',
}).then(function (response) {
    // console.log(response);
    let productData = response.data.product;
    let userOrderData = response.data.userOrder;
    // console.log(productData);
    let datalistContent = "";

    productData.forEach((item) => {
        datalistContent +=`
        <option value="${item.sku_code}"></option>
        `
    });

    $("#productId").append(datalistContent);

    $("#skuCode").on("change", function () {
        console.log("change");
        let id=$(this).val();
        console.log(productData.id);
        $("#productName").attr("value", productData.id);
    });
    
    userOrderData.forEach((item) => {
        
    })
    // console.log(datalistContent);


    
}).catch(function (error) {
    console.log(error);
});


// 把users資料表的account打到UI上
axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrderCreateUserApi.php',
}).then(function (response) {
    // console.log(response);
    let data = response.data;
    // console.log(data);
    let datalistContent = "";
    // console.log(data);
    data.forEach((item) => {
        datalistContent +=`
        <option value="${item.account}"></option>
        `
    })
    $("#userAccount").append(datalistContent);
    // console.log(datalistContent);

}).catch(function (error) {
    console.log(error);
});