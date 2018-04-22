<?php
namespace Controllers;
class Access extends Controller {

    public function logform($data = null){
        if(\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if(\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');
        $view=$this->getView('Access');
        $view->logform($data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

    public function login(){
        $model=$this->getModel('Access');
        $data = $model->login($_POST['login'],$_POST['password']);
        if(!isset($data['error']))
            $this->redirect('');
        else
            $this->logform($data);
    }

    public function logout(){
        $model=$this->getModel('Access');
        $model->logout();
        $this->redirect('');
    }

    public function islogin(){
        if(\Tools\Access::islogin() !== true){
            \Tools\Session::set('message', "Musisz być zalogowany!");
            $this->redirect('Logowanie');
        }
    }

}