<?php
require_once('includes/config.php');

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];
} else {
    echo 'No data!!';
    exit;
}

$brandSql = "SELECT id, name FROM brand WHERE valid = 1";
$brandStmt = $db_host->prepare($brandSql);
try {
    $brandStmt->execute();
    $brandRows = $brandStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}

if (isset($_POST['editImg'])) {
    $editImg = $_POST['editImg'];
}

if (isset($_POST['productSkuValid'])) {
    $productSkuValid = $_POST['productSkuValid'];
}



$editProductName = $_POST['editProductName'];
$editBrand = $_POST['editBrand'];
$editProductCategory = $_POST['editProductCategory'];
$editProductIntro = $_POST['editProductIntro'];
$typeGroup = $_POST['typeGroupEdit'];
$typeValueIdGroup = array_keys($typeGroup);                 //id of type value
$idOfEditProductSku = $_POST['idOfEditProductSku'];
$editSkuCode = $_POST['editSkuCode'];
$editStock = $_POST['editStock'];
$editPrice = $_POST['editPrice'];
$editStatus = $_POST['editStatus'];
$changeImg = $_FILES['file']['name'];
$now = date('Y-m-d H:i:s');

//轉換成代號
foreach ($brandRows as $row) {
    if ($editBrand == $row['name']) {
        $editBrand = $row['id'];
        break;
    }
}

//價格的顯示
if (count($editPrice) > 1 &&  min($editPrice) != max($editPrice)) {
    $productPrice = min($editPrice) . '~' . max($editPrice);
} else {
    $editProductPrice = $editPrice[0];
}

# 取得上傳檔案數量
$fileCount = count($_FILES['file']['name']);
// echo ($fileCount);

if (true) {
    for ($i = 0; $i < $fileCount; $i++) {
        # 檢查檔案是否上傳成功
        if ($_FILES['file']['error'][$i] === UPLOAD_ERR_OK) {
            // echo '檔案名稱: ' . $_FILES['file']['name'][$i] . '<br/>';
            // echo '檔案類型: ' . $_FILES['file']['type'][$i] . '<br/>';
            // echo '檔案大小: ' . ($_FILES['file']['size'][$i] / 1024) . ' KB<br/>';
            // echo '暫存名稱: ' . $_FILES['file']['tmp_name'][$i] . '<br/>';

            # 檢查檔案是否已經存在
            if (file_exists('../db_img/' . $_FILES['file']['name'][$i])) {
                // echo '檔案已存在。<br/>';
            } else {
                $file = $_FILES['file']['tmp_name'][$i];
                $dest = '../db_img/' . $_FILES['file']['name'][$i];

                # 將檔案移至指定位置
                move_uploaded_file($file, $dest);
            }
        } else {
            echo '錯誤代碼：'; 
            var_dump($_FILES['file']['error']);
            echo '<br/>';
        }
    }
}


// var_dump($productId);
// echo ('<br>');
// var_dump($editProductName);
// echo ('<br>');
var_dump($editBrand);
// echo ('<br>');
// var_dump($editProductCategory);
// echo ('<br>');
// var_dump($editProductIntro);
// echo ('<br>');
// var_dump($typeGroup);
// echo ('<br>');
// var_dump($editImg);
// echo ('<br>');
// var_dump($idOfEditProductSku);
// echo('<br>');
// var_dump($editSkuCode);
// echo('<br>');
// var_dump($editStock);
// echo('<br>');
// var_dump($editPrice);
// echo('<br>');
// var_dump($editStatus);
// echo('<br>');
// var_dump($productSkuValid);
// echo ('<br>');
// var_dump($changeImg);
// echo ('<br>');

//product update
$productSql = "UPDATE product SET name=?, category=?, brand=?, intro=?, price=?, update_time=? WHERE id=?";
$productStmt = $db_host->prepare($productSql);

//SKU update
$productSkuSql = "UPDATE product_sku SET sku_code=?, price=?, stock=?, update_time=?, status=? WHERE id=?";
$productSkuStmt = $db_host->prepare($productSkuSql);

//type value update
$productTypeValueSql = "UPDATE product_type_value SET type_value=? WHERE id=?";
$productTypeValueStmt = $db_host->prepare($productTypeValueSql);

//img update
$productImgSql = "UPDATE product_img SET img_name=? WHERE id=?";
$productImgStmt = $db_host->prepare($productImgSql);

//delete SKU
$deleteSkuSql = "UPDATE product_sku SET valid=? WHERE id=?";
$deleteSkuStmt = $db_host->prepare($deleteSkuSql);



try {
    //product update
    $productStmt->execute([$editProductName, $editProductCategory, $editBrand, $editProductIntro, $editProductPrice, $now, $productId]);

    //SKU update
    for ($i = 0; $i < count($idOfEditProductSku); $i++) {
        $updateSkuCode = $editSkuCode[$i];
        $updatePrice = $editPrice[$i];
        $updateStock = $editStock[$i];
        $updateStatus = $editStatus[$i];
        $productSkuId = $idOfEditProductSku[$i];

        $productSkuStmt->execute([$updateSkuCode, $updatePrice, $updateStock, $now, $updateStatus, $productSkuId]);
    }

    //type value update
    foreach ($typeValueIdGroup as $key) {
        $typeValueId = $key;
        $typeValue = $typeGroup[$key];
        $productTypeValueStmt->execute([$typeValue, $typeValueId]);
    }

    //img update
    if (count($changeImg) >= 1 && isset($editImg)) {
        $len = (count($changeImg) > count($editImg)) ? count($editImg) : count($changeImg);
        for ($i = 0; $i < $len; $i++) {
            $imgId = $editImg[$i];
            $newImgName = $_FILES['file']['name'][$i];

            $productImgStmt->execute([$newImgName, $imgId]);
        }
    }

    //delete SKU
    if(isset($productSkuValid)){
        foreach($productSkuValid as $value){
            $deleteSkuStmt->execute([0, $value]);
        }
    }


    echo 'modify account success';
} catch (PDOException $e) {
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}
