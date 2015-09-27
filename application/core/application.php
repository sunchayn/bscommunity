<?php

class Application {

    protected   $controller = 'home',
                $method = 'index',
                $params = [];
    static $prefix = URL;

    public function __construct()
    {
        $url = $this->parseUrl();
        if (isset($url))
        {
            if (file_exists('../application/controllers/'.$url[0].'.php'))
            {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                $this->controller = 'error';
            }
        }
        require_once '../application/controllers/'.$this->controller.'.php';
        $this->controller = new $this->controller;
        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        if (!method_exists($this->controller, $this->method))
            header('Location: ' . URL . 'error');

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url']))
        {
            return explode('/',filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
        }
    }
}