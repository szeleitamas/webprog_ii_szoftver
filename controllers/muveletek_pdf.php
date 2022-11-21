<?php

class Muveletek_Pdf_Controller
{
    public $baseName = 'muveletek_pdf';
    public function main(array $vars)
    {
        $view = new View_Loader($this->baseName."_main");
    }
}
