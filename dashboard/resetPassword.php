<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");

$account = new Account($db_host);
if(!isset($_GET['code'])) {
    exit("找不到資料。");
}

$code = $_GET['code'];
$account->getEmailQuery($code);

if(isset($_POST['password']) && isset($_POST['password2'])) {
    $pw = $_POST['password'];
    $pw2 = $_POST['password2'];

    $success = $account->PasswordReset($pw, $pw2, $code);
    if($success) {
        header("Refresh: 2; url=signIn.php");
        //Refresh after 2 secs
    }
}

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重設密碼</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../build/css/signIn.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="resetPassword-container">

        <div class="resetPassword__container">

            <h3 class="resetPassword__container-title">輸入新密碼</h3>

            <form method="POST" class="resetPassword__container-form">
                <div class="form">
                    <input class="form__input" type="password" name="password" placeholder="新密碼" required title="請輸入新密碼">
                    <label class="form__label" for="password" id="pw">新密碼</label>
                </div>
                <div class="form">
                    <input class="form__input" type="password" name="password2" placeholder="再確認" required title="請再確認新密碼">
                    <label class="form__label" for="password" id="pw2">再確認</label>
                </div>

                <?= $account->getMessage("新密碼設定完成！2秒後自動跳轉"); ?>
                <?= $account->getError("密碼不相符！"); ?>
                <?= $account->getError("密碼只能使用英文字母及數字"); ?>
                <?= $account->getError("密碼長度必須為8-20個字之間"); ?>

                <input class="form__submit" type="submit" name="submitButton" value="更新密碼" title="更新密碼">
            </form>
        
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>