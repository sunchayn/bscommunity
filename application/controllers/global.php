<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class globalVariable extends Controller{

    /**
     *
     */
    public static function run()
    {
        $data = [];
        //fetch for settings
        $settings = settingsAPI::getInstance()->getSettings();
        //fetch for logged user
        if (usersAPI::isLogged())
        {
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId(), "id, username, profile_picture, status, role, level, xp, posts, gold");
            if (!empty($getUser))
            {
                $data['logged'] = $getUser[0];
                //fetch all unread messages
                $data['logged']->notifications = notificationAPI::getNotificationsArray($data['logged']->id);
                $data['logged']->inbox = inboxAPI::getInstance()->getFormedInbox($data['logged']->id);
                $data['notificationsCount'] = count( $data['logged']->notifications );
                $data['inboxCount'] = count($data['logged']->inbox);
                $data['logged']->experience = ($data['logged']->level == 30) ?
                    "max" :
                    $data['logged']->xp . ' / ' . variablesAPI::getInstance()->getVariableValue('levels', $data['logged']->level);
                $data['loggedID'] = $data['logged']->id;
            }else{
                // - !! - if no rows return it mean there's a logged non-existent user
                usersAPI::clearLoggedTrace();
            }
        }
        self::fillData($settings, $data);
        self::$GLOBAL = $data;
    }
}