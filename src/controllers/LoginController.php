<?php
namespace src\controllers;

use \core\Controller;
use \src\handlers\LoginHandler;

class LoginController extends Controller {
    public function signin(){
        $flash = '';
        if(!empty($_SESSION['flash'])){
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('login', [
            'flash' => $flash
        ]);
    }

    public function signinAction(){
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $passwor = filter_input(INPUT_POST, 'password');

        if($passwor & $email){
            $token = LoginHandler::verifyLogin($email, $passwor);
            if($token){
                $_SESSION['token'] = $token;
                $this->redirect('/');
            }else{
                $_SESSION['flash'] = 'Email e/ou senha não confere';
                $this->redirect('/login');
            }
        }else{
            $_SESSION['flash'] = 'Digite os campos de email e/ou senha!';
            $this->redirect('/login');
        }
    }

    public function signup(){
        echo "Cadastro";
    }
}