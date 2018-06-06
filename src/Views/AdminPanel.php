<?php
namespace Views;

class AdminPanel extends View {

    public function adminPanel($data){
        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $this->render('adminPanel');
    }

}