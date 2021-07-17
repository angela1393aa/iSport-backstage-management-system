<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Account {
    private $con;
    private $errorArray = array();
    private $messageArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function login($user, $password) {

        $password = hash("sha512", $password); 
        $query = $this->con->prepare("SELECT * FROM admin_user WHERE username=:user AND password=:password");
        $query->bindParam(":user", $user);
        $query->bindParam(":password", $password);

        $query->execute();
        if($query->rowCount() >= 1) {
            return true;
        } else {
            array_push($this->errorArray, "帳號名稱或密碼錯誤！");
            return false;
        }
    }

    public function getError($error) {
        if(in_array($error, $this->errorArray)) {
            return "<div class='form__errorMessage'>$error</div>";
        }
    }

    public function getMessage($message) {
        if(in_array($message, $this->messageArray)) {
            return "<div class='form__message'>$message</div>";
        }
    }

    public function sendPasswordLinkEmail($emailTo) {
        
        $query = $this->con->prepare("SELECT email FROM admin_user WHERE email=:em");
        $query->bindParam(":em", $emailTo);
        $query->execute();

        if($query->rowCount() == 0) {
            array_push($this->errorArray, "此Email非管理者Email！");
            return false;
        } else {
            $code = uniqid(true);
            $query = $this->con->prepare("INSERT INTO reset_password (code, email) VALUES (:code, :em)");
            $query->bindParam(":code", $code);
            $query->bindParam(":em", $emailTo);
            $query->execute();

            if(!$query) {
                exit("發生錯誤");
            }

            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'learning1112345@gmail.com';                     //SMTP username
                $mail->Password   = 'qkfoiibqsrdyzyld';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('learning1112345@gmail.com', 'Isport');
                $mail->addAddress($emailTo);     //Add a recipient
                $mail->addReplyTo('no-reply@gmail.com', 'No reply');

                //Content
                $url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/resetPassword.php?code=$code";
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Your password reset link';
                $mail->Body    = "<h1>你請求重設平台密碼</h1>
                                    點擊 <a href='$url'>這個連結</a> 以重設密碼。";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                array_push($this->messageArray, "重設密碼連結已傳送至Email！");
            } catch (Exception $e) {
                echo "訊息無法傳送！ Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    public function getEmailQuery($code) {
        $query = $this->con->prepare("SELECT email FROM reset_password WHERE code=:code");
        $query->bindParam(":code", $code);
        $query->execute();
        if($query->rowCount() == 0) {
            exit("找不到資料。");
        }
        return $query;
    }

    public function PasswordReset($pw, $pw2, $code) {

        $this->validatePassword($pw, $pw2);

        if(empty($this->errorArray)) {
            $pw = hash("sha512", $pw); 
            $pw2 = hash("sha512", $pw2);

            $row = $this->getEmailQuery($code)->fetch(PDO::FETCH_ASSOC);
            $email = $row['email'];

            $query = $this->con->prepare("UPDATE admin_user SET password=:pw WHERE email=:em");
            $query->bindParam(":pw", $pw);
            $query->bindParam(":em", $email);
            $query->execute();

            if($query) {
                $query = $this->con->prepare("DELETE FROM reset_password WHERE code=:code");
                $query->bindParam(":code", $code);
                $query->execute();
                if($query) {
                    array_push($this->messageArray, "新密碼設定完成！自動跳轉中");
                    return true;
                } else {
                    exit("Something went wrong!");
                    return false;
                }
            } else {
                exit("Something went wrong!");
                return false;
            }
        } else {
            return false;
        }
    }

    private function validatePassword($pw, $pw2) {
        if($pw != $pw2) {
            array_push($this->errorArray, "密碼不相符！");
            return;
        }

        if(preg_match("/[^A-Za-z0-9]/", $pw)) {
            array_push($this->errorArray, "密碼只能使用英文字母及數字");
            return;
        }

        if(strlen($pw) > 20 || strlen($pw) < 8) {
            array_push($this->errorArray, "密碼長度必須為8-20個字之間");
            return;
        }


    }

}

?>