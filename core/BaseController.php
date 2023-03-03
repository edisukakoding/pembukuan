<?php 

class BaseController 
{
    protected $path     = 'app/views/';

    protected function view($file, $var = [], $print = true)
    {
        $render     = null;
        $file_path  = $this->path . $file . '.php';
        if(file_exists($file_path)) {
            extract($var);

            ob_start();

            include $file_path;

            $render = ob_get_clean();
        }

        if($print) {
            print $render;
        }

        return $render;
    }

    protected function redirect($url = "")
    {
        $tujuan = BASE_URL . $url;
        return header("Location: $tujuan");
    }

}