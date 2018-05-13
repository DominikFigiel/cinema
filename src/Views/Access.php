<?php
namespace Views;

class Access extends View {

    public function logform($data = null){
        $this->set('url' , 'Logowanie');

        /*
        if(\Tools\Access::islogin() === true){
            $this->set('zalogowany' , true);
        }
        else {
            $this->set('zalogowany', false);
        }
        */

            if (isset($data['message']))
                $this->set('message', $data['message']);
            if (isset($data['error']))
                $this->set('error', $data['error']);
            $this->render('LogForm');

    }

}