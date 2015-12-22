<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class rules extends Controller{

    /**
     *
     */
    public function index()
    {
        $params = func_get_args();
        if (isset($params[0]))
        {
            $getForum = forumsAPI::getInstance()->getForumByID($params[0]);
            if (!empty($getForum))
            {
                //prepare the language
                self::$language->load('rules');
                //set data
                $data = [];
                $data['title'] = self::$language->invokeOutput('title');
                $data['page-title'] = self::$language->invokeOutput('title');
                $data['heading'] = 'title_'.LANGUAGE_CODE;
                $data['desc'] = 'description_'.LANGUAGE_CODE;
                $data['rules'] = forumsAPI::getInstance()->getForumRules($params[0]);
                $data['forum'] = $getForum[0];
                //show views
                $this->loadView('header', $data);
                $this->loadView('rules', $data);
                $this->loadView('footer', $data);
            }else{
                //show bad url error
                header('Location: ../error');
            }
        }else{
            header('Location: error');
        }
    }

}