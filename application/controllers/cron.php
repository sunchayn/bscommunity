<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class cron extends Controller
{

    public function __construct()
    {
        //if the request not from the current host exit.
        if (!isset($_SERVER['REMOTE_ADDR']) || $_SERVER['SERVER_ADDR'] != $_SERVER['REMOTE_ADDR'])
            exit();
    }

    /**
     *
     */
    public function newsletter()
    {
        $x = new NewslettersCron();
    }
}
