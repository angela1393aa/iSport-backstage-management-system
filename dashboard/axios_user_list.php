<?php 
require_once("includes/header.php"); 
require_once("Userlist.php"); 
?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title row">
            <div class="title_left col-10">
                <h3>會員列表</h3>
                <div class="h6">共有位會員</div>
            </div>
            <div class="title_right col-2">
            <a href="user_create.php"><button type="button" class="btn btn-info btn-lg" >新增會員</button></a>
            </div>

            <table id="datatable" class="table table-striped table-bordered " style="width:100%">
            
                <thead>
                    <tr>
                        <th>姓名</th>
                        <th>帳號</th>
                        <th>信箱</th>
                        <th>手機</th>
                        <th>生日</th>
                        <th>編輯</th>
                    </tr>
                </thead>
                <tbody>
                        
                </tbody>
            
            </table>
                        <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <?php for($i=1; $i<=$pages ;$i++){?>
                    <li class="page-item"><a class="page-link" href="user_list.php?p=<?=$i?>"><?=$i?></a></li>
                    <?php } ?>
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
                </nav>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">會員詳情</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="UpdataUser.php" method="post">
            <ul>
                <label class="d-block">會員編號:<span id="id"></span></label>
                <input type="hidden" value="" name="id">
                <label>姓名:<span id="user_name"></span></label>
                <input type="text" class="form-control-plaintext" value="" name="user_name" readonly>

                <label>帳號:<span id="account"></span></label>
                <input class="form-control" type="text" class='account' name="account" id="account" placeholder="account" readonly value="">
                <label>密碼:</label>
                <input class="form-control" type="password" id="password1" name="password">


                <label>電話:0<span id="phone"></span></label>
                <input class="form-control" type="tel" class='tel' name="phone" required="required"
                                        data-validate-length-range="8,20" />
                <label>Email:<span id="email"></span></label>
                <input class="form-control" name="email" class='email' required="required"
                                        type="email" />

                <label>生日:<span id="birthday"></span></label>
                <input class="form-control" class='birthdate' type="date" name="birthdate"
                                       >
                <label>地址:<span id="address"></span></label>
                <input class="form-control" type="tel" class='text' name="address"/>
                <label>會員備註:<span id="intro"></span></label>
                <textarea  name='intro' class="d-block"></textarea>

                <label class="d-block">文章數:<span id="article_count"></span></label>
                <label class="d-block">影片數:<span id="video_count"></span></label>
                <label class="d-block">註冊時間:<span id="create_time"></span></label>
            </ul>
    </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger mx-auto" data-dismiss="modal">更新</button>
        <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">取消</button>
        
      </div>
    </div>
  </div>
</div>


<!-- /page content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    axios.get('api/users.php')
        .then(function(response){
            // console.log(response.data)
            let users=response.data;
            users.forEach((user)=>{
                let content=` 
                <tr>
                    <td>${user.user_name}</td>
                    <td>${user.account}</td>
                    <td>${user.email}</td>
                    <td>0${user.phone}</td>
                    <td>${user.birthday}</td>
                    <td><button data-id="${user.id}?>"type="button" class="btn btn-info" id="ViewData" data-toggle="modal" data-target="#exampleModal">會員詳情</button> <button class="btn btn-danger" id="DeleteData" type="button">刪除</button>

                </tr>`
                $("tbody").append(content)
        })
        })
        .catch(function(error){
            console.log(error)
        });

        $('tbody').on("click","#ViewData",function(){      
            let id=$(this).data("id")
            let formdata=new FormData();
            formdata.append("id",id);
            axios.post('api/ViewUser.php',formdata)
            .then(function(response){
                // console.log(response)
                let user=response.data;
                // console.log(user)
                $("#id").text(user.id)
                $("#account").text(user.account)
                $("#email").text(user.email)
                $("#user_name").text(user.user_name)
                $("#create_time").text(user.create_time)
                $("#phone").text(user.phone)
                $("#address").text(user.address)
                $("#birthday").text(user.birthday)
                $("#intro").text(user.intro)
                $("#article_count").text(user.article_count)
                $("#video_count").text(user.video_count)
                })
            .catch(function(error){
                console.log(error)
            })

        })
     




</script>




<?php require_once("includes/footer.php"); ?>
