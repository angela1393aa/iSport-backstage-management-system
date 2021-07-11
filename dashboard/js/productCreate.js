axios({
    method: 'post',
    url: '/project_01/dashboard/api/productCreat.php',
}).then((response) => {
    let data = response.data;
    let brandContent = '';
    let categoryContent = '';
    let productTypeContent = '';

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


}).catch();


$('.typeListAdd').click(function () {
    // console.log($(this));
    let typeNum = $(this).closest('div').data('type');
    // console.log(typeNum);
    $(this).before(`
        <input class="col-1 bg-transparent my-0 ml-3 typeInput" type="text" name="typeValue${typeNum}[]">
        <a class="btn text-secondery p-0 my-0  typeListDelete" id=""><i class="fas fa-minus-square"></i></a>
    `)
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
    $('.newSkuTypeList').empty();
    if (typeInputeCount1 <= 0) {
        newSkuTypeListContent = '<option value="0">無</option>'
        console.log(typeInputeCount1Length)
        for (i = 0; i < typeInputeCount2Length; i++) {
            newSkuTypeListContent += `
                <option value="[2,${i}]">${typeInputeCount2[i]}</option>
            `
        }
        $('.newSkuTypeList').append(newSkuTypeListContent);
    } else if (typeInputeCount2 <= 0) {
        newSkuTypeListContent = '<option value="0">無</option>'
        console.log(typeInputeCount1Length)
        for (i = 0; i < typeInputeCount1Length; i++) {
            newSkuTypeListContent += `
                <option value="[1,${i}]">${typeInputeCount1[i]}</option>
            `
        }
        $('.newSkuTypeList').append(newSkuTypeListContent);
    } else if (typeInputeCount1 <= 0 && typeInputeCount2 <= 0) {
        $('.newSkuTypeList').empty();
    } else {
        newSkuTypeListContent = '<option value="0">無</option>'
        console.log(typeInputeCount1Length, typeInputeCount2Length)
        for (i = 0; i < typeInputeCount1Length; i++) {
            for (j = 0; j < typeInputeCount2Length; j++) {
                newSkuTypeListContent += `
                <option value="[1,${i}],[2,${j}]">${typeInputeCount1[i]}  ${typeInputeCount2[j]}</option>
            `
            }
        }
        $('.newSkuTypeList').append(newSkuTypeListContent);
    }
}

itemLimitAlert = () => {
    console.log(itemCount, typeTotal);
    if (itemCount > typeTotal) {
        alert('已超出可新增數目請再修改');
    }
}

changeName = (target, parent, children, name) => {
    let targetBrother = parent.find(children);
    for (i = 0; i < targetBrother.length; i++) {
        targetBrother.eq(i).attr('name', `${name}[${i}]`);
        console.log(targetBrother.eq(i));
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
    let parent = $(this).closest('#addItem');
    itemCount = $('.itemInput').length;
    console.log()
    console.log(typeTotal);
    if (itemCount > typeTotal) {
        alert('已超出新增上限');
    } else if (itemCount >= typeTotal) {
        alert('已達新增上限,請修改');
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
    console.log($('.itemListDelete'))
    $(this).closest('div').remove();
    changeName($(this), parent, '.sku-group', 'skuGroup');
    changeName($(this), parent, '.sku-code', 'skuCode');
    changeName($(this), parent, '.price', 'price');
    changeName($(this), parent, '.stock', 'stock');
});

$('#productName').on({
    change:function(){
        let length = $(this).val().length;
        $('#productNameCount').css('color','#73879C');
        $('#productNameCount').text(`${length}/100`);
        if(length >= 100){
            $('#productNameCount').css('color','red');
            }
    },
    keydown:function(){
        let length = $(this).val().length;
        $('#productNameCount').css('color','#73879C');
        $('#productNameCount').text(`${length}/100`);
        if(length >= 100){
            $('#productNameCount').css('color','red');
        }
        console.log(length);
    }
});

$('#submitBtn').click(function(e){
    e.preventDefault();
});
// -----------------------------------------------------------------------------
$("#productPhotoUpload").change(function () {
    $("#previewPhoto").html(""); // 清除預覽
    readURL(this);
});

function readURL(input) {
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