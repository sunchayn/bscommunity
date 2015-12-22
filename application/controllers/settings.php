<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class settings extends Controller
{
    /**
     *
     */
    public function index()
    {
        if (usersAPI::isLogged()){
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId());
            if (!empty($getUser)) {
                //prepare the language
                self::$language->load('settings');
                //get the first record
                $getUser = $getUser[0];
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['general'] = "id='checked-setting'";
                $data['user'] = $getUser;
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('settings/index', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        } else {
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function logging()
    {
        if (usersAPI::isLogged()){
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId());
            if (!empty($getUser)) {
                //prepare the language
                self::$language->load('settings');
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['logging'] = "id='checked-setting'";
                $data['user'] = $getUser;
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('settings/logging', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        } else {
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function about()
    {
        if (usersAPI::isLogged()){
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId());
            if (!empty($getUser)) {
                //prepare the language
                self::$language->load('settings');
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['about'] = "id='checked-setting'";
                $data['education'] = json_decode($getUser->education);
                $data['skills'] = json_decode($getUser->skills);
                $data['interests'] = implode(', ', json_decode($getUser->interest));
                if (empty($data['interests'])) $data['interests'] = 'unset';
                $data['quote'] = json_decode($getUser->quote);
                $data['languages'] = implode(', ', json_decode($getUser->languages));
                if (empty($data['languages'])) $data['languages'] = 'unset';
                $data['user'] = $getUser;
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('settings/about', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        } else {
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function security()
    {
        if (usersAPI::isLogged()){
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId());
            if (!empty($getUser)) {
                //prepare the language
                self::$language->load('settings');
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['security'] = "id='checked-setting'";
                $data['user'] = $getUser;
                $data['preferences'] = usersAPI::getInstance()->getUserPreferences($id);
                if (!empty($data['preferences']))
                    $data['preferences'] = $data['preferences'][0];
                if (isset_get($data['preferences'], 'external') == 1)
                    $data['setExternal'] = "checked = 'checked'";
                else
                    $data['unsetExternal'] = "checked = 'checked'";
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('settings/security', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        } else {
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function privacy()
    {
        if (usersAPI::isLogged()){
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId());
            if (!empty($getUser)) {
                //prepare the language
                self::$language->load('settings');
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['privacy'] = "id='checked-setting'";
                $data['user'] = $getUser;
                $data['preferences'] = usersAPI::getInstance()->getUserPreferences($id);
                if (!empty($data['preferences']))
                    $data['preferences'] = $data['preferences'][0];
                if (isset_get($data['preferences'], 'bd_visibility') == 1)
                    $data['bd_visible'] = "checked = 'checked'";
                else
                    $data['bd_invisible'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'is_follow') == 1)
                    $data['canFollow'] = "checked = 'checked'";
                else
                    $data['cantFollow'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'profile_visibility') == 1)
                    $data['profileVisible'] = "checked = 'checked'";
                else
                    $data['profileInvisible'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'messages') == 1)
                    $data['allowedMsg'] = "checked = 'checked'";
                else
                    $data['disallowedMsg'] = "checked = 'checked'";
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('settings/privacy', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        } else {
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function notifications()
    {
        if (usersAPI::isLogged()){
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId());
            if (!empty($getUser)) {
                //prepare the language
                self::$language->load('settings');
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['notifications'] = "id='checked-setting'";
                $data['user'] = $getUser;
                $data['preferences'] = usersAPI::getInstance()->getUserPreferences($id);
                if (!empty($data['preferences']))
                    $data['preferences'] = $data['preferences'][0];

                if (isset_get($data['preferences'], 'notify_threads') == 1)
                    $data['threadEnabled'] = "checked = 'checked'";
                else
                    $data['threadDisabled'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'notify_pinned') == 1)
                    $data['pinEnabled'] = "checked = 'checked'";
                else
                    $data['pinDisabled'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'notify_replies') == 1)
                    $data['replyEnabled'] = "checked = 'checked'";
                else
                    $data['replyDisabled'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'notify_thanks') == 1)
                    $data['thanksEnabled'] = "checked = 'checked'";
                else
                    $data['thanksDisabled'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'notify_follow') == 1)
                    $data['followEnabled'] = "checked = 'checked'";
                else
                    $data['followDisabled'] = "checked = 'checked'";

                if (isset_get($data['preferences'], 'notify_achievement') == 1)
                    $data['achievementEnabled'] = "checked = 'checked'";
                else
                    $data['achievementDisabled'] = "checked = 'checked'";
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('settings/notifications', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        } else {
            //if no params is passed
            header('Location: ../error');
        }
    }

    /**
     *
     */
    public function follow()
    {
        if (usersAPI::isLogged()){
            $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId());
            if (!empty($getUser)) {
                //prepare the language
                self::$language->load('settings');
                //get the first record
                $getUser = $getUser[0];
                $id = $getUser->id;
                //set the view data array
                $data = [];
                $data['page-title'] = $getUser->username;
                $data['title'] = $getUser->username;
                $data['selected']['follow'] = "id='checked-setting'";
                $data['user'] = $getUser;
                $data['followers'] = followAPI::getInstance()->loadFollowers()->_data;
                $data['following'] = followAPI::getInstance()->loadFollowings()->_data;
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('settings/follow', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                //if the ID not found => show 404 error
                header('Location: ../error');
            }
        } else {
            //if no params is passed
            header('Location: ../error');
        }
    }
}