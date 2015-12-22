<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class forum extends Controller{

    /**
     *
     */
    public function index()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a forum ID
        if (isset($params[0]))
        {
            $getForum = forumsAPI::getInstance()->getForumByID($params[0]);
            if (!empty($getForum))
            {
                //set data
                $data = [];
                $data['forum'] = $getForum[0];
                //update the view count
                forumsAPI::getInstance()->updateView($params[0]);
                //prepare the language
                self::$language->load('forum');
                //the title of the page on browser tab
                $data['title'] = $data['forum']->title;
                //the title shown on the page wide header
                $data['page-title'] = self::$GLOBAL['site_name'];
                //set the order preference
                if (isset($_GET['order']))
                    Order::setOrder(false);
                //get the order type
                $gedOrderType = Order::getOrder(false, false);
                //check the order selected type's anchor
                $data[$gedOrderType] = "class='checked'";
                //get the normals ( non pinned and accessible ) threads with pagination
                $paginator = threadsAPI::getInstance()->getNormalThreadsPaginator($params[0]);
                //if the current page is wrong re-direct the user
                if ($paginator->isBadPage())
                    header('Location: error');
                //get the threads for the pagination result
                $data['threads'] = $paginator->_data;
                //get the pages list links form the pagination result
                $data['pages'] = $paginator->renderPages();
                //get the pages list anchor as a select menu
                $data['selectPages'] = $paginator->getSelectLinks();
                //get the pinned threads
                $data['pinned'] = threadsAPI::getInstance()->getPinnedThreads($params[0]);
                //get the data of authors of all fetched threads
                foreach (array_merge($data['threads'], $data['pinned']) as $thread)
                {
                    //get the user
                    $thread->author = usersAPI::getInstance()->getUserById( $thread->author_id, 'id, username');
                    //assign the data to the author property
                    $thread->author = (!empty($thread->author)) ? $thread->author[0] : null;
                }
                //get all the categories in order to make a cats. switcher
                $data['categories'] = categoryAPI::getInstance()->getCategories("id, title");
                //assign the forums of each category
                foreach ($data['categories'] as $cat)
                    $cat->forums = forumsAPI::getInstance()->getForumsByParent($cat->id, "id, title");
                //show views
                $this->loadView('header', $data);
                $this->loadView('forum', $data);
                $this->loadView('footer', $data);
            }else{
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        }else{
            //if no params is passed
            header('Location: error');
        }
    }

}