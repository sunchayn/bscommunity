<?php
/**
 * bloodstone community V1.0.0
 * variablesAPI Class !
 * an API
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class variablesAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'variables';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new variablesAPI(Controller::$db);
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

    public function getVariables()
    {
        return parent::selectData('*', null,$this->_table, null);
    }

    public function getLimits()
    {
        return parent::selectData('*', [ '`group` = \'limit\'' ],$this->_table, null);
    }

    public function getVariableByName($name)
    {
        return parent::selectData('value', [ ['name', '=', $name]], $this->_table, null, 'LIMIT 1');
    }

    public function updateVariable($data)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('admin_cp/validation/variables');
        if (empty($data))
            return false;
        $group = $data['group'];
        unset($data['group']);
        //check entry
        //- if isset update site name
        $e = key($data);
        $variable = $this->getVariableData($group, $e);
        if ($data[$e] == $variable->value)
            return [Controller::$language->invokeOutput("no-change")];
        if ($group == 'limit')
        {
            $new = abs(intval($data[$e]));
            if (isset($data['attachMaxFiles']) && $data['attachMaxFiles'] < 2)
                $new = 2;
        }
        //update the category
        return (parent::updateData($this->_table, ['field' => 'id', 'value' => $variable->id], ['value' => $new])) ? Controller::$language->invokeOutput('done') : false;
    }

    function getVariableValue($group, $variable)
    {
        $var = parent::selectData('value', [ ['group', '=', $group], ['name', '=', strval($variable)] ], $this->_table, null, 'LIMIT 1');
        return !empty($var) ? $var[0]->value : false;
    }

    function getVariableData($group, $variable)
    {
        $data = parent::selectData('*', [ ['group', '=', $group], ['name', '=', strval($variable)] ], $this->_table, null, 'LIMIT 1');
        return !empty($data) ? $data[0] : false;
    }

}