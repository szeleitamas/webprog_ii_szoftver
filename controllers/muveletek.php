<?php

class Muveletek_Controller
{
    public $baseName = 'muveletek';  //meghatározni, hogy melyik oldalon vagyunk
    public function main(array $vars) // a router által továbbított paramétereket kapja meg
    {
        //betöltjük a nézetet
        $view = new View_Loader($this->baseName."_main");
    }
}
