<?php
/**
 * bloodstone community V1.0.0
 * accessAPI Class !
 * an API for management access
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class accessAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'access';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new accessAPI(Controller::$db);
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
     * @return mixed
     */
    public function getAccess($rows = '*')
    {
        return parent::selectData($rows, null, $this->_table);
    }

    /**
     * @param $id
     * @param string $rows
     * @return mixed
     */
    public function getRoleById($id, $rows = '*')
    {
        return parent::selectData($rows, [['id', '=', $id]], $this->_table, null, 'LIMIT 1');
    }

    /**
     * @return bool
     */
    public static function is_admin()
    {
        if (!usersAPI::isLogged())
            return false;
        $getUser = usersAPI::getInstance()->getUserById(Controller::$GLOBAL['logged']->id);
        if (empty($getUser) || $getUser[0]->role != 3)
            return false;
        return true;
    }

    /**
     * @param $access
     * @return array|bool|null|string
     */
    public static function explainAccess($access)
    {
        Controller::$language->load('access');
        $access = json_decode($access);
        if (in_array('admin', $access))
            return Controller::$language->invokeOutput('admin');
        elseif(in_array('moderator', $access))
            return Controller::$language->invokeOutput('moderator');
        elseif(in_array('user', $access))
            return Controller::$language->invokeOutput('user');
        else
        {
            $explain = Controller::$language->invokeOutput('can').' ';
            foreach ($access as $ac)
                $explain .= Controller::$language->invokeOutput($ac).', ';
            return rtrim($explain, ', ');
        }
    }

    /**
     * @param $name
     * @param bool|false $arabic
     * @return bool
     */
    public function isNameExist($name, $arabic = false)
    {
        if (!$arabic)
            return !empty(parent::selectData('id', [['name_en', '=', $name]], $this->_table, null, ' LIMIT 1'));
        return !empty(parent::selectData('id', [['name_ar', '=', $name]], $this->_table, null, ' LIMIT 1'));
    }

    /**
     * @param $access
     * @return bool
     */
    public function isAccessExist($access)
    {
        $getAccess = $this->getAccess('access_json');
        if (empty($getAccess))
            return false;
        else
        {
            foreach ($getAccess as $acc)
            {
                if (empty(array_diff($access, json_decode($acc->access_json))) && empty(array_diff(json_decode($acc->access_json), $access)))
                    return true;
            }
            return false;
        }
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function addRole($data)
    {
        Controller::$language->load('validation/role');
        //array that hold errors
        $errors = [];
        //check for errors
        if (!isset($data['name_ar'], $data['name_en']))
            return ['general' => [Controller::$language->invokeOutput("require")]];
        // -- check for errors
        if (!isset($data['name_en'][0]))
            $errors['name_en'][] = Controller::$language->invokeOutput('name1');
        if ($this->isNameExist($data['name_en']))
            $errors['name_en'][] = Controller::$language->invokeOutput('name2');
        if (!isset($data['name_ar'][0]))
            $errors['name_ar'][] = Controller::$language->invokeOutput('name3');
        if ($this->isNameExist($data['name_ar'], true))
            $errors['name_ar'][] = Controller::$language->invokeOutput('name4');
        if (!isset($data['access']))
            $errors['access'][] = Controller::$language->invokeOutput('access1');
        else
        {
            $data['access'] = array_keys($data['access']);
            if ($this->isAccessExist($data['access']))
                $errors['access'][] = Controller::$language->invokeOutput('access2');
            $data['access_json'] = json_encode($data['access']);
            unset($data['access']);
        }
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))
            return $errors;
        return (parent::insertData($this->_table, array_keys($data), array_values($data))) ? Controller::$language->invokeOutput('done') : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function deleteRole($id)
    {
        Controller::$language->load('validation/role');
        # prevent deleting basic roles
        if (in_array($id, [1,2,3]))
            return [Controller::$language->invokeOutput('basic-roles')];
        # make users that have this role normal users
        parent::updateData('users', ['field' => 'role', 'value' => $id], ['role' => ['1']]);
        return (parent::deleteData($this->_table, ['field'=> 'id', 'value' => $id])) ? Controller::$language->invokeOutput('delete') : false;
        ##---
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function updateRole($data = array())
    {
        if (empty($data))
            return false;
        $id = $data['id'];
        unset($data['id']);
        $role = $this->getRoleById($id);
        if (empty($role))
            return false;
        $role = $role[0];
        Controller::$language->load('validation/role');
        $errors = [];
        $values = [];
        //seek for errors
        //-->update name
        if (isset($data['name_ar']) && $data['name_ar'] != $role->name_ar){
            if (!isset($data['name_ar'][0]))
                $errors['name_ar'][] = Controller::$language->invokeOutput('name3');
            if ($this->isNameExist($data['name_ar'], true))
                $errors['name_ar'][] = Controller::$language->invokeOutput('name4');
            $values['name_ar'] = $data['name_ar'];
        }
        if (isset($data['name_en']) && $data['name_en'] != $role->name_en){
            if (!isset($data['name_en'][0]))
                $errors['name_en'][] = Controller::$language->invokeOutput('name1');
            if ($this->isNameExist($data['name_ar'], true))
                $errors['name_en'][] = Controller::$language->invokeOutput('name2');
            $values['name_en'] = $data['name_en'];
        }
        //-->update access
        if (!isset($data['access']))
            $errors['access'][] = Controller::$language->invokeOutput('access1');
        else
        {
            $data['access'] = array_keys($data['access']);
            if ( !(empty(array_diff($data['access'], json_decode($role->access_json))) && empty(array_diff(json_decode($role->access_json), $data['access']))) )
            {
                if ($this->isAccessExist($data['access']))
                    $errors['access'][] = Controller::$language->invokeOutput('access2');
                $values['access_json'] = json_encode($data['access']);
            }
        }
        //------>
        //if there's an errors
        if (!empty($errors))
            return $errors;
        if (empty($values))
            return ['general' => [Controller::$language->invokeOutput('no-change')] ];
        //update the category
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], $values)) ? Controller::$language->invokeOutput('update') : false;
    }

    /**
     * @param $u
     * @param $action
     * @param bool|false $admin
     * @return bool
     */
    public function checkAccess($u, $action, $admin = false)
    {
        $join = "INNER JOIN users ON access.`id` = users.`role`";
        $getUserAccess = parent::selectData('access.`access_json`, users.role',[ ['users.`id`', '=', $u] ] ,[$this->_table, $join], null, 'LIMIT 1', null);
        if ($admin && $getUserAccess[0]->role == 3)
            return true;
        elseif($admin)
            return false;
        if (in_array($getUserAccess[0]->role, [2, 3]))
            return true;
        if (empty($getUserAccess))
            return false;
        else
            $getUserAccess = json_decode($getUserAccess[0]->access_json, true);
        return in_array($action, $getUserAccess);
    }

    /**
     * @param $author
     * @return bool
     */
    public function checkAccessToDeleteReply($author)
    {
        if (!usersAPI::isLogged())
            return false;
        $u = Controller::$GLOBAL['loggedID'];
        return ($author == $u) ?  true : $this->checkAccess($u, 'remove-replies');
    }

    /**
     * @param $author
     * @return bool
     */
    public function checkAccessToUpdateReply($author)
    {
        if (!usersAPI::isLogged())
            return false;
        $u = Controller::$GLOBAL['loggedID'];
        return ($author == $u) ?  true : $this->checkAccess($u, 'edit-replies');
    }

    /**
     * @param $author
     * @return bool
     */
    public function checkAccessToUpdateThread($author)
    {
        if (!usersAPI::isLogged())
            return false;
        $u = Controller::$GLOBAL['loggedID'];
        return ($author == $u) ?  true : $this->checkAccess($u, 'edit-threads');
    }

    /**
     * @param $author
     * @return bool
     */
    public function checkAccessToDeleteThread($author)
    {
        if (!usersAPI::isLogged())
            return false;
        $u = Controller::$GLOBAL['loggedID'];
        return ($author == $u) ?  true : $this->checkAccess($u, 'remove-threads');
    }

    /**
     * @return bool
     */
    public function checkAccessToPin()
    {
        if (!usersAPI::isLogged())
            return false;
        $u = Controller::$GLOBAL['loggedID'];
        return $this->checkAccess($u, 'pin-threads');
    }
}