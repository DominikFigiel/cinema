<?php
namespace Views;

class Contact extends View {

    public function get($data = null){

        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $this->render('contact');
    }

}