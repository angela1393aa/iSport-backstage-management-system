<?php require_once("header.php"); ?>

<?php
require_once("./config.php");
$id=$_GET["id"];
$sql="SELECT * FROM article WHERE id='$id'";
$result = $db_host->query($sql);
?>


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
                    <a class="btn btn-secondary" href="article-list.php">文章列表</a>修改文章:
                  </h2>
                  <div style="text-align: end;">
                    <a class="btn btn-secondary" href="article-list.php">返回</a> 
                </div>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

          <div class="container">
          <form action="articleUpdate.php" method="post">
            <?php  
                foreach($result as $key => $value ){
            ?> 
                <div class="mb-2">
                    <label for="upload_date"></label>
                    <input type="hidden" class="form-control " name="upload_date" value="<?=$value["upload_date"]?>">
                </div>
                <input type="hidden" name="id" value="<?=$row["id"]?>">
                <!-- type="hidden"讓使用者看不到 -->
                
                <div class="mb-2">
                    <label for="article_name">作者:</label>
                    <input type="text" class="form-control " name="article_name" value="<?=$value["article_name"]?>">
                </div>
                <div class="mb-2">
                    <input type="text" class="form-control" name="category" value="
                    <?php 
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

                            ?>">
                </div>
                <div class="mb-2">
                <label for="category">分類:</label>
                <select name="category" id="category">
                    <option value="1">有氧</option>
                    <option value="2">重訓</option>
                    <option value="3">tabata</option>
                    <option value="4"  selected="selected">核心</option>
                    <option value="5">飲食</option>
                </select>
            </div>
                
                <div class="mb-2">
                    <label for="added_by">標題:</label>
                    <input type="text" class="form-control" name="added_by" value="<?=$value["added_by"]?>"> 
                </div>
                <div class="mb-2">
                    <label for="content">內容:</label>
                    <textarea class="form-control" rows="30" name="content"><?= $value["content"]?></textarea>
                </div>

                
                <div>
                    <button class="btn btn-secondary" type="article-list.php">送出</button>
                </div>
                
            <?php
            } 
            ?>
        </form>
    </div>
      <!-- /page content -->

<?php require_once("footer.php"); ?>