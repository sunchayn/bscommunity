<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class logout extends Controller
{

    /**
     *
     */
    public function index()
    {
        usersAPI::clearLoggedTrace();
        header('Location: home');
    }

}
