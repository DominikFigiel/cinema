<?php
namespace Controllers;

class Movie extends Controller {



    public function index()
    {
        // Index tworzy obiekt widoku, który zleca wyświetlanie wszystkich produktów w widoku
        $view = $this->getView('Movie');
        if(!$view || !$view->index())
            $this->redirect('error/404.html');
    }
    public function getAll(){
        $accessController = new \Controllers\Access();
        $accessController->islogin();
        $view= $this->getView('Movie');
        $data = null;
        if(\Tools\Sesja::is('message'))
            $data['message'] = \Tools\Sesja::get('message');
        if(\Tools\Sesja::is('error'))
            $data['error'] = \Tools\Sesja::get('error');
        $view->getAll($data);
        \Tools\Sesja::clear('message');
        \Tools\Sesja::clear('error');
    }

    public function addform(){
        $accessController = new \Controllers\Access();
        $accessController->islogin();
        $view = $this->getView('Movie');
        $view->addform();
    }
    public function add()
    {
        $accessController = new \Controllers\Access();
        $accessController->islogin();
        $model = $this->getModel('Movie');
        $data = $model->add($_POST['Title'], $_POST['ReleaseDate'], $_POST['Age'], $_POST['DurationTime'], $_POST['Cover'], $_POST['Description']);
        if (isset($data['error']))
            \Tools\Sesja::set('error', $data['error']);
        if (isset($data['message']))
            \Tools\Sesja::set('message', $data['message']);
        $this->redirect("Film/");
    }
    public function delete($id){
        $accessController = new \Controllers\Access();
        $accessController->islogin();
        $model = $this->getModel('Movie');
        $data = $model->delete($id);
        if(isset($data['error']))
            \Tools\Sesja::set('error' , $data['error']);
        if(isset($data['message']))
            \Tools\Sesja::set('message' , $data['message']);
        $this->redirect('movie/');
    }

    public function editform($id){
        $accessController = new \Controllers\Access();
        $accessController->islogin();
        $model = $this->getModel('Movie');
        $data = $model->getOne($id);
        if(isset($data['error'])){
            \Tools\Sesja::set('error' , $data['error']);
            $this->redirect('movie/');
        }
        $widok = $this->getView('Movie');
        $widok->editform($data['movie']);
    }

    public function update(){
        $accessController = new \Controllers\Access();
        $accessController->islogin();
        $model = $this->getModel('Movie');
        $data = $model->update($_POST['IdMovie'] , $_POST['Title'] ,$_POST['ReleaseDate'],  $_POST['Age'],  $_POST['DurationTime'],  $_POST['Cover'],  $_POST['Description'] );
        if(isset($data['error']))
            \Tools\Session::set('error' , $data['error']);
        if(isset($data['message']))
            \Tools\Session::set('message' , $data['message']);
        $this->redirect('Film/');
    }

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

}