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
    public function getAllWithoutShowing($data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        $model = $this->getModel('Movie');
        $data = $model->getAllWithoutShowing();
        if(isset($data['movies']))
            $this->set('movies' , $data['movies']);
        $this->render('inCinemaSoon');
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
        $this->set("time", time());
        //Sprawdzenie, czy są filmy bez typu
        $model = $this->getModel('Movie');
        $check = $model->checkIfExistsMovieWithoutType();
        if(isset($check['check']))
            $this->set("check", $check['check']);
        else
            $this->set("check", false);
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
    public function editFormAdmin($id, $data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        $this->set('id' , $id);
        $model = $this->getModel('Movie');
        $movie = $model->getOne($id);
        if(isset($movie['movie'])) {
            $movie = $movie['movie'];
            $this->set('title', $movie[\Config\Database\DBConfig\Movie::$Title]);
            $this->set('releaseDate', $movie[\Config\Database\DBConfig\Movie::$ReleaseDate]);
            $this->set('age', $movie[\Config\Database\DBConfig\Movie::$Age]);
            $this->set('durationTime', $movie[\Config\Database\DBConfig\Movie::$DurationTime]);
            $this->set('description', $movie[\Config\Database\DBConfig\Movie::$Description]);
        }
        $genresChecked = $model->getGenreForMovie($id);
        if(isset($genresChecked['genres'])) {
            $genresChecked = $genresChecked['genres'];
            $this->set('genresChecked' , $genresChecked);
        }
        $productionsChecked = $model->getProductionForMovie($id);
        if(isset($productionsChecked['productions'])) {
            $productionsChecked = $productionsChecked['productions'];
            $this->set('productionsChecked' , $productionsChecked);
        }
        $model = $this->getModel('Genre');
        $genres = $model->getAll();
        if(isset($genres['genres'])) {
            $this->set('genres', $genres['genres']);
        }
        $model = $this->getModel('Production');
        $productions = $model->getAll();
        if(isset($productions['productions']))
            $this->set('productions' , $productions['productions']);
        $this->render('adminMovieEdit');
    }
}