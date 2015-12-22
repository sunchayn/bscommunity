<?php
/**
 * bloodstone community V1.0.0
 * usersAPI Class !
 * an API for the user table
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class usersAPI extends databaseAPI{

    private $_table = 'users';
    private $_table2 = 'users_pref';
    private $_table3 = 'username_change';
    private static $_instance = null;

    /**
     * @return null|usersAPI
     */
    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new usersAPI(Controller::$db);
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
    public function getUsers($rows = "*", $where = null){
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUserRole($id)
    {
        $join = "LEFT JOIN access ON access.id = users.role";
        return parent::selectData('access.*', [ ['users.id', '=', $id] ], [$this->_table, $join], null, 'LIMIT 1', null);
    }

    /**
     * @param $search
     * @param string $url
     * @return $this
     */
    public function getUsersPaginator($search, $url = 'members')
    {
        $join = "LEFT JOIN access ON access.id = users.role";
        if ($search === false)
            return Paginator::getInstance()->getData([$this->_table, $join], $url, "access.name_".LANGUAGE_CODE." as role, users.id, username, country, posts, level, profile_picture, create_date, status", null, 'order by users.id desc');
        return Paginator::getInstance()->getData([$this->_table, $join], $url.'?search='.$search, "access.name_".LANGUAGE_CODE." as role,users.id, username, country, posts, level, profile_picture, create_date, status", [ ['username', 'LIKE', "%".$search."%"] ], 'order by users.id desc', '&');
    }

    /**
     * @param $id
     * @param string $rows
     * @param array $where
     * @return mixed
     */
    public function getUserPreferences($id, $rows = "*", $where = [])
    {
        if (empty($this->getUserById($id)))
            return false;
        $get = parent::selectData($rows, array_merge([['user_id', '=', $id]], $where), $this->_table2);
        if (empty($get))
        {
            $get = explode(',', $rows);
            $array = '';
            settype($array, 'object');
            foreach ($get as $value)
                $array->$value = 0;
            return [$array];
        }else{
            return $get;
        }
    }

    /** select user by his username
     * @param $username
     * @param string $row
     * @return mixed
     */
    public function getUserByUserName($username, $row = "*")
    {
        return parent::selectData($row, [['username', '=', $username]], $this->_table, null, ' LIMIT 1');
    }

    /** select user by his id
     * @param $id
     * @param string $row
     * @return mixed
     */
    public function getUserById($id, $row = "*")
    {
        return parent::selectData($row, [['id', '=', $id]], $this->_table, null, ' LIMIT 1');
    }

    /**
     * @param $author
     * @param string $rows
     * @return mixed
     */
    public function getThreadAuthor($author, $rows = "users.id, username, posts, create_date, level, profile_picture, social")
    {
        $join = "LEFT JOIN access ON access.id = users.role";
        return parent::selectData($rows.', access.name_' . LANGUAGE_CODE . ' as role', [['users.id', '=', $author]], [$this->_table, $join], null, ' LIMIT 1', null);
    }

    /** select user by his email
     * @param $email
     * @param string $row
     * @return mixed
     */
    public function getUserByEmail($email, $row = "*")
    {
        return parent::selectData($row, [['email', '=', $email]], $this->_table, null, ' LIMIT 1');
    }

    /**
     * @param $email
     * @param string $row
     * @return mixed
     */
    public function getPrefByRecovery($email, $row = "*")
    {
        return parent::selectData($row, [['recovery', '=', $email]], $this->_table2, null, ' LIMIT 1');
    }

    public function getUserRecovery($id)
    {
            return parent::selectData('recovery', [ ['user_id', '=', $id] ], $this->_table2, null, ' LIMIT 1');
    }

    /**
     * @param array $where
     * @return $this
     */
    public function getUsernameRequests($where = [ 'status = 0' ])
    {
        return Paginator::getInstance()->getData($this->_table3, 'admin_cp/users?section=username', "*", $where, null, '&');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRequest($id)
    {
        return parent::selectData('*', [['id', '=', $id]], $this->_table3, null, ' LIMIT 1');
    }

    /**
     * @return bool
     */
    public static function warExternal()
    {
        if (!usersAPI::isLogged())
            return false;
        $pref = usersAPI::getInstance()->getUserPreferences(usersAPI::getLoggedId(), 'external');
        if (empty($pref)) return false; else return ($pref[0]->external == 1);
    }
    /**
     * @param $user_id
     * @return bool
     */
    public function issetUsernameRequest($user_id)
    {
        return !empty(parent::selectData('user_id', [['user_id', '=', $user_id], 'status = 0'], $this->_table3, null, ' LIMIT 1'));
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function handleUsernameRequest($data)
    {
        Controller::$language->load('validation/user');
        $getRequest = $this->getRequest($data['id']);
        if (empty($getRequest))
            return false;
        $getRequest = $getRequest[0];
        if (!isset($data['id'], $data['status']))
            return ['general' => Controller::$language->invokeOutput('require')];
        $status = (intval($data['status']) == 1) ? 1 : 2;
        if ($status == 1)
        {
            if( parent::updateData($this->_table, ['field' => 'id', 'value' => $getRequest->user_id], ['username' => $getRequest->new]) )
            {
                parent::updateData($this->_table3, ['field' => 'id', 'value' => $data['id']], ['status' => $status]);
                return Controller::$language->invokeOutput('request'.$status);
            }
            return false;
        }else{
            if ( parent::updateData($this->_table3, ['field' => 'id', 'value' => $data['id']], ['status' => $status]))
                return Controller::$language->invokeOutput('request'.$status);
            return false;
        }
    }

    /** check if given user id is exist or not
     * @param $id
     * @return mixed
     */
    public function isExist($id)
    {
        return (count($this->getUserById($id)) == 0  ) ? false : true;
    }

    /** check if given email is already token or not
     * @param $email
     * @return bool
     */
    public function isEmailExist($email)
    {
        return (empty($this->getUserByEmail($email))) ? false : true;
    }

    /**
     * @param $email
     * @return bool
     */
    public function isRecoveryExist($email)
    {
        return (empty($this->getPrefByRecovery($email))) ? false : true;

    }

    /** check if given username is already token or not
     * @param $username
     * @return bool
     */
    public function isUsernameExist($username)
    {
        return (count($this->getUserByUserName($username)) == 0  ) ? false : true;
    }

    /** check the password if match
     * @param $userRecord
     * @param $password
     * @return bool
     */
    public function matchPassword($userRecord, $password)
    {
        return ($userRecord->password == Hash::generate($password, $userRecord->salt)) ? true : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function closeUser($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/user');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 0])) ? Controller::$language->invokeOutput('close') : false;
    }

    /**
     * @param $id
     * @return array|bool|null|string
     */
    public function openUser($id)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        Controller::$language->load('validation/user');
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['status' => 1])) ? Controller::$language->invokeOutput('open') : false;
    }

    /**
     * @param array $data
     * @param string $msg
     * @return array|bool|null|string
     */
    public function createUser($data = array(), $msg = 'done')
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
        //if user exist
        if ($this->isUsernameExist($data['username']))
            $errors['username'][] = Controller::$language->invokeOutput("username1");
        //if username has disallowed words
        if (Validation::isRestrictEntry($data['username']))
            $errors['username'][] = Controller::$language->invokeOutput("username2");
        //if username is short
        if (!isset($data['username'][5]))
            $errors['username'][] = Controller::$language->invokeOutput("username3");
        //if email not valid
        if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
            $errors['email'][] = Controller::$language->invokeOutput("email1");
        //if email exist
        if ($this->isEmailExist($data['email']))
            $errors['email'][] = Controller::$language->invokeOutput("email2");
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
        $data['active'] = !(int)variablesAPI::getInstance()->getVariableValue('behaviour', 'verifyEmail');
        //create the user
        if (parent::insertData($this->_table, array_keys($data), array_values($data)))
        {
            $id = Controller::$db->lastInsertId();
            parent::insertData($this->_table2, ['user_id'], [$id]);
            if ($data['active'] == 0)
            {
                $data['id'] = $id;
                $send = $this->sendVerification($data);
                if (is_string($send))
                    return $send;
                return $send[0];
            }
            return Controller::$language->invokeOutput($msg);
        }
        return false;
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function sendVerification($data = array())
    {
        $mail = new Mailer();
        if ( $mail->send(null, $data['email'], Language::invokeOutput('verification').' '.Controller::$GLOBAL['site_name'], null, ['path' => 'verification','plain' => 'verificationPlain', 'data' => $data], true))
            return Language::invokeOutput('verificationDone');
        return [Language::invokeOutput('verificationFail')];
    }

    /**
     * @param $id
     * @return array|bool|int
     */
    public function resendVerification($id)
    {
        $getUser = usersAPI::getInstance()->getUserById($id, 'active, username, id, email, hash');
        //if the id wrong
        if (empty($getUser))
            return false;

        $getUser = $getUser[0];
        //if the user already active
        if ( (int)$getUser->active === 1 )
            return -1;

        //load the language
        Controller::$language->load('validation/join');
        $mail = new Mailer();
        $data = ['id' => $id, 'username' => $getUser->username, 'email' => $getUser->email, 'hash' => $getUser->hash];
        if ($mail->send(null, $data['email'], Language::invokeOutput('verification').' '.Controller::$GLOBAL['site_name'], null, ['path' => 'verification','plain' => 'verificationPlain', 'data' => $data], true))
            return $data;
        else
            return false;
    }

    /**
     * @param $id
     * @param $hash
     * @return bool|mixed
     */
    public function verifyUser($id, $hash)
    {
        $getUser = $this->getUserById($id);
        //if the id wrong
        if (empty($getUser))
            return false;

        $getUser = $getUser[0];
        //if the user already active
        if ( (int)$getUser->active === 1 )
            return -1;
        //if the hashes matches return the update result
        if ($getUser->hash == $hash)
        {
            if (parent::updateData($this->_table, ['field' => 'id', 'value' => $id], [ 'active' => 1 ]))
            {
                $this->sendWelcomeMsg($getUser);
                return true;
            }
        }

        return false;
    }

    public function sendWelcomeMsg($user)
    {
        //load the language
        Controller::$language->load('validation/join');
        $mail = new Mailer();
        $data = ['id' => $user->id, 'username' => $user->username, 'email' => $user->email];
        return ($mail->send(null, $data['email'], Language::invokeOutput('welcome').' '.Controller::$GLOBAL['site_name'], null, ['path' => 'welcome','plain' => 'welcomePlain', 'data' => $data], true));
    }
    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function updatePassword($data = array())
    {
        Controller::$language->load('validation/password');
        if (!isset($data['password'], $data['id'], $data['re-password']))
            return ['general' => [language::invokeOutput('missed')]];
        //if the passwords didn't match
        if ($data['password'] !== $data['re-password'])
            return ['password' => [language::invokeOutput('match')]];
        $getUser = $this->getUserById($data['id'], 'id, salt');
        if (empty($getUser))
            return ['general' => [language::invokeOutput('unf')]];
        $getUser = $getUser[0];
        //generate the new password hash
        $password = Hash::generate($data['password'], $getUser->salt);
        return (parent::updateData($this->_table, ['field' => 'id', 'value' => $getUser->id], ['password' => $password])) ? language::invokeOutput('password-done') : ['general' => [language::invokeOutput('frequent/wrong')]];
    }
    /**
     * @param $data
     * @return array|bool
     */
    public function usernameRequest($data)
    {
        Controller::$language->load('validation/join');
        //-- check for errors
        //if a required fields is inExistent return the error immediately
        if (!isset($data['old'], $data['user_id'], $data['new']) || isset($data[3]))
           return ['require' => [Controller::$language->invokeOutput("require")]];
        return parent::insertData($this->_table3, ['user_id', 'old', 'new'], array_values($data));
    }

    /**
     * @param $data
     * @return array|bool|null|string
     */
    public function changeRole($data)
    {
        //only admins can access to this method
        if (!accessAPI::is_admin())
            return false;
        //-- ## --//
        if (empty($data)) return false;
        Controller::$language->load('validation/changeRole');
        $getUser = $this->getUserById($data['id']);
        if (empty($getUser))
            return [Controller::$language->invokeOutput('wrong')];
        else $getUser = $getUser[0];
        if ($data['role'] == $getUser->role)
            return [Language::invokeOutput('no-change')];
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $getUser->id], ['role' => $data['role']])) ? Controller::$language->invokeOutput("done") : [Language::invokeOutput('frequent/wrong')];
    }
    /**
     * @param $needle
     * @param $skills
     * @return bool
     */
    public function hasSkill($needle, $skills)
    {
        foreach ($skills as $skill)
        {
            if ($skill->label == $needle)
                return true;
        }
        return false;
    }

    /**
     * @param $needle
     * @param $educations
     * @return bool
     */
    public function hasTitle($needle, $educations)
    {
        foreach ($educations as $education)
        {
            if ($education->title == $needle)
                return true;
        }
        return false;
    }

    /**
     * @param $id
     * @param array $data
     * @return array|bool|string
     */
    public function addSkill($id, $data = array())
    {
        Controller::$language->load('validation/user_about');
        $getUser = $this->getUserById($id, 'skills');
        if (empty($getUser))
            return [ 'general' => [Controller::$language->invokeOutput('wrong')] ];
        $fields = array_keys($data);
        //set the required fields
        $requireData = ['label', 'master'];
        //-- check for errors
        //if a required fields is inExistent return the error immediately
        if ( !empty(array_diff($requireData, $fields)) || Validation::isRequireEmpty($requireData, $data))
            return [ 'require' => [Controller::$language->invokeOutput('require')] ];
        $errors = [];
        $skills = (is_null($getUser[0]->skills) || empty($getUser[0]->skills)) ? [] : json_decode($getUser[0]->skills);
        $data['master'] = intval($data['master']);
        if ($this->hasSkill($data['label'], $skills))
            $errors['label'][]= Controller::$language->invokeOutput('skills/already');
        if ($data['master'] > 100 or $data['master'] <= 0)
            $errors['master'][]= Controller::$language->invokeOutput('skills/percentage');
        if (isset($data['certification']) && mb_strlen($data['certification'], 'UTF-8') == 0)
            unset($data['certification']);
        if (!empty($errors))
            return $errors;
        //----> end seeking for errors
        array_push($skills, $data);
        $skills = json_encode($skills);
        //add the skill
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['skills' => $skills]))? Controller::$language->invokeOutput('skills/done') : false;
    }

    /**
     * @param $id
     * @param array $data
     * @return array|bool|string
     */
    public function addTitle($id, $data = array())
    {
        Controller::$language->load('validation/user_about');
        $getUser = $this->getUserById($id, 'education');
        if (empty($getUser))
            return [ 'general' => [Controller::$language->invokeOutput('wrong')] ];
        $fields = array_keys($data);
        //set the required fields
        $requireData = ['title', 'department', 'years'];
        //-- check for errors
        //if a required fields is inExistent return the error immediately
        if ( !empty(array_diff($requireData, $fields)) || Validation::isRequireEmpty($requireData, $data))
            return [ 'require' => [Controller::$language->invokeOutput('require')] ];
        $errors = [];
        $educations = (is_null($getUser[0]->education) || empty($getUser[0]->education)) ? [] : json_decode($getUser[0]->education);
        if ($this->hasTitle($data['title'], $educations))
            $errors['title'][]= Controller::$language->invokeOutput('ed/already');
        if (!preg_match('/^[0-9]{4}\s*[,،]\s*[0-9]{4}$/u', trim($data['years'])))
            $errors['years'][]= Controller::$language->invokeOutput('ed/format');
        if (isset($data['website']) && mb_strlen($data['website'], 'UTF-8') == 0)
            unset($data['website']);
        if (!empty($errors))
            return $errors;
        //----> end seeking for errors
        $delimiter = mb_strpos($data['years'],',') ? ',' : '،';
        $data['years'] = explode($delimiter, preg_replace('/\s*/', '', $data['years']));
        array_push($educations, $data);
        $educations = json_encode($educations);
        //add the skill
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['education' => $educations]))? Controller::$language->invokeOutput('ed/done') : false;
    }

    /** delete an user
     * @param $id
     * @return bool
     */
    public function deleteUser($id)
    {
        Controller::$language->load('validation/user');
        //if the wanted user to delete is an admin
        if ($this->isExist($id) && $this->getUserById($id)[0]->role == 3) return false;
        return (parent::deleteData($this->_table, ['field'=> 'id', 'value' => $id])) ? Controller::$language->invokeOutput('delete') : false;
    }

    /** update the user data
     * @param $id
     * @param array $data
     * @return array|bool|mixed
     */
    public function updateUser($id, $data = array())
    {
        if (empty($data)) return false;
        Controller::$language->load('validation/join');
        $getUser = $this->getUserById($id);
        if (empty($getUser))
            return [Controller::$language->invokeOutput('wrong')];
        else $getUser = $getUser[0];
        //seek for errors
        //if updating complete name
        if (isset($data['fullName']))
        {
            //*merge all adjacent spaces
            $fullName = preg_replace('/[\s]+/u', ' ', trim($data['fullName']));
            //if the full name have a restricted words
            if (Validation::isRestrictEntry($fullName))
                return [Controller::$language->invokeOutput("fullName3")];
            //if there's only the first name ( one word is set )
            if (!preg_match('/\s/', $fullName))
                return [Controller::$language->invokeOutput("fullName1")];
            //if the full name contains non letters characters
            if (isset($fullName[1]) && !preg_match('/^([A-z\s\p{Arabic}])+$/u', $fullName))
                return [Controller::$language->invokeOutput("fullName2")];
            if ($fullName == $getUser->first_name . ' ' . $getUser->last_name)
                return [Controller::$language->invokeOutput("update/no-change")];
            $fullName = explode(' ', $data['fullName']);
            unset($data['fullName']);
            $data['first_name'] = $fullName[0];
            //if the first name is too short
            if (!isset($fullName[0][5]))
               return [Controller::$language->invokeOutput("fullName3")];
            //if there's a last name
            if (isset($fullName[1]))
            {
                $data['last_name'] = $fullName[1];
                //if the last name is too short
                if (!isset($data['last_name'][5]))
                    return [Controller::$language->invokeOutput("fullName4")];
            }
        }
        //if updating username
        if (isset($data['username']))
        {
            if ($this->issetUsernameRequest($getUser->id))
                return [Controller::$language->invokeOutput("username0")];
            if ($data['username'] == $getUser->username)
                return [Controller::$language->invokeOutput("update/no-change")];
            if ($this->isUsernameExist($data['username']))
                return [Controller::$language->invokeOutput("username1")];
            //if username has disallowed words
            if (Validation::isRestrictEntry($data['username']))
                return [Controller::$language->invokeOutput("username2")];
            //if username is short
            if (!isset($data['username'][5]))
                return [Controller::$language->invokeOutput("username3")];
            //add the use to change username request
            return ($this->usernameRequest(['user_id' => $getUser->id, 'old' => $getUser->username, 'new' => $data['username']])) ? Controller::$language->invokeOutput("update/usernameRequest") : false;
        }
        //if updating password
        if (isset($data['password']))
        {
            if ($this->matchPassword($getUser, $data['password']))
                return [Controller::$language->invokeOutput("update/no-change")];
            //if password is short
            if (!isset($data['password'][5]))
                return [Controller::$language->invokeOutput("password")];
            //if current passwords didn't match
            if (!isset($data['curr-password']) || !$this->matchPassword($getUser, $data['curr-password']))
                return [Controller::$language->invokeOutput("curr-wrong")];
            $data['password'] = Hash::generate($data['password'], $getUser->salt);
            unset($data['curr-password']);
        }
        //if updating email
        if (isset($data['email']))
        {
            if ($data['email'] == $getUser->email)
                return [Controller::$language->invokeOutput("update/no-change")];
            //if email not valid
            if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL))
                return [Controller::$language->invokeOutput("email1")];
            //if email exist
            if ($this->isEmailExist($data['email']))
                return [Controller::$language->invokeOutput("email2")];
        }
        //if updating profile_picture
        if (isset($data['profile_picture']))
        {
            //if picture the same
            if ($data['profile_picture'] == $getUser->profile_picture)
                return [ [Controller::$language->invokeOutput("update/no-change")] ];
            //check if picture is square
            list($width, $height) = @getimagesize($data['profile_picture']);
            if (!isset($width, $height))
                return [ [Controller::$language->invokeOutput("update/no-img")] ];
            if ($width != $height)
                return [ [Controller::$language->invokeOutput("update/size")] ];
            //update picture
            return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], $data))? Controller::$language->invokeOutput("update/done") : false;
        }
        //if updating Languages
        if (isset($data['languages']))
        {
            if (mb_strlen($data['languages'], 'UTF-8') > 0)
            {
                if (!preg_match('/^([A-z\s,،\p{Arabic}])+$/u', $data['languages']))
                    return [Controller::$language->invokeOutput("update/language1")];
                $data['languages'] = json_encode(explode(',', preg_replace('/[,،\s]+/u', ',', preg_replace(['/[,،\s]*$/u', '/^[,،\s]*/u'], '',$data['languages']))));
                if ($data['languages'] == $getUser->languages)
                    return [ [Controller::$language->invokeOutput("update/no-change")] ];
            }else{
                $data['languages'] = json_encode(['']);
            }
        }
        //if updating interests
        if (isset($data['interest']))
        {
            if (mb_strlen($data['interest'], 'UTF-8') > 0)
            {
                $data['languages'] = json_encode(explode(',', preg_replace('/[,\s]+/u', ',', preg_replace(['/[,\s]*$/u', '/^[,\s]*/u'], '',$data['interest']))));
                if ($data['interest'] == $getUser->interest)
                    return [ [Controller::$language->invokeOutput("update/no-change")] ];
            }else{
                $data['interest'] = json_encode(['']);
            }
        }
        //if updating quote
        if (isset($data['quote']))
        {
            if (mb_strlen($data['quote'], 'UTF-8') > 0)
            {
                if (!preg_match('/^[A-z0-9\s\-,\'"\p{Arabic}]+$/u', $data['quote']))
                    return [Controller::$language->invokeOutput("update/quote1")];
                $data['quote'] = explode('-', preg_replace('/[\-\s]*\-[\-\s]*/u', '-', preg_replace(['/([,\'\"،])+/', '/[,\'\"،](\0)*$/u','/[\s]+(\0)*/u'], '$1',$data['quote'])));
                if (count($data['quote']) != 2)
                    return [Controller::$language->invokeOutput("update/quote2")];
                $data['quote'] = json_encode($data['quote']);
                if ($data['quote'] == $getUser->quote)
                    return [ [Controller::$language->invokeOutput("update/no-change")] ];
            }else{
                $data['quote'] = json_encode(['']);
            }
        }
        //if updating education
        if (isset($data['skills']) || isset($data['education']))
            $data[key($data)] = json_encode($data[key($data)]);
        //if update social
        if (isset($data['social']))
        {

            $socs = [];
            foreach ($data['social'] as $k => $soc)
                $socs[$k] = preg_replace('/(http(s)?:\/\/)?([a-zA-Z0-9.]+)(\/)?/i', '', $soc, 1);
            $data['social'] = json_encode($socs);
        }
        //update the user
        return (parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], $data)) ? Controller::$language->invokeOutput("update/done") : ['error'];
    }

    /**
     * @param $id
     * @param array $data
     * @return array|bool|null|string
     */
    public function updatePreference($id, $data = array())
    {
        if (empty($data)) return false;
        Controller::$language->load('validation/join');
        $getUser = $this->getUserById($id);
        if (empty($getUser)) return [Controller::$language->invokeOutput('wrong')]; else $getUser = $getUser[0];
        $preferences = $this->getUserPreferences($id);
        if (empty($getUser)) return [Controller::$language->invokeOutput('wrong')]; else $preferences = $preferences[0];
        //seek for errors
        $key = key($data);
        if ($preferences->$key == $data[$key])
            return [ language::invokeOutput('update/no-change') ];
        if (isset($data['external']))
        {
            if (!in_array($data['external'], ['0', '1']))
                return [  language::invokeOutput('frequent/wrong')  ];
            $data['external'] = intval($data['external']);
        }
        if (isset($data['recovery']))
        {
            if ($this->isRecoveryExist($data['recovery']))
                return [  language::invokeOutput('update/rec-exist')  ];
        }
        //----->
        //update the user
        return (parent::updateData( $this->_table2, ['field' => 'user_id', 'value' => $id], $data)) ? Controller::$language->invokeOutput("update/done") : [ language::invokeOutput('frequent/wrong')  ];
    }

    /**
     * @param $data
     * @return string
     */
    public function login($data)
    {
        //get the language preferences
        Controller::$language->load('validation/login');
        //if the data array have the legal data set
        if (!isset($data['username'], $data['password']) or Validation::issetEmptyValue($data))
            return ['require' => [Controller::$language->invokeOutput("require")]];
        //if the user give an username
        if (!filter_var($data['username'], FILTER_VALIDATE_EMAIL))
        {
            //fetch the wanted username
            $getUser = $this->getUserByUserName($data['username'], "id, password, salt, status, active");
            //if no user match
            if (empty($getUser))
                //show no user error
                return ['username' => [Controller::$language->invokeOutput("identifier")]];
        }else{
            //fetch the wanted email
            $getUser = $this->getUserByEmail($data['username'], "id, password, salt, status");
            //if no user match
            if (empty($getUser))
                //show no user error
                return ['username' => [Controller::$language->invokeOutput("identifier")]];
        }
        //--- password matching
        //get the first and only record
        $getUser = $getUser[0];
        //if user login exceed the allowed attempts - 5 attempt in 5 minutes -
        if (!attemptAPI::getInstance()->checkAttempts($getUser->id))
            //prevent access and show blocking error
            return ['attempt' => [Controller::$language->invokeOutput("attempt")]];
        //test the matching
        $matchPassword = $this->matchPassword( $getUser, $data['password'] );
        //if passwords didn't matched
        if (!$matchPassword)
        {
            //create a new attempt
            attemptAPI::getInstance()->createAttempt($getUser->id);
            //count the attempts
            $countAttempt = attemptAPI::getInstance()->countAttempts($getUser->id);
            //show wrong password error
            return ['password' => [Controller::$language->invokeOutput("password")." ( " . Controller::$language->invokeOutput("attempt-word") . " {$countAttempt} )"]];
        }
        //check if the user not closed
        if ($getUser->status == 0)
            return ['general' => [Controller::$language->invokeOutput("status")]];
        //check if the user not deactivated
        if ($getUser->status == 2)
            return ['general' => [Controller::$language->invokeOutput("status2")]];
        //check if the user is active
        if ($getUser->active == 0)
            return ['general' => [Language::invokeOutput("active"). ' <a href="account/resend/'.$getUser->id.'" >'.Language::invokeOutput('resend').'</a>']];
        //clear this user login attempts while he logged successfully
        attemptAPI::getInstance()->clearAttempts($getUser->id);
        //set the logging session
        Session::set(LOGIN_SESSION_NAME, $getUser->id);
        //if remember me is active
        if (isset($data['remember']))
        {
            //check if user have an existent logging instance in the database
            $getHash = parent::selectData("hash", [ ['user_id', '=', $getUser->id] ],"sessions");
            //if no instance found create a new one
            if (empty($getHash))
            {
                //generate a unique hash
                $hash = Hash::unique();
                //insert the hash for the given user id
                parent::insertData("sessions", ['user_id', 'hash'], [$getUser->id, $hash]);
            }else{
                //if isset an instance return the Hash
                $hash = $getHash[0]->hash;
            }
            //set a remember me cookie with the fetched or created hash
            Cookie::set(REM_COOKIE_NAME, $hash, time()+60*60*24*365);
        }
        //if no error returned during the check return the succeed message
        return Controller::$language->invokeOutput("done");
    }

    /**
     * create a new logging session based on the visitor cookie hash
     */
    public static function createLoginSession()
    {
        //check if user have an existent logging instance in the database
        $getHash = Cookie::get(REM_COOKIE_NAME);
        $record = databaseAPI::getInstance()->selectData("*", [ ['hash', '=',$getHash] ], "sessions");
        if (empty($record))
            self::clearLoggedTrace();
        else
            Session::set(LOGIN_SESSION_NAME, $record[0]->user_id);
    }

    /** tell if the current guest is logged in
     * @return bool
     */
    public static function isLogged()
    {
        return (Session::exists(LOGIN_SESSION_NAME)) ? true : false ;
    }

    /** get the current logged user id
     * @return int | bool
     */
    public static function getLoggedId()
    {
        return Session::get(LOGIN_SESSION_NAME);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getUserRepliesCount($id)
    {
        return repliesAPI::getInstance()->getReplies("count(*) as c", [ ['author_id', '=', $id] ])[0]->c;
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getUserThreadsCount($id)
    {
        return threadsAPI::getInstance()->getThreads("count(*) as c", [ ['author_id', '=', $id] ])[0]->c;
    }

    /**
     * @param $id
     * @param $field
     * @return mixed
     */
    public function getUserRankByField($id, $field)
    {
        $sql = "SELECT
                    uo.username,
                    (SELECT
                            COUNT(*)
                        FROM
                            {$this->_table} AS ui
                        WHERE
                            ui.{$field} >= uo.{$field}) AS rank
                FROM
                    {$this->_table} AS uo
                WHERE
                    id = {$id}";
        return parent::executeQuery($sql)[0]->rank;
    }

    /**
     * @param $id
     * @param $table
     * @return int
     */
    public function getUserRankByTable($id, $table)
    {
        $sql = "SELECT DISTINCT
                    (SELECT
                            COUNT(*)
                        FROM
                            {$table}
                        WHERE
                            author_id = {$id}) AS cnt,
                    COUNT(*) AS c
                FROM
                    {$table} AS r
                GROUP BY r.author_id
                HAVING c >= cnt";
        $c = count(parent::executeQuery($sql));
        return ($c) ? $c : 1;
    }

    /**
     * @param $id
     * @return bool
     */
    public function getMainForum($id)
    {
        $sql = "SELECT
                  forums.title, forums.id, COUNT(*) as cnt
                FROM
                    forums
                        JOIN
                    threads ON threads.forum_id = forums.id AND threads.author_id = ?
                GROUP BY threads.forum_id
                LIMIT 1";
        return parent::executeQuery($sql, [$id]);
    }

    /**
     * clear logged users trace ( cookies , sessions and database record )
     */
    public static function clearLoggedTrace()
    {
        databaseAPI::getInstance()->deleteData("sessions",  ['field'=> 'user_id', 'value' => usersAPI::getLoggedId()]);
        Session::destroy(LOGIN_SESSION_NAME);
        Cookie::delete(REM_COOKIE_NAME);
    }

    /** return the formed format of the gender
     * @param $gender
     * @return string
     */
    public static function getGender($gender)
    {
        switch (intval($gender))
        {
            case 1 : return Language::invokeOutput('frequent/female');
                    break;
            case 2 : return Language::invokeOutput('frequent/male');
                    break;
            default : return Language::invokeOutput('frequent/unset');
                    break;
        }
    }

    /**
     * @param $birthday
     * @return int
     */
    public static function getAge($birthday)
    {
        return (isset($birthday)) ?  date_diff(date_create($birthday), date_create('today'))->y : 0;
    }

    /**
     * @param $join
     * @return float|int
     */
    public static function getDays($join)
    {
        if (!isset($join))
            return 0;
        return floor((time() - strtotime($join)) / (60*60*24));
    }

    /** increase or decrease the wanted users posts count
     * @param $id
     * @param bool|true $increase
     * @return mixed
     */
    public function updateUserPosts($id, $increase = true)
    {
        return ($increase) ?
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['posts' => ['posts + 1']]):
            parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['posts' => ['posts - 1']]);
    }

    /** add a xp amount to the user balance and level up if needed
     * @param $id
     * @param $xp
     * @return bool
     */
    public function addExperience($id, $xp)
    {
        //get the wanted user data
        $getUserXp = $this->getUserById($id, 'xp, level');
        //if no data return false
        if (empty($getUserXp)) return false ; else $getUserXp = $getUserXp[0];
        //if he is level 30 (max) return false
        if ($getUserXp->level == 30)
            return false;
        //add the experience
        $xp += $getUserXp->xp;
        //get the level boundary
        $getLevelMaxXp = variablesAPI::getInstance()->getVariableValue('levels', $getUserXp->level);
        //if the new experience exceed the boundary level up
        if ($xp >= intval($getLevelMaxXp))
        {
            if ($getUserXp->level < 29)
            {
                //get the new xp balance after level up
                $xp -= $getLevelMaxXp;
                //level up
                if (parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['level' => ['level + 1'], 'xp' => $xp]))
                {
                    //add a level up notification
                    notificationAPI::getInstance()->addNotification(['receiver' => $id, 'action' => 1, 'action_id' => ++$getUserXp->level]);
                    return true;
                }

            } else {
                //while the max is level 30 we have to make the xp back to zero
                return parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['level' => ['level + 1'], 'xp' => 0]);
            }
        }else{
            //add the xp without level up
            return parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['xp' => $xp]);
        }
    }

    /**
     * @param $id
     * @param $gold
     * @return bool|mixed
     */
    public function addGold($id, $gold)
    {
        //get the wanted user data
        $getUserGold = $this->getUserById($id, 'gold');
        //if no data return false
        if (empty($getUserGold)) return false ; else $getUserGold = $getUserGold[0]->gold;
            return parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['gold' => $getUserGold + $gold]);
    }

    /** increment the views of the current thread
     * @param $id
     * @return mixed
     */
    public function updateView($id)
    {
        $viewedProfiles = Session::get("profilesView");
        if (!$viewedProfiles || (is_array($viewedProfiles) && !in_array($id, $viewedProfiles) ) )
        {
            if (Session::setArray("profilesView", $id))
                return parent::updateData( $this->_table, ['field' => 'id', 'value' => $id], ['views' => ['views + 1']]);
        }
    }


    /**
     * @return array|bool|null|string
     */
    public function deactivateUser()
    {
        Controller::$language->load('validation/deactivate');
        $id = usersAPI::getLoggedId();
        $getUser = $this->getUserById($id);
        if (empty($getUser))
            return [ 'general' => [Language::invokeOutput('unf')] ];
        if (parent::updateData($this->_table, ['field' => 'id', 'value' => $id], ['status' => 2]))
        {
            self::clearLoggedTrace();
            return Language::invokeOutput('done');
        }
        return false;
    }
}