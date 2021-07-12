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

        let 