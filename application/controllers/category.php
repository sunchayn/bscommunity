<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class category extends Controller{

    /**
     *
     */
    public function index()
    {
        $params = func_get_args();
        if (isset($params[0]))
        {
            $getCategory = categoryAPI::getInstance()->getCategoryByID($params[0]);
            if (!empty($getCategory))
            {
                //prepare the language
                self::$language->load('category');
                //set data
                $data = [];
                $data['title'] = $getCategory[0]->title;
                $data['page-title'] = self::$GLOBAL['site_name'];
                $data['forums'] = forumsAPI::getInstance()->getForumsByParent($params[0]);
                //fill the data's array with this category information
                self::fillData($getCategory, $data['category']);
                //show views
                $this->loadView('header', $data);
                $this->loadView('category', $data);
                $this->loadView('footer', $data);
            }else{
                //show bad url error
                header('Location: ../error');
            }
        }else{
            header('Location: error');
        }
    }

}