<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class NewslettersCron {

    private static $amount = 50;
    private $language;
    private $currPart = 1;
    private $parts;
    private $sleep = 2;
    private $maxPriority = 1;
    public $data;
    public $msg = "newsletters have been sent";
    public $mail;

    /**
     *
     */
    public function __construct()
    {
        set_time_limit(0);
        ignore_user_abort();
        $this->language = new Language();
        $this->language->load('validation/subscribes');
        $this->mail = new Mailer();
        if (!$this->mail->isFine)
            $this->msg = ['error' => language::invokeOutput('frequent/wrong')];

        $this->gatherData();
        $p = $this->maxPriority;
        for ($p; $p > -1; $p--)
        {
            $this->getSubscribers($p, true);
            for ($x = 0; $x <= $this->parts; $x++)
            {
                $subs = $this->getSubscribers($p);
                //$this->send($subs);
                $this->currPart++;
                if ($this->currPart > $this->parts) break;
                sleep($this->sleep);
            }
            $this->currPart = 1;
        }
        if ($this->mail->isFine)
            $this->msg = ['msg' => $this->language->getArrayData()['sent']];
    }

    /**
     * @return bool
     */
    public function gatherData()
    {
        //get hot threads
        $getThreads = statisticAPI::getInstance()->getThreadsForSubscribers();
        if (empty($getThreads))
            return false;
        //fill the data
        foreach($getThreads as $thread)
        {
            $content = trim(strip_tags($thread->content));
            if (isset($content[70]))
                $content = mb_substr($content, 0, 50, 'UTF-8') . '...';
            $this->data[] = ['id'=> $thread->id, 'title' => $thread->title, 'content' => $content];
        }

        return true;
    }

    /**
     * @param null $priority
     * @param bool|false $init
     * @return bool|mixed
     */
    public function getSubscribers($priority = null, $init = false)
    {
        if (isset($priority))
        {
            $count = subscribesAPI::getInstance()->getSubscribersByPriority((int)$priority, "count(*) as c")[0]->c;
            $parts = (int)ceil($count / self::$amount);
            $this->parts = ($parts == 0) ?  1 : $parts;
            if ($init) return true;
            $start = ($this->currPart - 1) * self::$amount;
            return subscribesAPI::getInstance()->getSubscribersByPriority((int)$priority, "*", null, "LIMIT {$start} , " . self::$amount);
        } else {
            $count = subscribesAPI::getInstance()->getSubscribes(null, "count(*) as c")[0]->c;
            $parts = (int)ceil($count / self::$amount);
            $this->parts = ($parts == 0) ?  1 : $parts;
            if ($init) return true;
            $start = ($this->currPart - 1) * self::$amount;
            return subscribesAPI::getInstance()->getSubscribes(null, "*", null, "LIMIT {$start} , " . self::$amount);
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function send($data = array())
    {
        if (empty($this->data))
            return false;
        Controller::$language->load('emails');
        foreach ($data as $row)
           $this->mail->send(null, $row->email, Language::invokeOutput('mails/subscribes/title').' '.Controller::$GLOBAL['site_name'], null, ['path' => 'newsletter','plain' => 'newsletterPlain', 'data' => ['content' => $this->data, 'hash' => $row->hash]], true);
    }
}