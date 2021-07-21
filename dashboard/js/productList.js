axios({
    method: 'post',
    url: '/project_01/dashboard/api/productCreat.php',
}).then(function (response) {
    let categoryData = response.data.category;
    let brandData = response.data.brand;
    let typeListData = response.data.typeList;
    let content = '';

    //列表品牌選項產生
    brandData.forEach(item => {
        content += `
        <option value="${item.name}">${item.name}</option>
         `
    });
    $('#brandFilter').append(content);
    content = '';

    //列表與編輯之分類選項產生
    categoryData.forEach(item => {
        content += `
        <option value="${item.name}">${item.name}</option>
         `
    });
    $('#categoryFilter').append(content);

    content = '';
    categoryData.forEach(item => {
        content += `
        <option value="${item.id}">${item.name}</option>
         `
    });
    $('#editProductCategory').append(content);
    content = '';

    //編輯品牌選項產生
    brandData.forEach(item => {
        content += `
        <option value="${item.name}"></option>
         `
    });
    $('#editBrandList').append(content);
    content = '';

    //編輯規格選項產生
    typeListData.forEach(item => {
        content += `
        <option value="${item.id}">${item.name_frontend}</option>
         `
    });
    $('.editProductType').append(content);
}).catch(function (error) {
    console.log(error);
});

//show all of products
//function for filters

/**
 * 品牌篩選器
 * @param {array} data 欲處理陣列
 * @param {string} brandValue 篩選品牌
 * @returns {array} 符合條件之陣列
 */
let brandFilter = (data, brandValue) => {
    let brandFilterArr = $.grep(data, (row) => {
        return row.product_brand == brandValue;
    })
    return brandFilterArr;
}


/**
 * 分類篩選器
 * @param {array} data 欲處理陣列
 * @param {string} categoryValue 篩選分類
 * @returns {array} 符合條件之陣列
 */
let categoryFilter = (data, categoryValue) => {
    let categoryFilterArr = $.grep(data, (row) => {
        return row.category == categoryValue;
    })
    // console.log(categoryFilterArr);
    return categoryFilterArr;
}

//function for search

/**
 * 搜尋篩選器
 * @param {array} data 欲處理陣列
 * @param {string} keyWord 搜尋的關鍵字
 * @returns {array} 搜尋結果之陣列
 */
let productNameSearch = (data, keyWord) => {
    let productNameSearchArr = $.grep(data, (row) => {
        return row.product_name.includes(keyWord);
    })
    return productNameSearchArr;
}


/**
 * 字串之空格與空白判斷
 * @param {string} str 
 * @returns {boolean} 
 */
let strIsSpace = (str) => {
    if (str == "") return true;
    let regRule = "^[ ]+$";
    let re = new RegExp(regRule);
    return re.test(str);
}

/**
 * 分頁按鈕
 * @param {array} data 將被呈現的資料
 */
let createPageBtn = (data) => {
    let maxPage = Math.ceil(data.length / 15);
    let pageBtn = '';
    console.log(data.length / 15);
    for (i = 1; i <= maxPage; i++) {
        pageBtn += `
                <button type="button" class="pageBtn btn btn-secondary flex-grow-0" data-page="${i}">${i}</button>
            `;
    }
    $('#pageBtnGroup').empty();
    $('#pageBtnGroup').append(pageBtn);
}


/**
 * 表格顯示
 * @param {number} startNum 資料起始筆數
 * @param {number} endNum 資料最後筆數
 * @param {array} data 資料陣列
 */
let tableShowLoop = (startNum, endNum, data) => {
    let content = '';
    $('#dataCount').text(`共有${data.length}件商品`);
    console.log($('#dataCount').text());
    for (let i = startNum; i < endNum; i++) {
        if (!data[i]) break;
        content += `
                <tr class="even pointer p-0">
                    <td class="align-middle text-center p-2">${data[i].category}</td>
                    <td class="align-middle p-2" style="max-width: 200px;">${data[i].product_name}</td>
                    <td class="align-middle  text-center p-2" >${data[i].product_brand}</td>
                    <td class="align-middle px-2 p-1 text-truncate" style="max-width: 300px;">${data[i].product_intro}</td>
                    <td class="align-middle text-right p-2">${data[i].price}</td>
                    <td class="align-middle text-right p-2">${data[i].totalStock}</td>
                    <td class="align-middle text-center p-2">${data[i].totalSale}</td>
                    <td class="align-middle text-center p-2">${data[i].create_time}</td>
                    <td class="align-middle text-center p-2">${data[i].last_update_time}</td>
                    <td class="align-middle p-2">
                        <div class="d-flex justify-content-center">
                            <a href="#"
                               class="btn btn-round btn-info d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;" data-toggle="modal" data-target="#infoModal" data-id="${data[i].product_id}" id="info"><i class="fas fa-info"></i></a>
                            <a href="#"
                               class="btn btn-round btn-secondary d-flex justify-content-center align-items-center "
                               style="width: 30px;height: 30px;" data-toggle="modal" data-target=".bd-example-modal-xl" data-id="${data[i].product_id}" id="edit"><i class="fas fa-edit"></i></a>
                            <a href="#"
                               class="btn btn-round btn-danger d-flex justify-content-center align-items-center"
                               style="width: 30px;height: 30px;" data-toggle="modal" data-target="#exampleModalCenter" data-index="${i}" id="delete"><i class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                </tr>
            `
    }
    $('#productTbody').empty();
    $('#productTbody').append(content);
}




