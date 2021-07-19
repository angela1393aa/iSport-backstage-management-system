let statusFilter, categoryFilter, costFilterMax, costFilterMin;


axios({
    method: 'post',
    url: '/project_01/dashboard/api/productCategory.php',
}).then(function (response) {
    let categoryData = response.data;
    let content = '';
    categoryData.forEach(item => {
        content += `
        <option value="${item.id}">${item.name}</option>
         `
    });
    $('#categoryFilter').append(content);

}).catch(function (error) {
    console.log(error);
});


axios({
    method: 'post',
    url: '/project_01/dashboard/api/productListSkuApi.php',
})
    .then(function (response) {
        let originData = response.data;
        let data = response.data
        let content;

        $('#dataCount').text(`共有${data.length}件商品`);
        console.log($('#dataCount').text());
        console.log(data[1].status)

        for (let i = 0; i < 20; i++) {
            
            content += `
                <tr class="even pointer p-0">
                    <td class="text-center align-middle">
                        <input type="checkbox" class="" name="">
                    </td>
                    <td class="align-middle p-2">${data[i].sku_code}</td>
                    <td class="align-middle text-center p-2">${data[i].category}</td>
                    <td class="align-middle p-2" style="max-width: 200px;">${data[i].product_name}</td>
                    <td class="align-middle text-center px-2 p-1">${data[i].sku_group}</td>
                    <td class="align-middle text-right p-2">${data[i].price}</td>
                    <td class="align-middle text-right p-2">${data[i].stock}</td>
                    <td class="align-middle text-center p-2"><span class="badge badge-${data[i].stytusStyle}">${data[i].status}</span></td>
                    <td class="align-middle p-2">${data[i].upload_time}</td>
                    <td class="align-middle p-2">${data[i].upload_time}</td>
                    <td class="align-middle p-2">
                        <div class="d-flex justify-content-center">
                            <a href="#"
                               class="btn btn-round btn-info d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;"><i class="fas fa-info"></i></a>
                            <a href="#"
                               class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;"><i class="fas fa-edit"></i></a>
                            <a href="#"
                               class="btn btn-round btn-danger d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
            `
        }
        $('tbody').append(content);
        
        let page = '';
        let maxPage = Math.ceil(data.length / 20);
        console.log(data.length / 20);
        for(i = 1; i <= maxPage ; i++){
            page += `
                <button id="pageBtn" type="button" class="btn btn-secondary flex-grow-0" data-page="${i}">${i}</button>
            `;
        }
        $('#btnPrevious').after(page);

        $('#pageBtnGroup').on('click', '#pageBtn', function(){
            let page = $(this).data("page");
            $(this).addClass('active').siblings().removeClass('active');
            console.log(page);
            content = '';
            $('tbody').empty();
            console.log(page*20 ,page*20-20);
            let pageChange = page*20;
            console.log(page, maxPage)

            // if(page == maxPage){
            //     pageChange = ((page-1)*20) + data.length % 20;
            // }
            


            for (let i = page*20-20; i < pageChange; i++) {
                if(!data[i]) break;
                content += `
                    <tr class="even pointer p-0">
                        <td class="text-center align-middle">
                            <input type="checkbox" class="" name="">
                        </td>
                        <td class="align-middle p-2">${data[i].sku_code}</td>
                        <td class="align-middle text-center p-2">${data[i].category}</td>
                        <td class="align-middle p-2" style="max-width: 200px;">${data[i].product_name}</td>
                        <td class="align-middle text-center px-2 p-1">${data[i].sku_group}</td>
                        <td class="align-middle text-right p-2">${data[i].price}</td>
                        <td class="align-middle text-right p-2">${data[i].stock}</td>
                        <td class="align-middle text-center p-2"><span class="badge badge-${data[i].stytusStyle}">${data[i].status}</span></td>
                        <td class="align-middle p-2">${data[i].upload_time}</td>
                        <td class="align-middle p-2">${data[i].upload_time}</td>
                        <td class="align-middle p-2">
                            <div class="d-flex justify-content-center">
                                <a href="#"
                                   class="btn btn-round btn-info d-flex justify-content-center align-items-center "
                                   style="width: 30px;height: 30px;"><i class="fas fa-info"></i></a>
                                <a href="#"
                                   class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "
                                   style="width: 30px;height: 30px;"><i class="fas fa-edit"></i></a>
                                <a href="#"
                                   class="btn btn-round btn-danger d-flex justify-content-center align-items-center "
                                   style="width: 30px;height: 30px;"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </td>
                    </tr>
                `
            }
            $('tbody').append(content);
        });


        $('#filterSearch').click(function () {
            content = '';
            data = [];
            console.log('good');
            statusFilter = $('#statusFilter').val();
            categoryFilter = $('#categoryFilter').val();
            costFilterMax = $('#costFilterMax').val();
            costFilterMin = $('#costFilterMin').val();
            if(costFilterMax == ''){
                costFilterMax = '99999';
            }else if(costFilterMax < costFilterMin){
                alert('請輸入正確最大值');
                return ;
            }else{
                costFilterMax = costFilterMax;
            }
            if(costFilterMin == ''){
                costFilterMin = '0';
            }else if(costFilterMin > costFilterMax){
                alert('請輸入正確最小值');
                return ;
            }else{
                costFilterMin = costFilterMin;
            }
            console.log(statusFilter, categoryFilter, costFilterMax, costFilterMin);
            $('tbody').empty();
            data = $.grep(originData, (row) => {
                if(statusFilter == '0' && categoryFilter =='0'){
                    return row.price <= Number(costFilterMax) && row.price >= Number(costFilterMin);
                }else if(statusFilter == '0'){
                    return row.category_id == categoryFilter && row.price <= Number(costFilterMax) && row.price >= Number(costFilterMin);
                }else if(categoryFilter =='0'){
                    return row.status_id == statusFilter && row.price <= Number(costFilterMax) && row.price >= Number(costFilterMin);
                }else{
                    return row.status_id == statusFilter && row.category_id == categoryFilter && row.price <= Number(costFilterMax) && row.price >= Number(costFilterMin);
                }
            });
            console.log(data);

            $('#dataCount').text(`共有${data.length}件商品`);
            console.log($('#dataCount').text());

            for (let i = 0; i < 20; i++) {
                
                content += `
                <tr class="even pointer p-0">
                    <td class="text-center align-middle">
                        <input type="checkbox" class="" name="">
                    </td>
                    <td class="align-middle p-2">${data[i].sku_code}</td>
                    <td class="align-middle text-center p-2">${data[i].category}</td>
                    <td class="align-middle p-2" style="max-width: 200px;">${data[i].product_name}</td>
                    <td class="align-middle text-center px-2 p-1">${data[i].sku_group}</td>
                    <td class="align-middle text-right p-2">${data[i].price}</td>
                    <td class="align-middle text-right p-2">${data[i].stock}</td>
                    <td class="align-middle text-center p-2"><span class="badge badge-${data[i].stytusStyle}">${data[i].status}</span></td>
                    <td class="align-middle p-2">${data[i].upload_time}</td>
                    <td class="align-middle p-2">${data[i].upload_time}</td>
                    <td class="align-middle p-2">
                        <div class="d-flex justify-content-center">
                            <a href="#"
                               class="btn btn-round btn-info d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;"><i class="fas fa-info"></i></a>
                            <a href="#"
                               class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;"><i class="fas fa-edit"></i></a>
                            <a href="#"
                               class="btn btn-round btn-danger d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
            `
            }
            $('tbody').append(content);
            
        });

    }).catch(function (error) {
        console.log(error);
    }
    );

//-------------------------------------------
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
  })


