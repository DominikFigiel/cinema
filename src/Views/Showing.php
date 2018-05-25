<?php
namespace Views;
use DateTime;

class Showing extends View {

    //---------------------- Users functions --------------------------------------

    public function getAll($data = null, $date = null, $type = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        if($date != null) {
            if(is_numeric($date))
                $this->set('setDate', date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s', time()). ' + '.$date.' days')));
            else
                $this->set('setDate', $date);
        }
        else {
            $this->set('setDate', date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s', time()). ' + 0 days')));
        }

        $model = $this->getModel('Showing');
        $data = $model->getAll($date , $type);
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        if(isset($data['showings']))
            $this->set('showings' , $data['showings']);

        $data = $model->getType();
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        if(isset($data['types']))
            $this->set('types' , $data['types']);
        if($type == null)
            $type = 'All';
        $this->set('typeIn' , $type);

        $calendar = array();
        $date = date('Y-m-d h:i:s', time());
        for($i = 0; $i < 7; $i++){
            $calendar[$i] = date('Y-m-d h:i:s', strtotime($date. ' + '.$i.' days'));
        }
        $this->set('calendar' , $calendar);

        $this->render('showingGetAll');
    }

    //------------------ Admins functions ------------------------------------------------

    public function getAllAdmin($data, $date = null, $type = null, $cinemaHall = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        if($date != null) {
            if(is_numeric($date))
                $this->set('setDate', date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s', time()). ' + '.$date.' days')));
            else
                $this->set('setDate', $date);
        }
        else {
            $this->set('setDate', date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s', time()). ' + 2 days')));
        }


        //Get all showings
        $model = $this->getModel('Showing');
        $data = $model->getAllAdmin($date , $type , true, $cinemaHall);
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        if(isset($data['showings'])) {

            $this->set('showings', $data['showings']);
        }





        if($type == null){
            $type = 'All';
        }
        $this->set('typeIn' , $type);

        $data = $model->getType();
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        if(isset($data['types']))
            $this->set('types' , $data['types']);

        if($cinemaHall == null)
            $cinemaHall = 'All';
        $this->set('cinemaHallIn' , $cinemaHall);

        $data = $model->getCinemaHalls();
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        if(isset($data['cinemaHalls']))
            $this->set('cinemaHalls' , $data['cinemaHalls']);

        $calendar = array();
        $date = date('Y-m-d h:i:s', time());
        for($i = 2; $i < 26; $i++){
            $calendar[$i] = date('Y-m-d h:i:s', strtotime($date. ' + '.$i.' days'));
        }
        $this->set('calendar' , $calendar);

        $this->render('adminShowings');
    }

    public function addFormAdmin($data = null, $date = null, $time = null, $idCinemaHall = null, $idMovie = null, $idType = null, $dubbing = false){
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
            if(is_null($idCinemaHall)) {
                $idCinemaHall = $cinemaHalls['cinemaHalls'][0][\Config\Database\DBConfig\CinemaHall::$IdCinemaHall];
            }


        //Pobranie filmów
        $movies = $model->getMoviesForAdd();
        $this->set('movies' , $movies['movies']);
        //Ustawienie domyślnego filmu
        if(count($movies['movies']) > 0)
            if(is_null($idMovie)) {
                $idMovie = $movies['movies'][0][\Config\Database\DBConfig\Movie::$IdMovie];
            }

        //Pobranie typów dla filmu
        if(!is_null($idMovie))
        {
            $typesForMovie = $model->getTypesForMovie($idMovie);
            $this->set('typesForMovie', $typesForMovie['types']);
            //Ustawienie domyślnego typu
            if(is_null($idType)) {
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

        if(!is_null($date)) {
            if(is_numeric($date)) {
                $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', time()) . ' + ' . $date . ' days'));
            }
        }
        else{
            $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', time()) . ' + ' . 2 . ' days'));
        }

        if(!is_null($time)){
            if(is_string($date))
                $date = date_create($date);
            $date2 = date_create($time);
            date_time_set($date ,
                $date2->format('H'),
                $date2->format('i'),
                $date2->format('s'));
            $date = date_format($date,"Y/m/d H:i:s");
        }
        else{
            $date2 = date('Y-m-d H:i:s', time());
            $date2 =new DateTime($date2);
            $date = new DateTime($date);
            date_time_set($date ,
                $date2->format('H'),
                $date2->format('i'),
                $date2->format('s'));
            $date = date_format($date,"Y/m/d H:i:s");
        }

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

        //Sprawdzenie, czy są filmy bez typu
        $model = $this->getModel('Movie');
        $check = $model->checkIfExistsMovieWithoutType();
        if(isset($check['check']))
            $this->set("check", $check['check']);
        else
            $this->set("check", false);

        $this->render('adminShowingAdd');
    }

    public function editFormAdmin($id, $idCinemaHall = null , $idMovie = null , $idType = null , $date = null, $time = null, $dubbing = null, $data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $this->set('id', $id);

        $model = $this->getModel('Showing');

        //Pobranie danych filmu
        $showing = $model->getOne($id);
        if(isset($showing['error'])){
            $this->set('error' , $showing['error']);
            $this->render('adminShowings');
        }
        $showing = $showing['showing'];

        if(is_null($idCinemaHall))
            $idCinemaHall = $showing[\Config\Database\DBConfig\CinemaHall::$IdCinemaHall];
        $this->set('idCinemaHall', $idCinemaHall);

        if(is_null($idMovie))
            $idMovie = $showing[\Config\Database\DBConfig\Movie::$IdMovie];
        $this->set('idMovie', $idMovie);

        if(is_null($idType))
            $idType = $showing[\Config\Database\DBConfig\Type::$IdType];
        $this->set('idTypeMovie', $idType);

        if(is_null($dubbing))
            $dubbing = $showing[\Config\Database\DBConfig\Showing::$Dubbing];
        $this->set('dubbing', $dubbing);

        if(is_null($date))
            $date = "".$showing[\Config\Database\DBConfig\Showing::$DateTime];
        else{
            $date = date_create("".$date);
            $date2 = "".$showing[\Config\Database\DBConfig\Showing::$DateTime];
            $date2 = date_create($date2);
            date_time_set($date ,
                $date2->format('H'),
                $date2->format('i'),
                $date2->format('s'));
        }
        if(!is_null($time)){
            if(is_string($date))
                $date = date_create($date);
            $date2 = date_create($time);
            date_time_set($date ,
                $date2->format('H'),
                $date2->format('i'),
                $date2->format('s'));
            $date = date_format($date,"Y/m/d H:i:s");
        }
        $this->set('date', $date);

        //Pobranie sal kinowych
        $cinemaHalls = $model->getCinemaHalls();
        $this->set('cinemaHalls' , $cinemaHalls['cinemaHalls']);

        //Pobranie filmów
        $movies = $model->getMovies();
        $this->set('movies' , $movies['movies']);

        //Pobranie typów dla filmu
        if(!is_null($idMovie))
        {
            $typesForMovie = $model->getTypesForMovie($idMovie);
            $this->set('typesForMovie', $typesForMovie['types']);
        }

        //Ustawienie wartości dla sesji (w razie, gdyby użytkownik chciał edytować seans i będą potrzebne dane)
        \Tools\Session::set('idShowingEdit' , $id);
        \Tools\Session::set('idCinemaHallEdit' , $idCinemaHall);
        \Tools\Session::set('idMovieEdit' , $idMovie);
        \Tools\Session::set('idTypeEdit' , $idType);
        \Tools\Session::set('dateAdminEdit' , $date);
        \Tools\Session::set('dubbingEdit' , $dubbing);

        $this->render('adminShowingEdit');
    }

}