axios({
    method: 'post',
    url: '/project_01/dashboard/api/productList.php',
})
    .then(function (response) {
        let originData = response.data;
        let product = response.data.product;
        let productSku = response.data.productSku;
        let treatedProduct = response.data.product;
        let content;
        //-------------------category and brand filter---------------------

        $('#filterSearch').click(function () {
            let categoryValue = $('#categoryFilter').val();
            let brandValue = $('#brandFilter').val();
            // console.log(categoryValue);
            // 1.分類過濾
            let firstFilterArr = (categoryValue != 0) ? categoryFilter(product, categoryValue) : product;
            // console.log(firstFilterArr);
            // 2.品牌過濾
            let lastFilterArr = (brandValue != 0) ? brandFilter(firstFilterArr, brandValue) : firstFilterArr;
            // console.log(lastFilterArr);

            treatedProduct = lastFilterArr;
            console.log(treatedProduct);
            tableShowLoop(0, 15, treatedProduct);
            createPageBtn(treatedProduct);
        })

        //----------------product name search-----------------------------
        $('#keyWordsSearchBtn').click(function () {
            let keyWord = $('#keyWordsSearchInput').val();
            if (strIsSpace(keyWord)) {
                alert('請輸入關鍵字且不得為空格');
            } else {
                // console.log(keyWord);
                //關鍵字搜尋結果
                let productNameSearchArr = productNameSearch(product, keyWord);
                // console.log(productNameSearchArr);

                treatedProduct = productNameSearchArr;
                console.log(treatedProduct);
                tableShowLoop(0, 15, treatedProduct);
                createPageBtn(treatedProduct);
            }
        })

        //-------------------------------change page--------------------------------------
        $('#pageBtnGroup').on('click', '.pageBtn', function () {
            let page = $(this).data("page");
            let startNum = (page - 1) * 15;
            let endNum = page * 15;
            $(this).addClass('active').siblings().removeClass('active');
            console.log(page);
            tableShowLoop(startNum, endNum, treatedProduct);
        });
        //-------------------------
        tableShowLoop(0, 15, treatedProduct);
        createPageBtn(treatedProduct);


        //-----------------------------delete---------------------------------
        $('#productTbody').on('click', '#delete', function () {
            // console.log(this)
            let index = $(this).data('index');
            $('#deleteAlert').text(treatedProduct[index].product_name);
            $('#deleteProductBtn').attr('href', `productDelete.php?id=${treatedProduct[index].product_id}`);
        })
    }).catch();


