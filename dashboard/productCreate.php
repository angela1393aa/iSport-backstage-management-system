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



$brand = $_POST['brand'];
$newBrand = '';                         //篩選過的
$category = $_POST['category'];
$type = $_POST['type'];
$typeValue1 = $_POST['typeValue1'];
$typeValue2 = $_POST['typeValue2'];
$skuGroup = $_POST['skuGroup'];
$skuCode = $_POST['skuCode'];
$skuPrice = $_POST['skuPrice'];
$productPrice = '';                     //篩選過的
$stock = $_POST['stock'];
$intro = $_POST['intro'];
$now = date('Y-m-d H:i:s');

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


//
foreach ($brandRows as $row) {
    if ($brand == $row['name']) {
        $newBrand = $row['id'];
        break;
    }
}

if(count($skuPrice) > 1){
    $productPrice = min($skuPrice) . '~' . max($skuPrice);
}else{
    $productPrice = $skuPrice[0];
}
// echo($productPrice);

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
            if (file_exists('../upload/' . $_FILES['file']['name'][$i])) {
                echo '檔案已存在。<br/>';
            } else {
                $file = $_FILES['file']['tmp_name'][$i];
                $dest = '../upload/' . $_FILES['file']['name'][$i];

                # 將檔案移至指定位置
                move_uploaded_file($file, $dest);
            }
        } else {
            echo '錯誤代碼：' . $_FILES['file']['error'] . '<br/>';
        }
    }
}
//-------------------------------------------------------------------------












// $sql = "INSERT INTO users (name, phone, email, account, creat_time) VALUE (?, ?, ?, ?, ?) ";
// $stmt = $db_host -> prepare($sql);


// $stmt -> execute([$name, $phone, $email, $account, $creat_time]);

// echo 'creat account success';

// try {
//   $stmt->execute();
//   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } catch (PDOException $e) {
//   echo 'database connection error : <br>' . $e->getMessage() . '<br>';
//   exit();
// }

// $db_host = null;
