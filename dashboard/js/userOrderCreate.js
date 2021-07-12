        // 訂單編號隨機亂數
        function invoice_random_no(j) {
            let invoice_random_no = "";
            for (let i = 0; i < j; i++){ //j位隨機數，用以加在時間戳後面。
                invoice_random_no += Math.floor(Math.random() * 10);
            }
            let today = new Date();
            let mm = (today.getMonth() + 1 < 10 ? '0': '') + (today.getMonth() + 1);
            var dd = (today.getDate()<10 ? '0' : '')+today.getDate();
            invoice_random_no = today.getFullYear()+ mm + dd + invoice_random_no;
            return "A" + invoice_random_no;
        };
        console.log("invoice_random_no", invoice_random_no(1));


        // 加入判斷帳號是否存在
        $("#account").on({
            "change": function() {
                // console.log("change");
                $("#accountMsg").text("");
                let account = $(this).val();  //取值
                let formdata = new FormData();
                formdata.append("account", account);

                axios.post('/project_01/dashboard/api/userOrderCheck.php', formdata)
                .then(function(response) {
                    // console.log(response);
                    if (response.data.count === 0) {
                        $("#accountMsg").text("沒有這個帳號")
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            },
        });