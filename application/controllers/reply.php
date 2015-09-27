<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class reply extends Controller{

    /**
     *
     */
    public function index()
    {
        $params = func_get_args();
        if (isset($params[0]))
        {
            $getReply = repliesAPI::getInstance()->getReplyWithAuthor($params[0], 'replies.*, users.username, users.level, users.profile_picture');
            if (!empty($getReply))
            {
                //set data
                $data = [];
                $data['reply'] = $getReply[0];
                $getThread = threadsAPI::getInstance()->getThreadByID($data['reply']->thread_id);
                if (!empty($getThread))
                {
                    $getThread = $getThread[0];
                    //prepare the language
                    self::$language->load('reply');
                    $data['title'] = $getThread->title;
                    $data['page-title'] = self::$GLOBAL['site_name'];
                    //show views
                    $this->loadView('header', $data);
                    $this->loadView('reply', $data);
                    $this->loadView('footer', $data);
                }else{
                    //show bad url error
                    $this->loadView('404');
                }
            }else{
                //show bad url error
                $this->loadView('404');
            }
        }else{
            header('Location: error');
        }
    }
}