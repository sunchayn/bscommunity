<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class edit extends Controller
{

    /**
     * @return bool
     */
    public function thread()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0])) {
            //set the view data array
            $data = [];
            $data['thread'] = threadsAPI::getInstance()->getThreadByID($params[0]);
            if (!empty($data['thread'])){
                $data['thread'] = $data['thread'][0];
                if (!accessAPI::getInstance()->checkAccessToUpdateThread($data['thread']->author_id))
                {
                    $this->loadView('access');
                    return false;
                }
                $data['forum'] = forumsAPI::getInstance()->getForumByID($data['thread']->forum_id, 'id, cat_id, title_'.LANGUAGE_CODE.' as title');
                if (!empty($data['forum'])) {
                    //prepare the language
                    self::$language->load('edit');
                    //the title of the page on browser tab
                    $data['title'] = self::$language->invokeOutput('title/thread');
                    //the title shown on the page wide header
                    $data['page-title'] = self::$language->invokeOutput('title/thread');
                    //get the category title
                    $data['forum'] = $data['forum'][0];
                    $data['category'] = categoryAPI::getInstance()->getCategoryByID($data['forum']->cat_id, 'id, title_'.LANGUAGE_CODE.' as title');
                    $data['category'] = isset_get($data['category'], 0, []);
                    //load the header view
                    $this->loadView('header', $data);
                    //load this page view
                    $this->loadView('edit/thread', $data);
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
     * @return bool
     */
    public function reply()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0])) {
            //set the view data array
            $data = [];
            $data['reply'] = repliesAPI::getInstance()->getReplyByID($params[0]);
            if (!empty($data['reply']))
            {
                $data['reply'] = $data['reply'][0];
                if (!accessAPI::getInstance()->checkAccessToUpdateReply($data['reply']->author_id))
                {
                    $this->loadView('access');
                    return false;
                }
                $data['thread'] = threadsAPI::getInstance()->getThreadByID($data['reply']->thread_id, 'id, forum_id, title');
                if (!empty($data['thread'])){
                    $data['thread'] = $data['thread'][0];
                    $data['forum'] = forumsAPI::getInstance()->getForumByID($data['thread']->forum_id, 'id, cat_id, title');
                    if (!empty($data['forum'])) {
                        //prepare the language
                        self::$language->load('edit');
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
                        $this->loadView('edit/reply', $data);
                        //load the footer view
                        $this->loadView('footer', $data);
                    }else{
                        //if the ID not found => show 404 error
                        $this->loadView('404');
                    }
                }else{
                    echo 'no thread';
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

}
