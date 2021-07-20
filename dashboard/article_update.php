<?php 
require_once("includes/header.php");
require_once("includes/config.php");
$id=$_GET["id"];
$stmt = $db_host->prepare("SELECT * FROM article WHERE id='$id'");//顯示
try{
	$stmt->execute();
	$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
	echo "資料庫連結失敗";
}
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>文章</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>
              <a class="btn btn-secondary" href="article_list.php">文章列表</a>修改文章:
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <form action="articleUpdate.php" method="post">
              <?php
                  foreach($rows as $value){
              ?>
                <input type="hidden" name="id" value="<?=$value["id"]?>">
                <div class="mb-2">
                  <label for="article_name">作者:</label>
                  <input type="text" class="form-control " name="article_name" value="<?=$value["article_name"]?>">
                </div>
                <div class="mb-2">
                  <label for="category">分類:</label>
                  <select name="category" id="category" class="form-control ">
                    <option value="1" <?php if($value["category"]=='1' )echo "selected" ?>>有氧</option>
                    <option value="2" <?php if($value["category"]=='2' )echo "selected" ?>>重訓</option>
                    <option value="3" <?php if($value["category"]=='3' )echo "selected" ?>>tabata</option>
                    <option value="4" <?php if($value["category"]=='4' )echo "selected" ?>>核心</option>
                    <option value="5" <?php if($value["category"]=='5' )echo "selected" ?>>飲食</option>
                  </select>
                </div>
                <div class="mb-2">
                  <label for="added_by">標題:</label>
                  <input type="text" class="form-control" name="added_by" value="<?=$value["added_by"]?>">
                </div>
                <div class="mb-2">
                  <label>圖片:</label><br>
                  <img class="img-fluid" src="images/article_upload/<?=$value["photos"]?>" alt="photos">
                </div>
                <div class="mb-2">
                  <label for="content">內容:</label>
                  <textarea class="form-control" rows="30" name="content"><?= $value["content"]?></textarea>
                </div>
                <div style="text-align: end;">
                  <a class="btn btn-secondary" href="article_list.php">返回</a>
                  <button class="btn btn-secondary" type="article_list.php">修改</button>
                </div>
                <?php
                    } 
                ?>
              </form>
            </div>
            <?php require_once("includes/footer.php"); ?>