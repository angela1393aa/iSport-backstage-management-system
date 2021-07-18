

axios({
    method: 'post',
    url: '/project_01/dashboard/api/productCreat.php',
}).then((response) => {
    let data = response.data;
    let brandContent = '';
    let categoryContent = '';
    let productTypeContent = '';

    let brandData = [];
    data['brand'].forEach(item => {
        brandData.push(item['name']);
    });
    console.log(brandData);
    data['brand'].forEach(item => {
        brandContent += `
            <option value="${item['name']}">
        `
    });
    $('#brandList').append(brandContent);
    // console.log(brandContent);

    data['category'].forEach(item => {
        categoryContent += `
        <option value="${item['id']}">${item['name']}</option>
        `
    });
    $('#categoryList').append(categoryContent);
    // console.log(categoryContent);

    data['productType'].forEach(item => {
        productTypeContent += `
        <option data-type="${item['id']}" value="${item['id']}">${item['name']}</option>
        `
    });
    $('.typeListSelect').append(productTypeContent);
    // console.log(productTypeContent);

    $('#brand').change(function () {
        let brandInput = $(this).val();
        let find = $.inArray(brandInput, brandData);
        $('#brandAlert').text('');
        if (find == -1) {
            $('#brandAlert').text('請選擇正確品牌名稱');
            console.log(find);
        }
    })


}).catch();



$('.typeListAdd').click(function () {
    let value = $('#typeConfig').val();
    if (value == 1) {
        // console.log($(this));
        let typeNum = $(this).closest('div').data('type');
        // console.log(typeNum);
        $(this).before(`
        <input class="col-1 bg-transparent my-0 ml-3 typeInput" type="text" name="typeValue${typeNum}[]">
        <a class="btn text-secondery p-0 my-0  typeListDelete" id=""><i class="fas fa-minus-square"></i></a>
    `)
    }

});
let typeInputeCount1 = [];
let typeInputeCount2 = [];
let typeTotal = 1;
let typeInputeCount1Length = 0;
let typeInputeCount2Length = 0;
let itemCount = 0;

function typeInputeCount(type, element) {
    let typeInputLength = element.closest('div').children('.typeInput').length;
    let typeInputVal = null;
    if (type == 1) {
        typeInputeCount1 = [];
        for (let i = 0; i < typeInputLength; i++) {
            typeInputVal = element.closest('div').children('.typeInput').eq(i).val();
            if (typeInputVal && typeInputVal != '') {
                typeInputeCount1.push(typeInputVal);
            }
        }
    } else {
        typeInputeCount2 = [];
        for (let i = 0; i < typeInputLength; i++) {
            typeInputVal = element.closest('div').children('.typeInput').eq(i).val();
            if (typeInputVal && typeInputVal != '') {
                typeInputeCount2.push(typeInputVal);
            }
        }
    }
}

typeTotalCalc = () => {
    $('#addItem .addBtn').prev().remove();
    typeInputeCount1Length = (typeInputeCount1.length > 0) ? typeInputeCount1.length : 1;
    typeInputeCount2Length = (typeInputeCount2.length > 0) ? typeInputeCount2.length : 1;
    typeTotal = typeInputeCount1Length * typeInputeCount2Length
    $('#addItem .addBtn').before(`<span class="mx-2">可以添加${typeTotal}項單品</span>`);
}

newSkuType = () => {
    console.log(typeInputeCount2, typeInputeCount1);
    let newSkuTypeListContent = '';
    $('.newSkuTypeList').empty();
    if (typeInputeCount1 <= 0 && typeInputeCount2 <= 0) {
        console.log('123466752');
        newSkuTypeListContent = '<option value="0">無</option>'
    } else if (typeInputeCount2 <= 0) {
        newSkuTypeListContent = '<option value="0">無</option>'
        console.log(typeInputeCount1Length)
        for (i = 0; i < typeInputeCount1Length; i++) {
            newSkuTypeListContent += `
                <option value="${i}">${typeInputeCount1[i]}</option>
            `
        }
        $('.newSkuTypeList').append(newSkuTypeListContent);
    } else if (typeInputeCount1 <= 0) {
        newSkuTypeListContent = '<option value="0">無</option>'
        console.log(typeInputeCount1Length)
        for (i = 0; i < typeInputeCount2Length; i++) {
            newSkuTypeListContent += `
                <option value="${i}">${typeInputeCount2[i]}</option>
            `
        }
        $('.newSkuTypeList').append(newSkuTypeListContent);
    } else {
        newSkuTypeListContent = '<option value="0">無</option>'
        console.log(typeInputeCount1Length, typeInputeCount2Length)
        for (i = 0; i < typeInputeCount1Length; i++) {
            for (j = 0; j < typeInputeCount2Length; j++) {
                newSkuTypeListContent += `
                <option value="${i},${j}">${typeInputeCount1[i]}  ${typeInputeCount2[j]}</option>
            `
            }
        }
        $('.newSkuTypeList').append(newSkuTypeListContent);
    }
}

