<?php
/**
 * bloodstone community V1.0.0
 * visitorAPI Class !
 * an API that handle visitors information
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class visitsAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'visits',
            $_sess = 'BSCSV';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new visitsAPI(Controller::$db);
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

    public function getVisitorCount()
    {
        return parent::selectData('count(*) as c', null, $this->_table, null)[0]->c;
    }

    public function androidTablet($ua){
        //Find out if it is a tablet
        if(strstr(strtolower($ua), 'android') ){//Search for android in user-agent
            if(!strstr(strtolower($ua), 'mobile'))//If there is no ''mobile' in user-agent (Android have that on their phones, but not tablets)
                    return true;
        }
    }
    public function userAgent($ua){
        //Search for 'mobile' in user-agent (iPhone have that)
        $iphone = strstr(strtolower($ua), 'mobile');
        //Search for 'android' in user-agent
        $android = strstr(strtolower($ua), 'android');
        //Search for 'phone' in user-agent (Windows Phone uses that)
        $windowsPhone = strstr(strtolower($ua), 'phone');
        //Do androidTablet function
        $androidTablet = $this->androidTablet($ua);
        //Search for iPad in user-agent
        $iPad = strstr(strtolower($ua), 'ipad');
        //Search for iPad in user-agent
        $kindle = strstr(strtolower($ua), 'kindle');
        //If it's a tablet (iPad / Android / Kindly)
        if($androidTablet || $iPad || $kindle)
            return 'tablet';
        //If it's a phone and NOT a tablet
        elseif($iphone || $android || $windowsPhone)
            return 'mobile';
        else//If it's not a mobile device
            return 'desktop';
    }

    public function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'other';
        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
            $bname = 'Internet Explorer';
        elseif(preg_match('/Firefox/i',$u_agent))
            $bname = 'Mozilla Firefox';
        elseif(preg_match('/Chrome/i',$u_agent))
            $bname = 'Google Chrome';
        return $bname;
    }

    public function setVisitor()
    {
        if (!Session::get($this->_sess))
        {
            $device = $this->userAgent($_SERVER['HTTP_USER_AGENT']);
            $ip = $_SERVER['REMOTE_ADDR'];
            $country = json_decode(@file_get_contents('http://ipinfo.io/'. $ip .'/json'));
            $country = (isset($country->country)) ? $country->country : 'unknown';
            if(parent::insertData($this->_table, ['ip', 'device', 'browser', 'country'],[$ip, $device, $this->getBrowser(), $country]))
                Session::set($this->_sess, true);
        }
    }

    public function getBrowsers()
    {
        return parent::selectData('count(*) as c, browser', null, $this->_table, 'GROUP BY browser ORDER BY c DESC');
    }

    public function getTopCountry()
    {
        return parent::selectData('count(*) as c, country', null, $this->_table, 'GROUP BY country ORDER BY c DESC', 'LIMIT 4');

    }
}