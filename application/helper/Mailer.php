<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Mailer{

    public $mailer;
    public $isFine;
    //default view path
    private $viewPath;

    /**
     * @throws Exception
     * @throws null
     * @throws phpmailerException
     */
    function __construct()
    {
        $this->mailer = new PHPMailer();

        //debug
        //$this->mailer->SMTPDebug = 2;
        //$this->mailer->Debugoutput = 'html';
        //--

        $this->mailer->isSMTP();
        $this->mailer->isHTML();
        $this->mailer->Host = SMTP_HOST;
        $this->mailer->Port = SMTP_PORT;
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = SMTP_USER;
        $this->mailer->Password = SMTP_PASS;
        $this->mailer->CharSet = 'UTF-8';

        //return the result of initialisation
        $this->isFine = $this->mailer->smtpConnect();

        //set the view path
        $this->viewPath = ROOT.'application/views/mails/';
    }

    /**
     * @param $from
     * @param $to
     * @param $subject
     * @param $body
     * @param array $view
     * @param bool|false $noReply
     * @return bool
     * @throws Exception
     * @throws phpmailerException
     */
    public function send($from, $to, $subject, $body, $view = array(), $noReply = false)
    {
        $this->to($to);
        $this->replyTo($from, $noReply);
        $this->from($from);
        $this->subject($subject);
        $this->body($body, $view);
        //send
        return $this->mailer->send();
    }

    /**
     * @param $to
     */
    public function to($to)
    {
        if (!is_array($to))
            $this->mailer->addAddress($to);
        else
        {
            foreach($to as $adr)
                $this->mailer->AddAddress($adr->mail);
        }
    }

    /**
     * @param $from
     * @throws phpmailerException
     */
    public function from($from)
    {
        $mail = (is_null($from)) ? Controller::$GLOBAL['webmaster_email'] : $from;
        $this->mailer->setFrom($mail, Controller::$GLOBAL['site_name'].' webmaster');
    }

    /**
     * @param $replyTo
     * @param bool|false $noReply
     */
    public function replyTo($replyTo, $noReply = false)
    {
        if ($noReply)
            $this->mailer->addReplyTo(SMTP_NO_REPLY, Controller::$GLOBAL['site_name'].' webmaster');
        else
        {
            $mail = (is_null($replyTo)) ? Controller::$GLOBAL['webmaster_email'] : $replyTo;
            $this->mailer->addReplyTo($mail, Controller::$GLOBAL['site_name'].' webmaster');
        }
    }

    /**
     * @param $subject
     */
    public function subject($subject)
    {
        $this->mailer->Subject = $subject;
    }

    /**
     * @param $body
     * @param array $view
     */
    public function body($body, $view = array())
    {
        if (!isset($body) && empty($view))
            $this->mailer->smtpClose();
        else {
            if (empty($view))
                $this->mailer->Body = $body;
            else
                $this->mailer->Body = $this->renderView($view);
            //make a version for mail clients that do not have HTML email capability
            if (isset($view['plain']))
                $this->mailer->AltBody = $this->renderView($view, true);
            else
                $this->mailer->AltBody = $this->mailer->html2text($this->mailer->Body);
        }
    }

    /**
     * @param array $view
     * @param boolean $plain
     * @return string
     */
    public function renderView($view = array(), $plain = false)
    {
        $target = (!$plain) ? $view['path'] : $view['plain'];
        ob_start();
            Controller::$language->load('emails');
            $data = $view['data'];
            if (is_readable($this->viewPath.$target .'.php'))
                require_once  $this->viewPath.$target .'.php';
            else
                $this->mailer->smtpClose();
            $render = ob_get_clean();
        @ob_end_clean();
        return $render;
    }

}