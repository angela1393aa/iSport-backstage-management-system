<?php 
//session_start();
require_once("includes/header.php");
?>
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/decoupled-document/ckeditor.js"></script>
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
              <div class="row justify-content-center">
                <div class="col-md-8 col-sm-8">
                <form action="articleCreate.php" method="post" enctype="multipart/form-data">
                <div class="mb-2">
                  <label for="article_name">作者:<span style="color:red;">必填!!</span></label>
                  <input type="text" class="form-control" name="article_name" id="article_name" placeholder="最多50字"
                    value="<?= $_SESSION['article']['article_name'];?>">
                </div>
                <div class="mb-2">
                  <label for="category">分類:</label>
                  <select name="category" id="category" class="form-control">
                    <option value="1">有氧</option>
                    <option value="2">重訓</option>
                    <option value="3">tabata</option>
                    <option value="4">核心</option>
                    <option value="5">飲食</option>
                  </select>
                </div>
                <div class="mb-2">
                  <label for="added_by">標題:<span style="color:red;">必填!!</span></label>
                  <input type="text" class="form-control" name="added_by" id="added_by" placeholder="最多100字"
                    value="<?= $_SESSION['article']['added_by'];?>">
                </div>
                <div class="mb-2">
                  <label for="">上傳圖片:</label>
                  <input class="form-control" type="file" name="file" id="file">
                </div>
                <div class="mb-2">
                  <label for="content">內容:<span style="color:red;">必填!!</span></label>
                  <div id="toolbar-container"></div>
                  <div id="editor">
                  <?= $_SESSION['article']['content'];?>
                  </div>
                  <textarea name="content" id="content" style="display:none;"></textarea>
                </div>
                <div style="text-align: end;">
                  <button class="btn btn-secondary" type="submit" id="button">新增</button>
                </div>
              </form>
                </div>
              </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="crossorigin="anonymous"></script>
            <script>
              $(function () {
                $('#button').on('click', function () {
                  var html = $("#editor").html();
                  $("textarea").val(html);
                });
              })
              DecoupledEditor
                .create(document.querySelector('#editor'))
                .then(editor => {
                  const toolbarContainer = document.querySelector('#toolbar-container');
                  toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                })
                .catch(error => {
                  console.error(error);
                });
            </script>
            <?php require_once("includes/footer.php"); ?>