itemLimitAlert = () => {
    console.log(itemCount, typeTotal);
    if (itemCount > typeTotal) {
        $('#addSkuAlert').text('已超出可新增數目請再修改');
        setTimeout(alert, 4500)
    }
}

changeName = (target, parent, children, name) => {
    let targetBrother = parent.find(children);
    for (i = 0; i < targetBrother.length; i++) {
        targetBrother.eq(i).attr('name', `${name}[${i}]`);
        // console.log(targetBrother.eq(i));
    }
}


$('.typeList').on('click', '.typeListDelete', function () {
    $(this).prev().remove();
    let typeNum = $(this).closest('div').data('type');
    typeInputeCount(typeNum, $(this));
    $(this).remove();
    typeTotalCalc();
    newSkuType();
    itemLimitAlert();
});



$('.typeList').on('change', '.typeInput', function () {
    let typeNum = $(this).closest('div').data('type');
    typeInputeCount(typeNum, $(this));
    typeTotalCalc();
    newSkuType();
    itemLimitAlert();
});

$('#addItemBtn').on('click', (function () {
    alert = () => {
        $('#addSkuAlert').text('')
    }
    let parent = $(this).closest('#addItem');
    itemCount = $('.itemInput').length;
    console.log(itemCount)
    console.log(typeTotal);
    if (itemCount > typeTotal) {
        $('#addSkuAlert').text('已超出新增上限');
        setTimeout(alert, 3500)
    } else if (itemCount >= typeTotal) {
        $('#addSkuAlert').text('已達新增上限');
        setTimeout(alert, 3500)
    } else {
        $('#addItem').append(`
        <div class="itemInput d-flex col-12 row py-3 mx-2 type-config shadow-sm my-1">
        <label class="text-body" for="">規格：</label>
        <select class="col-2 mr-2 bg-transparent newSkuTypeList sku-group"  id="newSkuTypeList" data-num="" name="skuGroup[]">
        <option value="0">無</option>
                        </select>
                        <label class="col-auto text-right text-body ml-3" for="" >貨號：</label>
                    <input class="col-3 bg-transparent sku-code" type="text" placeholder="" name="skuCode[]">
                    <label class="col-auto text-right text-body ml-3" for="">價格：</label>
                    <input class="col-1 bg-transparent sku-price" type="text" placeholder="" name="skuPrice[]">
                    <label class="col-auto text-right text-body ml-3" for="">數量：</label>
                    <input class="col-1 bg-transparent stock" type="text" placeholder="" name="stock[]">
                        <a class="btn text-secondery p-0 my-0 mx-1 itemListDelete flex-grow-1 text-right" id=""><i class="fas fa-minus-square"></i></a>
                      </div>
        `)
    }
    newSkuType();
    changeName($(this), parent, '.sku-group', 'skuGroup');
    changeName($(this), parent, '.sku-code', 'skuCode');
    changeName($(this), parent, '.sku-price', 'skuPrice');
    changeName($(this), parent, '.stock', 'stock');
}));

$('#addItem').on('click', '.itemListDelete', function () {
    let parent = $(this).closest('#addItem');
    // console.log($('.itemListDelete'))
    $(this).closest('div').remove();
    changeName($(this), parent, '.sku-group', 'skuGroup');
    changeName($(this), parent, '.sku-code', 'skuCode');
    changeName($(this), parent, '.price', 'price');
    changeName($(this), parent, '.stock', 'stock');
});



$('#typeConfig').on('change', function () {
    let value = $('#typeConfig').val();
    // console.log(value);
    if (value == 0) {
        $('.typeListSelect').attr("disabled", "disabled");
        $('.typeInput').attr('readonly');
        $('.typeInput').val('');
        $('.typeListSelect').val('0');
    } else {
        $('.typeListSelect').removeAttr("disabled", "disabled");
        $('.typeInput').removeAttr('readonly');
    }
})


let productNameCount = 0;
let introInputCount = 0;

