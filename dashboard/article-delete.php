
<?php require_once("header.php"); ?>
<?php
require_once("./config.php");
$id=$_GET["id"];
$sql="SELECT * FROM article WHERE id='$id'";
$result = $db_host->query($sql);
?>
<?php require_once("header.php"); ?>

<!-- page content -->
<div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>文章</h3>
            </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>
                    <a class="btn btn-secondary" href="article-list.php">文章列表</a>刪除文章:
                  </h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

          <div class="container">
          <form action="articleDelete.php" method="post">
            <!-- <?php  
                foreach($result as $key => $value ){
            ?>  -->
                <div class="mb-2" style="text-align: end;">
                    <span>時間:<?=$value["upload_date"]?></span>
                </div>
                <input type="hidden" name="id" value="<?=$value["id"]?>">
                <!-- type="hidden"讓使用者看不到 -->
                <div class="mb-2">
                    <label>作者:</label>
                    <input type="text" class="form-control " name="article_name" value="<?=$value["article_name"]?>" readonly>
                </div>
                <div class="mb-2">
                    <label>分類:</label>
                    <input type="text" class="form-control" name="category" value="<?php 
                                switch($value["category"]){
                                    case('1'):
                                        echo '有氧';
                                    break;
                                    case('2'):
                                        echo '健身';
                                    break;
                                    case('3'):
                                        echo 'tabata';
                                    break;
                                    case('4'):
                                        echo '飲食';
                                    break;
                                    case('5'):
                                        echo '核心';
                                    break;
                                }

                            ?>" readonly>
                </div>

                
                <div class="mb-2">
                    <label>標題:</label>
                    <input type="text" class="form-control" name="added_by" value="<?=$value["added_by"]?>" readonly> 
                </div>
                <div class="mb-2">
                    <label>內容:</label>
                    <textarea class="form-control" rows="30" name="content" readonly><?= $value["content"]?></textarea>
                </div>
                <div style="text-align: end;">
                  <a class="btn btn-secondary" href="article-list.php">返回</a> 
                  <button class="btn btn-secondary">刪除</button>
                </div>
            <!-- <?php
            } 
            ?> -->
        </form>
    </div>
      <!-- /page content -->

<?php require_once("footer.php"); ?>