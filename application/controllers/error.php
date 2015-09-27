<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class error extends Controller{

    /**
     *
     */
    public function index()
    {
        self::$language->load('error');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $this->loadView('404', $data);
    }
}