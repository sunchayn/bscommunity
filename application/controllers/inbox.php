<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class inbox extends Controller
{
    /**
     *
     */
    public function index()
    {
        //redirect visitors
        if (!usersAPI::isLogged())
            header('Location: home');
        //get the logged id
        $id = self::$GLOBAL['logged']->id;
        //prepare the language
        self::$language->load('inbox');
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('page-title');
        //get the current section
        $section = isset_get($_GET, 'section', 'inbox');
        //select the current link
        $data['selected'][$section] = "id='checked'";
        //get the current section
        if ($section == 'inbox')
        {
            $paginator = inboxAPI::getInstance()->getUserInbox($id, true);
            $data['postfix'] = '1';
        }
        elseif ($section == 'sent')
        {
            $paginator = inboxAPI::getInstance()->getUserOutbox($id, true, '&');
            $data['postfix'] = '2';
        }
        elseif($section == 'draft')
        {
            $paginator = inboxAPI::getInstance()->getUserInbox($id);
            $data['postfix'] = '3';
        }
        //redirect bad pages
        if ($paginator->isBadPage() && $section == 'inbox')
            header('Location: inbox');
        elseif ($paginator->isBadPage())
            header('Location: inbox?section='.$section);
        //get the fetched data
        $data['messages'] = $paginator->_data;
        //get the pages links
        $data['pages'] = $paginator->getInboxPages();
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('inbox', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

}