$('#productName').on({
    change: function () {
        productNameCount = $(this).val().length;
        $('#productNameCount').css('color', '#73879C');
        $('#productNameCount').text(`${productNameCount}/100`);
        if (productNameCount >= 100) {
            $('#productNameCount').css('color', 'red');
        }
    },
    keydown: function () {
        productNameCount = $(this).val().length;
        $('#productNameCount').css('color', '#73879C');
        $('#productNameCount').text(`${productNameCount}/100`);
        if (productNameCount >= 100) {
            $('#productNameCount').css('color', 'red');
        }
        console.log(productNameCount);
    }
});

$('#introInput').on({
    change: function () {
        introInputCount = $(this).val().length;
        $('#introInputCount').css('color', '#73879C');
        $('#introInputCount').text(`${introInputCount}/1000`);
        if (introInputCount >= 1000) {
            $('#introInputCount').css('color', 'red');
        }
    },
    keydown: function () {
        introInputCount = $(this).val().length;
        $('#introInputCount').css('color', '#73879C');
        $('#introInputCount').text(`${introInputCount}/1000`);
        if (introInputCount >= 1000) {
            $('#introInputCount').css('color', 'red');
        }
        console.log(introInputCount);
    }
})


// -----------------------------------------------------------------------------
let photoInput = 0;
$("#productPhotoUpload").change(function () {
    $("#previewPhoto").html(""); // 清除預覽
    readURL(this);
});

function readURL(input) {
    photoInput = input.files.length;
    if (input.files && input.files.length >= 0) {
        for (let i = 0; i < input.files.length; i++) {
            $('#previewPhoto').append(`
          <figure class="col-3 mx-0 my-1 p-0 figure">
          </figure>
          `)
            let reader = new FileReader();
            reader.onload = function (e) {
                let img = $('<img class="d-block img-thumbnail">').attr('src', e.target.result);
                $(".figure").eq(i).append(img);
                console.log(e.target.result);
            }
            reader.readAsDataURL(input.files[i]);
        }
    } else {
        let noPictures = $("<p>目前沒有圖片</p>");
        $("#previewPhoto").append(noPictures);
    }
}
//-----------------------------------------------------------------------------------
$('#submitBtn').click(function (e) {
    let value = $('#typeConfig').val();
    let productNameValue = $('#productName').val();
    const skuCodeRules = /[\d]{8}/
    let verify = true;

    console.log(value);

    console.log('123')
    e.preventDefault();
    // console.log(productNameCount);
    $('.submitAlert').empty();
    alert = '';
    if (productNameValue == '') {
        alert += '<p class="p-1 m-0">*請輸入商品名稱</p>';
        verify = false;
    } else if (productNameValue.indexOf(' ') >= 0) {
        alert += '<p class="p-1 m-0">*商品名稱不能包含空格</p>';
        verify = false;
    } else if (productNameCount > 100) {
        alert += '<p class="p-1 m-0">*商品名稱過長</p>'
        verify = false;
    }

    if (value == 1 && ($('.typeListSelect').eq(0).val() == 0 && $('.typeListSelect').eq(1).val() == 0)) {
        alert += '<p class="p-1 m-0">*請設定規格</p>';
        verify = false;
    }

    if ($('#categoryList').val() < 0 || $('#categoryList').val() == '') {
        alert += '<p class="p-1 m-0">*請選擇商品分類</p>';
        verify = false;
    }

    for (let i = 0; i < $('.sku-group').length; i++) {
        if ($('.sku-group').eq(i).val() == '' || $('.sku-code').eq(i).val() == '' || $('.sku-price').eq(i).val() == '' || $('.stock').eq(i).val() == '') {
            alert += '<p class="p-1 m-0">*請輸入欲新增之單品的完整資訊</p>';
            verify = false;
            break;
        }
    }
    // for(let i = 0; i < $('.sku-group').length; i++){
    //     console.log(skuCodeRules.test($('.sku-code').eq(i).val()));

    //     if(skuCodeRules.test($('.sku-code').eq(i).val())){
    //         alert += '<p class="p-1 m-0">*貨號須為8碼數字</p>';
    //         verify = false;
    //         break;
    //     }
    // }
    if (photoInput == 0) {
        alert += '<p class="p-1 m-0">*請至少選擇一張圖片</p>';
        verify = false;
    }

    if (introInputCount > 1000) {
        alert += '<p class="p-1 m-0">*商品介紹過長</p>'
        verify = false;
    }
    $('.submitAlert').append(alert);
    if (verify) {
        $('.typeListSelect').removeAttr("disabled", "disabled");
        $('.typeInput').removeAttr('readonly');
        $("form").submit();
    }

});

