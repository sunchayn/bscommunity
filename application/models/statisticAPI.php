<?php
/**
 * bloodstone community V1.0.0
 * statisticAPI Class !
 * an API for generating statistic about the site
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class statisticAPI extends databaseAPI{
    /**
     * @var  string
     */

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new statisticAPI(Controller::$db);
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
     * @param string $table
     * @param null $where
     * @return mixed
     */
    public function getCategoriesCount($table = "categories", $where = null)
    {
        return parent::selectData("count(*) as cID", $where, $table)[0]->cID;
    }

    /**
     * @param string $table
     * @param null $where
     * @return mixed
     */
    public function getForumsCount($table = "forums", $where = null)
    {
        return parent::selectData("count(*) as cID", $where, $table)[0]->cID;
    }

    /**
     * @param string $table
     * @param null $where
     * @return mixed
     */
    public function getThreadsCount($table = "threads", $where = null)
    {
        return parent::selectData("count(*) as cID", $where, $table)[0]->cID;
    }

    /**
     * @param string $table
     * @param int $limit
     * @return bool
     */
    public function getHotThreads($table = "threads", $limit = 3)
    {
        $sql = "SELECT
                count(*) as Cnt,
                            {$table}.`id`,
                            {$table}.`title`
                FROM
                            replies,
                            {$table}
                WHERE
                replies.`thread_id` = threads.`id`
                AND
                DATEDIFF(CURDATE(), replies.`create`) < 10
                group by thread_id
                ORDER by Cnt DESC
                LIMIT {$limit}";
        return parent::executeQuery($sql);
    }

    /**
     * @param string $table
     * @param null $where
     * @return mixed
     */
    public function getUsersCount($table = "users", $where = null)
    {
        return parent::selectData("count(*) as cID", $where, $table)[0]->cID;
    }

    /**
     * @param string $table
     * @param null $where
     * @return mixed
     */
    public function getRepliesCount($table = "replies", $where = null)
    {
        return parent::selectData("count(*) as cID", $where, $table)[0]->cID;
    }


    /**
     * @param int $limit
     * @param string $table
     * @return mixed
     */
    public function getTopCountries($limit = 4, $table = 'users')
    {
        return parent::selectData("count(*) as c, country", ['country IS NOT NULL'], $table, 'GROUP by country ORDER BY c DESC', "LIMIT {$limit}");
    }

    /**
     * @param string $table
     * @param string $row
     * @return mixed
     */
    public function getLastJoinedUser($table = "users", $row = '*')
    {
        return parent::selectData($row, null, $table, 'ORDER BY id DESC', 'LIMIT 1')[0];
    }

    /**
     * @param $sexe
     * @param string $table
     * @return mixed
     */
    public function countGender($sexe, $table = 'users')
    {
        return parent::selectData("count(*) as cID", [ ['sexe', '=', $sexe] ], $table)[0]->cID;
    }

    /**
     * @param string $table
     * @param string $row
     * @return mixed
     */
    public function getFirstJoinedUser($table = "users", $row = '*')
    {
        return parent::selectData($row, ['id > 1'], $table, 'ORDER BY id ASC', 'LIMIT 1')[0];
    }

    /**
     * @param string $table
     * @param string $row
     * @return mixed
     */
    public function getMostActiveUser($table = 'users', $row = '*')
    {
        $sql = "SELECT
                    {$row}
                FROM
                    {$table}
                WHERE
                    posts = (SELECT
                            MAX(posts)
                        FROM
                            {$table}) limit 1";
        return parent::executeQuery($sql)[0];
    }

    /**
     * @param $table
     * @param $id
     * @param int $days
     * @return mixed
     */
    public function getRecentDataCount($table, $id, $days = 7)
    {
        $inject = "DATEDIFF(CURDATE(),{$table}.`create`) < ".$days;
        return parent::selectData('count(*) as c', [['author_id', '=', $id], $inject], $table, null)[0]->c;

    }

    /**
     * @param string $table
     * @return mixed
     */
    public function joinUsToday($table = "users")
    {
         return parent::selectData("count(*) as cID", [ ['DATE(`create_date`)', '=', 'CURDATE()'] ], $table, null, null, '');
    }


    /**
     * @param string $table
     * @param string $row
     * @return mixed
     */
    public function haveBirthday($table = "users", $row = "id, username, level, birthday")
    {
        return parent::selectData($row, [ 'DAY(`birthday`) = DAY(CURDATE())', 'MONTH(`birthday`) = MONTH(CURDATE())'], $table, null, null, '');
    }


    /**
     * @param array $ages
     * @return array
     */
    public function getUsersCountByAges($ages = [])
    {
        $data = [];
        foreach ($ages as $key => $age)
        {
            $data[] = [
                'label' => $key,
                'countF' => usersAPI::getInstance()->getUsers('count(*) as c', ["sexe = 1 and (year(curdate()) - year(birthday) between {$age[0]} and {$age[1]})"])[0]->c,
                'countM' => usersAPI::getInstance()->getUsers('count(*) as c', ["sexe = 2 and (year(curdate()) - year(birthday) between {$age[0]} and {$age[1]})"])[0]->c
            ];
        }
        return $data;
    }

    /**
     * @param int $limit
     * @param string $table
     * @return mixed
     */
    public function getTopCategories($limit = 3, $table = 'forums')
    {
        $join = 'LEFT JOIN categories on categories.id = forums.cat_id';
        return parent::selectData("categories.title, (sum(forums.threads) + sum(forums.replies)) as posts", null, [$table, $join], 'group by categories.id order by posts desc', "LIMIT {$limit}");
    }

    /**
     * @param $date
     * @return mixed
     */
    public function getActivityInDate($date)
    {
        $rep = 'SELECT count(*) as c FROM replies WHERE DATE(`create`) = \''.$date.'\'';
        $thr = 'SELECT count(*) as c FROM threads WHERE DATE(`create`) = \''.$date.'\'';
        return parent::executeQuery($rep)[0]->c + parent::executeQuery($thr)[0]->c;
    }
}