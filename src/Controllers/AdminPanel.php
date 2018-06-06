<?php
namespace Controllers;
class AdminPanel extends Controller {

    public function adminPanel(){
        if(\Tools\Access::islogin()) {
            $view = $this->getView('AdminPanel');
            $data = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->adminPanel($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

}