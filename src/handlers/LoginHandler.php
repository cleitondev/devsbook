<?php
namespace src\handlers;
use src\models\User;

class LoginHandler {
    public static function checklogin(){
        if(!empty($_SESSION['token'])){
            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();
            if(count($data) > 0){
                $loggedUser = new User();
                $loggedUser->id = $data['id'];
                $loggedUser->email = $data['email'];
                $loggedUser->name = $data['name'];

                return $loggedUser;
            } 
        } 
        return false;
    }
    public static function verifyLogin($email, $passwor){
        $user = User::select()->where('email', $email)->one();

        if($user) {
            if(password_verify($passwor, $user['password'])){
                $token = md5(time(), rand(0,9999),time());

                User::update()->set('token', $token)->where('email', $email);

                return $token;
            }
        } else {
            return false;
        }
    }
}

