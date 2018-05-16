<?php
namespace Views;

class Movie extends View {

    public function getAll($data = null){

        $model = $this->getModel('Movie');
        $data = $model->getAll();
        $this->set('movies', $data['movie']);
        //$this->set('customScript', array('datatables.min', 'table.min'));
        $this->render('MovieGetAll');
    }
    public function index(){
        $model = $this->getModel('Movie');
        if($model) {
            $data = $model->getAll();
            if(isset($data['movie']))
                $this->set('allMovies', $data['movie']);
            if(isset($data['error']))
                $this->set('error', $data['error']);
            $this->render('Movie');return true;
        }
        return false;
    }

    public function addform()
    {
        $this->set('customScript', array('jquery.validate.min', 'MovieAddForm', 'formularz'));
        $this->render('MovieAddForm');
    }

    public function getOne($id , $data = null)
    {
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $model = $this->getModel('Movie');
        $data = $model->getOne($id);
        if(isset($data['movie']))
            $this->set('movie' , $data['movie']);

        $data = $model->getGenreForMovie($id);
        if(isset($data['genres']))
            $this->set('genres' , $data['genres']);

        $data = $model->getActorForMovie($id);
        if(isset($data['actors']))
            $this->set('actors' , $data['actors']);

        $data = $model->getProductionForMovie($id);
        if(isset($data['productions']))
            $this->set('productions' , $data['productions']);

        $this->render('movieGetOne');
    }

    public function editForm($movie)
    {
        $this->set('IdMovie', $movie[\Config\Database\DBConfig\Movie::$IdMovie ]);
        $this->set('Title', $movie[\Config\Database\DBConfig\Movie::$Title]);
        $this->set('ReleaseDate', $movie[\Config\Database\DBConfig\Movie::$ReleaseDate]);
        $this->set('Age', $movie[\Config\Database\DBConfig\Movie::$Age]);
        $this->set('DurationTime', $movie[\Config\Database\DBConfig\Movie::$DurationTime]);
        $this->set('Cover', $movie[\Config\Database\DBConfig\Movie::$Cover]);
        $this->set('Description', $movie[\Config\Database\DBConfig\Movie::$Description]);
        $this->set('customScript', array('jquery.validate.min', 'MovieEditForm'));
        $this->render('MovieEditForm');
    }


}