<?php
namespace Controllers;

class Movie extends Controller {

    public function getOne($id){
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


    //------------------ Admin functions ------------------------------------

    public function adminGetAll(){
        if(\Tools\Access::islogin()) {
            $data = array();
            $view = $this->getView('Movie');
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->adminGetAll($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function addFormAdmin(){
        if(\Tools\Access::islogin()) {
            $data = array();
            $view = $this->getView('Movie');
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view->addFormAdmin($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function adminGetOne($id){
        $view = $this->getView('Movie');
        $data = array();
        if (\Tools\Session::is('message'))
            $data['message'] = \Tools\Session::get('message');
        if (\Tools\Session::is('error'))
            $data['error'] = \Tools\Session::get('error');
        $view->adminGetOne($id, $data);
        \Tools\Session::clear('message');
        \Tools\Session::clear('error');
    }

    public function addMovie(){
        if(\Tools\Access::islogin()) {
            $model = $this->getModel('Movie');

            $Genre = $_POST['Genre'];
            $Productions = $_POST['Production'];
            $movie = $model->addMovie($_POST['Title'], $_POST['ReleaseDate'], $_POST['Age'],
                                        $_POST['DurationTime'], "COVER", $_POST['Description'],
                                        $Genre, $Productions);
            if(isset($movie['message'])){
                \Tools\Session::set('message', $movie['message']);
            }
            if(isset($movie['error'])){
                \Tools\Session::set('error', $movie['error']);
            }

            $this->redirect('Zarządzanie/Filmy/');
        }
        else
            $this->redirect('Zarządzanie/Filmy/');
    }

    public function deleteMovie($idMovie){
        if(\Tools\Access::islogin()) {
            $model = $this->getModel('Movie');
            $movie = $model->deleteMovie($idMovie);
            if(isset($movie['message'])){
                \Tools\Session::set('message', $movie['message']);
            }
            if(isset($movie['error'])){
                \Tools\Session::set('error', $movie['error']);
            }

            $this->redirect('Zarządzanie/Filmy/');
        }
        else
            $this->redirect('Zarządzanie/Filmy/');
    }

}