<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class newsletter extends Controller{

    /**
     *
     */
    public function unsubscribe()
    {
        $params = func_get_args();
        if (!isset($params[0]))
            header('Location: ' . URL . 'home');
        subscribesAPI::getInstance()->unSubscribe($params[0]);
        header('Location: ' . URL . 'home');
    }
}