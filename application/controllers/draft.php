<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class draft extends Controller
{

    public function __construct()
    {
        parent::__construct();
        //clear current user old thread drafts
        threadDraftAPI::getInstance()->clearUserOldDrafts();
        //clear current user old inbox drafts
        inboxDraftAPI::getInstance()->clearUserOldDrafts();
    }

    /**
     *
     */
    public function inbox()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a draft ID
        if (isset($params[0])) {
            //set the view data array
            $data = [];
            $data['draft'] = inboxDraftAPI::getInstance()->getDraftById($params[0]);
            if (!empty($data['draft'])){
                $data['draft'] = $data['draft'][0];
                $id = usersAPI::getLoggedId();
                if ($data['draft']->sender != $id)
                    header('Location: ../error');
                //prepare the language
                self::$language->load('create');
                self::$language->loadAnotherData('draft');
                //the title of the page on browser tab
                $data['title'] = self::$language->invokeOutput('inbox/title');
                //the title shown on the page wide header
                $data['page-title'] = self::$language->invokeOutput('inbox/page-title');
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('draft/inbox', $data);
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
    public function threads()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a draft ID
        if (isset($params[0])) {
            //set the view data array
            $data = [];
            $data['draft'] = threadDraftAPI::getInstance()->getDraftById($params[0]);
            if (!empty($data['draft'])){
                $data['draft'] = $data['draft'][0];
                $id = usersAPI::getLoggedId();

                if ($data['draft']->author_id != $id)
                    header('Location: ../error');
                $data['forum'] = forumsAPI::getInstance()->getForumByID($data['draft']->forum_id, 'id, cat_id, title_'.LANGUAGE_CODE.' as title');
                if (!empty($data['forum'])) {
                    //prepare the language
                    self::$language->load('create');
                    self::$language->loadAnotherData('draft');
                    //the title of the page on browser tab
                    $data['title'] = self::$language->invokeOutput('thread/title');
                    //the title shown on the page wide header
                    $data['page-title'] = self::$language->invokeOutput('thread/page-title');
                    //get the category title
                    $data['forum'] = $data['forum'][0];
                    $data['category'] = categoryAPI::getInstance()->getCategoryByID($data['forum']->cat_id, 'id, title_'.LANGUAGE_CODE.' as title');
                    $data['category'] = isset_get($data['category'], 0, []);
                    //load the header view
                    $this->loadView('header', $data);
                    //load this page view
                    $this->loadView('draft/thread', $data);
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

    public function see()
    {
        if (!usersAPI::isLogged())
            header('Location: ../home');
        $id = usersAPI::getLoggedId();
        Controller::$language->load('draft');
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('see/title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('see/page-title');
        //fetch the drafts paginator
        $paginator = threadDraftAPI::getInstance()->getUserDraftsP($id);
        //get data
        $data['drafts'] = $paginator->_data;
        //render pages
        $data['pages'] = $paginator->renderPages();
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('draft/see', $data);
        //load the footer view
        $this->loadView('footer', $data);        
    }
}