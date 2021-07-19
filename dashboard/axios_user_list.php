<?php 
$title = '會員列表';
$style = 'userlist.css';
require_once("includes/header.php"); 
require_once("UserCount.php"); 
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>會員列表</h3>
        <div class="h6">共有<?=$no?>位會員</div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title ">
            <div style="display:flex; justify-content: space-between;">
              <div>
                <a class="btn btn-secondary" href="">首頁</a>
              </div>
              <div>
                <a class="btn btn-secondary"  href="user_create.php"><i class="fa fa-plus"></i>新增會員</a>
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
              </div>
                 <!--USER VIEW Modal -->
<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">會員詳情</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="UpdateUser.php" method="post">
                <div class="modal-body">
                    <label class="d-block mb-2">會員編號:<span id="id"></span></label>
                    <input type="hidden" id="idInput" name="id" >

                    <label class="d-block mb-2">帳號:<span id="account"></span></label>

                    <label>姓名:</label>
                    <input class="form-control mb-3" type="text" name="user_name" id="user_name_Input" value="">

                    <label>密碼:</label>
                    <input class="form-control mb-3" type="password" name="password" id="passwordInput" value="">
                    

                    <label>電話:</label>
                    <input class="form-control mb-3" type="tel" name="phone"  id="phoneInput" data-validate-length-range="8,20">

                    <label>Email:</label>
                    <input class="form-control mb-3" name="email" type="email" id="emailInput">

                    <label>生日:<span id="birthday"></span></label>
                    <input class="form-control mb-3" type="date" name="birthday" id="birthdayInput" >
                    <!-- required -->
                    <label>地址:</label>
                    <input class="form-control mb-3" type="tel" name="address" id="addressInput">

                    <label>會員備註:</label>
                    <textarea  name='intro' class="d-block mb-3" id="introInput"></textarea>
                    <!-- 暫時用不到
                    <label class="d-block mb-2">文章數:<span id="article_count"></span></label>
                    <label class="d-block mb-2">影片數:<span id="video_count"></span></label> -->
                    <label class="d-block mb-2">註冊時間:<span id="create_time"></span></label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger mx-auto" id="updatebutten">更新</button>
                    <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">取消</button>
                </div>    
            </form> 
        </div>
    </div>
</div>
<!--USER DELETE Modal -->
<div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title text-danger" id="exampleModalLabel">刪除會員</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="api/DeleteUser.php" method="post">
                <div class="modal-body ">
                    <div class="h5">您確定要刪除會員帳號:<span class="h3 text-danger"  id="DeleteAccout"></span>這個會員嗎?</div>
                    <input type="hidden" id="Deletemeber" name="Deletemeber" value="<?=$value["id"]?>" >
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger mx-auto" id="Deletebutton">確定</button>
                    <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">取消</button>
                </div>    
            </form>
          
        
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
                    <td>${user.phone}</td>
                    <td>${user.birthday}</td>
                    <td><button data-id="${user.id}" type="button" class="btn btn-info " id="ViewData" data-toggle="modal" data-target="#ViewModal">會員詳情</button> 
                        <button data-id="${user.id}" type="submit" class="btn btn-danger "  id="DeleteData"  data-toggle="modal" data-target="#DeleteModal">刪除</button>

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
                let user=response.data;
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
                $("#idInput").val(user.id)
                $("#emailInput").val(user.email)
                $("#user_name_Input").val(user.user_name)
                $("#phoneInput").val(user.phone)
                $("#addressInput").val(user.address)
                $("#introInput").val(user.intro)


                })
            .catch(function(error){
                console.log(error)
            })

        })


        $('tbody').on("click","#DeleteData",function(){      
            let id=$(this).data("id")
            let formdata=new FormData();
            formdata.append("id",id);
            axios.post('api/ViewUser.php',formdata)
            .then(function(response){
            let user=response.data;
            $("#id").text(user.id)
            $("#DeleteAccout").text(user.account)
            $("#Deletemeber").val(user.id)
        })
            .catch(function(error){
                console.log(error)
            })

        })
        function hideshow(){
			var password = document.getElementById("password1");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");
			
			if(password.type === 'password'){
				password.type = "text";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
				password.type = "password";
				slash.style.display = "none";
				eye.style.display = "block";
			}

		}

        // $("#Deletebutton").click(setTimeout(function(){
        //     alert('刪除完成');},2000);
            
</script>




<?php require_once("includes/footer.php"); ?>