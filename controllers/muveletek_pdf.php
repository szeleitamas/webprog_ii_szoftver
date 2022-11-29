<?php

class Muveletek_Pdf_Controller
{
    public $baseName = 'muveletek_pdf';
    public function main(array $vars)
    {

        $pdfModel = new Muveletek_Pdf_Model;
        $pdfModel->pdf_data();

        $view = new View_Loader($this->baseName."_main");
    }
}
