<?php
namespace Controllers;

class Reservation extends Controller {

    public function chooseAPlaces($id){
        if(!\Tools\Access::islogin()) {
            $data = array();
            \Tools\Session::set("navigation", "Movie");
            $view = $this->getView('Reservation');
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');

            if(isset($_COOKIE["places"])) {
                $data['places'] = $_COOKIE["places"];
            }

            $view->chooseAPlaces($data, $id);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function userData($id){
        if(!\Tools\Access::islogin()) {
            $data = array();
            \Tools\Session::set("navigation", "Movie");
            $view = $this->getView('Reservation');
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');

            if(!isset($_COOKIE['places']))
                $this->redirect('');


            $view->userData($id , $_COOKIE['places']);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function reservation(){
        if(!\Tools\Access::islogin()) {
            if(!isset($_COOKIE['places']))
                $this->redirect('');
            $model = $this->getModel('Reservation');
            $reservation = $model->reservation($_POST['idShowing'], $_POST['firstName'],
                $_POST['lastName'], $_POST['email'],
                $_POST['mobilePhone'], $_COOKIE['places']);

            $this->redirect('');
        }
        else
            $this->redirect('');
    }

}