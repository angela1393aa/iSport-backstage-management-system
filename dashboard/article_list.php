<?php 
require_once("includes/header.php"); 
require_once("includes/config.php");
$stmt = $db_host->prepare("SELECT * FROM article where valid =1 ");
try{
	$stmt->execute();
	$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(PDOException $e){
	echo "資料庫連結失敗";
}
?>
<style>
    .dataTables_filter {
    text-align: end;
  }
</style>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title" style="display:flex; justify-content: space-between;">
      <div class="title_left">
        <h3>文章</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title ">
            <div style="display:flex; justify-content: space-between;">
              <div>
                <a class="btn btn-secondary" href="article_list.php">文章列表</a>
              </div>
              <div>
                <a class="btn btn-secondary" href="article_create.php"><i class="fa fa-plus"></i>新增文章</a>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <table class="table table-striped table-bordered dataTables_filter" style="width:100%" id="datatable"><!-- id="datatable" -->
                    <thead>
                      <tr>
                        <th style="width: 12px;">序號</th>
                        <th style="width: 12px;">作者</th>
                        <th style="width: 12px;">分類</th>
                        <th style="width: 12px;">標題</th>
                        <th style="width: 12px;">time</th>
                        <th style="width: 12px;"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach($rows as $value){
                        ?>
                      <tr>
                        <td>
                          <?php echo $value["id"] ?>
                        </td>
                        <td>
                          <?php echo $value["article_name"]?>
                        </td>
                        <td>
                          <?php 
                            switch($value["category"]){
                                case('1'):
                                    echo '有氧';
                                break;
                                case('2'):
                                    echo '重訓';
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
                        ?>
                        </td>
                        <td>
                          <?php echo $value["added_by"]?>
                        </td>
                        <!-- <td><?php echo $value["content"]?></td> -->
                        <td>
                          <?php echo $value["upload_date"]?>
                        </td>
                        <td>
                        <a class="close-link" href="article_onelist.php?id=<?php echo $value["id"]?>"><i class="fa fa-search"></i>瀏覽</a><!-- user.php -->
                        <a class="close-link" href="article_update.php?id=<?php echo $value["id"]?>"><i class="fa fa-pencil-square-o"></i>修改</a><!-- updateUser.php -->
                        <a class="close-link" href="article_delete.php?id=<?php echo $value["id"]?>"><i class="fa fa-trash"></i>刪除</a>  
                        </td>
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once("includes/footer.php"); ?>
