let statusFilter, categoryFilter, costFilterMax, costFilterMin;


axios({
    method: 'post',
    url: '/project_01/dashboard/api/productCreat.php',
}).then(function (response) {
    let categoryData = response.data.category;
    let brandData = response.data.brand;
    let typeListData = response.data.typeList;
    let content = '';
    categoryData.forEach(item => {
        content += `
        <option value="${item.id}">${item.name}</option>
         `
    });
    $('#categoryFilter').append(content);
    $('#editProductCategory').append(content);
    content = '';
    brandData.forEach(item => {
        content += `
        <option value="${item.name}"></option>
         `
    });
    $('#editBrandList').append(content);
    content = '';
    typeListData.forEach(item => {
        content += `
        <option value="${item.id}">${item.name_frontend}</option>
         `
    });
    $('.editProductType').append(content);



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
                    
                    <td class="align-middle text-center p-2">${product[i].category}</td>
                    <td class="align-middle p-2 text-truncate" style="max-width: 200px;">${product[i].product_name}</td>
                    <td class="align-middle  text-center p-2" >${product[i].product_brand}</td>
                    <td class="align-middle px-2 p-1 text-truncate" style="max-width: 200px;">${product[i].product_intro}</td>
                    <td class="align-middle text-right p-2">${product[i].price}</td>
                    <td class="align-middle text-right p-2">${product[i].totalStock}</td>
                    <td class="align-middle text-center p-2">${product[i].totalSale}</td>
                    <td class="align-middle text-center p-2">${product[i].create_time}</td>
                    <td class="align-middle text-center p-2">${product[i].last_update_time}</td>
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
    $('#productId').val(id);
    axios.post('/project_01/dashboard/api/productListProductApi.php', productFormData)
        .then(function (response) {
            let product = response.data.product;
            let productSku = response.data.productSku;
            let typeGroup = response.data.typeGroup;
            let arr = Object.keys(typeGroup);
            let len = arr.length;
            let imgKeyArr = Object.keys(product['product_img']);
            let imgKeyArrLen = imgKeyArr.length;
            console.log(imgKeyArr);
            console.log(imgKeyArr.length);
            let content = '';
            // console.log(id);
            console.log(product);
            console.log(productSku);
            // console.log(typeGroup);
            $('#productEditPageTitle').text(product.product_name);
            $('#editProductName').val(product.product_name);
            $('#editBrand').val(product.product_brand);
            $('#editProductCategory1').val(product.category_id);
            $('#editProductIntro').val(product.product_intro);

            // console.log(len);
            $(`#editProductTypeValue1`).empty();
            $(`#editProductTypeValue2`).empty();
            $(`#editProductType1`).val('');
            $(`#editProductType2`).val('');

            for (let i = 0; i < len; i++) {
                let key = arr[i];
                let keyArr = Object.keys(typeGroup[key]);
                let keyArrLen = keyArr.length;
                content = '';

                // console.log(arr[i]);
                // console.log(typeGroup[key]);
                $(`#editProductType${i + 1}`).val(key);
                for (let j = 0; j < keyArrLen; j++) {
                    content += `
                    <input type="text" class="form-control col-2 mr-0" value="${typeGroup[key][keyArr[j]]}" name="typeGroupEdit[${keyArr[j]}]">
                    `
                }
                $(`#editProductTypeValue${i + 1}`).append(content);
            }

            $('#editProductImgBlock').empty();
            content = '';
            for(let i = 0; i < imgKeyArrLen; i++){
                content += `
                <div class="col-3 p-1 mb-2 bd-change">
                <div class="row p-0 m-0 imgCheck">
                <input type="checkbox" name="editImg[]" value="${imgKeyArr[i]}" class="col-12 my-2">
                <figure class="m-0  p-0 figure ratio ratio-1x1 col-12">
                    <img class="d-block img-thumbnail" src="../db_img/${product['product_img'][imgKeyArr[i]]}">
                </figure>
                </div>
                </div>
                `
            }
            $('#editProductImgBlock').append(content);

            $('#productSkuEditTbody').empty();
            content = '';
            productSku.forEach(element => {
                content += `
                <tr class="even pointer p-0">
                <input type="hidden" value="${element['product_sku_id']}" name="idOfEditProductSku[]" class="form-control" readonly>
                    <td> <input type="text" value="${element['sku_group']}" class="form-control" readonly> </td>
                    <td><input type="text" value="${element['sku_code']}" name="editSkuCode[]" class="form-control" ></td>
                    <td><input type="text" value="${element['stock']}" name="editStock[]" class="form-control" ></td>
                    <td><input type="text" value="${element['price']}" name="editPrice[]" class="form-control" ></td>
                    <td>
                        <select name="editStatus[]" class="form-control" value="${element['status_id']}">
                            <option value="1">供貨中</option>
                            <option value="2">缺貨中</option>
                            <option value="3">已下架</option>
                        </select>
                    </td>
                    <td class="productSkuValidCheckbox text-center align-middle position-relative">
                        <div class="h-75 w-75 check-area"></div>
                        <input type="checkbox" value="${element['product_sku_id']}" name="productSkuValid[]" class="col-12" list="brandList">
                    </td>
                </tr>
                `
            })
            $('#productSkuEditTbody').append(content);
        }).catch(function (error) {
            console.log(error)
        })
})

$('#editProductImgBlock').on('click', 'figure',function(){
    if($(this).closest('.imgCheck').find('input[type=checkbox]').prop('checked')){
        $(this).closest('.imgCheck').find('input[type=checkbox]').prop('checked', false);
        $(this).css('border', 'none');
    }else{
        $(this).closest('.imgCheck').find('input[type=checkbox]').prop('checked', true);
        $(this).css('border', '1px solid #20c997');
    }
    // $('#editProductImgBlock').find(':checkbox').closest('.imgCheck').find('figure').css('border', 'none');
    // $('#editProductImgBlock').find(':checked').closest('.imgCheck').find('figure').css('border', '1px solid #20c997');
})

$('#editProductImgBlock').on('click', ':checkbox',function(){
    $(this).closest('.imgCheck').find('figure').css('border', 'none');
    $('#editProductImgBlock').find(':checked').closest('.imgCheck').find('figure').css('border', '1px solid #20c997');
})


$('#productSkuEditTbody').on('click', '.check-area', function(){
    if($(this).closest('td').find('input[type=checkbox]').prop('checked')){
        $(this).closest('td').find('input[type=checkbox]').prop('checked', false);
        $(this).closest('tr').css('background-color', '');
    }else{
        $(this).closest('td').find('input[type=checkbox]').prop('checked', true);
        $(this).closest('tr').css('background-color', '#FFECF5');
    }
})

$('#productSkuEditTbody').on('click', ':checkbox',function(){
    $(this).closest('tr').css('background-color', '');
    if($(this).prop('checked')){
        $(this).closest('tr').css('background-color', '#FFECF5');
    }
})

$('#submitUpdateBtn').click(function(){
    $('.submit-mask').css('display', 'block');
});

$('#cancelUpdate').click(function(){
    $('.submit-mask').css('display', 'none');
})

$('#confirmUpdate').click(function(){
    $('form').submit();
})

//------------------------------------------------------------
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})


