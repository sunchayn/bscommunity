<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class profile extends Controller
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     *
     */
    public function index()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a user ID
        if (isset($params[0])) {
            $getUser = usersAPI::getInstance()->getUserById($params[0]);
            if (!empty($getUser))
            {
                if (usersAPI::getInstance()->getUserPreferences($params[0], 'profile_visibility')[0]->profile_visibility == 0 && !usersAPI::isLogged())
                    header('Location: ../home');
                //prepare the language
                self::$language->load('profile');
                //update the profile view count
                usersAPI::getInstance()->updateView($params[0]);
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['general'] = "class='checked'";
                $data['user'] = $getUser;
                $data['stats'] = [];
                $data['stats']['replies'] = repliesAPI::getInstance()->getReplies('count(*) as cnt', [ [ 'author_id', '=', $id ] ])[0]->cnt;
                $data['stats']['threads'] = threadsAPI::getInstance()->getThreads('count(*) as cnt', [ [ 'author_id', '=', $id ] ])[0]->cnt;
                $data['stats']['thanked'] = thanksAPI::getInstance()->getThankedCount($id);
                $data['threads'] = threadsAPI::getInstance()->getLastThreads('`id`, `title`, `content`, `create`', [ [ 'author_id', '=', $id ] ], 2);
                $data['education'] = json_decode($getUser->education);
                $data['skills'] = json_decode($getUser->skills);
                $data['interests'] = json_decode($getUser->interest);
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('profile/index', $data);
                //load the footer view
                $this->loadView('footer', $data);
            }else{
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        }else{
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function threads()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0])) {
            $getUser = usersAPI::getInstance()->getUserById($params[0]);
            if (!empty($getUser))
            {
                if (usersAPI::getInstance()->getUserPreferences($params[0], 'profile_visibility as p')[0]->p == 0 && !usersAPI::isLogged())
                    header('Location: ../../home');
                //prepare the language
                self::$language->load('profile');
                //update the profile view count
                usersAPI::getInstance()->updateView($params[0]);
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['threads'] = "class='checked'";
                $data['user'] = $getUser;
                //get current forum
                $forum = intval(isset_get($_GET, 'forum', 0));
                //get users threads
                if ($forum == 0)
                    $paginator = threadsAPI::getInstance()->getThreadsByAuthorForums($id, false);
                else
                    $paginator = threadsAPI::getInstance()->getThreadsByAuthorForums($id, $forum);
                $data['forum'] = ($forum == 0) ?
                    language::invokeOutput('threads-p/all') :
                    forumsAPI::getInstance()->getForumByID($forum, "title")[0]->title;
                $data['threads'] = $paginator->_data;
                //get the pages list links form the pagination result
                $data['pages'] = $paginator->renderPages();
                //get the pages list anchor as a select menu
                $data['selectPages'] = $paginator->getSelectLinks();
                //get all the categories in order to make a cats. switcher
                $data['categories'] = categoryAPI::getInstance()->getCategories("id, title");
                //assign the forums of each category
                foreach ($data['categories'] as $cat)
                    $cat->forums = forumsAPI::getInstance()->getForums("id, title", [['cat_id','=',$cat->id]]);
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('profile/threads', $data);
                //load the footer view
                $this->loadView('footer', $data);
            }else{
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        }else{
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function about()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0])) {
            $getUser = usersAPI::getInstance()->getUserById($params[0]);
            if (!empty($getUser))
            {
                if (usersAPI::getInstance()->getUserPreferences($params[0], 'profile_visibility as p')[0]->p == 0 && !usersAPI::isLogged())
                    header('Location: ../../home');
                //prepare the language
                self::$language->load('profile');
                //update the profile view count
                usersAPI::getInstance()->updateView($params[0]);
                //get the first record
                $getUser = $getUser[0];
                $getPref = usersAPI::getInstance()->getUserPreferences($getUser->id, 'bd_visibility');
                $getPref = (!empty($getPref)) ? $getPref[0]->bd_visibility : false;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['about'] = "class='checked'";
                $data['user'] = $getUser;
                //$data['birthday'] =  (!$getPref) ? null : date('F d, Y', strtotime($data['user']->birthday)) . ' -';
                $data['birthday'] =  (!$getPref) ? null : $data['user']->birthday . ' -';
                $data['education'] = json_decode($getUser->education);
                $data['skills'] = json_decode($getUser->skills);
                $data['interests'] = json_decode($getUser->interest);
                $data['quote'] = json_decode($getUser->quote);
                $data['languages'] = (isset($getUser->languages)) ? implode(', ', json_decode($getUser->languages)) : null;
                if (empty($data['languages'])) $data['languages'] = Controller::$language->invokeOutput('frequent/unset');
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('profile/about', $data);
                //load the footer view
                $this->loadView('footer', $data);
            }else{
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        }else{
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function statistic()
    {
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a thread ID
        if (isset($params[0])) {
            $getUser = usersAPI::getInstance()->getUserById($params[0]);
            if (!empty($getUser))
            {
                if (usersAPI::getInstance()->getUserPreferences($params[0], 'profile_visibility as p')[0]->p == 0 && !usersAPI::isLogged())
                    header('Location: ../../home');
                //prepare the language
                self::$language->load('profile');
                $id = $params[0];
                //update the profile view count
                usersAPI::getInstance()->updateView($id);
                //get the first record
                $getUser = $getUser[0];
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['statistic'] = "class='checked'";
                $data['user'] = $getUser;
                $data['user']->birthday = isset($data['user']->birthday) ? date('F d, Y', strtotime($getUser->birthday)) : null;
                $threads = statisticAPI::getInstance()->getThreadsCount();
                $replies = statisticAPI::getInstance()->getRepliesCount();
                $posts = $threads + $replies;
                $views = usersAPI::getInstance()->getUsers('sum(views) as v')[0]->v;
                $days = usersAPI::getDays($getUser->create_date) + 1;
                $userPosts = threadsAPI::getInstance()->getThreads('count(*) as c', [ ['author_id', '=', $getUser->id] ])[0]->c +
                                repliesAPI::getInstance()->getReplies('count(*) as c', [ ['author_id', '=', $getUser->id] ])[0]->c;
                $data['thanksC'] = thanksAPI::getInstance()->getThankedCount($id);
                $data['totalThanks'] = thanksAPI::getInstance()->getThanks('count(*) as c')[0]->c;
                $data['posts'][] = usersAPI::getInstance()->getUserRankByField($id, 'posts');
                $data['posts'][] = ($posts) ? ceil(($userPosts / $posts ) * 100) : 0;
                $data['threads'][] = usersAPI::getInstance()->getUserRankByTable($id, 'threads');
                $data['threads'][] = ($threads) ? ceil((usersAPI::getUserThreadsCount($id) / $threads ) * 100) : 0;
                $data['replies'][] = usersAPI::getInstance()->getUserRankByTable($id, 'replies');
                $data['replies'][] = ($replies) ? ceil((usersAPI::getUserRepliesCount($id) / $replies ) * 100) : 0;
                $data['views'][] = usersAPI::getInstance()->getUserRankByField($id, 'views');
                $data['views'][] = ($views) ? ceil(($getUser->views / $views ) * 100) : 0;
                $data['thanks'][] = thanksAPI::getInstance()->getUserRank($id);
                $data['thanks'][] = ($data['thanksC']) ? ceil(( $data['thanksC'] / $data['totalThanks'] ) * 100) : 0;
                $data['ppd'] =  round($getUser->posts / $days, 2);
                $data['rpd'] =  round(usersAPI::getUserRepliesCount($id) / $days, 2);
                $data['tpd'] =  round($data['thanksC'][0] / $days, 2);
                $data['pvpd'] = round($getUser->views / $days, 2);
                $data['rReplies'] = statisticAPI::getInstance()->getRecentDataCount('replies', $id);
                $data['rThreads'] =  statisticAPI::getInstance()->getRecentDataCount('threads', $id);
                $data['rThanks'] =  statisticAPI::getInstance()->getRecentDataCount('thanks', $id);
                //$data['rThanks'] =  statisticAPI::getInstance()->getRecentDataCount('thanks', $id);
                $data['main'] = usersAPI::getInstance()->getMainForum($id);
                $data['levels'] = usersAPI::getInstance()->getUsers("distinct count(*) as cnt, level");
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('profile/statistic', $data);
                //load the footer view
                $this->loadView('footer', $data);
            }else{
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        }else{
            //if no params is passed
            header('Location: ../error');
        }
    }
}