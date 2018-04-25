<?php
namespace Views;

class Movie extends View {

    public function getAll($data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $date = null;
        if(isset($data['date'])) {
            $date = $data['date'];
            if(is_numeric($date))
                $this->set('setDate', date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s', time()). ' + '.$date.' days')));
            else
                $this->set('setDate', $date);
        }
        else $this->set('setDate', date('Y-m-d h:i:s', time()));

        $model = $this->getModel('Showing');
        $data = $model->getAll($date , null);
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        if(isset($data['showings']))
            $this->set('showings' , $data['showings']);

        $calendar = array();
        $date = date('Y-m-d h:i:s', time());
        for($i = 0; $i < 7; $i++){
            $calendar[$i] = date('Y-m-d h:i:s', strtotime($date. ' + '.$i.' days'));
        }
        $this->set('calendar' , $calendar);

        $this->render('movieGetAll');
    }

    public function getAllAdmin($data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $this->render('adminShowings');
    }

    public function addFormAdmin($data = null, $date = null , $idCinemaHall = null, $idMovie = null, $idType = null, $dubbing = false){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        //Pobranie sal kinowych
        $model = $this->getModel('Showing');
        $cinemaHalls = $model->getCinemaHalls();
        $this->set('cinemaHalls' , $cinemaHalls['cinemaHalls']);
        //Ustawienie domyślnej sali
        if(count($cinemaHalls['cinemaHalls']))
            if($idCinemaHall === null) {
                $idCinemaHall = $cinemaHalls['cinemaHalls'][0][\Config\Database\DBConfig\CinemaHall::$IdCinemaHall];
            }

        //Pobranie filmów
        $movies = $model->getMovies();
        $this->set('movies' , $movies['movies']);
        //Ustawienie domyślnego filmu
        if(count($movies['movies']) > 0)
            if($idMovie === null) {
                $idMovie = $movies['movies'][0][\Config\Database\DBConfig\Movie::$IdMovie];
            }

        //Pobranie typów dla filmu
        if($idMovie != null)
        {
            $typesForMovie = $model->getTypesForMovie($idMovie);
            $this->set('typesForMovie', $typesForMovie['types']);
            //Ustawienie domyślnego typu
            if($idType == null) {
                if (count($typesForMovie) > 0)
                    $idType = $typesForMovie['types'][0][\Config\Database\DBConfig\MovieType::$IdType];
            }
            else {
                $checkType = $model->checkContainsTypeForMovie($idMovie, $idType);
                if ($checkType['check'] == false){
                    $idType = $typesForMovie['types'][0][\Config\Database\DBConfig\MovieType::$IdType];
                }
            }
        }


        //Ustawienie domyślnej daty
        if($date === null)
            $date = date('Y-m-d h:i:s', time());

        //Ustawienie wartości do smarty
        $this->set('date', $date);
        $this->set('idCinemaHall', $idCinemaHall);
        $this->set('idMovie', $idMovie);
        $this->set('idTypeMovie', $idType);
        $this->set('dubbing', $dubbing);

        //Ustawienie wartości dla sesji (w razie, gdyby użytkownik chciał dodać seans i będą potrzebne dane)
        \Tools\Session::set('idCinemaHall' , $idCinemaHall);
        \Tools\Session::set('idMovie' , $idMovie);
        \Tools\Session::set('idType' , $idType);
        \Tools\Session::set('date' , $date);
        \Tools\Session::set('dubbing' , $dubbing);
        $_COOKIE['url'] = "http://".$_SERVER['HTTP_HOST']."".\Config\Website\Config::$subdir."";


        $this->render('adminShowingAdd');
    }

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

}