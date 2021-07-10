<?php require_once("header.php"); ?>

<!-- page content -->
<style>
  .dataTables_filter{
    text-align: end;
  }
</style>
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
            <div class="x_title ">
              <div style="display:flex; justify-content: space-between;">
                <div >
                  <a class="btn btn-secondary" href="article-list.php" >文章列表</a>
                </div>
                <div>
                  <a class="btn btn-secondary" href="article-create.php"><i class="fa fa-plus"></i>新增文章</a>
                </div>
              </div>
            <div class="clearfix"></div>
          </div>
        <div class="x_content">
    <div class="row">
      <div class="col-sm-12">
        <div class="card-box table-responsive">
          <table class="table table-striped table-bordered " style="width:100%" id="datatable"><!-- id="datatable" -->
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
$row = $db_host->query("SELECT * FROM article order by id desc");
      foreach($row as $row){
      ?>
            <tr>
                <td><?php echo $row["id"] ?></td>
                <td><?php echo $row["article_name"]?></td>
                <td>
      <?php 
          switch($row["category"]){
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

      ?>
                </td>
                <td><?php echo $row["added_by"]?></td>
                <!-- <td><?php echo $row["content"]?></td> -->
                <td><?php echo $row["upload_date"]?></td>
                <td>
                  <a class="close-link" href="article-onelist.php?id=<?php echo $row["id"]?>"><i class="fa fa-search"></i>瀏覽</a><!-- user.php -->
                  <a class="close-link" href="article-update.php?id=<?php echo $row["id"]?>"><i class="fa fa-pencil-square-o"></i>修改</a><!-- updateUser.php -->
                  <a class="close-link" href="article-delete.php?id=<?php echo $row["id"]?>"><i class="fa fa-trash"></i>刪除</a>
               </td>
            </tr>
      <?php
        }
      ?>
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
      <!-- /page content -->

      

<?php require_once("footer.php"); ?>