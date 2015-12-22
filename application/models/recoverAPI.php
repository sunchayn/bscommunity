<?php
/**
 * bloodstone community V1.0.0
 * attachmentAPI Class !
 * an API to handle account recover system
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class recoverAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'recover';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new recoverAPI(Controller::$db);
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
     * @param $id
     * @return mixed
     */
    public function getRecoverRequest($id)
    {
        return parent::selectData('*', [ ['user_id', '=', $id] ], $this->_table);
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function addRecoverRequest($data = array())
    {
        Controller::$language->load('validation/recover');
        $getUser = usersAPI::getInstance()->getUserByEmail( $data['email'] );
        //if the id is wrong
        if(empty($getUser))
            return [ 'email' => [Language::invokeOutput('wrong-mail')] ];
        $getUser = $getUser[0];

        //if the user already sent a request
        if (!empty($this->getRecoverRequest($getUser->id)))
            //delete the older one(s)
            parent::deleteData($this->_table, ['field'=> 'user_id', 'value' => $getUser->id]);
        //set the target email
        if (isset($data['re-mail']))
        {
            //get the recovery email
            $getPref = usersAPI::getInstance()->getUserRecovery( $getUser->id );
            //sent a request to recovery email
            $recovery = false;
            if (!empty($getPref) && isset($getPref[0]->recovery))
            {
                $data['email'] = $getPref[0]->recovery;
                $recovery = true;
            }  
        }
        //prepare the data
        $data['hash'] = Hash::generate(time(),  Hash::salt(64));
        $data['username'] = $getUser->username;
        $data['id'] = $getUser->id;
        //if adding the data entry failed return error
        if ( !parent::insertData( $this->_table, ['user_id', 'hash'], [ $getUser->id, $data['hash'] ] ) )
            return [ 'general' => [Language::invokeOutput('frequent/wrong')] ];
        //prepare the mail wrapper
        $mail = new Mailer();
        //send
        if ( $mail->send(null, $data['email'], Language::invokeOutput('recoverHeading').' - '.Controller::$GLOBAL['site_name'], null,
                            ['path' => 'recover','plain' => 'recoverPlain', 'data' => $data], true))
        {
                //if the user didn't check the recovery mail option
                if (!isset($data['re-mail']))
                    return Language::invokeOutput('recoverDone');
                else
                    //return the right msg that tell if the mail sent to recovery or main e-mail
                    return ($recovery) ? Language::invokeOutput('recoverDone3') : Language::invokeOutput('recoverDone2');
        }
        //on fail
        return [ 'general' => [Language::invokeOutput('recoverFail')] ];
    }

    /**
     * @param $hash
     * @return array|bool|int|null|string
     */
    public function parseHash($hash)
    {
        Controller::$language->load('validation/recover');
        //check if the hash exists
        $getData = parent::selectData('*', [ ['hash', '=', $hash] ], $this->_table);
        //if the $hash didn't match
        if (empty($getData))
            return Language::invokeOutput('bad-hash');
        //does the link exceed 12 hours ?
        $hours = floor( (time() - strtotime($getData[0]->time)) / 3600 );
        if ($hours > 12)
            return language::invokeOutput('time-out');
        //otherwise every think is ok !
        return $getData[0];
    }

    /**
     * @param array $data
     * @return array|bool|null|string
     */
    public function resetPassword($data = array())
    {
        Controller::$language->load('validation/recover');
        //if something is missing
        if (!isset($data['password'], $data['hash'], $data['re-password']))
            return ['general' => [language::invokeOutput('missed')]];
        //get the hash check result
        $parse = $this->parseHash($data['hash']);
        //if something went wrong or the user change something
        if (!isset($data['hash']) && !is_object($parse))
            return ['general' => [language::invokeOutput('changed')]];
        //get user
        $getUser = usersAPI::getInstance()->getUserById($parse->user_id);
        if(empty($getUser))
            return ['general' => [language::invokeOutput('unf')]];
        $getUser = $getUser[0];
        //reset the password
        $reset = usersAPI::getInstance()->updatePassword(['id' => $getUser->id, 'password' => $data['password'], 're-password' => $data['re-password']]);
        //if the reset succeed => delete the reset request
        if (is_string($reset))
            parent::deleteData($this->_table, ['field'=> 'user_id', 'value' => $getUser->id]);

        return $reset;
    }
}