<?php
namespace Views;

class Movie extends View {

    public function getOne($id , $data = null){

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

    public function adminGetAll($data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $model = $this->getModel('Movie');
        $data = $model->adminGetAll();
        if(isset($data['movies']))
            $this->set('movies' , $data['movies']);

        $this->render('adminMovies');
    }

    public function adminGetOne($id, $data = null){
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

        $this->render('adminMovieGetOne');
    }

    public function addFormAdmin($data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $model = $this->getModel('Genre');
        $genres = $model->getAll();
        if(isset($genres['genres']))
            $this->set('genres' , $genres['genres']);

        $model = $this->getModel('Production');
        $productions = $model->getAll();
        if(isset($productions['productions']))
            $this->set('productions' , $productions['productions']);

        $this->render('adminMovieAdd');
    }

}