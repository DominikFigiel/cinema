<?php
namespace Controllers;

class Showing extends Controller {

    //---------------------- Users functions --------------------------------------

    public function getAll(){
        if(!\Tools\Access::islogin()) {
            \Tools\Session::set("navigation", "Movie");
            $view = $this->getView('Showing');
            $data = null;
            $date = null;
            $type = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            if(isset($_COOKIE["dateGetAll"])) {
                if(is_numeric($_COOKIE["dateGetAll"])){
                    $date = date('Y-m-d h:i:s', strtotime( date('Y-m-d h:i:s', time()). ' + '.$_COOKIE["dateGetAll"].' days'));
                }
                else {
                    $date1 = date_create($date);
                    $date2 = date_create($_COOKIE["dateGetAll"]);
                    date_date_set($date1, $date2->format('Y'), $date2->format('m'), $date2->format('d'));
                    $date = $date1;
                    $date = date_format($date, "Y-m-d H:i:s");
                }
            }
            if(isset($_COOKIE["typeGetAll"])) {
                $type = $_COOKIE["typeGetAll"];
                if($type == "All")
                    $type = null;
            }

            $view->getAll($data, $date, $type);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    //------------------ Admins functions ------------------------------------------------

    public function getAllAdmin(){
        if(\Tools\Access::islogin()) {
            $view = $this->getView('Showing');
            $data = null;
            $date = null;
            $type = null;
            $cinemaHall = null;
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            if(isset($_COOKIE["dateAdminGetAll"])) {
                if(is_numeric($_COOKIE["dateAdminGetAll"])){
                    $date = date('Y-m-d h:i:s', strtotime( date('Y-m-d h:i:s', time()). ' + '.$_COOKIE["dateAdminGetAll"].' days'));
                }
                else {
                    $date1 = date_create($date);
                    $date2 = date_create($_COOKIE["dateAdminGetAll"]);
                    date_date_set($date1, $date2->format('Y'), $date2->format('m'), $date2->format('d'));
                    $date = $date1;
                    $date = date_format($date, "Y-m-d H:i:s");
                }
            }
            else{
                $date = date('Y-m-d h:i:s', strtotime( date('Y-m-d h:i:s', time()). ' + '.'2'.' days'));
            }
            if(isset($_COOKIE["typeAdminGetAll"])) {
                $type = $_COOKIE["typeAdminGetAll"];
                if($type == "All")
                    $type = null;
            }
            if(isset($_COOKIE["cinemaHallGetAll"])){
                $cinemaHall = $_COOKIE["cinemaHallGetAll"];
                if($cinemaHall === 'All')
                    $cinemaHall = null;
            }
            $view->getAllAdmin($data, $date, $type, $cinemaHall);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function addFormAdmin(){
        if(\Tools\Access::islogin()) {
            $view = $this->getView('Showing');
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
            else{
                $dubbing = false;
            }
            if(isset($_COOKIE["dateAdminGetAll"])) {
                $date1 = date_create($date);
                if(is_numeric($_COOKIE["dateAdminGetAll"])) {
                    $date2 = date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s', time()) . ' + ' . $_COOKIE["dateAdminGetAll"] . ' days'));
                    $date2 = date_create($date2);
                }
                else{
                    $date2 = date_create($_COOKIE["dateAdminGetAll"]);
                }
                date_date_set($date1 , $date2->format('Y') , $date2->format('m'), $date2->format('d'));
                $date = $date1;
                $date = date_format($date,"Y/m/d H:i:s");
            }
            if(isset($_COOKIE["time"])) {
                if(is_string($date))
                    $date = date_create($date);
                $date1 = $date;
                $date2 = date_create($_COOKIE["time"]);
                date_time_set($date1 , $date2->format('H'), $date2->format('m'), $date2->format('s'));
                $date = $date1;
                $date = date_format($date,"Y/m/d H:i:s");
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

    public function deleteShowing($id){
        if(\Tools\Access::islogin()) {
            $model = $this->getModel('Showing');
            $data = $model->deleteShowing($id);
            if(isset($data['message'])){
                \Tools\Session::set('message', $data['message']);
            }
            if(isset($data['error'])){
                \Tools\Session::set('error', $data['error']);
            }
            $this->redirect('Zarządzanie/Seanse/');
        }
        else
            $this->redirect('');
    }

    public function addShowing(){
        if(\Tools\Access::islogin()) {
            if(!\Tools\Session::is('idMovie') || !\Tools\Session::is('idType') || !\Tools\Session::is('idCinemaHall')
                || !\Tools\Session::is('date') || !\Tools\Session::is('dubbing')){
                \Tools\Session::set('error', 'Nie udało się dodać.');
                $this->redirect('Zarządzanie/Seanse/');
            }
            $model = $this->getModel('Showing');
            $idMovieType = $model->getIdMovieType(\Tools\Session::get('idMovie') , \Tools\Session::get('idType'));
            $idMovieType = $idMovieType['idMovieType'];
            $result = $model->addShowing($idMovieType, \Tools\Session::get('idCinemaHall'),
                \Tools\Session::get('dubbing'), \Tools\Session::get('date'));

            if(isset($result['message'])){
                \Tools\Session::set('message', 'Udało się dodać.');
            }
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

}