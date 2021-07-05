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

          <div class="container">
        <form action="userCreate.php" method="post">
            <div class="mb-2">
                <label for="article_name">作者</label>
                <input type="text" class="form-control" name="article_name" id="article_name" required>
            </div>
            <div class="mb-2">
                <label for="category">分類</label>
                <select name="category" id="category">
                    <option value="1">有氧</option>
                    <option value="2">重訓</option>
                    <option value="3">tabata</option>
                    <option value="4">核心</option>
                    <option value="5">飲食</option>
                </select>
            </div>
            <div class="mb-2">
                <label for="added_by">標題</label>
                <input type="text" class="form-control" name="added_by" id="added_by" required>
            </div>
            <div class="mb-2">
                    <label for="content">內容:</label>
                    <textarea class="form-control" rows="30" name="content" id="content" required></textarea>
                </div>
            <button class="btn btn-info" type="submit">新增</button>
        </form>
    </div>
      <!-- /page content -->

<?php require_once("footer.php"); ?>