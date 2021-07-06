<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");

$account = new Account($db_host);
if(isset($_POST['email'])) {

    $emailTo = str_replace(" ", "", $_POST['email']);
    $emailSent = $account->sendPasswordLinkEmail($emailTo);

}

?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>忘記密碼</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../build/css/signIn.css?v=<?php echo time(); ?>">
</head>

<body>

    <div class="forgetPassword-container">

        <div class="forgetPassword__container">

            <h3 class="forgetPassword__container-title">輸入Email</h3>

                <form method="POST" class="forgetPassword__container-form">
                    <div class="form">
                        <input class="form__input" type="email" name="email" placeholder="Email" autocomplete="off" required>
                        <label class="form__label" for="email" id="em">Email</label>
                    </div>
                    <?= $account->getError("此Email非管理者Email！"); ?>
                    <?= $account->getMessage("重設密碼連結已傳送至Email！"); ?>
                    <input class="form__submit" type="submit" name="submitButton" value="確認">
                </form>
                <a class="form__backToSignin" href="signIn.php">返回</a>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>