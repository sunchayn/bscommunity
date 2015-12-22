<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class search extends Controller{

    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->load('search');
        //set data
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('title');
        //if search for user
        $data['search'] = renderOutput(isset_get($_GET, 'q', false), true);
        if (is_string($data['search']) && !isset($data['search'][0]))
            header('Location: search');
        $data['results'] = false;
        if ($data['search'] !== false)
        {
            //get search result
            $paginator = threadsAPI::getInstance()->getThreadSearchPaginator($data['search']);
            //if the current page is wrong re-direct the user
            if ($paginator->isBadPage())
                header('Location: error');
            //get the users for the pagination result
            $data['results'] = $paginator->_data;
            //get the pages list links form the pagination result
            $data['pages'] = $paginator->renderPages();
        }
        //show views
        $this->loadView('header', $data);
        $this->loadView('search', $data);
        $this->loadView('footer', $data);
    }

}