<?php
namespace Views;

class Pricing extends View {

    public function getAll($data = null){

        if(isset($data['message']))
            $this->set('message' , $data['message']);
        if(isset($data['error']))
            $this->set('error' , $data['error']);

        $model = $this->getModel('Pricing');

        //Get 2D pricing list.
        $data = $model->getType("2D");
        if(isset($data['pricings']))
            $this->set('pricings2D' , $data['pricings']);

        //Get 3D pricing list.
        $data = $model->getType("3D");
        if(isset($data['pricings']))
            $this->set('pricings3D' , $data['pricings']);

        $this->render('pricingGetAll');
    }

}