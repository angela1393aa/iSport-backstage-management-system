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

// 驗證
$("#submitBtn").click(function(e) {
    let accountValue = $("#account").val();
    console.log("click");
    e.preventDefault();

    $("#submitAlert").empty();

    alert = "";
    if(accountValue == "") {
        alert += "請填入會員帳號";
    }
})
$("#submitAlert").append(alert);



// *******************把userOrderCreateApi的資料打到UI上***********************
axios({
    method: 'post',
    url: '/project_01/dashboard/api/userOrderCreateApi.php',
}).then(function (response) {
    // console.log(response);
    let userData = response.data.user;
    let productData = response.data.product;
    let userOrderData = response.data.userOrder;
    // console.log(productData);
    let datalistContent = "";
    let content = "";

    userData.forEach((item) => {
        datalistContent +=`
        <option value="${item.account}"></option>
        `
    })
    $("#userAccount").append(datalistContent);
    
    productData.forEach((item) => {
        content +=`
        <option value="${item.sku_code}"></option>
        `
    });
    $("#productId").append(content);

    // **********************自動產生產品名稱************************
    $("#skuCode").on("keyup", function() {
        console.log("key up");
        let id=$(this).val();                               //  .val()取值, 取得商品編號的值(sku_code)
        console.log("id", id);
        $("#productName").empty();                          //  **沒有輸入品名時或沒有此商品編號時不顯示**
        productData.forEach((item)=>{
            let skuCode = item.sku_code;                    //  以sku_code作為key, 尋找品名
            if (skuCode == id) {
                $("#productName").text(item.name);
                console.log(item.name);
            }
        })
    });

    userOrderData.forEach((item) => {
        
    })
    // console.log(datalistContent);

    
}).catch(function (error) {
    console.log(error);
});