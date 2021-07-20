<?php
require_once("../includes/config.php");

// 用PDO將資料庫資料提取 -> 轉成json檔 -> 再以js方式取得json檔裡的資訊
// 取得品名及料號
$userOrderSql = "SELECT * FROM user_order WHERE valid = 1";
$productSql = "SELECT id, name FROM product WHERE valid = 1";
$productSkuSql = "SELECT id, product_id, sku_code FROM product_sku WHERE valid = 1";

$userOrderStmt = $db_host->prepare($userOrderSql);
$productStmt = $db_host->prepare($productSql);
$productSkuStmt = $db_host->prepare($productSkuSql);


try{
    $userOrderStmt->execute();
    $productStmt->execute();
    $productSkuStmt->execute();

    $userOrderRows = $userOrderStmt->fetchAll(PDO::FETCH_ASSOC);
    $productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);
    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);

    $orderArr = [];
    $productArr = [];
    $productSkuArr = [];
    $productIdArr = [];
    $productResultArr = [];
    $arr = [];
    $combineArr = [];

    foreach ($userOrderRows as $userOrderRow){
        $arr = [
            // 'order_date' => $userOrderRow['order_date'],
            // 'order_id' => $userOrderRow['id'],
            // 'order_no' => $userOrderRow['order_no'],
            // 'recipient' => $userOrderRow['recipient'],
            // 'user_id' => $userOrderRow['user_id'],
            // 'user_account' => $userArr[$userOrderRow['user_id']],
            // 'phone' => [$userOrderRow['phone']],
            // 'address' => [$userOrderRow['address']],
            // 'order_status' => $orderStatusArr[$userOrderRow['order_status']],
            // 'invoice_no' => $userOrderRow['invoice_no'],
            'paytype' => $userOrderRow['paytype'],
            'delivery' => $userOrderRow['delivery'],
        ];
        array_push($orderArr, $arr);
    }

    foreach ($productRows as $productRow){
        $productArr[$productRow["id"]] = $productRow["name"];
        // $arr = [
            //         "id" => $productRow["id"],
            //         "name" => $productRow["name"],
            //     ];
            //     array_push($resultArr, $arr);
        };
        // print_r($productArr);
        // echo json_encode($resultArr);
        
        foreach ($productSkuRows as $productSkuRow){
            // $productSkuArr[$productSkuRow["id"]] = $productSkuRow["sku_code"];
            // $productIdArr[$productSkuRow["id"]] = $productSkuRow["product_id"];
            $arr = [
                "id" => $productSkuRow["id"],
                "product_id" => $productSkuRow["product_id"],
                "sku_code" => $productSkuRow["sku_code"],
                "name" => $productArr[$productSkuRow["product_id"]],
            ];
            array_push($productResultArr, $arr);
        };
        // print_r($productSkuArr);

        // 將使用者訂單$orderArr與連結過後的產品陣列$productResultArr(product + product_sku資料表),合併成 $combineArr
        $combineArr = [
            'userOrder' => $orderArr,
            'product' => $productResultArr,
        ];
        echo json_encode($combineArr);
        
}catch (PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e -> getMessage(). "<br>";
    exit;
}

?>