<?php

class Muveletek_Restful_Controller
{
    public $baseName = 'muveletek_restful';
    public function main(array $vars)
    {
        $view = new View_Loader($this->baseName."_main");
    }
}
