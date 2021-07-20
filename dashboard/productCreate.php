<?php
require_once('./includes/config.php');

if (isset($_POST['productName'])) {
    $productName = $_POST['productName'];
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

$productId = 41;

$brand = $_POST['brand'];
$newBrand = '';                         //篩選過的：轉成代號
$category = $_POST['category'];
$type = $_POST['type'];
$typeValue1 = $_POST['typeValue1'];
$newTypeValue1 = array_values(array_filter($typeValue1));       //篩選過的：過濾空值
$typeValue2 = $_POST['typeValue2'];
$newTypeValue2 = array_values(array_filter($typeValue2));       //篩選過的：過濾空值
$skuGroup = $_POST['skuGroup'];
$newSkuGroup = [];                      //篩選過的：將原始的字串轉成陣列
$dbSkuGroup = [];                      //篩選過的：變成將要儲存的id串
$skuCode = $_POST['skuCode'];
$skuPrice = $_POST['skuPrice'];
$productPrice = '';                     //篩選過的：將要儲存的格式
$stock = $_POST['stock'];
$intro = $_POST['intro'];
$now = date('Y-m-d H:i:s');

print_r($newTypeValue1);
print_r($newTypeValue2);


echo ('productName' . $productName . '<br>');
echo ('brand' . $brand . '<br>');
echo ('category' . $category . '<br>');
echo ('type');
print_r($type);
echo ('<br>');
echo ('typeValue1');
print_r($typeValue1);
echo ('<br>');
echo ('typeValue2');
print_r($typeValue2);
echo ('<br>');
echo ('skuGroup');
print_r($skuGroup);
echo ('<br>');
echo ('skuCode');
print_r($skuCode);
echo ('<br>');
echo ('skuPrice');
print_r($skuPrice);
echo ('<br>');
echo ('stock');
print_r($stock);
echo ('<br>');
echo ('intro' . $intro . '<br>');
echo ('now' . $now . '<br>');


//轉換成代號
foreach ($brandRows as $row) {
    if ($brand == $row['name']) {
        $newBrand = $row['id'];
        break;
    }
}

//價格的顯示
if (count($skuPrice) > 1 &&  min($skuPrice) != max($skuPrice)) {
    $productPrice = min($skuPrice) . '~' . max($skuPrice);
} else {
    $productPrice = $skuPrice[0];
}
// echo($productPrice);


//將字串變陣列
foreach ($skuGroup as $item) {
    array_push($newSkuGroup, explode(',', $item));
}
// print_r($newSkuGroup);



/**
 * product資料表寫入
 */
$productSql = "INSERT INTO product (name, category, brand, intro, price, creat_time) VALUE (?, ?, ?, ?, ?, ?) ";
$productStmt = $db_host -> prepare($productSql);
try {
  $productStmt->execute(([$productName, $category, $newBrand, $intro, $productPrice, $now]));
  $productId = $db_host->lastInsertId();
  echo($productId);
} catch (PDOException $e) {
  echo 'database connection error : <br>' . $e->getMessage() . '<br>';
  exit();
}



/**
 * product_type_value資料表寫入
 */
$productTypeValueSql = "INSERT INTO product_type_value (product_id, type_id, type_value) VALUE (?, ?, ?) ";
$productTypeValueStmt = $db_host->prepare($productTypeValueSql);
try {
    $productTypeValueId1 = [];
    $productTypeValueId2 = [];

    if ($newTypeValue1 && count($newTypeValue1) >= 1) {
        $typeId = $type[0];
        foreach ($newTypeValue1 as $value) {
            $typeValue = $value;
            $productTypeValueStmt->execute(([$productId, $typeId, $typeValue]));
            array_push($productTypeValueId1, $db_host->lastInsertId());
        }
    }

    if ($newTypeValue2 && count($newTypeValue2) >= 1) {
        $typeId = $type[1];
        foreach ($newTypeValue2 as $value) {
            $typeValue = $value;
            $productTypeValueStmt->execute(([$productId, $typeId, $typeValue]));
            array_push($productTypeValueId2, $db_host->lastInsertId());
        }
    }
    var_dump($productTypeValueId1);
    var_dump($productTypeValueId2);
} catch (PDOException $e) {
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}

/**
 * 生產sku_group
 */
if (count($productTypeValueId1) >= 1 && count($productTypeValueId2) >= 1) {
    foreach ($newSkuGroup as $item) {
        $newItem = $productTypeValueId1[$item[0]] . ',' . $productTypeValueId2[$item[1]];
        array_push($dbSkuGroup, $newItem);
    }
} else if (count($productTypeValueId1) >= 1 && count($productTypeValueId2) <= 0) {
    foreach ($newSkuGroup as $item) {
        $newItem = $productTypeValueId1[$item[0]];
        array_push($dbSkuGroup, $newItem);
    }
} else if (count($productTypeValueId1) <= 0 && count($productTypeValueId2) >= 1) {
    foreach ($newSkuGroup as $item) {
        $newItem = $productTypeValueId2[$item[1]];
        array_push($dbSkuGroup, $newItem);
    }
}else{
    $dbSkuGroup = [''];
}
print_r($dbSkuGroup);

/**
 * product_sku寫入
 */
$productSkuSql = "INSERT INTO product_sku (product_id, sku_code, sku_group, price, stock) VALUE (?, ?, ?, ?, ?) ";
$productSkuStmt = $db_host->prepare($productSkuSql);
try{
    for($i = 0; $i < count($dbSkuGroup); $i++){
        $skuCodeDb = $skuCode[$i];
        $dbSkuGroupDb = $dbSkuGroup[$i];
        $skuPriceDb = $skuPrice[$i];
        $stockDb = $stock[$i];
        $productSkuStmt->execute(([$productId, $skuCodeDb, $dbSkuGroupDb, $skuPriceDb, $stockDb]));
    }
} catch(PDOException $e){
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}

# 取得上傳檔案數量
$fileCount = count($_FILES['file']['name']);
echo ($fileCount);

if (true) {
    for ($i = 0; $i < $fileCount; $i++) {
        # 檢查檔案是否上傳成功
        if ($_FILES['file']['error'][$i] === UPLOAD_ERR_OK) {
            echo '檔案名稱: ' . $_FILES['file']['name'][$i] . '<br/>';
            echo '檔案類型: ' . $_FILES['file']['type'][$i] . '<br/>';
            echo '檔案大小: ' . ($_FILES['file']['size'][$i] / 1024) . ' KB<br/>';
            echo '暫存名稱: ' . $_FILES['file']['tmp_name'][$i] . '<br/>';

            # 檢查檔案是否已經存在
            if (file_exists('../db_img/' . $_FILES['file']['name'][$i])) {
                echo '檔案已存在。<br/>';
            } else {
                $file = $_FILES['file']['tmp_name'][$i];
                $dest = '../db_img/' . $_FILES['file']['name'][$i];

                # 將檔案移至指定位置
                move_uploaded_file($file, $dest);
            }
        } else {
            echo '錯誤代碼：' . $_FILES['file']['error'] . '<br/>';
        }
    }
}
//-------------------------------------------------------------------------

//圖片上傳
$productImgSql = "INSERT INTO product_img (product_id, img_name) VALUE (?, ?) ";
$productImgStmt = $db_host->prepare($productImgSql);
try{
    for($i = 0; $i < count($dbSkuGroup); $i++){
        $imgName = $_FILES['file']['name'][$i];
        $productImgStmt->execute(([$productId, $imgName]));
    }
} catch(PDOException $e){
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}
$db_host = null;
header('location: product_list.php');