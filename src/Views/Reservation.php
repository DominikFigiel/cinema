<?php
namespace Views;

class Reservation extends View {

    public function chooseAPlaces($data, $id){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        if(isset($data['places'])) {
            $placesReservation = explode(",",$data['places']);
            $this->set('placesReservation', $placesReservation);
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

        $this->set('idShowing', $id);

        $this->render('reservationPlaces');
    }

    public function userData($id, $places){
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

}