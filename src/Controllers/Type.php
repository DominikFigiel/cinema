<?php
namespace Controllers;

class Type extends Controller {

    public function getMovieWithoutTypes(){
        if(\Tools\Access::islogin()) {
            $data = array();
            if (\Tools\Session::is('message'))
                $data['message'] = \Tools\Session::get('message');
            if (\Tools\Session::is('error'))
                $data['error'] = \Tools\Session::get('error');
            $view = $this->getView('Type');
            $view->getMovieWithoutTypes($data);
            \Tools\Session::clear('message');
            \Tools\Session::clear('error');
        }
        else
            $this->redirect('');
    }

    public function setTypeForMovie($idMovie){
        if(\Tools\Access::islogin()) {
            $model = $this->getModel('Type');
            $data = $model->setTypeForMovie($idMovie, $_POST['type']);
            if(isset($data['message'])){
                \Tools\Session::set('message', $data['message']);
            }
            if(isset($data['error'])){
                \Tools\Session::set('error', $data['error']);
            }

            $model = $this->getModel('Movie');
            $check = $model->checkIfExistsMovieWithoutType();
            if(isset($check['check']) && $check['check'] !== true)
                $this->redirect('Zarządzanie/Seanse/Dodaj');
            else
                $this->redirect('Zarządzanie/Filmy/BezTypu/');
        }
        else
            $this->redirect('');
    }

}