//-------------------------edit-------------------------------------------
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
            $('#editProductCategory').val(product.category_id);
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
            for (let i = 0; i < imgKeyArrLen; i++) {
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
            $('#editNoType').text('');
            productSku.forEach(element => {
                let sku_group = element['sku_group'];
                if( sku_group == ''){
                    sku_group = '無規格';
                    $('#editNoType').text('無規格');
                }
                content += `
                <tr class="even pointer p-0">
                <input type="hidden" value="${element['product_sku_id']}" name="idOfEditProductSku[]" class="form-control" readonly>
                    <td> <input type="text" value="${sku_group}" class="form-control" readonly> </td>
                    <td><input type="text" value="${element['sku_code']}" name="editSkuCode[]" class="form-control" ></td>
                    <td><input type="text" value="${element['stock']}" name="editStock[]" class="form-control" ></td>
                    <td><input type="text" value="${element['price']}" name="editPrice[]" class="form-control" ></td>
                    <td>
                        <select name="editStatus[]" class="form-control editSkuCategory${element['product_sku_id']}" data-category="${element['product_sku_id']}" >
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
            productSku.forEach(element => {
                $(`.editSkuCategory${element['product_sku_id']}`).val(element['status_id']);
            })

        }).catch(function (error) {
            console.log(error)
        })
})

$('#editProductImgBlock').on('click', 'figure', function () {
    if ($(this).closest('.imgCheck').find('input[type=checkbox]').prop('checked')) {
        $(this).closest('.imgCheck').find('input[type=checkbox]').prop('checked', false);
        $(this).css('border', 'none');
    } else {
        $(this).closest('.imgCheck').find('input[type=checkbox]').prop('checked', true);
        $(this).css('border', '1px solid #20c997');
    }
    // $('#editProductImgBlock').find(':checkbox').closest('.imgCheck').find('figure').css('border', 'none');
    // $('#editProductImgBlock').find(':checked').closest('.imgCheck').find('figure').css('border', '1px solid #20c997');
})

$('#editProductImgBlock').on('click', ':checkbox', function () {
    $(this).closest('.imgCheck').find('figure').css('border', 'none');
    $('#editProductImgBlock').find(':checked').closest('.imgCheck').find('figure').css('border', '1px solid #20c997');
})


$('#productSkuEditTbody').on('click', '.check-area', function () {
    if ($(this).closest('td').find('input[type=checkbox]').prop('checked')) {
        $(this).closest('td').find('input[type=checkbox]').prop('checked', false);
        $(this).closest('tr').css('background-color', '');
    } else {
        $(this).closest('td').find('input[type=checkbox]').prop('checked', true);
        $(this).closest('tr').css('background-color', '#FFECF5');
    }
})

$('#productSkuEditTbody').on('click', ':checkbox', function () {
    $(this).closest('tr').css('background-color', '');
    if ($(this).prop('checked')) {
        $(this).closest('tr').css('background-color', '#FFECF5');
    }
})

$('#submitUpdateBtn').click(function () {
    $('.submit-mask').css('display', 'block');
});

$('#cancelUpdate').click(function () {
    $('.submit-mask').css('display', 'none');
})

$('#confirmUpdate').click(function () {
    $('form').submit();
})

//---------------------info----------------------------------
$('#productTbody').on('click', '#info', function () {
    let id = $(this).data('id');
    let infoFormData = new FormData();
    let content = '';
    infoFormData.append("product_id", id);
    axios.post('/project_01/dashboard/api/productListProductApi.php', infoFormData)
        .then(function (response) {
            console.log(response);
            let product = response.data.product;
            let productSku = response.data.productSku;
            let img = product['product_img'];
            let imgArr = Object.values(img);

            // $('#infoModalTitle').text(product.product_name);
            $('#infoProductName').text(product.product_name);
            $('#infoBrand').text(product.product_brand);
            $('#infoCategory').text(product.category);
            $('#infoCreateTime').text(product.create_time);
            $('#infoUpdateTime').text(product.maxUpdateTime);
            $('#infoIntro').text(product.product_intro);

            productSku.forEach(element => {
                content += `
                <tr class="even pointer p-0">
                    <td class="text-center">${element['sku_code']}</td>
                    <td class="text-center">${element['sku_group']}</td>
                    <td class="text-center">${element['price']}</td>
                    <td class="text-center">${element['stock']}</td>
                    <td class="text-center">${element['sale']}</td>
                    <td class="text-center"><span class="badge badge-${element.stytusStyle}">${element['status']}</span></td>

                </tr>
                `
            })
            $('#productSkuInfoTbody').empty();
            $('#productSkuInfoTbody').append(content);

            content = '';
            imgArr.forEach(element => {
                content += `
                <figure>
                    <img src="../db_img/${element}" alt="">
                </figure>
                `
            })
            $('.info-img-small').empty();
            $('.info-img-small').append(content);

            let startImg = $('.info-img-small figure').eq(0).find('img').attr('src');
            console.log(startImg);
            $('.info-img-big img').attr('src', startImg)
            $('.info-img-small figure').eq(0).css('border', '2px solid #20c997');

        }).catch(function (error) {
            console.log(error)
        })
})

$('.info-img-small').on('click', 'figure', function(){
    let imgSrc = $(this).find('img').attr('src');
    $(this).siblings().css('border', '2px solid transparent');
    $(this).css('border', '2px solid #20c997')
    $('.info-img-big img').attr('src', imgSrc)
})


//------------------------------------------------------------
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})


