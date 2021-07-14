<?php require_once("includes/header.php"); 

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>會員新增</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>注意事項  </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Settings 1</a>
                                    <a class="dropdown-item" href="#">Settings 2</a>
                                </div>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="" action="UserCreate.php" method="post" novalidate>
                            <p>填寫會員註冊資料，標記有 <code>*</code> 請務必填寫 </a>
                            </p>
                            <span class="section">會員註冊訊息</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">姓名<span
                                        class="required"><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" required="required" name="user_name" placeholder="請輸入姓名" required />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">會員帳號 <span
                                        class="required"><code>*</code></span></label>
                                        <small class="text-danger" id="accountMsg"></small>

                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" class='account' name="account" id="account" placeholder="請輸入 4~8 碼帳號"
                                    required="required">
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">密碼<span
                                        class="required"><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" id="password1" name="password"
                                        title="請輸入密碼"
                                        required="required" />

                                    <span style="position: absolute;right:15px;top:7px;" onclick="hideshow()">
                                        <i id="slash" class="fa fa-eye-slash"></i>
                                        <i id="eye" class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">再次輸入密碼<span
                                        class="required text-red"><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="password" name="password2"
                                        data-validate-linked='password' required="required" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">聯絡信箱<span
                                        class="required"><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="email" class='email' required="required"
                                        type="email" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">手機<span
                                        class="required"><code>*</code></span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="tel" class='tel' name="phone" required="required"
                                        data-validate-length-range="8,20" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">地址</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="tel" class='text' name="address"/>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">生日</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" class='birthdate' type="date" name="birthdate"
                                       >
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">其他訊息</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea  name='intro'></textarea>
                                </div>
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">建立會員</button>
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
	</script>

    <script>
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
                            // if(response.data.count===1){
                            //     $("#accountMsg").text("這個帳號已經有人註冊過了")
                            // }
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                "keyup": function(){
                    $("#accountMsg").text("");
                    let accountLength=$(this).val().length;
                    if(accountLength<4){
                        $("#accountMsg").text("帳號太短")
                    }else if(accountLength>8){
                        $("#accountMsg").text("帳號太長")
                    }
                }
            })

            $("#sign").click(function(e){
                e.preventDefault();
                let passContent=$("#password").val();
                let repassContent=$("#repassword").val();
                if(passContent===repassContent){
                    // alert("密碼一致")
                    $("form").submit();
                }else{
                    alert("前後密碼不一致")
                }
            })

        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        // var validator = new FormValidator({
        //     "events": ['blur', 'input', 'change']
        // }, document.forms[0]);
        // // on form "submit" event
        // document.forms[0].onsubmit = function(e) {
        //     var submit = true,
        //         validatorResult = validator.checkAll(this);
        //     console.log(validatorResult);
        //     return !!validatorResult.valid;
        // };
        // // on form "reset" event
        // document.forms[0].onreset = function(e) {
        //     validator.reset();
        // };
        // // stuff related ONLY for this demo page:
        // $('.toggleValidationTooltips').change(function() {
        //     validator.settings.alerts = !this.checked;
        //     if (this.checked)
        //         $('form .alert').remove();
        // }).prop('checked', false);

    </script>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- validator -->
    <!-- <script src="../vendors/validator/validator.js"></script> -->

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>





<?php require_once("includes/footer.php"); ?>
