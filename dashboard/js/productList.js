axios({
    method: 'post',
    url: '/project_01/dashboard/api/productCategory.php',
}).then(function(response){
    let categoryData = response.data;
    let content = '';
    console.log(categoryData);

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
    url: '/project_01/dashboard/api/productList.php',
})
    .then(function (response) {
        // console.log(response);
        let originalData = response.data;
        // console.log(data);
        let content;
        let data = [];
        data = $.grep(originalData, (row) => {
            return row.status !== '0';
        });

        $('#dataCount').text(`共有${data.length}件商品`);
        console.log($('#dataCount').text());

        


        for(let i = 0; i < 20; i++){
            let status, statusColor;
            switch(data[i].status){
                case '1':
                    status = '供貨中';
                    statusColor = 'success';
                    break;
                case '2':
                    status = '已下架';
                    statusColor = 'secondary';
                    break;
                case '3':
                    status = '缺貨中';
                    statusColor = 'danger';
                    break;
            }
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
                    <td class="align-middle text-center p-2"><span class="badge badge-${statusColor}">${status}</span></td>
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
    }).catch(function (error) {
        console.log(error);
    }
);

$