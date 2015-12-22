<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Application {

    protected   $controller = 'home',
                $method = 'index',
                $params = [];
    static $prefix = URL;

    /**
     *
     */
    public function __construct()
    {
        //parse the URL to get the Controller, methods and params
        $url = $this->parseUrl();
        if (isset($url))
        {
            //if the controller exist
            if (file_exists('../application/controllers/'.$url[0].'.php'))
            {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                //or show 404 error
                $this->controller = 'error';
            }
        }
        //require the Controller
        require_once '../application/controllers/'.$this->controller.'.php';
        //make an instance for controller
        $this->controller = new $this->controller;
        //if there's a method in the url
        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                //put the method in the holder
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        //if there's params
        $this->params = $url ? array_values($url) : [];
        //if the given method is wrong show 404 error
        if (!method_exists($this->controller, $this->method))
            header('Location: ' . URL . 'error');
        //call the controller method from the holders and pass the params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * @return array
     */
    public function parseUrl()
    {
        if (isset($_GET['url']))
            return explode('/',filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL));
    }
}