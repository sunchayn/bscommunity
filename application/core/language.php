<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
 
class Language {

    /**
    * Variable holds array of language
    * @var array
    */
    private $array = array(),
            $general = array();

    public function __construct($load = true)
    {
        if ($load)
            $this->loadGeneralLanguage();
    }

    /**
     * load the general language preference in order to merge it later with the wanted language
     */
    public function loadGeneralLanguage()
    {
        $file = APP."languages/" . LANGUAGE_CODE ."/general.php";
        if (is_readable($file)) {
            // require file
            $this->array = include ($file);
        } else {
            // display error
            die ( "Could not load language file '" . LANGUAGE_CODE . "/general.php" );
        }
        //if there's an user logged get the languages preferences that concern members
        if (usersAPI::isLogged())
        {
            $file = APP."languages/" . LANGUAGE_CODE ."/loggedUsers.php";
            if (is_readable($file)) {
                // require file and add it to the $general property
                $this->array = array_merge(include ($file), $this->array);
            } else {
                // display error
                die ( "Could not load language file '" . LANGUAGE_CODE . "/loggedUsers.php" );
            }
        }
    }

    /** load a specific language page
     * @param $pageName
     * @param string $lang
     */
    public function load($pageName, $lang = LANGUAGE_CODE)
    {
        // get the lang file
        $file = APP."languages/{$lang}/{$pageName}.php";
        // check if is readable
        if (is_readable($file)) {
            // require file
            $this->array = array_merge( include ($file), $this->array);
        } else {
            // display error
            die( "Could not load language file '{$lang}/{$pageName}.php'");
        }
    }

    /**
     * @param $pageName
     * @param string $lang
     */
    public function loadAnotherData($pageName, $lang = LANGUAGE_CODE)
    {
        // get the lang file
        $file = APP."languages/{$lang}/{$pageName}.php";
        // check if is readable
        if (is_readable($file)) {
            // require file
            $this->array = array_merge( include ($file), $this->array);
        } else {
            // display error
            die( "Could not load language file '{$lang}/{$pageName}.php'");
        }
    }

    /** get the array that hold the language preferences
     * @return array
     */
    public function getArrayData()
    {
        return $this->array;
    }

    /** walk through language array to get the wanted text the path look like - key1/../$keyX and will return $keyX text
     * @param string $path
     * @param bool $dataSource
     * @return array|bool|null|string
     */
    public static function invokeOutput($path = "", $dataSource = false)
    {
        //get the language preferences holder
        if (!$dataSource) $dataSource = Controller::$language->getArrayData();
        //the array that hold the keys that will walk through
        $arrayLvls = explode('/', $path);
        //get the last path's element value
        foreach($arrayLvls as $key => $lvl)
            $dataSource = isset($dataSource[$lvl]) ? $dataSource[$lvl] : 'undefined';
        // if there's an output return it or return error
        return ( !empty($dataSource) ) ? $dataSource : "undefined index";
    }

    public function loadSingleLang($pageName, $path = 'language/',$lang = LANGUAGE_CODE)
    {
        // get the lang file
        $file = $path.$lang.'/'.$pageName.'.php';
        // check if is readable
        if (is_readable($file)) {
            // require file
            return include ($file);
        } else {
            // display error
            //die( "Could not load language file '{$lang}/{$pageName}.php'");
            die( "Could not load language file '{$lang}/{$pageName}.php'");
        }
    }
}
