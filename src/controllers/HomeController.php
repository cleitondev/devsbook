<?php
namespace src\controllers;

use \core\Controller;
use \src\Handlers\LoginHandler;

class HomeController extends Controller {

    private $loggedUser;

    public function __construct(){
        $this->loggedUser = LoginHandler::checklogin();
        if($this->loggedUser === false){
            $this->redirect('/login');
        }
    }

    public function index() {
        $this->render('home', ['nome' => 'Bonieky']);
    }

}