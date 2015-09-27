<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class inventory extends Controller
{
    /**
     *
     */
    public function index()
    {
        if (!usersAPI::isLogged())
            header('Location: home');
        $user = Controller::$GLOBAL['logged']->id;
        //prepare the language
        self::$language->load('inventory');
        self::$language->loadAnotherData('items');
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('page-title');
        //get the paginator
        $paginator = inventoryAPI::getInstance()->getInventoryPaginator($user);
        if ($paginator->isBadPage())
            header('Location: inventory');
        $data['items'] = $paginator->_data;
        $data['pages'] = $paginator->renderPages();
        $data['item-title'] = 'title_'.LANGUAGE_CODE;
        $data['item-desc'] = 'desc_'.LANGUAGE_CODE;
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('inventory', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

}