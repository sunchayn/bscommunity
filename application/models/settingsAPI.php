<?php
/**
 * bloodstone community V1.0.0
 * settingsAPI Class !
 * an API for site general settings
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class settingsAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'settings';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new settingsAPI(Controller::$db);
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
    public function getSettings($rows = "*"){
        return parent::selectData($rows, null, $this->_table, null, 'LIMIT 1');
    }

    /**
     * @param array $data
     * @return array|mixed|string
     */
    public function updateSettings($data = array())
    {
        Controller::$language->load('admin_cp/validation/settings');
        if (empty($data))
            return false;
        if ($data[key($data)] == Controller::$GLOBAL[key($data)])
            return [Controller::$language->invokeOutput("no-change")];
        //check entry
        //- if isset update site name
        if (isset($data['site_name']))
        {
            if (!isset($data['site_name'][4]))
                return [Controller::$language->invokeOutput('siteName1')];
            if (Validation::isRestrictEntry($data['site_name']))
                return [Controller::$language->invokeOutput('siteName2')];
        }
        //- if update webmaster email
        if (isset($data['webmaster_email']))
        {
            //if email not valid
            if (!filter_var($data['webmaster_email'],FILTER_VALIDATE_EMAIL))
                return [Controller::$language->invokeOutput("email1")];
        }
        //- if update keywords
        if (isset($data['site_keywords']))
        {
            $data['site_keywords'] = preg_replace(['/[,،\s]*$/u', '/^[,،\s]*/u', '/[\s]*/u'], '', $data['site_keywords']);
            if ($data['site_keywords'] == Controller::$GLOBAL['site_keywords'])
                return [Controller::$language->invokeOutput("no-change")];
            if (!preg_match('/^([A-z\p{Arabic}\s\d,،])+$/u', $data['site_keywords']))
              return [Controller::$language->invokeOutput("keywords")];
        }
        //update the category
        return (parent::updateData($this->_table, ['field' => 'id', 'value' => 1], $data)) ? Controller::$language->invokeOutput('update') : false;
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function createSettings($data)
    {
        Controller::$language->load('admin_cp/validation/settings');
        if (!empty($this->getSettings()))
            return ['already' => [Controller::$language->invokeOutput("already")]];
        //get the array of fields
        $fieldsArray = array_keys($data);
        //set the required fields
        $requireData = ['site_name','webmaster_email','site_tag','site_desc','site_keywords'];
        if (!empty(array_diff($requireData, $fieldsArray)))
            return ['general' => [Controller::$language->invokeOutput("require")]];
        //array that hold errors
        $errors = [];
        // -- check for errors
        if (!isset($data['site_name'][4]))
            $errors['site_name'][] = Controller::$language->invokeOutput('siteName1');
        if (Validation::isRestrictEntry($data['site_name']))
            $errors['site_name'][] = Controller::$language->invokeOutput('siteName2');
        //tag error
        if (!isset($data['site_tag'][4]))
            $errors['site_tag'][] = Controller::$language->invokeOutput('siteTag1');
        //desc error
        if (!isset($data['site_desc'][4]))
            $errors['site_desc'][] = Controller::$language->invokeOutput('siteDesc1');
        //if email not valid
        if (!filter_var($data['webmaster_email'],FILTER_VALIDATE_EMAIL))
            $errors['webmaster_email'][] = Controller::$language->invokeOutput("email1");
        $data['site_keywords'] = preg_replace(['/[,،\s]*$/u', '/^[,،\s]*/u', '/[,،\s]*/'], '', $data['site_keywords']);
        if (isset($data['site_keywords'][1]) && !preg_match('/^([A-z\p{Arabic}\s\d,،])+$/u', $data['site_keywords']))
            $errors['site_keywords'][] =  Controller::$language->invokeOutput("keywords");
        // -- end check for errors
        //if an error has occurred return
        if (!empty($errors))return $errors;
        if (!isset($data['logo_url'][1]))
            $data['logo_url'] = URL.'img/logo.png';
        if (!isset($data['favicon_url'][1]))
            $data['favicon_url'] = URL.'img/logo.png';
        $data['close_msg'] = language::invokeOutput('defaultMsg');
        return parent::insertData($this->_table, $fieldsArray, array_values($data)) ? Controller::$language->invokeOutput('done') : false;
    }
}