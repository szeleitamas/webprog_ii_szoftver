<?php

class Muveletek_Ajax_Controller
{
    public $baseName = 'muveletek_ajax';
    public function main(array $vars)
    {
        $view = new View_Loader($this->baseName."_main");
    }
}
