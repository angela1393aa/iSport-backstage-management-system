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
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>
              <a class="btn btn-secondary" href="article_list.php">文章列表</a>新增文章:
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <form action="articleCreate.php" method="post">
                <!-- userCreate.php -->
                <div class="mb-2">
                  <label for="article_name">作者</label>
                  <input type="text" class="form-control" name="article_name" id="article_name" required>
                </div>
                <div class="mb-2">
                  <label for="category">分類</label>
                  <select name="category" id="category" class="form-control">
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
                <div style="text-align: end;">
                  <button class="btn btn-secondary" type="submit">新增</button>
                </div>
              </form>
            </div>
            <!-- /page content -->

            <?php require_once("footer.php"); ?>