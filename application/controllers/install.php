<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class install extends Controller
{

    public function __construct()
    {
        $this->openDatabaseConnection();
        self::$language = new Language();
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        error_reporting(0);
    }

    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->load('install/general');
        //set the view data array
        $data = [];
        //the title
        $data['title'] = self::$language->invokeOutput('title');
        //load this page view
        $this->loadView('install/_header', $data);
        $this->loadView('install/home', $data);
        $this->loadView('install/_footer', $data);
    }

    /**
     *
     */
    public function step1()
    {
        //prepare the language
        self::$language->load('install/general');
        //set the view data array
        $data = [];
        //the title
        $data['title'] = self::$language->invokeOutput('title');
        //load this page view
        $this->loadView('install/_header', $data);
        $this->loadView('install/step1', $data);
        $this->loadView('install/_footer', $data);
    }

    /**
     *
     */
    public function step2()
    {
        //prepare the language
        self::$language->load('install/general');
        //set the view data array
        $data = [];
        //the title
        $data['title'] = self::$language->invokeOutput('title');
        //load this page view
        $this->loadView('install/_header', $data);
        $this->loadView('install/step2', $data);
        $this->loadView('install/_footer', $data);
    }

    /**
     *
     */
    public function step3()
    {
        //prepare the language
        self::$language->load('install/general');
        //set the view data array
        $data = [];
        //the title
        $data['title'] = self::$language->invokeOutput('title');
        //load this page view
        $this->loadView('install/_header', $data);
        $this->loadView('install/step3', $data);
        $this->loadView('install/_footer', $data);
    }

    /**
     *
     */
    public function step4()
    {
        //prepare the language
        self::$language->load('install/general');
        //set the view data array
        $data = [];
        //the title
        $data['title'] = self::$language->invokeOutput('title');
        //load this page view
        $this->loadView('install/_header', $data);
        $this->loadView('install/step4', $data);
        $this->loadView('install/_footer', $data);
    }

    /**
     *
     */
    public function finish()
    {
        $base = realpath(__DIR__.'/../../').DIRECTORY_SEPARATOR;
        unlink($base.'public/js/install.js');
        unlink($base.'public/css/install.css');
        rrdir($base.'application/languages/en/install');
        rrdir($base.'application/languages/ar/install');
        rrdir($base.'application/views/install');
        unlink($base.'application/controllers/install.php');
        header('Location: ../home');
    }

    /**
     * ajax method for installing tables and basic data
     */
    public function tables()
    {
        //prepare the language
        self::$language->load('install/tables');
        $results = [];
        $fail = language::invokeOutput('fail');
        $succ = language::invokeOutput('succ');
        $already = language::invokeOutput('already');
        //creating table 1 ( access table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `access` LIMIT 1");
            $results['table1'] = $already;
            $truncate = 'TRUNCATE `access`;';
           databaseAPI::getInstance()->executeQuery($truncate, null, false);
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `access` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `name_ar` varchar(255) NOT NULL,
                  `name_en` varchar(255) DEFAULT NULL,
                  `access_json` varchar(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table1'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //inserting access basic data
        if (empty(accessAPI::getInstance()->getAccess()))
        {
            $sql = "INSERT INTO `access` VALUES (1,'عضو','user','[\"user\"]'),(2,'مشرف','moderator','[\"moderator\"]'),(3,'مدير','admin','[\"admin\"]');";
            $results['access-data'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? language::invokeOutput('dataInserted') : language::invokeOutput('notInserted');
        }
        //creating table 2 ( active_items table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `active_items` LIMIT 1");
            $results['table2'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `active_items` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `user_id` int(11) NOT NULL,
                      `item_id` int(11) NOT NULL,
                      `remain_use` int(11) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table2'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 3 ( attempts table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `attempts` LIMIT 1");
            $results['table3'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `attempts` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `user_id` int(11) DEFAULT NULL,
                      `time` datetime DEFAULT CURRENT_TIMESTAMP,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table3'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 4 ( categories table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `categories` LIMIT 1");
            $results['table4'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `categories` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `title` varchar(255) NOT NULL,
                      `desc` text NOT NULL,
                      `logo` varchar(255) DEFAULT NULL,
                      `status` int(1) NOT NULL DEFAULT '1',
                      `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `order` int(11) NOT NULL,
                      `visibility` int(1) NOT NULL DEFAULT '1',
                      `views` int(11) DEFAULT '0',
                      `threads` int(11) DEFAULT '0',
                      `replies` int(11) DEFAULT '0',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table4'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 5 ( filter_list table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `filter_list` LIMIT 1");
            $results['table5'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `filter_list` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `is_black` int(1) NOT NULL DEFAULT '1',
                      `url` varchar(255) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table5'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 6 ( follow table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `follow` LIMIT 1");
            $results['table6'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `follow` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `following_id` int(11) NOT NULL,
                      `follower_id` int(11) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table6'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 7 ( forums table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `forums` LIMIT 1");
            $results['table7'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `forums` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `cat_id` int(11) NOT NULL,
                      `title` varchar(255) NOT NULL,
                      `desc` text NOT NULL,
                      `logo` varchar(255) NOT NULL,
                      `views` int(11) NOT NULL DEFAULT '0',
                      `replies` int(11) NOT NULL DEFAULT '0',
                      `threads` int(11) NOT NULL DEFAULT '0',
                      `status` int(1) NOT NULL DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table7'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 8 ( inbox table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `inbox` LIMIT 1");
            $results['table8'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `inbox` (
                       `id` int(11) NOT NULL AUTO_INCREMENT,
                      `sub_inbox` int(11) DEFAULT '0',
                      `title` varchar(255) NOT NULL,
                      `content` mediumtext NOT NULL,
                      `receiver` int(11) NOT NULL,
                      `sender` int(11) NOT NULL,
                      `is_rec_read` int(1) NOT NULL DEFAULT '0',
                      `has_response` int(1) NOT NULL DEFAULT '0',
                      `is_rec_del` int(1) NOT NULL DEFAULT '0',
                      `is_sen_del` int(1) NOT NULL DEFAULT '0',
                      `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                      `last_response` timestamp NULL DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table8'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 9 ( inventory table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `inventory` LIMIT 1");
            $results['table9'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `inventory` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `user_id` int(11) DEFAULT NULL,
                      `item_id` int(11) DEFAULT NULL,
                      `amount` int(11) DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table9'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 10 ( items table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `items` LIMIT 1");
            $results['table10'] = $already;
            $truncate = 'TRUNCATE `items`;';
            databaseAPI::getInstance()->executeQuery($truncate, null, false);
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `items` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `item_cat` int(11) NOT NULL,
                      `item_action` varchar(255) NOT NULL,
                      `cost` int(11) NOT NULL,
                      `uses_number` int(11) DEFAULT '1',
                      `item_icon` varchar(255) DEFAULT 'qsd',
                      `title_ar` varchar(45) NOT NULL,
                      `title_en` varchar(45) NOT NULL,
                      `desc_ar` varchar(255) NOT NULL,
                      `desc_en` varchar(255) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table10'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //inserting items basic data
        if (empty(itemsAPI::getInstance()->getItems()))
        {
            $icon = URL.'public/img/bsc-icon.jpg';
            $sql = "INSERT INTO `items` VALUES (1,1,'[\"xp\",25]',25,1,'{$icon}','بطاقة خبرة 25','xp card 25','تمنحك 25 نقطة خبرة','give you a 25 point of experience'),(2,1,'[\"xp\",50]',50,1,'{$icon}','بطاقة خبرة 50','xp card 50','تمنحك 50 نقطة خبرة','give you a 50 point of experience'),(3,1,'[\"xp\",75]',75,1,'{$icon}','بطاقة خبرة 75','xp card 75','تمنحك 75 نقطة خبرة','give you a 75 point of experience'),(4,2,'',100,6,'{$icon}','صديق المواضيع','thread\'s firend','تمنحك 6 مواضيع إضافية اذا نجاوزت حدود المواضيع اليومية','give you an extra 6 threads to create if you exceed the limit of threads per day.'),(5,2,'',200,20,'{$icon}','زقزقات لطيفة','friendly tweet','تمنحك 20 رسالة إضافية لإرساله اذا تجاوزت الحد اليومي','give you an extra 20 message to send if you exceed the limit'),(6,2,'',400,40,'{$icon}','الطائر','the tweeter','تمنحك 40 رسالة إضافية لإرسالها اذا تجاوت الحد اليومي','give you an extra 40 message to send if you exceed the limit');";
            $results['store-data'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? language::invokeOutput('dataInserted') : language::invokeOutput('notInserted');
        }
        //creating table 11 ( notification table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `notification` LIMIT 1");
            $results['table11'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `notification` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `receiver` int(11) NOT NULL,
                      `action` int(2) NOT NULL,
                      `action_id` int(11) NOT NULL,
                      `seen` int(1) NOT NULL DEFAULT '0',
                      `stuck` int(11) DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table11'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 12 ( online table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `online` LIMIT 1");
            $results['table12'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `online` (
                      `ip` varchar(15) NOT NULL,
                      `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      PRIMARY KEY (`ip`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table12'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 13 ( replies table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `replies` LIMIT 1");
            $results['table13'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `replies` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `thread_id` int(11) NOT NULL,
                      `author_id` int(11) NOT NULL,
                      `content` text NOT NULL,
                      `rate` int(11) NOT NULL,
                      `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table13'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 14 ( reply_rate table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `reply_rate` LIMIT 1");
            $results['table14'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `reply_rate` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `reply_id` int(11) NOT NULL,
                      `user_id` int(11) NOT NULL,
                      `value` tinyint(1) NOT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table14'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 15 ( report table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `report` LIMIT 1");
            $results['table15'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `report` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `type` int(11) NOT NULL,
                      `content` varchar(255) NOT NULL,
                      `reported` int(11) NOT NULL,
                      `reporter` int(11) NOT NULL,
                      `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `seen` int(1) DEFAULT '0',
                      `global_seen` int(1) DEFAULT '0',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table15'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 16 ( rules table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `rules` LIMIT 1");
            $results['table16'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `rules` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `forum_id` int(11) NOT NULL,
                      `title_ar` varchar(45) NOT NULL,
                      `description_ar` tinytext NOT NULL,
                      `title_en` varchar(45) DEFAULT NULL,
                      `description_en` tinytext,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table16'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 17 ( sessions table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `sessions` LIMIT 1");
            $results['table17'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `sessions` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `user_id` int(11) DEFAULT NULL,
                      `hash` varchar(255) DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table17'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 18 ( settings table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `settings` LIMIT 1");
            $results['table18'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `settings` (
                      `id` int(1) NOT NULL DEFAULT '1',
                      `site_name` varchar(255) NOT NULL,
                      `site_desc` text NOT NULL,
                      `site_keywords` text NOT NULL,
                      `webmaster_email` varchar(255) NOT NULL,
                      `logo_url` varchar(255) NOT NULL,
                      `favicon_url` varchar(255) NOT NULL,
                      `is_close` int(1) NOT NULL '0',
                      `close_msg` text NOT NULL,
                      `social` varchar(255) DEFAULT NULL,
                      `site_tag` varchar(255) NOT NULL,
                      `external` int(1) DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table18'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 19 ( support table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `support` LIMIT 1");
            $results['table19'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `support` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `sender` int(11) DEFAULT NULL,
                      `title` varchar(255) DEFAULT NULL,
                      `content` tinytext,
                      `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                      `seen` int(1) DEFAULT '0',
                      `status` int(1) DEFAULT '0',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table19'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 20 ( thanks table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `thanks` LIMIT 1");
            $results['table20'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `thanks` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `thread_id` int(11) DEFAULT NULL,
                      `author_id` int(11) DEFAULT NULL,
                      `thank_user` int(11) DEFAULT NULL,
                      `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table20'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 21 ( threads table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `threads` LIMIT 1");
            $results['table21'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `threads` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `forum_id` int(11) NOT NULL,
                      `title` varchar(255) NOT NULL,
                      `content` longtext NOT NULL,
                      `author_id` int(11) NOT NULL,
                      `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `views` int(11) NOT NULL DEFAULT '0',
                      `replies` int(11) NOT NULL DEFAULT '0',
                      `status` int(11) NOT NULL DEFAULT '1',
                      `rate` int(11) DEFAULT NULL,
                      `last_reply` timestamp NULL DEFAULT NULL,
                      `keywords` varchar(255) DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table21'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 22 ( username_change table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `username_change` LIMIT 1");
            $results['table22'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `username_change` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `user_id` int(11) DEFAULT NULL,
                      `old` varchar(45) DEFAULT NULL,
                      `new` varchar(45) DEFAULT NULL,
                      `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                      `status` int(1) DEFAULT '0',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table22'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 23 ( users table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `users` LIMIT 1");
            $results['table23'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `users` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `username` varchar(255) NOT NULL,
                      `password` varchar(255) NOT NULL,
                      `salt` varchar(255) NOT NULL,
                      `email` varchar(255) NOT NULL,
                      `role` int(11) NOT NULL DEFAULT '1',
                      `first_name` varchar(45) DEFAULT NULL,
                      `last_name` varchar(45) DEFAULT NULL,
                      `sexe` int(2) NOT NULL DEFAULT '0',
                      `country` varchar(120) DEFAULT NULL,
                      `birthday` date DEFAULT NULL,
                      `social` varchar(255) DEFAULT NULL,
                      `education` TEXT,
                      `skills` TEXT,
                      `interest` varchar(255) DEFAULT '[]',
                      `about` tinytext,
                      `quote` varchar(255) DEFAULT '[]',
                      `languages` varchar(255) DEFAULT '[]',
                      `profile_picture` varchar(255) DEFAULT NULL,
                      `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                      `posts` int(11) DEFAULT '0',
                      `level` int(2) DEFAULT '1',
                      `xp` int(11) DEFAULT '0',
                      `gold` int(11) DEFAULT '0',
                      `views` int(11) DEFAULT '0',
                      `status` int(11) NOT NULL DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table23'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 24 ( users_pref table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `users_pref` LIMIT 1");
            $results['table24'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `users_pref` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `user_id` int(11) NOT NULL,
                      `recovery` varchar(125) DEFAULT NULL,
                      `external` int(1) DEFAULT '1',
                      `bd_visibility` int(1) DEFAULT '1',
                      `is_follow` int(11) DEFAULT '1',
                      `profile_visibility` int(1) DEFAULT '1',
                      `messages` int(1) DEFAULT '1',
                      `notify_pinned` int(1) DEFAULT '1',
                      `notify_replies` int(1) DEFAULT '1',
                      `notify_thanks` int(1) DEFAULT '1',
                      `notify_follow` int(1) DEFAULT '1',
                      `notify_achievement` int(1) DEFAULT '1',
                      `notify_threads` int(1) DEFAULT '1',
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table24'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //creating table 25 ( variables table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `variables` LIMIT 1");
            $results['table25'] = $already;
            $truncate = 'TRUNCATE `variables`;';
            databaseAPI::getInstance()->executeQuery($truncate, null, false);
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `variables` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `group` varchar(45) DEFAULT NULL,
                      `name` varchar(45) DEFAULT NULL,
                      `value` varchar(45) DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table25'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //inserting variables basic data
        if (empty(variablesAPI::getInstance()->getVariables()))
        {
            $sql = "INSERT INTO `variables` VALUES (1,'levels','1','90'),(2,'levels','2','98'),(3,'levels','3','105'),(4,'levels','4','113'),(5,'levels','5','448'),(6,'levels','6','476'),(7,'limit','threads','6'),(8,'limit','messages','40'),(9,'limit','replyPP','8'),(10,'limit','threadPP','10'),(11,'limit','msgPP','12'),(12,'levels','7','504'),(13,'levels','8','532'),(14,'levels','9','560'),(15,'levels','10','1050'),(16,'levels','11','1100'),(17,'levels','12','1150'),(18,'levels','13','1200'),(19,'levels','14','1250'),(20,'levels','15','1300'),(21,'levels','16','1350'),(22,'levels','17','1400'),(23,'levels','18','1450'),(24,'levels','19','1500'),(25,'levels','20','2131'),(26,'levels','21','2200'),(27,'levels','22','2269'),(28,'levels','23','2338'),(29,'levels','24','2406'),(30,'levels','25','2475'),(31,'levels','26','2544'),(32,'levels','27','2613'),(33,'levels','28','2681'),(34,'levels','29','2750');";
            $results['variables-data'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? language::invokeOutput('dataInserted') : language::invokeOutput('notInserted');
        }
        //creating table 26 ( visits table )
        try {
            databaseAPI::getInstance()->executeQuery("SELECT 1 FROM `visits` LIMIT 1");
            $results['table26'] = $already;
        } catch (Exception $e){
            // We got an exception == table not found
            $sql = "CREATE TABLE `visits` (
                      `id` int(11) NOT NULL AUTO_INCREMENT,
                      `ip` varchar(15) DEFAULT NULL,
                      `country` varchar(45) DEFAULT NULL,
                      `device` varchar(45) DEFAULT NULL,
                      `browser` varchar(45) DEFAULT NULL,
                      PRIMARY KEY (`id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
            $results['table26'] = databaseAPI::getInstance()->executeQuery($sql, null, false) ? $succ : $fail;
        }
        //print the json object
        echo json_encode($results);
    }

    /**
     * ajax method for creating website general settings
     */
    public function settings()
    {
        $set = settingsAPI::getInstance()->createSettings($_POST);
        if (is_string($set) )
        {
            echo json_encode(["done" => $set]);
        }
        else
        {
            if (is_array($set))
                echo json_encode($set);
            else
                echo json_encode(["displayError" => self::$language->invokeOutput('frequent/wrong')]);
        }
    }

    /**
     * ajax method for creating admin account
     */
    public function admin()
    {
        Controller::$language->load('install/admin');
        if (!empty(usersAPI::getInstance()->getUserById(1)))
        {
            echo json_encode(['already' => Controller::$language->invokeOutput('already')]);
        }else{
            $set = usersAPI::getInstance()->createUser(array_merge($_POST, ['role' => 3]), 'adminCreate');
            if (is_string($set) )
            {
                echo json_encode(["done" => $set]);
            }
            else
            {
                if (is_array($set))
                    echo json_encode($set);
                else
                    echo json_encode(["displayError" => self::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }
}
