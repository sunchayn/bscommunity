<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class members extends Controller{

    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->load('members');
        //set data
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('members');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('members');
        //the checked navbar item
        $data['menu-members'] = "class='checked'";
        //if search for user
        $data['search'] = renderOutput(isset_get($_GET, 'search', false), true);
        if (is_string($data['search']) && !isset($data['search'][0]))
            header('Location: members');
        //get members paginator
        $paginator = usersAPI::getInstance()->getUsersPaginator($data['search']);
        //if the current page is wrong re-direct the user
        if ($paginator->isBadPage())
            header('Location: error');
        //get the users for the pagination result
        $data['users'] = $paginator->_data;
        //get the pages list links form the pagination result
        $data['pages'] = $paginator->renderPages();
        //show views
        $this->loadView('header', $data);
        $this->loadView('members', $data);
        $this->loadView('footer', $data);
}

}