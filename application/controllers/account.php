<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class account extends Controller
{

    /**
     *
     */
    public function verify()
    {
        $params = func_get_args();
        //prepare the language
        self::$language->load('account');
        $data['title'] = Language::invokeOutput('verify/title');
        $data['page-title'] = Language::invokeOutput('verify/title');
        $data['id'] = (int)isset_get($params, 0, 0);
        $hash = renderOutput(isset_get($params, 1, ''));
        $data['result'] = usersAPI::getInstance()->verifyUser($data['id'], $hash);
        //if the user already active
        if ($data['result'] === -1)
            header('Location: '.URL.'home');
        //show views
        $this->loadView('header', $data);
        $this->loadView('account/verify', $data);
        $this->loadView('footer', $data);
    }

    /**
     *
     */
    public function resend()
    {
        $params = func_get_args();
        //prepare the language
        self::$language->load('account');
        $data['title'] = Language::invokeOutput('resend/title');
        $data['page-title'] = Language::invokeOutput('resend/title');
        $id = (int)isset_get($params, 0, 0);
        $data['result'] = usersAPI::getInstance()->resendVerification($id);
        //if the user already active
        if ($data['result'] === -1)
            header('Location: '.URL.'home');
        //show views
        $this->loadView('header', $data);
        $this->loadView('account/resend', $data);
        $this->loadView('footer', $data);
    }

    public function recover()
    {
        $params = func_get_args();
        //prepare the language
        self::$language->load('account');
        if (isset($params[0]))
        {
            $view = 'reset';
            $data['result'] = recoverAPI::getInstance()->parseHash($params[0]);
        }else{
            $view = 'recover';
        }

        $data['title'] = Language::invokeOutput($view.'/title');
        $data['page-title'] = Language::invokeOutput($view.'/title');
        //show views
        $this->loadView('header', $data);
        $this->loadView('account/'.$view, $data);
        $this->loadView('footer', $data);
    }
}
