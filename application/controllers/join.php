<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class join extends Controller
{

    /**
     *
     */
    public function index()
    {
        if (usersAPI::isLogged())
            header('Location: home');
        //prepare the language
        self::$language->load('join');
        //set the view data array
        $data = [];
        $data['page-title'] = language::invokeOutput('page-title');
        $data['title'] = language::invokeOutput('title');
        $data['menu-join'] = "class='checked'";
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('join', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

}
