<?php
namespace Controllers;

class Contact extends Controller {

    public function get(){
        if(!\Tools\Access::islogin()) {
            \Tools\Session::set("navigation", "Contact");
            $view = $this->getView('Contact');
            $data = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->get($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

}