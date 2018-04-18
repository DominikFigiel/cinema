<?php
namespace Controllers;

class Movie extends Controller {

    public function getAll($id){
        $view = $this->getView('Movie');
        $data = null;
        if(\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if(\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');
        if(isset($id) && $id != null)
            $data['date'] = $id;
        $view->getAll($data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

    public function getOne($id){
        $view = $this->getView('Movie');
        $data = null;
        if(\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if(\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');
        $view->getOne($id , $data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

}