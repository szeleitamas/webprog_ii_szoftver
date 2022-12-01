<?php

class Muveletek_Ajax_Controller
{
    public $baseName = 'muveletek_ajax';
    public function main(array $vars)
    {

        /*$ajaxModel = new Muveletek_Ajax_Model;
        $ajaxModel->get_data();*/

        $view = new View_Loader($this->baseName."_main");
    }
}