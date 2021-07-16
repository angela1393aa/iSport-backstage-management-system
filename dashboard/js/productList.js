let statusFilter, categoryFilter, costFilterMax, costFilterMin;


axios({
    method: 'post',
    url: '/project_01/dashboard/api/productCreat.php',
}).then(function (response) {
    let categoryData = response.data.category;
    let brandData = response.data.brand;
    let content = '';
    categoryData.forEach(item => {
        content += `
        <option value="${item.id}">${item.name}</option>
         `
    });
    $('#categoryFilter').append(content);
    $('#productEditCategory').append(content);
    content = '';
    brandData.forEach(item => {
        content += `
        <option value="${item.name}"></option>
         `
    });
    $('#editBrandList').append(content);
}).catch(function (error) {
    console.log(error);
});


axios({
    method: 'post',
    url: '/project_01/dashboard/api/productList.php',
})
    .then(function (response) {
        let originData = response.data;
        let product = response.data.product;
        let productSku = response.data.productSku;
        let content;

        $('#dataCount').text(`共有${product.length}件商品`);
        console.log($('#dataCount').text());

        for (let i = 0; i < 20; i++) {

            content += `
                <tr class="even pointer p-0">
                    <td class="text-center align-middle">
                        <input type="checkbox" class="" name="">
                    </td>
                    <td class="align-middle p-2">${product[i].category}</td>
                    <td class="align-middle text-center p-2">${product[i].product_name}</td>
                    <td class="align-middle p-2" style="max-width: 200px;">${product[i].product_brand}</td>
                    <td class="align-middle text-center px-2 p-1">${product[i].product_intro}</td>
                    <td class="align-middle text-right p-2">${product[i].price}</td>
                    <td class="align-middle text-right p-2">${product[i].totalStock}</td>
                    <td class="align-middle text-center p-2"><span class="badge badge-${product[i].totalSale}">${product[i].totalSale}</span></td>
                    <td class="align-middle p-2">${product[i].create_time}</td>
                    <td class="align-middle p-2">${product[i].maxUpdateTime}</td>
                    <td class="align-middle p-2">
                        <div class="d-flex justify-content-center">
                            <a href="#"
                               class="btn btn-round btn-info d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;" data-id="${product[i].product_id}" id="info"><i class="fas fa-info"></i></a>
                            <a href="#"
                               class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;" data-toggle="modal" data-target=".bd-example-modal-xl" data-id="${product[i].product_id}" id="edit"><i class="fas fa-edit"></i></a>
                            <a href="#"
                               class="btn btn-round btn-danger d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;" data-id="${product[i].product_id}" id="delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
            `
        }
        $('#productTbody').append(content);
    }).catch();

$('#productTbody').on('click', '#edit', function () {
    $('#myModal').modal({ backdrop: 'static', keyboard: false });
    let id = $(this).data('id');
    let productFormData = new FormData();
    productFormData.append("product_id", id);
    axios.post('/project_01/dashboard/api/productListProductApi.php', productFormData)
        .then(function (response) {
            console.log(response);
            let product = response.data.product;
            let productSku = response.data.productSku;
            console.log(id);
            console.log(product.product_name);
            console.log(response.data);
            $('#editProductName').val(product.product_name);


        }).catch(function (error) {
            console.log(error)
        })
})

//------------------------------------------------------------
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})


