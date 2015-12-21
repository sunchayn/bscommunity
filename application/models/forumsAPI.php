<?php
/**
 * bloodstone community V1.0.0
 * usersAPI Class !
 * an API for the user table
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class forumsAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'forums', $_table2 = 'rules';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new forumsAPI(Controller::$db);
        }
        return self::$_instance;
    }
    /**
     * define the database variable when call this class
     * @param $db
     */
    function __construct($db){
        $this->setDataBase($db);
    }

    /**
     * @param string $rows
     * @param null $where
     * @return mixed
     */
    public function getForums($rows = "*", $where = null){
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @param $parentID
     * @param string $rows
     * @return mixed
     */
    public function getForumsByParent($parentID, $rows = '*'){
        //$rows = "forums.*, count(threads.id) as threads"
        //$join = 'LEFT JOIN threads on threads.forum_id = forums.id';
        return parent::selectData($rows, [['cat_id', '=', $parentID]],$this->_table, 'order by id');
    }


    /**
     * @param $forumTitle
     * @param string $lang
     * @param string $row
     * @return mixed
     */
    public function getForumByTitle($forumTitle, $row = "*", $lang = '_ar')
    {
        return parent::selectData($row, [['title'.$lang, '=', $forumTitle]], $this->_table, null, ' LIMIT 1');
    }

    /**
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getForumByID($id, $row = "*")
    {
        return parent::selectData($row, [['id', '=', $id]], $this->_table, null, ' LIMIT 1');
    }


    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getForumRules($id, $rows = '*')
    {
        return parent::selectData($rows, [['forum_id', '=', $id]], $this->_table2);
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getRuleById($id, $rows = '*')
    {
        return parent::selectData($rows, [['id', '=', $id]], $this->_table2);
    }

    /**
     * @param $heading
     * @param bool|false $arabic
     * @return bool
     */
    public function isRuleHeadingExist($heading, $arabic = false)
    {
        if (!$arabic)
            return !empty(parent::selectData('id', [['title_en', '=', $heading]], $this->_table2, null, ' LIMIT 1'));
        return !empty(parent::selectData('id', [['title_ar', '=', $heading]], $this->_table2, null, ' LIMIT 1'));
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function addRule($data)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/rules');
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['title_ar','title_en','description_ar','description_en', 'forum_id'];
        //array that hold errors
        $errors = [];
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput('require')]];
        // -- check for errors
        //if forum doesn't exist
        if (!$this->isExist(($data['forum_id'])))
            $errors['general'][] = Controller::$language->invokeOutput('no-forum');
        //if forum title exist
        if ($this->isRuleHeadingExist($data['title_en']))
            $errors['title_en'][] = Controller::$language->invokeOutput('title_en1');
        //if empty title
        if (!isset($data['title_en'][1]))
            $errors['title_en'][] = Controller::$language->invokeOutput('title_en2');
        //if forum title exist
        if ($this->isRuleHeadingExist($data['title_ar'], true))
            $errors['title_ar'][] = Controller::$language->invokeOutput('title_ar1');
        //if empty title
        if (!isset($data['title_ar'][1]))
            $errors['title_ar'][] = Controller::$language->invokeOutput('title_ar2');
        //if empty description
        if (!isset($data['description_ar'][6]))
            $errors['description_ar'][] = Controller::$language->invokeOutput('desc2');
        if (!isset($data['description_en'][6]))
            $errors['description_en'][] = Controller::$language->invokeOutput('desc1');
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))
            return $errors;
        //create the user
        return (parent::insertData($this->_table2, $fieldsArray, array_values($data))) ? Controller::$language->invokeOutput('done') : false;

    }


    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function deleteRule($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/rules');
        return (parent::deleteData($this->_table2, ['field'=> 'id', 'value' => $id])) ? Controller::$language->invokeOutput('delete') : false;
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function updateRule($data = array())
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        if (empty($data))
            return false;
        $id = $data['id'];
        unset($data['id']);
        $rule = $this->getRuleById($id);
        if (empty($rule))
            return false;
        $rule = $rule[0];
        Controller::$language->load('validation/rules');
        $errors = [];
        $values = [];
        //seek for errors
        //-->update title
        if (isset($data['title_ar']) && $data['title_ar'] != $rule->title_ar)
        {
            if (!isset($data['title_ar'][0]))
                $errors['title_ar'][] = Controller::$language->invokeOutput('title_ar2');
            if ($this->isRuleHeadingExist($data['title_ar'], true))
                $errors['title_ar'][] = Controller::$language->invokeOutput('title_ar1');
            $values['title_ar'] = $data['title_ar'];
        }
        if (isset($data['title_en']) && $data['title_en'] != $rule->title_en)
        {
            if (!isset($data['title_en'][0]))
                $errors['title_en'][] = Controller::$language->invokeOutput('title_en2');
            if ($this->isRuleHeadingExist($data['title_en']))
                $errors['title_en'][] = Controller::$language->invokeOutput('title_en1');
            $values['title_en'] = $data['title_en'];
        }
        //-->update description
        if (isset($data['description_ar']) && $data['description_ar'] != $rule->description_ar)
        {
            //if empty description
            if (!isset($data['description_ar'][6]))
                $errors['description_ar'][] = Controller::$language->invokeOutput('desc2');
            $values['description_ar'] = $data['description_ar'];
        }
        if (isset($data['description_en']) && $data['description_en'] != $rule->description_en)
        {
            //if empty description
            if (!isset($data['description_en'][6]))
                $errors['description_en'][] = Controller::$language->invokeOutput('desc1');
            $values['description_en'] = $data['description_en'];
        }
        //------>
        //if there's an errors
        if (!empty($errors))
            return $errors;
        if (empty($values))
            return ['general' => [Controller::$language->invokeOutput('no-change')] ];
        //update the category
        return (parent::updateData( $this->_table2, ['field' => 'id', 'value' => $id], $values)) ? Controller::$language->invokeOutput('update') : false;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function isExist($id)
    {
        return (count($this->getForumByID($id)) == 0  ) ? false : true;
    }


    /**
     * @param $title
     * @param string $lang
     * @param string $rows
     * @return bool
     */
    public function isTitleExist($title, $lang = '_ar', $rows="*")
    {
        return (count($this->getForumByTitle($title, $rows, $lang)) == 0  ) ? false : true;
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function createForum($data = array())
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/forum');
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['title_ar','desc_ar', 'title_en', 'desc_en','cat_id'];
        //array that hold errors
        $errors = [];
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput('require')]];
        // -- check for errors
        //if category doesn't exist
        if (!categoryAPI::getInstance()->isExist(($data['cat_id'])))
            $errors['general'][] = Controller::$language->invokeOutput('no-cat');
        //if forum title exist
        if ($this->isTitleExist($data['title_ar']))
            $errors['title_ar'][] = Controller::$language->invokeOutput('title1');
        if ($this->isTitleExist($data['title_en'], '_en'))
            $errors['title_en'][] = Controller::$language->invokeOutput('title1-1');
        //if empty title
        if (!isset($data['title_ar'][1]))
            $errors['title_ar'][] = Controller::$language->invokeOutput('title2');
        if (!isset($data['title_en'][1]))
            $errors['title_en'][] = Controller::$language->invokeOutput('title2-2');
        //if short description
        if (!isset($data['desc_ar'][6]))
            $errors['desc_ar'][] = Controller::$language->invokeOutput('desc1');
        if (!isset($data['desc_en'][6]))
            $errors['desc_en'][] = Controller::$language->invokeOutput('desc1-1');
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))
            return $errors;
        //if no logo done
        if (!isset($data['logo'][1]))
            $data['logo'] = URL."img/logo.png";
        //create the user
        return (parent::insertData($this->_table, $fieldsArray, array_values($data))) ? Controller::$language->invokeOutput('done') : false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteForum($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/forum');
        //first of all delete all forum threads
        $getThreads = threadsAPI::getInstance()->getThreads('id', [ ['forum_id', '=', $id] ]);
        if (!empty($getThreads))
            foreach($getThreads as $thread)
                threadsAPI::getInstance()->deleteThread($thread->id, false);
        //if process succeed delete the categories
        return (parent::deleteData($this->_table, ['field'=> 'id', 'value' => $id])) ? Controller::$language->invokeOutput('delete') : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function closeForum($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/forum');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 0])) ? Controller::$language->invokeOutput('close') : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function openForum($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/forum');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 1])) ? Controller::$language->invokeOutput('open') : false;
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function updateForum($data = array())
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        if (empty($data))
            return false;
        $id = $data['id'];
        unset($data['id']);
        $forum = $this->getForumByID($id);
        if (empty($forum))
            return false;
        $forum = $forum[0];
        Controller::$language->load('validation/forum');
        $errors = [];
        $values = [];
        //seek for errors
        //->update title
        if (isset($data['title_ar']) && $data['title_ar'] != $forum->title_ar)
        {
            //if forum title exist
            if ($this->isTitleExist($data['title_ar']))
                $errors['title_ar'][] = Controller::$language->invokeOutput('title1');
            //if empty title
            if (!isset($data['title_ar'][1]))
                $errors['title_ar'][] = Controller::$language->invokeOutput('title2');
            $values['title_ar'] = $data['title_ar'];
        }
        if (isset($data['title_en']) && $data['title_en'] != $forum->title_en)
        {
            //if forum title exist
            if ($this->isTitleExist($data['title_en']))
                $errors['title_en'][] = Controller::$language->invokeOutput('title1-1');
            //if empty title
            if (!isset($data['title_en'][1]))
                $errors['title_en'][] = Controller::$language->invokeOutput('title2-2');
            $values['title_en'] = $data['title_en'];
        }
        //->update desc
        if (isset($data['desc_ar']) && $data['desc_ar'] != $forum->desc_ar)
        {
            //if description too short
            if (!isset($data['desc_ar'][6]))
                $errors['desc_ar'][] = Controller::$language->invokeOutput('desc1');
            $values['desc_ar'] = $data['desc_ar'];
        }
        if (isset($data['desc_en']) && $data['desc_en'] != $forum->desc_en)
        {
            //if description too short
            if (!isset($data['desc_en'][6]))
                $errors['desc_en'][] = Controller::$language->invokeOutput('desc1-1');
            $values['desc_en'] = $data['desc_en'];
        }
        //->update logo
        if (isset($data['logo']) && $data['logo'] != $forum->logo)
            $values['logo'] = $data['logo'];
        if (empty($values))
            return ['general' => [Controller::$language->invokeOutput('no-change')] ];
        //if there's an errors
        if (!empty($errors))
            return $errors;
        //update the category
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], $data)) ? Controller::$language->invokeOutput('update') : false;
    }

    /** increment the views of the current forum
     * @param $id
     * @return mixed
     */
    public function updateView($id)
    {
        $viewedForums = Session::get("forumView");
        if (!$viewedForums || (is_array($viewedForums) && !in_array($id, $viewedForums)) )
        {
            if (Session::setArray("forumView", $id))
                return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['views' => ['views + 1']]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getForumThreadsCount($id)
    {
        return threadsAPI::getInstance()->getThreadsByParentID($id, 'count(*) as c')[0]->c;
    }

    /**
     * @param $id
     * @param bool|true $increase
     * @param int $amount
     */
    public function updateForumThreads($id, $increase = true, $amount = 1)
    {
        ($increase) ?
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['threads' => ["threads + {$amount}"]]):
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['threads' => ["threads - {$amount}"]]);
    }

}