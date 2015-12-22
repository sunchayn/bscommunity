<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class faq extends Controller
{
    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->load('faq');
        //set the view data array
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('page-title');
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('faq', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

}
