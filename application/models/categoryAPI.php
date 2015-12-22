<?php
/**
 * bloodstone community V1.0.0
 * usersAPI Class !
 * an API for the user table
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class categoryAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'categories';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new categoryAPI(Controller::$db);
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
     * @param bool $order
     * @return mixed
     */
    public function getCategories($rows = "*", $order = true)
    {
        if ($order)
            return parent::selectData($rows, null, $this->_table, 'ORDER BY `order` ASC');
        else
            return parent::selectData($rows, null, $this->_table);
    }


    /**
     * @param $catTitle
     * @param string $row
     * @param string $lang
     * @return mixed
     */
    public function getCategoryByTitle($catTitle, $row = "*", $lang = '_ar')
    {
        return parent::selectData($row, [['title'.$lang, '=', $catTitle]], $this->_table, null, ' LIMIT 1');
    }

    /**
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getCategoryByID($id, $row = "*")
    {
        return parent::selectData($row, [ ['id', '=', $id] ], $this->_table, null, ' LIMIT 1');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function isExist($id)
    {
        return (count($this->getCategoryByID($id)) == 0  ) ? false : true;
    }


    /**
     * @param $title
     * @param string $ar
     * @param string $rows
     * @return bool
     */
    public function isTitleExist($title, $ar = "_ar", $rows = "*")
    {
        return (count($this->getCategoryByTitle($title, $rows,$ar)) == 0  ) ? false : true;
    }

    /**
     * @return mixed
     */
    public function getMaxOrder()
    {
        return parent::selectData("max(`order`) as maxOrder", null, $this->_table)[0]->maxOrder;
    }

    /**
     * @param array $data
     * @return array|bool
     */
    public function createCategory($data = array())
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/category');
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['title_ar','desc_ar','title_en','desc_en'];
        //array that hold errors
        $errors = [];
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput('require')]];
        // -- check for errors
        //if category title exist
        if ($this->isTitleExist($data['title_ar']))
            $errors['title_ar'][] = Controller::$language->invokeOutput('title1');
        if ($this->isTitleExist($data['title_en'], '_en'))
            $errors['title_en'][] = Controller::$language->invokeOutput('title1-1');
        //if empty title
        if (!isset($data['title_ar'][1]))
            $errors['title_ar'][] = Controller::$language->invokeOutput('title2');
        if (!isset($data['title_en'][1]))
            $errors['title_en'][] = Controller::$language->invokeOutput('title2-2');
        //if empty description
        if (!isset($data['desc_ar'][6]))
            $errors['desc_ar'][] = Controller::$language->invokeOutput('desc1');
        if (!isset($data['desc_en'][6]))
            $errors['desc_en'][] = Controller::$language->invokeOutput('desc1-1');
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))
            return $errors;
        //get max order and add 1
        $getMaxOrder = $this->getMaxOrder() + 1;
        //handle the order of the category
        $data['order'] = isset($data['order'][0]) ? intval($data['order']) : $getMaxOrder;
        $fieldsArray = array_keys($data);
        if ($data['order'] > 0)
        {
            //if order exist swap orders
            $getOrder = parent::selectData("`id`", [ ['order', '=', $data['order']] ], $this->_table, null, 'LIMIT 1');
            if (!empty($getOrder))
                //if update old order fail return false
                if (!parent::updateData($this->_table, ['field' => 'id', 'value' => $getOrder[0]->id], ['order' => $getMaxOrder])) return false;
        }
        //create the user
        return (parent::insertData($this->_table, $fieldsArray, array_values($data)))? Controller::$language->invokeOutput('done') : false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteCategory($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/category');
        //first of all delete all categories forums and all forums threads
        $getForums = forumsAPI::getInstance()->getForums('id', [ ['cat_id', '=', $id] ]);
        if (!empty($getForums))
            foreach($getForums as $forum)
                forumsAPI::getInstance()->deleteForum($forum->id);
        //if process succeed delete the categories
        return (parent::deleteData($this->_table, ['field'=> 'id', 'value' => $id])) ? Controller::$language->invokeOutput('delete') : false;
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function updateCategory($data = array())
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        if (empty($data))
            return false;
        $id = $data['id'];
        unset($data['id']);
        $cat = $this->getCategoryByID($id);
        if (empty($cat))
            return false;
        $cat = $cat[0];
        Controller::$language->load('validation/category');
        $errors = [];
        $values = [];
        //seek for errors
        //-->update title
        if (isset($data['title_ar']) && $data['title_ar'] != $cat->title_ar){
            //if empty title
            if (!isset($data['title_ar'][1]))
                $errors['title_ar'][] = Controller::$language->invokeOutput('title2');
            //if category title exist
            if ($this->isTitleExist($data['title_ar']))
                $errors['title_ar'][] = Controller::$language->invokeOutput('title1');
            $values['title_ar'] = $data['title_ar'];
        }
        if (isset($data['title_en']) && $data['title_en'] != $cat->title_en){
            //if empty title
            if (!isset($data['title_en'][1]))
                $errors['title_en'][] = Controller::$language->invokeOutput('title2-2');
            //if category title exist
            if ($this->isTitleExist($data['title_en'], '_en'))
                $errors['title_en'][] = Controller::$language->invokeOutput('title1-1');
            $values['title_en'] = $data['title_en'];
        }
        //-->update desc
        //if empty description
        if (isset($data['desc_ar']) && $data['desc_ar'] != $cat->desc_ar)
        {
            //if empty desc
            if (!isset($data['desc_ar'][1]))
                $errors['desc_ar'][]= Controller::$language->invokeOutput('desc1');
            $values['desc_ar'] = $data['desc_ar'];
        }
        if (isset($data['desc_en']) && $data['desc_en'] != $cat->desc_en)
        {
            //if empty desc
            if (!isset($data['desc_en'][1]))
                $errors['desc_en'][]= Controller::$language->invokeOutput('desc1-1');
            $values['desc_en'] = $data['desc_en'];
        }
        //if update order
        if (isset($data['order']) && $data['order'] != $cat->order)
        {
            $values['order'] = intval($data['order']);
            if ($values['order'] != 0)
            {
                //swap orders
                $getOrder = parent::selectData("`id`", [ ['order', '=', $values['order']] ], $this->_table, null, 'LIMIT 1');
                //if there's an exit order
                if (!empty($getOrder))
                    //if update old order fail return false
                    if (!parent::updateData($this->_table, ['field' => 'id', 'value' => $getOrder[0]->id], ['order' => $cat->order])) return false;
            }else{
                $values['order'] = $cat->order;
            }
          }
        if (isset($data['visibility']) && $data['visibility'] != $cat->visibility)
            $values['visibility'] = intval($data['visibility']);
        if (empty($values))
            return ['general' => [Controller::$language->invokeOutput('no-change')] ];
        //if there's an errors
        if (!empty($errors))
            return $errors;
        //update the category
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], $values)) ? Controller::$language->invokeOutput('update') : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function closeCategory($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/category');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 0])) ? Controller::$language->invokeOutput('close') : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function openCategory($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/category');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 1])) ? Controller::$language->invokeOutput('open') : false;
    }

}