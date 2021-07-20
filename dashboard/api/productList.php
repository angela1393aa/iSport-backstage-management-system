<?php
require_once('../includes/config.php');

// $sql = "SELECT product_sku.valid AS product_sku_valid,product_sku.stock,product_sku.status AS product_sku_status,product_sku.id AS product_sku_id,product_sku.sku_code,product_sku.status,product_sku.sku_group, product_sku.price AS product_sku_price, product_sku.stock,product_sku.Sales, product.*
//     	FROM product
//     	JOIN product_sku ON product.id = product_sku.product_id";
// $stmt = $db_host->prepare($sql);

$productSkuSql = "SELECT * FROM product_sku WHERE valid = 1";
$productSql = "SELECT * FROM product WHERE valid = 1 ORDER BY id DESC";
$typeSql = "SELECT * FROM product_type_value";
$categorySql = "SELECT * FROM product_category";
$statusSql = "SELECT * FROM product_status";
$brandSql = "SELECT * FROM brand WHERE valid = 1";

// $totalArr = [];
// for($i = 1; $i <= count($productRows); $i++){
//     $totalSql = "SELECT product_id,sum(stock) AS totalStock,sum(sale) AS totalSale FROM product_sku WHERE product_id=$i";
//     $totalStmt = $db_host->prepare($totalSql);
//     $totalStmt->execute();
//     $totalRows = $totalStmt->fetchAll(PDO::FETCH_ASSOC);
//     array_push($totalArr, $totalRows);
// }


$productSkuStmt = $db_host->prepare($productSkuSql);
$productStmt = $db_host->prepare($productSql);
$typeStmt = $db_host->prepare($typeSql);
$categoryStmt = $db_host->prepare($categorySql);
$statusStmt = $db_host->prepare($statusSql);
$brandStmt = $db_host->prepare($brandSql);

try {
    // $stmt->execute();
    // $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $productSkuStmt->execute();
    $productStmt->execute();
    $typeStmt->execute();
    $categoryStmt->execute();
    $statusStmt->execute();
    $brandStmt->execute();

    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);
    $productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);
    $typeRows = $typeStmt->fetchAll(PDO::FETCH_ASSOC);
    $categoryRows = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
    $statusRows = $statusStmt->fetchAll(PDO::FETCH_ASSOC);
    $brandRows = $brandStmt->fetchAll(PDO::FETCH_ASSOC);

    $creatTimeArr = [];
    $productArr = [];
    $productCategory = [];
    $brandArr =[];

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
    foreach ($brandRows as $row) {
        $brandArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }


    $typeArr = [];
    $categoryArr = [];
    $statusArr = [];
    $productSku = [];
    $product = [];
    foreach ($typeRows as $row) {
        $typeArr[$row['id']] = $row['type_value'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($categoryRows as $row) {
        $categoryArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($statusRows as $row) {
        $statusArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }

    $totalArr = [];
    for ($i = 1; $i <= count($productRows); $i++) {
        $totalSql = "SELECT product_id,sum(stock) AS totalStock,sum(sale) AS totalSale,max(update_time) AS maxUpdateTime FROM product_sku WHERE product_id=$i";
        $totalStmt = $db_host->prepare($totalSql);
        $totalStmt->execute();
        $totalRows = $totalStmt->fetchAll(PDO::FETCH_ASSOC);
        $totalArr[$i] = $totalRows;
    }
    // echo count($productRows);
    // print_r($totalArr);

    $imgArr = [];
        $imgSql = "SELECT product_id,GROUP_CONCAT(id) AS img_id,GROUP_CONCAT(img_name) AS img_name FROM product_img GROUP BY product_id ORDER BY product_id";
        $imgStmt = $db_host->prepare($imgSql);
        $imgStmt->execute();
        $imgRows = $imgStmt->fetchAll(PDO::FETCH_ASSOC);

    $img = [];
    foreach($imgRows as $row){
        $arr1 = explode(',', $row['img_id']);
        $arr2 = explode(',', $row['img_name']);
        $arr3 = [];
        for($i = 0; $i < count($arr1); $i++){
            $arr3[$arr1[$i]] = $arr2[$i];
        }
        array_push($img, $arr3);
        $imgArr[$row['product_id']] = $arr3;
    }
    // print_r($imgArr['2']);

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
            'product_name' => $productArr[$row['product_id']],
            'product_sku_id' => $row['id'],
            'category' => $categoryArr[$productCategory[$row['product_id']]],
            'category_id' => $productCategory[$row['product_id']],
            'sku_code' => $row['sku_code'],
            'sku_group' => $typeStr,
            'price' => $row['price'],
            'stock' => $row['stock'],
            'upload_time' => $creatTimeArr[$row['product_id']],
            'status_id' => $row['status'],
            'status' => $statusArr[$row['status']],
            'stytusStyle' => $statusStyle[$row['status']],
            'sale' => $row['sale']
        ];
        array_push($productSku, $arr2);                                   //將每一row(array)傳到一個陣列中
    }

    foreach ($productRows as $row) {
        $arr = [
            'product_id' => $row['id'],
            'category' => $categoryArr[$row['category']],
            'product_name' => $row['name'],
            'product_brand' => $brandArr[$row['brand']],
            'product_intro' => $row['intro'],
            'price' => $row['price'],
            'totalStock' => $totalArr[$row['id']][0]['totalStock'],
            'totalSale' => $totalArr[$row['id']][0]['totalSale'],
            'create_time' => $row['creat_time'],
            'last_update_time' => $row['update_time'],
            // 'maxUpdateTime' => $totalArr[$row['id']][0]['maxUpdateTime'],
            'product_img' => $imgArr[$row['id']]
        ];
        array_push($product, $arr);
    }

    $jArr = [
        'productSku' => $productSku,
        'product' => $product
    ];
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
$db_host = null;
