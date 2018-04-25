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

    public function addFormAdmin(){
        if(\Tools\Access::islogin()) {
            $view = $this->getView('Movie');
            $data = null;
            $idCinemaHall = null;
            $idMovie = null;
            $idType = null;
            $dubbing = null;
            $date = date('Y-m-d h:i:s', time());
            if(isset($_COOKIE["idCinemaHall"])) {
                $idCinemaHall = $_COOKIE["idCinemaHall"];
            }
            if(isset($_COOKIE["idMovie"])) {
                $idMovie = $_COOKIE["idMovie"];
            }
            if(isset($_COOKIE["idType"])) {
                $idType = $_COOKIE["idType"];
            }
            if(isset($_COOKIE["dubbing"])) {
                if($_COOKIE["dubbing"] == 1)
                    $dubbing = true;
                else
                    $dubbing = false;
            }
            if(isset($_COOKIE["date"])) {
                $date = $_COOKIE["date"];
                //setcookie ("date", "", time() - 3600);
            }

            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->addFormAdmin($data , $date, $idCinemaHall, $idMovie, $idType, $dubbing);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function addShowing(){
        if(\Tools\Access::islogin()) {
            if(!\Tools\Session::is('idMovie') || !\Tools\Session::is('idType') || !\Tools\Session::is('idCinemaHall')
                || !\Tools\Session::is('date') || !\Tools\Session::is('dubbing')){
                $this->redirect('Zarządzanie/Seanse/');
            }
            $model = $this->getModel('Showing');
            $idMovieType = $model->getIdMovieType(\Tools\Session::get('idMovie') , \Tools\Session::get('idType'));
            $idMovieType = $idMovieType['idMovieType'];
            $result = $model->addShowing($idMovieType, \Tools\Session::get('idCinemaHall'),
                                \Tools\Session::get('dubbing'));

            if(isset($result['error'])){
                \Tools\Session::set('error', 'Nie udało się dodać.');
            }
            $this->redirect('Zarządzanie/Seanse/');

            //Czyszczenie sesji
            if(\Tools\Session::is('idMovie'))
                \Tools\Session::clear('idMovie');
            if(\Tools\Session::is('idType'))
                \Tools\Session::clear('idType');
            if(\Tools\Session::is('idCinemaHall'))
                \Tools\Session::clear('idCinemaHall');
            if(\Tools\Session::is('date'))
                \Tools\Session::clear('date');
            if(\Tools\Session::is('dubbing'))
                \Tools\Session::clear('dubbing');
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