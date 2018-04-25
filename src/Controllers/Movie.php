<?php
namespace Controllers;

class Movie extends Controller {

    public function getAll($id){
        if(!\Tools\Access::islogin()) {
            \Tools\Session::set("navigation", "Movie");
            $view = $this->getView('Movie');
            $data = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            if (isset($id) && $id != null)
                $data['date'] = $id;
            $view->getAll($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function getAllAdmin(){
        if(\Tools\Access::islogin()) {
            $view = $this->getView('Movie');
            $data = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->getAllAdmin($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function addShowingFormAdmin($date = null , $idCinemaHall = 1){
        if(\Tools\Access::islogin()) {
            $view = $this->getView('Movie');
            $data = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->addShowingFormAdmin($data , $date, $idCinemaHall);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function getOne($id){
        if(!\Tools\Access::islogin()) {
            \Tools\Session::set("navigation", "Movie");
            $view = $this->getView('Movie');
            $data = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->getOne($id, $data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

}