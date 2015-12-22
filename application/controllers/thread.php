<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class thread extends Controller{

    /**
     *
     */
    public function index()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0]))
        {
            $getThread = threadsAPI::getInstance()->getThreadByID($params[0]);
            if (!empty($getThread))
            {
                //update the view count
                threadsAPI::getInstance()->updateView($params[0]);
                //prepare the language
                self::$language->load('thread');
                //set data
                $data = [];
                //the title of the page on browser tab
                $data['title'] = $getThread[0]->title;
                //the title shown on the page wide header
                $data['page-title'] = self::$GLOBAL['site_name'];
                //no - checked navbar item => empty $data['menu-...'];
                //set the order preference
                if (isset($_GET['order']))
                    Order::setOrder();
                //get the order type
                $gedOrderType = Order::getOrder(false);
                //check the order selected type's anchor
                $data[$gedOrderType] = "class='checked'";
                //get the forum and category title
                $data['forum'] = forumsAPI::getInstance()->getForumById($getThread[0]->forum_id, 'id, title_'.LANGUAGE_CODE.' as title, cat_id');
                $data['cat'] = categoryAPI::getInstance()->getCategoryByID($data['forum'][0]->cat_id, 'id, title_'.LANGUAGE_CODE.' as title');
                if (empty($data['forum']) || empty($data['cat']))
                    header('Location: ../error');
                $data['forum'] = $data['forum'][0];
                $data['cat'] = $data['cat'][0];
                //get the data of the author
                $data['author'] = [];
                if($author = usersAPI::getInstance()->getThreadAuthor($getThread[0]->author_id))
                {
                    $data['author'] = $author[0];
                    $data['author']->thanked = thanksAPI::getInstance()->getThankedCount($getThread[0]->author_id);
                    $data['authorSocial'] = json_decode($data['author']->social);
                }
                //get the thanks
                $data['thanks'] = thanksAPI::getInstance()->getThanksForThread($params[0]);
                //get thread replies
                $rows = "replies.*, users.username, users.id as uID, users.create_date, users.country, users.posts, users.level,users.profile_picture, access.name_".LANGUAGE_CODE." as role";
                $paginator = repliesAPI::getInstance()->getRepliesWithAuthor($params[0], $rows);
                //if the current page is wrong re-direct the user
                if ($paginator->isBadPage())
                    header('Location: ../thread/'.$params[0]);
                //get the threads for the pagination result
                $data['replies'] = $paginator->_data;
                //get the pages list links form the pagination result
                $data['pages'] = $paginator->renderPages();
                //get the pages list anchor as a select menu
                $data['selectPages'] = $paginator->getSelectLinks();
                //fill the data's array with this forum information
                $data['thread'] = $getThread[0];
                //var_dump($data);
                //show views
                $this->loadView('header', $data);
                $this->loadView('thread', $data);
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