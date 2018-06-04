<?php
namespace Controllers;

class Reservation extends Controller {

    public function chooseAPlaces($id){
        if(!\Tools\Access::islogin() || \Tools\Access::islogin()) {
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
        if(!\Tools\Access::islogin() || \Tools\Access::islogin()) {
            $data = array();
            \Tools\Session::set("navigation", "Movie");
            $view = $this->getView('Reservation');
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');

            if(!isset($_COOKIE['places']))
                $this->redirect('');


            $view->userData($id , $_COOKIE['places'], $data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function reservation(){
        if(!\Tools\Access::islogin() || \Tools\Access::islogin()) {
            if(!isset($_COOKIE['places']))
                $this->redirect('');
            $model = $this->getModel('Reservation');
            $reservation = $model->reservation($_POST['idShowing'], $_POST['firstName'],
                                                $_POST['lastName'], $_POST['email'],
                                                $_POST['mobilePhone'], $_COOKIE['places']);
            setcookie('places' , null, time()+(60*60*1000), "/");
            if (!\Tools\Access::islogin())
                $this->redirect('');
            else {
                $this->redirect('Zarządzanie/Rezerwacje/');
            }
        }
        else
            $this->redirect('');
    }

    //---------------------- Admin -----------------------------------

    public function getAllAdmin(){
        if(\Tools\Access::islogin()) {

            //For reservation places
            setcookie('places' , null, time()+(60*60*1000), "/");

            $view = $this->getView('Reservation');

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

            $view->getAllAdmin($data, $date, $type);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function searchAdmin(){
        if(\Tools\Access::islogin()) {

            //For reservation places
            setcookie('places' , null, time()+(60*60*1000), "/");

            $data = array();
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');

            $date = null;
            if(isset($_COOKIE["dateGetAll"]) && !is_null($_COOKIE["dateGetAll"]) && $_COOKIE["dateGetAll"] !== '') {
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

            $firstName = null;
            if(isset($_COOKIE["firstName"]) && !is_null($_COOKIE["firstName"]) && $_COOKIE["firstName"] !== '') {
                $firstName = $_COOKIE["firstName"];
            }
            $lastName = null;
            if(isset($_COOKIE["lastName"]) && !is_null($_COOKIE["lastName"]) && $_COOKIE["lastName"] !== '') {
                $lastName = $_COOKIE["lastName"];
            }
            $email = null;
            if(isset($_COOKIE["email"]) && !is_null($_COOKIE["email"]) && $_COOKIE["email"] !== '') {
                $email = $_COOKIE["email"];
            }
            $mobilePhone = null;
            if(isset($_COOKIE["mobilePhone"]) && !is_null($_COOKIE["mobilePhone"]) && $_COOKIE["mobilePhone"] !== '') {
                $mobilePhone = $_COOKIE["mobilePhone"];
            }

            $view = $this->getView('Reservation');
            $view->searchAdmin($data, $date, $firstName, $lastName, $email, $mobilePhone);

            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function deleteReservation($idUser){
        if(\Tools\Access::islogin()) {
            $model = $this->getModel('Reservation');
            $reservation = $model->deleteReservationForUser($idUser);
            if(isset($reservation['error']))
                \Tools\Session::set('error', $reservation['error']);
            if(isset($reservation['message']))
                \Tools\Session::set('message', $reservation['message']);

            $this->redirect('Zarządzanie/Rezerwacje/Szukaj/');
        }
        else
            $this->redirect('');
    }

}