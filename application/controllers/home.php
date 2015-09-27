<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class Home extends Controller
{

    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->load('home');
        //set the view data array
        $data = [];
        //the title of the page on browser tab
        $data['title'] = language::invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$GLOBAL['site_name'];
        //the checked navbar item
        $data['menu-home'] = "class='checked'";
        //get the statistics
            //all threads count
            $data['threads-count'] = statisticAPI::getInstance()->getThreadsCount();
            //all users count
            $data['users-count'] = statisticAPI::getInstance()->getUsersCount();
            //all replies count
            $data['replies-count'] = statisticAPI::getInstance()->getRepliesCount();
            //last user join us
            $data['last-user'] = statisticAPI::getInstance()->getLastJoinedUser();
            //number of users that join us today
            $data['join-us-today'] = statisticAPI::getInstance()->joinUsToday();
            //users that have a birthday today
            $data['have-birthday'] = statisticAPI::getInstance()->haveBirthday();
            //get the recent threads posted on the community
            $data['recent-threads'] = threadsAPI::getInstance()->getLastThreads('id, title', null, 3);
            //get the hottest threads of the previous few days
            $data['hot-threads'] = statisticAPI::getInstance()->getHotThreads();
            //get all categories
            $data['categories'] = categoryAPI::getInstance()->getCategories();
        //fetch all categories
        foreach($data['categories'] as $cat)
        {
            //if current category have forums
            if(!empty($getForums = forumsAPI::getInstance()->getForumsByParent($cat->id)))
            {
                //fetch all forums
                foreach($getForums as $forum)
                {
                    //get current forum threads
                    $getForumThreads = threadsAPI::getInstance()->getThreads("id,count(id) as cID, author_id, title", [['forum_id','=',$forum->id]])[0];
                    //if current forum have threads
                    if ($getForumThreads->cID > 0)
                    {
                        //get the number of threads
                        $forum->threadsCount = $getForumThreads->cID;
                        //get last thread ID
                        $forum->lastThreadID = $getForumThreads->id;
                        //get last thread title
                        $forum->lastThreadTitle = $getForumThreads->title;
                        //get last thread author iD
                        $forum->lastThreadAuthorID = $getForumThreads->author_id;
                        //fetch author by his ID
                        $forum->lastThreadAuthor = usersAPI::getInstance()->getUserById($getForumThreads->author_id, 'username, profile_picture')[0];
                    }else{
                        //if no threads has found in this forum
                        $forum->noThreads = true;
                    }
                }
                //add the forums to the data array
                $data['forums'][$cat->id] = $getForums;
            }
        }
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('home', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

}
