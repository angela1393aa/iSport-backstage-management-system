<?php
require_once("../includes/config.php");

// 用PDO將資料庫資料提取 -> 轉成json檔 -> 再以js方式取得json檔裡的資訊
// 取得品名及料號
$productSql = "SELECT id, name FROM product WHERE valid = 1";
$productSkuSql = "SELECT id, product_id, sku_code FROM product_sku WHERE valid = 1";

$productStmt = $db_host->prepare($productSql);
$productSkuStmt = $db_host->prepare($productSkuSql);


try{
    $productStmt->execute();
    $productSkuStmt->execute();

    $productRows = $productStmt->fetchAll(PDO::FETCH_ASSOC);
    $productSkuRows = $productSkuStmt->fetchAll(PDO::FETCH_ASSOC);

    $productArr = [];
    $productSkuArr = [];
    $productIdArr = [];
    $resultArr = [];
    $arr = [];
    


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
            array_push($resultArr, $arr);
        };
        // print_r($productSkuArr);
        echo json_encode($resultArr);
        
        // echo json_encode($$productArr);

}catch (PDOException $e){
    echo "資料庫連結失敗<br>";
    echo "Error: ".$e -> getMessage(). "<br>";
    exit;
}

?>