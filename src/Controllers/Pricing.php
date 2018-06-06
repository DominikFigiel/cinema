<?php
namespace Controllers;

class Pricing extends Controller {
    public function getAll(){
        if(!\Tools\Access::islogin()) {
            \Tools\Session::set("navigation", "Pricing");
            $view = $this->getView('Pricing');
            $data = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->getAll($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }
}