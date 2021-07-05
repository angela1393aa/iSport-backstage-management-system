<?php
class Account {
    private $con;
    private $errorArray = array();

    public function __construct($con) {
        $this->con = $con;
    }

    public function login($user, $password) {
        $query = $this->con->prepare("SELECT * FROM admin_user WHERE username=:user AND password=:password");
        $query->bindParam(":user", $user);
        $query->bindParam(":password", $password);

        $query->execute();
        if($query->rowCount() == 1) {
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
}

?>