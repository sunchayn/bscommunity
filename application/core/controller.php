<?php

class Controller {
    static $db;
    static $GLOBAL;
    static $language;


    /**
     * @param bool|true $newToken
     * @param bool|false $close
     */
    function __construct($newToken = true, $close = false)
    {
        $this->openDatabaseConnection();
        //rebuild the session of user
        if (Cookie::exists(REM_COOKIE_NAME) && !Session::exists(LOGIN_SESSION_NAME))
            usersAPI::createLoginSession();
        require_once'../application/controllers/global.php';
        self::$language = new Language();
        globalVariable::run();
        if (self::$GLOBAL['is_close'] && !accessAPI::is_admin() && !$close)
        {
            self::$language->load('close');
            $data = [];
            $data['title'] = self::$language->invokeOutput('title');
            $this->loadView('close', $data);
            exit();
        }
        //set the token
        if ($newToken)
        {
            self::$GLOBAL['token'] = Token::generate();
            onlineAPI::getInstance()->updateOnline();
            visitsAPI::getInstance()->setVisitor();
        }
    }
    /**
     *
     */
    function openDatabaseConnection()
    {
        try	{
            $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
            // generate a database connection, using the PDO connector
           self::$db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
        }catch(PDOException $e){
            die ($e->getMessage());
        }
    }

    /**
     * @param $object
     * @param array $data
     */
    public static function fillData($object, &$data = array())
    {
        foreach ($object as $record)
        {
            foreach($record as $key => $value)
            {
                $data[$key] = $value;
            }
        }
    }

    public static function fillDataByReference($object, &$data = array(), $reference = array())
    {
        foreach ($object as $record)
        {
            foreach($reference as $key => $value)
            {
                $data[$key] = $value;
            }
        }
    }

    /**
     * Loads the wanted "model".
     * @param $model
     * @return object models
     */
    public function loadModel($model, $returnInstance = false)
    {
        require_once '../application/models/'. $model .'.php';
        // create new "model" (and pass the database connection)
       if ($returnInstance) return new $model(self::$db);
    }

    /**
     * Loads the wanted "view".
     * @param $view
     * @param $data
     */
    public function loadView($view, $data = [])
    {
        $global = self::$GLOBAL;
        require_once  '../application/views/'. $view .'.php';
    }
}