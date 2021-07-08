<?php
require_once('../includes/config.php');

// $sql = "SELECT product_sku.valid AS product_sku_valid,product_sku.stock,product_sku.status AS product_sku_status,product_sku.id AS product_sku_id,product_sku.sku_code,product_sku.status,product_sku.sku_group, product_sku.price AS product_sku_price, product_sku.stock,product_sku.Sales, product.*
//     	FROM product
//     	JOIN product_sku ON product.id = product_sku.product_id";
// $stmt = $db_host->prepare($sql);

$productSkuSql = "SELECT * FROM product_sku WHERE valid = 1";
$productSql = "SELECT id, name, creat_time, category FROM product WHERE valid = 1";
$typeSql = "SELECT * FROM product_type_value";
$categorySql = "SELECT * FROM product_category";
$statusSql = "SELECT * FROM product_status";

$productSkuStmt = $db_host->prepare($productSkuSql);
$productStmt = $db_host->prepare($productSql);
$typeStmt = $db_host->prepare($typeSql);
$categoryStmt = $db_host->prepare($categorySql);
$statusStmt = $db_host->prepare($statusSql);

try {
    // $stmt->execute();
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $productSkuStmt->execute();
    $productStmt->execute();
    $typeStmt->execute();
    $categoryStmt->execute();
    $statusStmt->execute();

    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);
    $productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);
    $typeRows = $typeStmt->fetchAll(PDO::FETCH_ASSOC);
    $categoryRows = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
    $statusRows = $statusStmt->fetchAll(PDO::FETCH_ASSOC);

    $creatTimeArr = [];
    $productArr = [];
    $productCategory = [];

    $statusStyle = [
        '1' => 'success',
        '2' => 'danger',
        '3' => 'secondary'
    ];
    foreach ($productRows as $row) {
        $creatTimeArr[$row['id']] = $row['creat_time'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($productRows as $row) {
        $productArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($productRows as $row) {
        $productCategory[$row['id']] = $row['category'];                  //以id作為key產生新的陣列以便後續取值
    }

    $typeArr = [];
    $categoryArr = [];
    $statusArr = [];
    $jArr = [];
    foreach ($typeRows as $row) {
        $typeArr[$row['id']] = $row['type_value'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($categoryRows as $row) {
        $categoryArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($statusRows as $row) {
        $statusArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($productSkuRows as $row) {
        $typeStrArr = [];
        $arr = explode(',', $row['sku_group']);                     //字串分割變成陣列
        foreach ($arr as $value) {
            if (!empty($value)) {
                array_push($typeStrArr, $typeArr[$value]);          //陣列的值變成key並得出相對值 xe:1 => 黑
            } else {
                array_push($typeStrArr, "");                        //有些資料的type_value為空會錯誤 因此判斷後給空字串
            }
        }
        $typeStr = implode(' ', $typeStrArr);                       //將新陣列串 之後傳到$arr2裡面
        $arr2 = [
            'product_id' => $row['id'],
            'product_name' => $productArr[$row['product_id']],
            'category' => $categoryArr[$productCategory[$row['product_id']]],
            'category_id' => $productCategory[$row['product_id']],
            'sku_code' => $row['sku_code'],
            'sku_group' => $typeStr,
            'price' => $row['price'],
            'stock' => $row['stock'],
            'upload_time' => $creatTimeArr[$row['product_id']],
            'status_id' => $row['status'],
            'status' => $statusArr[$row['status']],
            'stytusStyle' => $statusStyle[$row['status']]
        ];
        array_push($jArr, $arr2);                                   //將每一row(array)傳到一個陣列中
    }
//    var_dump($jArr);
//foreach ($jArr as $value){
//    print_r($value);
//    echo '<br>';
//}
    echo json_encode($jArr);                                        //形成json檔
} catch (PDOException $e) {
    echo 'database connection error : <br>' . $e->getMessage() . '<br>';
    exit();
}
?>