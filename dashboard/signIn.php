<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");

$account = new Account($db_host);
if(isset($_POST['submitButton'])) {

    $user = str_replace(" ", "", $_POST['user']);
    //To replace white space by empty
    $password = $_POST['password'];

    $success = $account->login($user, $password);

    if($success) {
        //success
        //direct user to name.php
        $_SESSION['userLoggedIn'] = $user;
        header("Location: axios_user_list.php");
        exit();
    }
}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../build/css/signIn.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="signIn-container">
        
        <div class="signin__container">

            <h3 class="signin__container-title">登入帳號</h3>
            
            <form method="POST" class="signin__container-form">

                <div class="form">
                    <input class="form__input" type="text" name="user" id="user" placeholder="帳號" value="<?= getInputValue('user')?>" title="請輸入帳號" required autocomplete="off">
                    <label class="form__label" for="user">帳號</label>
                </div>

                <div class="form">
                    <input class="form__input" type="password" name="password" placeholder="密碼" title="請輸入密碼" required>
                    <label class="form__label" for="password">密碼</label>
                </div>
                <?= $account->getError("帳號名稱或密碼錯誤！"); ?>
                <input class="form__submit" type="submit" name="submitButton" value="登入" title="登入">
                </form>
                <a class="form__forgetPassword" href="forgetPassword.php" title="忘記密碼">忘記密碼</a>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>