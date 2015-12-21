<?php
/**
 * bloodstone community V1.0.0
 * installAPI Class !
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class installAPI extends databaseAPI {
    private $_table = 'users';
    private $_table2 = 'users_pref';
    private static $_instance = null;

    /**
     * @return null|usersAPI
     */
    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new installAPI(Controller::$db);
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
     * @param array $data
     * @param string $msg
     * @return array|bool|null|string
     */
    public function createAdmin($data = array(), $msg = 'done')
    {
        Controller::$language->load('validation/join');
        $retype = $data['rePassword'];
        $fullName = $data['fullName'];
        //remove the rePassword and fullName from the array because they aren't a valid fields
        unset($data['rePassword'], $data['fullName']);
        $fields = array_keys($data);
        //set the required fields
        $requireData = ['username', 'password', 'email', 'rePassword', 'fullName', 'birthday'];
        $errors = [];
        //-- check for errors
        //if a required fields is inExistent return the error immediately
        if ( !empty(array_diff($requireData, array_merge($fields, ['rePassword', 'fullName']))) )
            return ['require' => [Controller::$language->invokeOutput("require")]];
        //*merge all adjacent spaces
        $fullName = preg_replace('/[\s]+/u', ' ', trim($fullName));
        //if the full name have a restricted words
        if (Validation::isRestrictEntry($fullName))
            $errors['fullName'][] = Controller::$language->invokeOutput("fullName3");
        //if there's only the first name ( one word is set )
        if (!preg_match('/\s/', $fullName))
            $errors['fullName'][] = Controller::$language->invokeOutput("fullName1");
        //if the full name contains non letters characters
        if (isset($fullName[0]) && !preg_match('/^([A-z\s\p{Arabic}])+$/u', $fullName))
            $errors['fullName'][] = Controller::$language->invokeOutput("fullName2");
        //lowercase the full name
        strtolower($fullName);
        //split the full name into ( firstName lastName )
        $fullName = explode(' ', $fullName);
        //insert the two new fields into the data array
        $data['first_name'] = $fullName[0];
        //if the first name is too short
        if (!isset($data['first_name'][2]))
            $errors['fullName'][] = Controller::$language->invokeOutput("fullName3");
        //if there's a last name
        if (isset($fullName[1]))
        {
            $data['last_name'] = $fullName[1];
            $data['last_name'] .= isset($fullName[2]) ? ' '.$fullName[2] : '';
            //if the last name is too short
            if (!isset($data['last_name'][2]))
                $errors['fullName'][] = Controller::$language->invokeOutput("fullName4");
        }
        //if username has disallowed words
        if (Validation::isRestrictEntry($data['username']))
            $errors['username'][] = Controller::$language->invokeOutput("username2");
        //if username is short
        if (!isset($data['username'][5]))
            $errors['username'][] = Controller::$language->invokeOutput("username3");
        //if email not valid
        if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
            $errors['email'][] = Controller::$language->invokeOutput("email1");
        //if password is short
        if (!isset($data['password'][5]))
            $errors['password'][] = Controller::$language->invokeOutput("password");
        //if password isn't the same as the re-type
        if ($data['password'] != $retype)
            $errors['rePassword'][] = Controller::$language->invokeOutput("rePassword");
        //reformat date
        $data['birthday'] = getRealDate($data['birthday']);
        //if the birthday is wrong
        if ($data['birthday'] === false)
            $errors['birthday'][] = Controller::$language->invokeOutput("birthday1");
        // -- end check for errors
        //if an error has occurred return the error array
        if (!empty($errors))return $errors;
        //hash the password
        $data['salt'] = Hash::salt(32);
        $data['password'] = Hash::generate($data['password'], $data['salt']);
        //set the default profile picture
        $data['profile_picture'] = URL.'img/bsc-icon.jpg';
        //send a verification e-mail if needed
        $data['hash'] = Hash::generate(time(),  Hash::salt(32));
        $data['active'] = 1;
        $data['role'] = 3;
        //create the user
        if (parent::insertData($this->_table, array_keys($data), array_values($data)))
        {
            $id = Controller::$db->lastInsertId();
            parent::insertData($this->_table2, ['user_id'], [$id]);
            return Controller::$language->invokeOutput($msg);
        }
        return false;
    }

}
