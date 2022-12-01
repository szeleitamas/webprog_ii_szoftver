<?php

class Muveletek_Controller
{
    public $baseName = 'muveletek';
    public function main(array $vars)
    {
        $view = new View_Loader($this->baseName."_main");
    }
}
