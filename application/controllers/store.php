<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class store extends Controller
{

    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->load('store');
        self::$language->loadAnotherData('items');
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('page-title');
        //the checked navbar link
        $data['menu-store'] = "class='checked'";
        //if search for items
        $data['search'] = renderOutput(isset_get($_GET, 'search', false), true);
        if ($data['search'] !== false && mb_strlen($data['search'], 'UTF-8') == 0)
            header('Location: store');
        //get the paginator
        $paginator = itemsAPI::getInstance()->getItemsPaginator($data['search']);
        if ($paginator->isBadPage())
            header('Location: store');
        $data['items'] = $paginator->_data;
        $data['pages'] = $paginator->getInboxPages();
        $data['item-title'] = 'title_'.LANGUAGE_CODE;
        $data['item-desc'] = 'desc_'.LANGUAGE_CODE;
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('store', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

}