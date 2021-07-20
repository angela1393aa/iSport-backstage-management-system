<?php require_once("includes/header.php"); 

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>會員新增</h3>
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
                <a class="btn btn-secondary"  href="axios_user_list.php">返回會員列表</a>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-box table-responsive">
                  <div class="container">
                    <div class="x_content">
                        <form class="" action="UserCreate.php" method="post">
                        <h2>注意事項</h2>
                            <p>填寫會員註冊資料，標記有 <code>*</code> 請務必填寫 </a></p>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="user_name">姓名<span class="required"><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="user_name"  title="請輸入姓名" id="user_name" placeholder="請輸入姓名" required>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="account">會員帳號 <span><code>*</code></span></label>
                                       

                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control"  type="text" title="請輸入 4~8 碼帳號" class='account' name="account" id="account" placeholder="請輸入 4~8 碼帳號"
                                    required> <small class="text-danger WorMsg" id="accountMsg"></small>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="password1">密碼<span><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" id="password1" name="password"
                                        title="請輸入密碼"
                                        required>

                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
                                        <i id="slash" class="fa fa-eye-slash"></i>
                                        <i id="eye" class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="repassword">再次確認密碼<span class="required text-red"><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" name="repassword" title="再次確認密碼" data-validate-linked='password' required id="repassword">
                                    <small class="text-danger WorMsg" id="CheckpasswordMsg"></small>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="email">聯絡信箱<span><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="email" class='email' title="請輸入聯絡信箱" required  type="email" id="email">
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="phone" >手機<span><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="tel" class='tel' name="phone"  title="請輸入手機" required="required" id="phone"
                                        data-validate-length-range="8,20" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="address" >地址</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="tel"  title="請輸入地址" class='text' name="address" id="address">
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="birthdate">生日</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" class='birthdate' title="請輸入生日" type="date" name="birthdate" id="birthdate">
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align" for="intro">其他訊息</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea  name='intro' id="intro"></textarea>
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary" id="submitBtn">建立會員</button>
                                        <button type='reset' class="btn btn-success">重置資料</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
      <!-- /page content -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="../vendors/validator/multifield.js"></script>
    <script src="../vendors/validator/validator.js"></script>
    
    <!-- Javascript functions	-->
	<script>
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
	
    $("#account").on({
                "change": function(){
                    // console.log("change")
                    $("#accountMsg").text("");
                    let account=$(this).val();
                    let formdata=new FormData();
                    formdata.append("account", account);

                    axios.post('api/check-user.php', formdata)
                        .then(function (response) {
                            console.log(response);
                            if(response.data.count===1){
                                $("#accountMsg").text("這個帳號已經有人註冊過了")
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                
                "keyup": function(){
                    $("#accountMsg").text("");
                    let accountLength=$(this).val().length;
                    if(accountLength<4){
                        $("#accountMsg").text("帳號過短，請輸入4~8碼帳號。")
                    }else if(accountLength>8){
                        $("#accountMsg").text("帳號過長，請輸入4~8碼帳號。")
                    }
                }
            })

            $("#repassword").on({
                "change": function(){
                    $("#CheckpasswordMsg").text("");
                    let passContent=$("#password1").val();
                    let repassContent=$("#repassword").val();
                            if(passContent !== repassContent){
                            //     $("#repasswordMsg").text("確認密碼一致。")
                            // }else
                            $("#CheckpasswordMsg").text("密碼不一致。")}
                        }})
            $("#submitBtn").on({
                "click":function(){
                    let WorMsg=$(".WorMsg").text();
                    if(WorMsg !==""){
                        alert("請檢查紅字錯誤部分");
                        return false;
                    }
            }})

            

      

    </script>


<?php require_once("includes/footer.php"); ?>
