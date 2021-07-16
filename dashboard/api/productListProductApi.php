<?php
require_once('../includes/config.php');
$id=$_POST["product_id"];
// $id = 3;
$productSql = "SELECT * FROM product WHERE valid = 1 AND id = ?";
$productStmt = $db_host->prepare($productSql);

$productSkuSql = "SELECT * FROM product_sku WHERE valid = 1 AND product_id=?";

$categorySql = "SELECT * FROM product_category";
$brandSql = "SELECT * FROM brand WHERE valid = 1";
$statusSql = "SELECT * FROM product_status";
$typeSql = "SELECT * FROM product_type_value WHERE product_id=?";

$productSkuStmt = $db_host->prepare($productSkuSql);
$categoryStmt = $db_host->prepare($categorySql);
$brandStmt = $db_host->prepare($brandSql);
$statusStmt = $db_host->prepare($statusSql);

$typeStmt = $db_host->prepare($typeSql);




try {
    $productSkuStmt->execute([$id]);
    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);

    $productStmt->execute([$id]);
    $productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);


    $typeStmt->execute([$id]);
    $categoryStmt->execute();
    $statusStmt->execute();
    $brandStmt->execute();

    $typeRows = $typeStmt->fetchAll(PDO::FETCH_ASSOC);
    $categoryRows = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
    $statusRows = $statusStmt->fetchAll(PDO::FETCH_ASSOC);
    $brandRows = $brandStmt->fetchAll(PDO::FETCH_ASSOC);

    $typeGroupArr = [];
    foreach ($typeRows as $row) {
        $typeGroupArr[$row['type_id']][$row['id']] = $row['type_value'];
    }
    // print_r($typeGroupArr);

    

    $creatTimeArr = [];
    $productArr = [];
    $productCategory = [];
    $brandArr = [];

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
    // print_r($typeArr);
    foreach ($categoryRows as $row) {
        $categoryArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($statusRows as $row) {
        $statusArr[$row['id']] = $row['name'];                  //以id作為key產生新的陣列以便後續取值
    }

    $totalArr = [];
    $totalSql = "SELECT product_id,sum(stock) AS totalStock,sum(sale) AS totalSale,max(update_time) AS maxUpdateTime FROM product_sku WHERE product_id=$id";
    $totalStmt = $db_host->prepare($totalSql);
    $totalStmt->execute();
    $totalRows = $totalStmt->fetchAll(PDO::FETCH_ASSOC);

    // print_r($totalArr);

    $imgArr = [];
    $imgSql = "SELECT product_id,GROUP_CONCAT(id) AS img_id,GROUP_CONCAT(img_name) AS img_name FROM product_img GROUP BY product_id ORDER BY product_id";
    $imgStmt = $db_host->prepare($imgSql);
    $imgStmt->execute();
    $imgRows = $imgStmt->fetchAll(PDO::FETCH_ASSOC);

    $img = [];
    foreach ($imgRows as $row) {
        $arr1 = explode(',', $row['img_id']);
        $arr2 = explode(',', $row['img_name']);
        $arr3 = [];
        for ($i = 0; $i < count($arr1); $i++) {
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
        $product = [
            'product_id' => $row['id'],
            'category' => $categoryArr[$row['category']],
            'category_id' => $row['category'],
            'product_name' => $row['name'],
            'product_brand' => $brandArr[$row['brand']],
            'product_intro' => $row['intro'],
            'price' => $row['price'],
            'totalStock' => $totalRows[0]['totalStock'],
            'totalSale' => $totalRows[0]['totalSale'],
            'create_time' => $row['creat_time'],
            'maxUpdateTime' => $totalRows[0]['maxUpdateTime'],
            'product_img' => $imgArr[$row['id']]
        ];
        // array_push($product, $arr);
    }

    $jArr = [
        'productSku' => $productSku,
        'product' => $product,
        'typeGroup' => $typeGroupArr
    ];
} catch (PDOException $e) {
    echo "讀取資料失敗";
}

// print_r($productRows);


// var_dump($rows);
echo json_encode($jArr);

$db_host = null;
