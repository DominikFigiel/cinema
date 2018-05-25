<?php
namespace Views;
use DateTime;

class Type extends View {

    public function getMovieWithoutTypes($data){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $model = $this->getModel('Movie');
        $data = $model->adminGetMovieWithoutType();
        if(isset($data['movies']))
            $this->set('movies' , $data['movies']);

        $this->set("time", time());

        $model = $this->getModel('Type');
        $types = $model->getAll();
        if(isset($types['types'])) {
            $types = $types['types'];
            if(count($types) > 0)
                $this->set('types', $types);
        }

        $this->render('adminShowingWithoutType');
    }

}