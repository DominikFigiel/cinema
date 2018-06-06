<?php
namespace Views;

class Reservation extends View {

    public function chooseAPlaces($data, $id){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        if(isset($data['places']) && $data['places'] != "") {
            $placesReservation = explode(",",$data['places']);
            if(is_array($placesReservation)) {
                if (count($placesReservation) > 0 && !empty($placesReservation)) {
                    $this->set('placesReservation', $placesReservation);
                }
            }
        }

        $model = $this->getModel('Showing');
        $showing = $model->getOne($id);
        if(isset($showing['message']))
            $this->set('message' , $showing['message']);
        if(isset($showing['error']))
            $this->set('error', $showing['error']);
        if(isset($showing['showing'])) {
            $showing = $showing['showing'];
            $this->set('showing', $showing);
        }

        $model = $this->getModel('CinemaHallPlaces');
        $places = $model->getCinemaHallPlaces($showing[\Config\Database\DBConfig\Showing::$IdCinemaHall] , $id);
        if(isset($places['message']))
            $this->set('message' , $places['message']);
        if(isset($places['error']))
            $this->set('error', $places['error']);
        if(isset($places['places'])) {
            $places = $places['places'];
            if(isset($placesReservation)){
                foreach ($places as $keyRow => $row){
                    foreach ($row as $keyColumn => $column){
                        foreach ($placesReservation as $placeReservation){
                            if((int)$placeReservation == (int)$column['id']){
                                $places[$keyRow][$keyColumn]['busy'] = false;
                            }
                        }
                    }
                }
            }
            $this->set('places', $places);
        }

        if(\Tools\Access::islogin())
            $this->set('admin', true);

        $this->set('idShowing', $id);

        $this->render('reservationPlaces');
    }

    public function userData($id, $places, $data = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        if(isset($places)) {
            $placesReservation = explode(",",$places);
            $this->set('placesReservation', $placesReservation);
        }

        $this->set('idShowing', $id);

        $this->render('reservationUserData');
    }

    //-------------------- Admin -----------------------------------

    public function getAllAdmin($data = null, $date = null, $type = null){
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

        $this->set('reservation', true);

        $this->render('adminReservationsAdd');
    }

    public function searchAdmin($data = null, $date = null, $firstName = null, $lastName = null, $email = null, $mobilePhone = null){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $model = $this->getModel('Reservation');
        $data = $model->getAll($date, $firstName, $lastName, $email, $mobilePhone);
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);
        if(isset($data['reservations']))
            $this->set('reservations' , $data['reservations']);

        if($date != null) {
            if(is_numeric($date))
                $this->set('setDate', date('Y-m-d h:i:s', strtotime(date('Y-m-d h:i:s', time()). ' + '.$date.' days')));
            else
                $this->set('setDate', $date);
        }
        else {
            $this->set('setDate', null);
        }

        if($firstName !== null)
            $this->set('firstName', $firstName);

        if($lastName !== null)
            $this->set('lastName', $lastName);
        if($email !== null)
            $this->set('email', $email);
        if($mobilePhone !== null)
            $this->set('mobilePhone', $mobilePhone);

        $calendar = array();
        $date = date('Y-m-d h:i:s', time());
        for($i = 0; $i < 7; $i++){
            $calendar[$i] = date('Y-m-d h:i:s', strtotime($date. ' + '.$i.' days'));
        }
        $this->set('calendar' , $calendar);

        $this->set('reservation', false);
        $this->render('adminReservationsSearch');
    }

}