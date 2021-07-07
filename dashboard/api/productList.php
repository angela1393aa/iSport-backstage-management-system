<?php
require_once('../includes/config.php');

$sql = "SELECT product_sku.stock,product_sku.status AS product_sku_status,product_sku.id AS product_sku_id,product_sku.sku_code,product_sku.status,product_sku.sku_group, product_sku.price AS product_sku_price, product_sku.stock,product_sku.Sales, product.*
    	FROM product
    	JOIN product_sku ON product.id = product_sku.product_id";
$stmt = $db_host->prepare($sql);
$typeSql = "SELECT * FROM product_type_value";
$typeStmt = $db_host->prepare($typeSql);

try {
    $stmt->execute();
    $typeStmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $typeRows = $typeStmt->fetchAll(PDO::FETCH_ASSOC);
    $typeArr = [];
    $jArr = [];
    foreach ($typeRows as $row) {
        $typeArr[$row['id']] = $row['type_value'];                  //以id作為key產生新的陣列以便後續取值
    }
    foreach ($rows as $row) {
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
            'product_name' => $row['name'],
            'sku_code' => $row['sku_code'],
            'sku_group' => $typeStr,
            'price' => $row['product_sku_price'],
            'stock' => $row['stock'],
            'upload_time' => $row['creat_time'],
            'status' => $row['product_sku_status']
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