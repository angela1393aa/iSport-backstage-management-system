<?php 
require_once("includes/header.php");
?>
<!-- page content -->
<style>
  .dataTables_filter {
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
                  <div class="container">
                    <table class="table table-striped table-bordered " style="width:100%" id="datatable">
                      <thead>
                        <tr>
                          <th>序號</th>
                          <th>作者</th>
                          <th>分類</th>
                          <th>標題</th>
                          <th>time</th>
                          <th> </th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- jquery -->
                  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                  <!-- axios -->
                  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
                  <script>
                    axios({
                      method: 'post',
                      url: '/project_01-master/dashboard/api/articleList.php',//改這裡
                    })
                      .then(function (response) {
                        // console.log(response);
                        let data = response.data;
                        //console.log(data);
                        let content = "";
                        let category = "";
                        let getCategory = (cgy) => {
                          cgy == '1' ? cgy = '有氧' : '';
                          cgy == '2' ? cgy = '重訓' : '';
                          cgy == '3' ? cgy = 'tabata' : '';
                          cgy == '4' ? cgy = '核心' : '';
                          cgy == '5' ? cgy = '飲食' : '';
                          return cgy;
                        }
                        data.forEach((article) => {
                          article.category = getCategory(article.category);
                          content += `
            <tr>
                <td>${article.id}</td>
                <td>${article.article_name}</td>
                <td>
                ${article.category}
                </td>
                <td>${article.added_by}</td>
                <td>${article.upload_date}</td>
                <td>
                <a class="close-link" href="article_onelist.php?id=${article.id}"><i class="fa fa-search"></i>瀏覽</a>
                <a class="close-link" href="article_update.php?id=${article.id}"><i class="fa fa-pencil-square-o"></i>修改</a>
                <a class="close-link" href="article_delete.php?id=${article.id}"><i class="fa fa-trash"></i>刪除</a>
                </td>
            </tr>`
                        })
                        $("tbody").append(content)
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
                  </script>
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
<?php require_once("includes/footer.php"); ?>