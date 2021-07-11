<?php

if (isset($_POST['productName'])){
    $productName = $_POST['productName'];
}else{
    echo 'No data!!';
    exit;
}

echo($productName . '<br>');

$brand = $_POST['brand'];
$category = $_POST['category'];
$type = $_POST['type'];
$typeValue1 = $_POST['typeValue1'];
$typeValue2 = $_POST['typeValue2'];
$skuGroup = $_POST['skuGroup'];
$skuCode = $_POST['skuCode'];
$skuPrice = $_POST['skuPrice'];
$stock = $_POST['stock'];
$intro = $_POST['intro'];
$now = date('Y-m-d H:i:s');

echo($productName . '<br>');
echo($brand . '<br>');
echo($category . '<br>');
print_r($type);
echo('<br>');
print_r($typeValue1);
echo('<br>');
print_r($typeValue2);
echo('<br>');
print_r($skuGroup);
echo('<br>');
print_r($skuCode);
echo('<br>');
print_r($skuPrice);
echo('<br>');
print_r($stock);
echo('<br>');
echo($intro . '<br>');
echo($now . '<br>');











































#--------------------------------圖片上傳----------------------------------------

# 取得上傳檔案數量
$fileCount = count($_FILES['file']['name']);
$aaa = 0;
if($aaa > 1){
    for ($i = 0; $i < $fileCount; $i++) {
  # 檢查檔案是否上傳成功
  if ($_FILES['file']['error'][$i] === UPLOAD_ERR_OK){
    echo '檔案名稱: ' . $_FILES['file']['name'][$i] . '<br/>';
    echo '檔案類型: ' . $_FILES['file']['type'][$i] . '<br/>';
    echo '檔案大小: ' . ($_FILES['file']['size'][$i] / 1024) . ' KB<br/>';
    echo '暫存名稱: ' . $_FILES['file']['tmp_name'][$i] . '<br/>';

    # 檢查檔案是否已經存在
    if (file_exists('../upload/' . $_FILES['file']['name'][$i])){
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
