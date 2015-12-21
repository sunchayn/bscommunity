<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class login extends Controller
{

    public function __construct()
    {
        if (usersAPI::isLogged())
            header('Location: home');
        parent::__construct(true, true);
    }

    /**
     *
     */
    public function index()
    {
        if (usersAPI::isLogged())
            header('Location: home');
        self::$language->loadGeneralLanguage();
        $data = [];
        $data['title'] = self::$language->invokeOutput('login/title');
        $this->loadView('login', $data);
    }

}
