<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class feed extends Controller{

    /**
     *
     */
    public function index()
    {
        if (!usersAPI::isLogged())
            header('Location: home');
        //prepare the language
        self::$language->load('feed');
        //set data
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('page-title');
        //the checked navbar link
        $data['menu-feed'] = "class='checked'";
        //get followers
        $paginator = followAPI::getInstance()->getFollowingPaginator(usersAPI::getLoggedId());
        //if the current page is wrong re-direct the user
        if ($paginator->isBadPage())
            header('Location: error');
        $data['following'] = $paginator->_data;
        $data['pages'] = $paginator->renderPages();
        //var_dump($data['following']);
        foreach($data['following'] as $following)
            $following->threads = threadsAPI::getInstance()->getLastThreads('*', [ ['author_id', '=', $following->following_id] ], 4);
        //show views
        $this->loadView('header', $data);
        $this->loadView('feed', $data);
        $this->loadView('footer', $data);
    }

}