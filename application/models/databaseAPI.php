<?php
/**
 * bloodstone community V1.0.0
 * databaseAPI Class !
 * an API for the database
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class databaseAPI{
    /**
     * $_database:
     * hold the database connection.
     * $_charset:
     * hold the database charset
     */
    private static $_instance;
    private $_connection,
            $_charset = DB_CHARSET,
            $_function = ['CURDATE()', 'DAY(CURDATE())', 'MONTH(CURDATE())'];
    /**
     * @param $db
     */
    public function setDataBase($db)
    {
        $this->_connection = $db;
        $this->setCharset();
    }

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new databaseAPI(Controller::$db);
        }
        return self::$_instance;
    }
    /**
     * define the database variable when call this class
     * @param $db
     */
    function __construct($db){
        $this->_connection = $db;
        $this->setCharset();
    }

    /**
     * @param $sql
     * @param array $data
     * @param int $fetchMode
     * @return bool
     */
    public function executeQuery($sql, $data = [], $fetch = true,$fetchMode = PDO::FETCH_OBJ)
    {
        $query = Controller::$db->prepare($sql);
        //echo $sql.'<br />';
        //var_dump($data);
        $execute = $query->execute($data);
        if (!$fetch)
            return $execute;
        else
        {
            if ($execute)
                return $query->fetchALL($fetchMode);
            else
                return false;
        }
    }

    /**
     * @param $rows
     * @param null $where
     * @param $table
     * @param string $order
     * @param null $limit
     * @param string $quotes
     * @param int $fetchMode
     * @return mixed
     */
    public function selectData($rows, $where = null, $table, $order = 'ORDER BY id DESC', $limit = null, $quotes = '`',$fetchMode = PDO::FETCH_OBJ)
    {
        //set the basic query
        $sql = "SELECT {$rows} FROM ";
        //if the table is an array => there's a join tables data
        $sql .= is_array($table) ? implode(' ', $table) : $table;
        $bindData = [];
        //add the where clause if exist
        if ( isset($where[0]) )
        {
            //add ' where ' to the query
            $sql .= " WHERE ";
            //add all the values of the where array structured like this ( array( fieldName, operator, value) )
            foreach ($where as $value)
            {
                if (is_array($value))
                {
                    $bindString = '?';
                    if (in_array($value[2], $this->_function))
                        $bindString = $value[2];
                    else
                        $bindData[] = $value[2];
                    $sql .= "{$quotes}{$value[0]}{$quotes} {$value[1]} {$bindString} AND ";
                }else{
                    $sql .= $value . " AND ";
                }
            }
            //remove the last ' AND '
            $sql = rtrim($sql, ' AND ');
        }
        //add the order and limit clauses
        $sql .=" {$order} $limit";
        //prepare the statement
        $query = Controller::$db->prepare($sql);
        //execute the statement
        $query->execute($bindData);
        //echo $sql . '<br />';
        //var_dump($bindData);
        //return the fetched results
        return $query->fetchAll($fetchMode);
    }

    /**
     * @param $table
     * @param array $fields
     * @param array $values
     * @param int $fetchMode
     * @return bool
     */
    public function insertData($table,  $fields = array(), $values = array(), $fetchMode = PDO::FETCH_OBJ)
    {
        $fields = '`'. implode('`,`', $fields) .'`';
        //set the basic query
        $sql = "INSERT into {$table} ({$fields}) VALUES ";
        $bindString = "";
        if (empty ($values)) return false;
        for ($i = 0; $i < count($values); $i++)
        {
            $bindString .= "?, ";
        }
        $bindString = rtrim($bindString, ', ');
        $sql .= "({$bindString})";
         //prepare the statement
        $query = Controller::$db->prepare($sql);
        //echo $sql . '<br />';
        //var_dump($values);
        //execute the statement and return the result
        return $query->execute($values);
    }

    /**
     * @param $table
     * @param array $data
     * @return mixed
     */
    public function deleteData($table, $data = array())
    {
        $sql = 'DELETE FROM '. $table .' WHERE ';
        $c = count($data);
        if ($c == 1)
        {
            $sql .= ' '.$data[0];
            $bind = null;
        }
        elseif ($c != 3)
        {
            $sql .= "`{$data['field']}` = ?";
            $bind = [$data['value']];
        }
        else
        {
            $sql .= "`{$data[0]}` {$data[1]} ?";
            $bind = [$data[2]];
        }
        $query = Controller::$db->prepare($sql);
        //echo $sql . '<br />';
        //echo $data['value'] . '<br />';
        return $query->execute($bind);
    }

    /**
     * @param $table
     * @param array $match
     * @param array $data
     * @return mixed
     */
    public function updateData($table, $match = array(), $data = array())
    {
        $sql = "UPDATE {$table} SET";
        $bindData = [];
        foreach($data as $key => $value)
        {
            if (!is_array($value))
            {
                $bindData[] = $value;
                $sql .= " `$key` = ?, ";
            }else{
                $sql .= " `$key` = $value[0], ";
            }
        }

        $sql = rtrim($sql, ', ');
        //$sql .= " WHERE `{$match['field']}` = ?";
        if (is_array($match['field']))
        {
            $sql .= ' WHERE ';
            foreach ($match['field'] as $k => $field)
            {
                $sql .= "`{$field}` = ? AND";
                $bindData[] = $match['value'][$k];
            }

            $sql = rtrim($sql, ' AND');
        }else{
            $sql .= " WHERE `{$match['field']}` = ?";
            $bindData[] = $match['value'];
        }
        $query = Controller::$db->prepare($sql);
        //$bindData[] = $match['value'];
        //echo $sql . '<br />';
        //var_dump($bindData);
        return $query->execute($bindData);
    }
    /**
     * @return mixed
     */
    public function setCharset(){
        return Controller::$db->exec("SET NAMES '{$this->_charset}'");
    }

}