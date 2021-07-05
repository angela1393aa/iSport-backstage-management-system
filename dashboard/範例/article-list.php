<?php require_once("header.php"); ?>

<!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>文章</h3>
            </div>

            <!-- <div class="title_right">
              <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Go!</button>
                  </span>
                </div>
              </div>
            </div> -->
          </div>

          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_title">
                  <h2>
                    <a class="btn btn-secondary" href="article-list.php">文章列表</a>
                    <a class="fa fa-plus-square" href="article-create.php">新增文章</a><!-- create-user.php -->
                  </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                          class="fa fa-wrench"></i></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                      </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
<div class="row">
<div class="col-sm-12">
<div class="card-box table-responsive">
<table id="datatable" class="table table-striped table-bordered" style="width:100%">
<thead>

<tr>
<th>序號</th>
<th>作者</th>
<th>分類</th>
<th>標題</th>
<th>time</th>
<th></th>
</tr>
</thead>

<tbody>

<?php
$row = $db_host->query("SELECT * FROM article");
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
                            <a class="close-link" href="deleteUser.php?id=<?php echo $row["id"]?>"><i class="fa fa-trash"></i>刪除</a>
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