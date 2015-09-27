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
     * @return mixed
     */
    public function getCategoryByTitle($catTitle, $row = "*")
    {
        return parent::selectData($row, [['title', '=', $catTitle]], $this->_table, null, ' LIMIT 1');
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
     * @return bool
     */
    public function isTitleExist($title)
    {
        return (count($this->getCategoryByTitle($title)) == 0  ) ? false : true;
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
        Controller::$language->load('validation/category');
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['title','desc'];
        //array that hold errors
        $errors = [];
        //check for errors
        if (!empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput('require')]];
        // -- check for errors
        //if category title exist
        if ($this->isTitleExist($data['title']))
            $errors['title'][] = Controller::$language->invokeOutput('title1');
        //if empty title
        if (!isset($data['title'][1]))
            $errors['title'][] = Controller::$language->invokeOutput('title2');
        //if title have disallowed words
        if (Validation::isRestrictEntry($data['title'], Controller::$db))
            $errors['title'][] = Controller::$language->invokeOutput('title3');
        //if empty description
        if (!isset($data['desc'][6]))
            $errors['desc'][] = Controller::$language->invokeOutput('desc1');
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))
            return $errors;
        //get max order and add 1
        $getMaxOrder = $this->getMaxOrder() + 1;
        //handle the order of the category
        if (isset($data['order']))
        {
            //if order exist swap orders
            $getOrder = parent::selectData("`id`", [ ['order', '=', $data['order']] ], $this->_table, null, 'LIMIT 1');
            //if there's an exit order
            if (!empty($getOrder))
                //if update old order fail return false
                if (!parent::updateData($this->_table, ['field' => 'id', 'value' => $getOrder[0]->id], ['order' => $getMaxOrder])) return false;
        }else{
            //set the order of current category
            $data['order'] = $getMaxOrder;
            //add the element to the fields array
            array_push($fieldsArray, 'order');
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
        if (isset($data['title']) && $data['title'] != $cat->title){
            //if empty title
            if (!isset($data['title'][1]))
                $errors['title'][] = Controller::$language->invokeOutput('title2');
            //if category title exist
            if ($this->isTitleExist($data['title']))
                $errors['title'][] = Controller::$language->invokeOutput('title1');
            //if title have disallowed words
            if (Validation::isRestrictEntry($data['title'], Controller::$db))
                $errors['title'][] = Controller::$language->invokeOutput('title3');
            $values['title'] = $data['title'];
        }
        //-->update desc
        //if empty description
        if (isset($data['desc']) && $data['desc'] != $cat->desc)
        {
            //if empty desc
            if (!isset($data['desc'][1]))
                $errors['desc'][]= Controller::$language->invokeOutput('desc1');
            $values['desc'] = $data['desc'];
        }
        //if update order
        if (isset($data['order']) && $data['order'] != $cat->order)
        {
            $values['order'] = intval($data['order']);
            //get max order and add 1
            $getMaxOrder = $this->getMaxOrder() + 1;
            if ($values['order'] != 0)
            {
                //swap orders
                $getOrder = parent::selectData("`id`", [ ['order', '=', $values['order']] ], $this->_table, null, 'LIMIT 1');
                //if there's an exit order
                if (!empty($getOrder))
                    //if update old order fail return false
                    if (!parent::updateData($this->_table, ['field' => 'id', 'value' => $getOrder[0]->id], ['order' => $getMaxOrder])) return false;
            }else{
                $values['order'] = $getMaxOrder;
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
        Controller::$language->load('validation/category');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 0])) ? Controller::$language->invokeOutput('close') : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function openCategory($id)
    {
        Controller::$language->load('validation/category');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 1])) ? Controller::$language->invokeOutput('open') : false;
    }

}