<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class create extends Controller
{
    /**
     *
     */
    public function thread()
    {
        if (!usersAPI::isLogged())
            header('Location: '.URL.'home');
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0])) {
            //set the view data array
            $data = [];
            $data['forum'] = forumsAPI::getInstance()->getForumByID($params[0], 'id, cat_id, title, status');
            if (!empty($data['forum'])){
                if ($data['forum'][0]->status == 0)
                    header('Location: '.URL.'home');
                //prepare the language
                self::$language->load('create');
                //the title of the page on browser tab
                $data['title'] = self::$language->invokeOutput('title/thread');
                //the title shown on the page wide header
                $data['page-title'] = self::$language->invokeOutput('title/thread');
                //get the category title
                $data['forum'] = $data['forum'][0];
                $data['category'] = categoryAPI::getInstance()->getCategoryByID($data['forum']->cat_id, 'id, title');
                $data['category'] = isset_get($data['category'], 0, []);
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('create/thread', $data);
                //load the footer view
                $this->loadView('footer', $data);
            }else{
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        }else{
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function reply()
    {
        if (!usersAPI::isLogged())
            header('Location: '.URL.'home');
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0])) {
            //set the view data array
            $data = [];
            $data['thread'] = threadsAPI::getInstance()->getThreadByID($params[0], 'id, forum_id, title');
            if (!empty($data['thread'])){
                $data['thread'] = $data['thread'][0];
                $data['forum'] = forumsAPI::getInstance()->getForumByID($data['thread']->forum_id, 'id, cat_id, title');
                if (!empty($data['forum'])) {
                    //prepare the language
                    self::$language->load('create');
                    //the title of the page on browser tab
                    $data['title'] = self::$language->invokeOutput('title/reply');
                    //the title shown on the page wide header
                    $data['page-title'] = self::$language->invokeOutput('title/reply');
                    //get the category title
                    $data['forum'] = $data['forum'][0];
                    $data['category'] = categoryAPI::getInstance()->getCategoryByID($data['forum']->cat_id, 'id, title');
                    $data['category'] = isset_get($data['category'], 0, []);
                    //load the header view
                    $this->loadView('header', $data);
                    //load this page view
                    $this->loadView('create/reply', $data);
                    //load the footer view
                    $this->loadView('footer', $data);
                }else{
                    //if the ID not found => show 404 error
                    header('Location: ../error');
                }
            }else{
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        }else{
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function message()
    {
        if (!usersAPI::isLogged())
            header('Location: '.URL.'home');
        //get the passed params
        $params = func_get_args();
        //create the data holder
        $data = [];
        //if isset a param => isset a user id
        if (isset($params[0])){
            $id = self::$GLOBAL['logged']->id;
            //if the user attempt to send a message to himself
            if ($id == $params[0])
                header('Location: ../error');
            $user = usersAPI::getInstance()->getUserById($params[0], 'id, username');
            //if the given id is wrong
            if (empty($user))
                header('Location: ../error');
            else
                $data['user'] = $user[0];
        }
        //prepare the language
        self::$language->load('create');
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title/message');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('create/message');
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('create/message', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

}
