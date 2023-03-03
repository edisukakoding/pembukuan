<?php 
session_start();
require('config/config.php');

class Init
{
    private mixed $controller;
    private string $method;
    private array $params;
    private string $file;
    private string $uri;
    private string|array $base_url;

    public function __construct($controller, $method)
    {
        if($_SERVER['SERVER_PORT'] == '80') {
            $server     = ($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
            $no_port    = ($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . $_SERVER['SERVER_NAME'];
            $this->base_url = str_replace($no_port, $server, BASE_URL);
        }else {
            $this->base_url = BASE_URL;
        }

        $this->uri          = ($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
        $this->controller   = ucwords($controller);
        $this->method       = $method;
        $this->file         = 'app/controllers/' . $controller . '.php';

        $uri        = str_replace($this->base_url, '', $this->uri);
        $request    = explode('/', $uri);
        // make controller
        // var_dump($request);die;
        if((isset($request[0]) AND ($request[0] !== ''))) {
            $this->file = 'app/controllers/' . ucwords($request[0]) . '.php';
            if(file_exists($this->file)) {
                $this->controller   = ucwords($request[0]);
                unset($request[0]);
            } else {
                echo '<h1>404 - File not Found!</h1>';die;
            }
        }

        
        require('core/BaseController.php');
        require('core/Helper.php');
        require_once($this->file);
        $this->controller  = new $this->controller;

        // make method
        if(isset($request[1])) {
            if(method_exists($this->controller, $request[1])) {
                $this->method   = $request[1];
                unset($request[1]);
            }
        }

        // make params
        if(isset($request)) {
            $this->params   = array_values($request);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);

    }
}

new Init(CONTROLLER, METHOD);