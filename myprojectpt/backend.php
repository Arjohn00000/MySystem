<?php
require("database.php");
class backend
{
    public function doLogin($user,$pass){
        return self::login($user,$pass);
    }
    public function doRegister($user,$pass){
        return self::register($user,$pass);
    }
    private function login($user, $pass)
    {
        try {
            if ($this->checkIfVallid($user, $pass)) {
                $db = new database();
                if ($db->getStatus()) {
                    $tmp = md5($pass);
                    $stmt = $db->getCon()->prepare($this->loginQuery());
                    $stmt->execute(array($user,$tmp));
                    $result = $stmt->fetch();
                    if ($result) {
                        $_SESSION['user'] = $user;
                        $_SESSION['pass'] = $tmp;
                        $db->closeConnection();
                        return "200";
                    }else{
                        $db->closeConnection();
                        return "404";
                    }
                }else{
                    return "403";
                }
            } else {
                return "403";
            }
        } catch (PDOException $th) {
            return "501";
        }
    }

    private function register($user, $pass){
        try {
            if ($this->checkIfVallid($user,$pass)) {
                $db = new database();
                if ($db->getStatus()) {
                    $stmt = $db->getCon()->prepare($this->registerQuery());
                    $stmt->execute(array($user,md5($pass),$this->getCurrentDate()));
                    $result = $stmt->fetch();
                    if (!$result) {
                        $db->closeConnection();
                        return "200";
                    }else{
                        $db->closeConnection();
                        return "404";
                    }
                }else{
                    return "403";
                }
            } else {
                return "403";
            }
        } catch (PDOException $th) {
            return "501";
        }
    }

    private function getCurrentDate(){
        return date("Y/m/d");
    }

    private function checkIfVallid($user, $pass)
    {
        if ($user != "" && $pass != "")
            return true;
        else
            return false;
    }

    private function loginQuery()
    {
        return "SELECT * FROM user_login WHERE `user` = ? AND `pass` = ?";
    }
    private function registerQuery(){
        return "INSERT INTO user_login (`user`,`pass`,created) VALUES (?,?,?)";
    }
}
?>
