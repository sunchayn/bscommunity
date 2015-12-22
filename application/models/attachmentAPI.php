<?php
/**
 * bloodstone community V1.0.0
 * attachmentAPI Class !
 * an API to handle threads attachments system
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class attachmentAPI extends databaseAPI{
    /**
     * @var  string
     */
    private $_table = 'attachment';

    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new attachmentAPI(Controller::$db);
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
    public function getAttachments($rows = '*', $where = null)
    {
        return parent::selectData($rows, $where, $this->_table);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAttachmentById($id)
    {
        return parent::selectData("*", [ ['id', '=', $id] ], $this->_table);
    }

    /**
     * @param $thread
     * @param string $rows
     * @return bool|mixed
     */
    public function getThreadAttachments($thread, $rows = "*")
    {
        if (threadsAPI::getInstance()->isExist($thread))
            return parent::selectData($rows, [ ['thread_id', '=', $thread] ], $this->_table);
        else
            return false;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function addAttachment($data = array())
    {
        if (threadsAPI::getInstance()->isExist($data['thread_id']))
            return (parent::insertData($this->_table, array_keys($data), array_values($data))) ? true : false;
        else
            return false;
    }

    public function deleteAttachment($id)
    {
        return parent::deleteData($this->_table, ['field' => 'id', 'value' => $id]);
    }

    /**
     * @param $thread
     * @return string
     */
    public function getFilesReadyForDownload($thread)
    {
        Controller::$language->load('attachment');
        $attachs = $this->getThreadAttachments($thread);
        $links = "";
        foreach($attachs as $attach)
        {
            $path = $attach->path;
            if (file_exists(ROOT.'public/attachment/'.$path))
            {
                if (isset($path[35]))
                    $path = mb_substr($path, 0, 30, 'UTF-8').'[...]';
                $links .= "<div class='col-m col-12'><a href='".URL."attachment/{$attach->id}'>{$path}</a> - <small>{$attach->size}</small></div>";
            }else{
                $links .= "<div class='col-m col-12'><a href='error' class='disabled'>". Language::invokeOutput('file-not-found') ."</a> - <small>0b</small></div>";
            }
        }
        return $links;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteThreadAttachments($id)
    {
        $getAttach = $this->getThreadAttachments($id);
        if (empty($getAttach))
            return true;
        foreach($getAttach as $attch)
        {
            $this->deleteAttachment($attch->id);
            if (is_readable(ROOT.'public/attachment/'.$attch->path))
                unlink(ROOT.'public/attachment/'.$attch->path);
        }
    }

    public static function fetchAttachments($jsonFile)
    {
        $getFiles = json_decode(base64_decode($jsonFile));
        if (empty($getFiles))
            return false;

        $links = '';
        foreach ($getFiles as $file)
            $links .= "<div class='col-m col-12'>{$file->newName} - <small>{$file->size}</small></div>";

        return $links;
    }
}