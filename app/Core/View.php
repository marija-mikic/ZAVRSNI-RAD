<?php

namespace Core;

use Exception;

class View
{
    public function render($phtmlPage, $parameters = [])
    {
        $fileName = BP_APP . 'View' . DIRECTORY_SEPARATOR . $phtmlPage . '.phtml';
        if(!file_exists($fileName))
        {
            return new Exception('Template not found');//konstruira iznimku
        }
        ob_start();
        extract($parameters, EXTR_SKIP);
        include $fileName;
        $content = ob_get_clean();  // dohvaća trenutni sadržaj i briše međuspremnik
        return $content;
    }
}