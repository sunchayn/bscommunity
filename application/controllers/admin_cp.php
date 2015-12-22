<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class admin_cp extends Controller{

    public function __construct()
    {
        parent::__construct();
        if (!accessAPI::is_admin())
            header('Location: '. URL .'home');
        self::$language->load('admin_cp/general');
    }

    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->loadAnotherData('admin_cp/index');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $data['checked']['general'] = 'class="checked"';
        $data['sub-checked'] = [];
        //get the statistics
            //all threads count
            $data['threads-count'] = statisticAPI::getInstance()->getThreadsCount();
            //all users count
            $data['users-count'] = statisticAPI::getInstance()->getUsersCount();
            //all replies count
            $data['replies-count'] = statisticAPI::getInstance()->getRepliesCount();
            //get categories count
            $data['categories-count'] = statisticAPI::getInstance()->getCategoriesCount();
            //all forums count
            $data['forums-count'] = statisticAPI::getInstance()->getForumsCount();
            //all visits count
            $data['visits-count'] = visitsAPI::getInstance()->getVisitorCount();
        //get Last Thread
            $data['last-thread'] = threadsAPI::getInstance()->getLastThreads('threads.id, title, username, users.id as UID', null, 1, true);
            $data['last-thread'] = empty( $data['last-thread'] ) ? [] :  $data['last-thread'][0];
        //get Last Reply
            $data['last-reply'] = repliesAPI::getInstance()->getLastReply('thread_id, users.id, username, title');
            $data['last-reply'] = empty( $data['last-reply'] ) ? [] :  $data['last-reply'][0];
        //top visiting countries
        $top = visitsAPI::getInstance()->getTopCountry();
        $data['top-countries'] = [];
        foreach ($top as $country)
            $data['top-countries'][] = [$country->country, ceil(($country->c / $data['visits-count'] ) * 100)];
        $total = disk_total_space(__DIR__);
        $free = disk_free_space(__DIR__);
        $u = $total - $free;
        $per = ceil(($u / $total) * 100);
        $u = round($u / 8 / 1024 / 1024 / 1024, 2);
        $total = round($total / 8 / 1024 / 1024 / 1024, 2);
        $data['usage'] = [$u, $total, $per];
        //show views
        $this->loadView('admin_cp/_header', $data);
        $this->loadView('admin_cp/index', $data);
        $this->loadView('admin_cp/_footer', $data);
    }

    /**
     *
     */
    public function settings()
    {
        //prepare the language
        self::$language->loadAnotherData('admin_cp/settings');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $section = isset_get($_GET, 'section', 'general');
        $data['checked']['settings'] = 'class="checked"';
        $data['sub-checked'][$section] = 'class="checked"';
        if (!in_array($section, ['general', 'variables', 'filter']))
            header('Location: settings');
        if ($section == 'variables')
        {
            $data['limits'] = variablesAPI::getInstance()->getLimits();
            foreach($data['limits'] as $limit)
                $data[$limit->name] = $limit->value;
            unset($data['limits']);
        }
        //show views
        $this->loadView('admin_cp/_header', $data);
        $this->loadView('admin_cp/settings/'.$section, $data);
        $this->loadView('admin_cp/_footer', $data);
    }

    /**
     *
     */
    public function categories()
    {
        //prepare the language
        self::$language->loadAnotherData('admin_cp/categories');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $section = isset_get($_GET, 'section', 'categories');
        $data['checked']['categories'] = 'class="checked"';
        $data['sub-checked'][$section] = 'class="checked"';
        if (!in_array($section, ['categories', 'forums', 'rules']))
            header('Location: settings');
        if ($section == 'categories')
        {
            $data['categories'] = categoryAPI::getInstance()->getCategories('*', true);
        }
        elseif($section == 'forums')
        {
            $cat = intval(isset_get($_GET, 'cat_id', false));
            $data['categories'] = categoryAPI::getInstance()->getCategories();
            if (!empty($data['categories']))
            {
                $data['curr_cat'] = categoryAPI::getInstance()->getCategoryByID($cat);
                if (empty($data['curr_cat']))
                    $data['curr_cat'] = $data['categories'][0];
                else
                    $data['curr_cat'] = $data['curr_cat'][0];
                $data['forums'] = forumsAPI::getInstance()->getForumsByParent($data['curr_cat']->id);
            }
        }elseif($section == 'rules')
        {
            $forum = intval(isset_get($_GET, 'forum_id', false));
            $data['forums'] = forumsAPI::getInstance()->getForums();
            if (!empty($data['forums']))
            {
                $data['curr_forum'] = forumsAPI::getInstance()->getForumByID($forum);
                if (empty($data['curr_forum']))
                    $data['curr_forum'] = $data['forums'][0];
                else
                    $data['curr_forum'] = $data['curr_forum'][0];
                $data['rules'] = forumsAPI::getInstance()->getForumRules($data['curr_forum']->id);
                $data['heading'] = 'title_'.LANGUAGE_CODE;
                $data['desc'] = 'description_'.LANGUAGE_CODE;
            }
        }
        //show views
        $this->loadView('admin_cp/_header', $data);
        $this->loadView('admin_cp/categories/'.$section, $data);
        $this->loadView('admin_cp/_footer', $data);
    }

    /**
     *
     */
    public function users(){
        //prepare the language
        self::$language->loadAnotherData('admin_cp/users');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $section = isset_get($_GET, 'section', 'users');
        $data['checked']['users'] = 'class="checked"';
        $data['sub-checked'][$section] = 'class="checked"';
        if (!in_array($section, ['users', 'roles', 'username']))
            header('Location: users');
        if ($section == 'users')
        {
            $data['search'] = isset_get($_GET, 'search', false);
            if (is_string($data['search']) && !isset($data['search'][0]))
                header('Location: users');
            //get users paginator
            $paginator = usersAPI::getInstance()->getUsersPaginator($data['search'], 'admin_cp/users');
            //if the current page is wrong re-direct the user
            if ($paginator->isBadPage())
                header('Location: error');
            //get the users for the pagination result
            $data['users'] = $paginator->_data;
            //get the pages list links form the pagination result
            $data['pages'] = $paginator->renderPages();
            //get all the roles
            $data['roles'] = accessAPI::getInstance()->getAccess();
            //
            $data['name'] = 'name_'.LANGUAGE_CODE;
        }elseif($section == 'roles'){
            $data['roles'] = accessAPI::getInstance()->getAccess();
            $data['role_name'] = 'name_'.LANGUAGE_CODE;
        }elseif($section == 'username')
        {
            $paginator = usersAPI::getInstance()->getUsernameRequests();
            //if the current page is wrong re-direct the user
            if ($paginator->isBadPage())
                header('Location: error');
            //get the username requests for the pagination result
            $data['username'] = $paginator->_data;
            //get the pages list links form the pagination result
            $data['pages'] = $paginator->renderPages();
        }
        //show views
        $this->loadView('admin_cp/_header', $data);
        $this->loadView('admin_cp/users/'.$section, $data);
        $this->loadView('admin_cp/_footer', $data);
    }

    /**
     *
     */
    public function about()
    {
        //prepare the language
        self::$language->loadAnotherData('admin_cp/about');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $data['checked']['about'] = 'class="checked"';
        $data['sub-checked'] = [];
        //show views
        $this->loadView('admin_cp/_header', $data);
        $this->loadView('admin_cp/about', $data);
        $this->loadView('admin_cp/_footer', $data);
    }

    /**
     *
     */
    public function support()
    {
        //prepare the language
        self::$language->loadAnotherData('admin_cp/support');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $data['checked']['support'] = 'checked';
        $data['sub-checked'] = [];
        $params = func_get_args();
        if (empty($params))
        {
            $paginator = supportAPI::getInstance()->getTicketsPaginator();
            if ($paginator->isBadPage())
                header('Location: error');
            //get the tickets for the pagination result
            $data['tickets'] = $paginator->_data;
            //get the pages list links form the pagination result
            $data['pages'] = $paginator->renderPages();
            //show views
            $this->loadView('admin_cp/_header', $data);
            $this->loadView('admin_cp/support/home', $data);
            $this->loadView('admin_cp/_footer', $data);
        }else{
            $data['ticket'] = supportAPI::getInstance()->getTicketById($params[0]);
            if (!empty($data['ticket']))
            {
                supportAPI::getInstance()->seeTicket($params[0]);
                $data['ticket'] = $data['ticket'][0];
                $this->loadView('admin_cp/_header', $data);
                $this->loadView('admin_cp/support/view', $data);
                $this->loadView('admin_cp/_footer', $data);
            }else{
                header('Location: ../support');
            }
        }
    }

    /**
     *
     */
    public function seo()
    {
        //prepare the language
        self::$language->loadAnotherData('admin_cp/seo');
        $data = [];
        $data['title'] = self::$language->invokeOutput('title');
        $data['checked']['seo'] = 'class="checked"';
        $data['sub-checked'] = [];
        $this->loadView('admin_cp/_header', $data);
        $this->loadView('admin_cp/seo', $data);
        $this->loadView('admin_cp/_footer', $data);
    }
}