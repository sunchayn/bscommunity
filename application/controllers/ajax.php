<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class ajax extends Controller
{

    public function __construct()
    {
        parent::__construct(false, true);
        if ($this->checkAttempts())
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/waitAjax'), "displayError" => Controller::$language->invokeOutput('frequent/waitAjax')]);
            exit();
        }
    }

    /** check if the user dosen't spam ajax requests
     * @return bool
     */
    public function checkAttempts()
    {
        $counter = 0;
        $attempts = Session::get(AJAX);
        $attempts = ($attempts === false) ? [] : $attempts;
        if ($attempts === false)
            Session::set(AJAX, []);
        else
            $this->setAttempt();
        foreach ($attempts as $key => $attempt)
        {
            if (time() - intval($attempt) <= 10)
                $counter++;
            else
                Session::destroyArray(AJAX, $key);
        }
        return $counter >= 5;
    }

    /** set a new attempt
     * @return mixed
     */
    public function setAttempt()
    {
        return Session::setArray(AJAX, time());
    }

    /**
     * thank a user for his thread
     */
    public function addThank()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['error' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $addThank = thanksAPI::getInstance()->addThank($_POST);
            //var_dump($addThank);
            if (is_string($addThank) )
            {
                echo json_encode(["done" => $addThank]);
            }else{
                echo json_encode(["error" => $addThank[0]]);
            }
        }
    }

    /**
     * add a new reply
     */
    public function createReply()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $addReply = repliesAPI::getInstance()->createReply($_POST);
            if (is_string($addReply) )
            {
                Token::destroyToken();
                if (isset_get($_GET, 'redirect') === 'true')
                    echo json_encode(["done" => $addReply, 'redirect' => 'thread/'.$_POST['thread_id']]);
                else
                    echo json_encode(["done" => $addReply, 'reload' => true]);
            }else{
                if (is_array($addReply))
                    echo json_encode($addReply);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }
    /**
     * create a new thread
     */
    public function createThread()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $addThread = threadsAPI::getInstance()->createThread($_POST);
            if (is_string($addThread))
            {
                Token::destroyToken();
                echo json_encode(["done" => $addThread, 'redirect' => 'forum/'.$_POST['forum_id']]);
            }else{
                if (is_array($addThread))
                    echo json_encode($addThread);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * update a thread
     */
    public function updateThread()
    {
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updateThread = threadsAPI::getInstance()->updateThread($_POST);
            if (is_string($updateThread) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $updateThread, "redirect" => 'thread/'.$_POST['id']]);
            }else{
                if (is_array($updateThread))
                    echo json_encode($updateThread);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * update a reply
     */
    public function updateReply()
    {
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $updateReply = repliesAPI::getInstance()->updateReply($_POST);
            if (is_string($updateReply) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $updateReply, "redirect" => 'thread/'.$_POST['thread_id']]);
            }else{
                if (is_array($updateReply))
                    echo json_encode($updateReply);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * crate an user
     */
    public function join()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $addUser = usersAPI::getInstance()->createUser($_POST);
            if (is_string($addUser))
            {
                Token::destroyToken();
                echo json_encode(["done" => $addUser, "redirect" => 'home']);
            }else{
                echo json_encode($addUser);
            }
        }
    }

    /**
     * login to the website
     */
    public function login()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $login = usersAPI::getInstance()->login($_POST);
            if (is_string($login) )
            {
                Token::destroyToken();
                echo json_encode(['done' => $login, 'reload' => true]);
            }else{
                echo json_encode($login);
            }
        }
    }

    /**
     *delete a reply
     */
    public function deleteReply()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['error' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $deleteReply = repliesAPI::getInstance()->deleteReply($_POST['id']);
            if (is_string($deleteReply) )
                echo json_encode(["done" => $deleteReply]);
            else
                echo  json_encode(["error" => $deleteReply[0]]);
        }
    }

    /**
     * give a positive rate to a reply
     */
    public function rateUpReply()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['error' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $rateReply = repliesAPI::getInstance()->rateReply($_POST['id']);
            if (is_string($rateReply) )
                echo json_encode(["done" => $rateReply]);
            else
            {
                if (is_array($rateReply))
                    echo json_encode(["error" => $rateReply[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * give a negative rate to a reply
     */
    public function rateDownReply()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['error' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $rateReply = repliesAPI::getInstance()->rateReply($_POST['id'], false);
            if (is_string($rateReply) )
                echo json_encode(["done" => $rateReply]);
            else
            {
                if (is_array($rateReply))
                    echo json_encode(["error" => $rateReply[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * get the confirm message to be shown when the user about to delete something
     */
    public function getConfirmMsg()
    {
        Controller::$language->load('confirm');
        switch ($_POST['type'])
        {
            case 'reply' :
                echo language::invokeOutput('reply');
                break;
            case 'EdTitle' :
                echo language::invokeOutput('EdTitle');
                break;
            case 'skill' :
                echo language::invokeOutput('skill');
                break;
            case 'deleteMessages' :
                echo language::invokeOutput('deleteMessages');
                break;
            case 'buyItem' :
                echo language::invokeOutput('buyItem');
                break;
            case 'consumeItem' :
                echo language::invokeOutput('consumeItem');
                break;
            case 'deleteCategory' :
                echo language::invokeOutput('deleteCategory');
                break;
            case 'deleteForum' :
                echo language::invokeOutput('deleteForum');
                break;
            case 'deleteUser' :
                echo language::invokeOutput('deleteUser');
                break;
            case 'deleteRole' :
                echo language::invokeOutput('deleteRole');
                break;
            case 'deleteTickets' :
                echo language::invokeOutput('deleteTickets');
                break;
            case 'approveDecline' :
                echo language::invokeOutput('approveDecline');
                break;
            case 'deleteRule' :
                echo language::invokeOutput('deleteRule');
                break;
        }
    }

    /**
     * update one user field
     */
    public function updateUser()
    {
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['error' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updateUser = usersAPI::getInstance()->updateUser(usersAPI::getLoggedId(), $_POST);
            //var_dump($addThank);
            if (is_string($updateUser) )
            {
                //Token::destroyToken();
                echo json_encode(["done" => $updateUser]);
            }
            else
            {
                if (is_array($updateUser))
                    echo json_encode(["error" => $updateUser[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * update one user preference
     */
    public function updatePref()
    {
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['error' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updatePref = usersAPI::getInstance()->updatePreference(usersAPI::getLoggedId(), $_POST);
            if (is_string($updatePref) )
            {
                //Token::destroyToken();
                echo json_encode(["done" => $updatePref]);
            }
            else
            {
                if (is_array($updatePref))
                    echo json_encode(["error" => $updatePref[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * update user profile picture
     */
    public function updateUserPicture()
    {
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $update = usersAPI::getInstance()->updateUser(usersAPI::getLoggedId() ,$_POST);
            if (is_string($update) )
                echo json_encode(["done" => $update, "reload" => true]);
            else
            {
                if (is_array($update))
                    echo json_encode(["error" => $update[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete education title
     */
    public function deleteEdTitle()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $id = usersAPI::getLoggedId();
            $getEducation = usersAPI::getInstance()->getUserById($id, 'education');
            if (empty($getEducation))
                echo json_encode(["error" => '']);
            $getEducation = json_decode($getEducation[0]->education);
            unset($getEducation[intval($_POST['key'])], $_POST['key'], $_POST['token']);
            $deleteTitle = usersAPI::getInstance()->updateUser($id, ['education' => $getEducation]);
            if (is_string($deleteTitle) )
                echo json_encode(["done" => $deleteTitle]);
            else
            {
                if (is_array($deleteTitle))
                    echo json_encode(["error" => $deleteTitle[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * add education title
     */
    public function addTitle()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $add = usersAPI::getInstance()->addTitle(usersAPI::getLoggedId() ,$_POST);
            if (is_string($add) )
                echo json_encode(["done" => $add, "reload" => true]);
            else
            {
                if (is_array($add))
                    echo json_encode($add);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * add user skill
     */
    public function addSkill()
    {
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $add = usersAPI::getInstance()->addSkill(usersAPI::getLoggedId() ,$_POST);
            if (is_string($add) )
                echo json_encode(["done" => $add, "reload" => true]);
            else
            {
                if (is_array($add))
                    echo json_encode($add);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete user skill
     */
    public function deleteSkill()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $id = usersAPI::getLoggedId();
            $getSkills = usersAPI::getInstance()->getUserById($id, 'skills');
            if (empty($getSkills))
                echo json_encode(["error" => '']);
            $getSkills = json_decode($getSkills[0]->skills);
            unset($getSkills[intval($_POST['key'])], $_POST['key'], $_POST['token']);
            $deleteSkill = usersAPI::getInstance()->updateUser($id, ['skills' => $getSkills]);
            if (is_string($deleteSkill) )
                echo json_encode(["done" => $deleteSkill]);
            else
            {
                if (is_array($deleteSkill))
                    echo json_encode(["error" => $deleteSkill[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * response to a message
     */
    public function responseMessage()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $addResponse = inboxAPI::getInstance()->responseMessage($_POST);
            if (is_string($addResponse) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $addResponse, 'reload' => true]);
            }else{
                if (is_array($addResponse))
                    echo json_encode($addResponse);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete a message
     */
    public function deleteMessages()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $id = self::$GLOBAL['logged']->id;
            $errors = 0;
            Controller::$language->load('validation/inbox');
            foreach ($_POST['select'] as $msg)
            {
                $getMsg = inboxAPI::getInstance()->getMessageById($msg, 'sender')[0];
                $isSender = ($getMsg->sender == $id);
                $deleteMessage = inboxAPI::getInstance()->deleteInbox($msg, $isSender);
                if ($deleteMessage !== true)
                    $errors++;
            }

            if ($errors == 0)
            {
                Token::destroyToken();
                echo json_encode(["done" => Controller::$language->invokeOutput('delete')]);
            }else{
                if ($errors < count($_POST['select']))
                    echo json_encode(["error" => Controller::$language->invokeOutput('not-all')]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * get username by id
     */
    public function getUser()
    {
        $getUser = usersAPI::getInstance()->getUserById($_POST['id'], 'id, username');
        if (!empty($getUser))
        {
            echo json_encode(['done' => $getUser[0]->username]);
        }else{
            echo json_encode(['error' => Controller::$language->invokeOutput('user-nfound')]);
        }
    }

    /**
     * send a message
     */
    public function sendMessage()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $sendMessage = inboxAPI::getInstance()->sendMessage($_POST);
            if (is_string($sendMessage) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $sendMessage, 'redirect' => 'inbox?section=sent']);
            }else{
                if (is_array($sendMessage))
                    echo json_encode($sendMessage);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * buy an item from the store
     */
    public function buyItem()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $buyItem = itemsAPI::getInstance()->buyItem($_POST['id']);
            if (is_string($buyItem) )
                echo json_encode(["done" => $buyItem]);
            else
            {
                if (is_array($buyItem))
                    echo json_encode(["error" => $buyItem[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * consume an item from inventory
     */
    public function consumeItem()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $consumeItem = inventoryAPI::getInstance()->consumeItem($_POST['id']);
            if (is_string($consumeItem) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $consumeItem]);
            }
            else
            {
                if (is_array($consumeItem))
                    echo json_encode(["error" => $consumeItem[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * make all notifications as read
     */
    public function seeNotifications()
    {
        notificationAPI::getInstance()->seeNotifications();
        echo json_encode(['done' => true]);
    }

    /**
     * update website general settings
     */
    public function updateSettings()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updateSettings = settingsAPI::getInstance()->updateSettings($_POST);
            if (is_string($updateSettings) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $updateSettings, 'reload' => true]);
            }
            else
            {
                if (is_array($updateSettings))
                    echo json_encode(["error" => $updateSettings[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * update a global variable
     */
    public function updateVariables()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updateVariables = variablesAPI::getInstance()->updateVariable($_POST);
            if (is_string($updateVariables) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $updateVariables, 'reload' => true]);
            }
            else
            {
                if (is_array($updateVariables))
                    echo json_encode(["error" => $updateVariables[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * add a category
     */
    public function addCategory()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $createCategory = categoryAPI::getInstance()->createCategory($_POST);
            if (is_string($createCategory) )
            {
                Token::destroyToken();
                    echo json_encode(["done" => $createCategory, "redirect" => 'admin_cp/categories']);
            }else{
                if (is_array($createCategory))
                    echo json_encode($createCategory);
                else
                    echo json_encode(["displayError" => self::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * close a category
     */
    public function closeCategory()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $close = categoryAPI::getInstance()->closeCategory($_POST['id']);
            if (is_string($close) )
                echo json_encode(["done" => $close]);
            else
            {
                if (is_array($close))
                    echo json_encode(["error" => $close[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * open a category
     */
    public function openCategory()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $close = categoryAPI::getInstance()->openCategory($_POST['id']);
            if (is_string($close) )
                echo json_encode(["done" => $close]);
            else
            {
                if (is_array($close))
                    echo json_encode(["error" => $close[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete a category
     */
    public function deleteCategory()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $close = categoryAPI::getInstance()->deleteCategory($_POST['id']);
            if (is_string($close) )
                echo json_encode(["done" => $close]);
            else
            {
                if (is_array($close))
                    echo json_encode(["error" => $close[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * get category by id
     */
    public function getCategory()
    {
        $getCat = categoryAPI::getInstance()->getCategoryByID($_POST['id']);
        if (!empty($getCat))
            echo json_encode(['done' => $getCat[0]]);
        else
            echo json_encode(['error' => Controller::$language->invokeOutput('frequent/wrong')]);
    }

    /**
     * update a category
     */
    public function updateCategory()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updateCategory = categoryAPI::getInstance()->updateCategory($_POST);
            if (is_string($updateCategory) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $updateCategory, 'reload' => true]);
            }
            else
            {
                if (is_array($updateCategory))
                    echo json_encode($updateCategory);
                else
                    echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * create a forum
     */
    public function addForum()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $createForum = forumsAPI::getInstance()->createForum($_POST);
            if (is_string($createForum) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $createForum, 'reload' => true]);
            }else{
                if (is_array($createForum))
                    echo json_encode($createForum);
                else
                    echo json_encode(["displayError" => self::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * update a froum
     */
    public function updateForum()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updateForum = forumsAPI::getInstance()->updateForum($_POST);
            if (is_string($updateForum) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $updateForum, 'reload' => true]);
            }
            else
            {
                if (is_array($updateForum))
                    echo json_encode($updateForum);
                else
                    echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * get a forum in order to update
     */
    public function getForum()
    {
        $getForum = forumsAPI::getInstance()->getForumByID($_POST['id']);
        if (!empty($getForum))
            echo json_encode(['done' => $getForum[0]]);
        else
            echo json_encode(['error' => Controller::$language->invokeOutput('frequent/wrong')]);
    }

    /**
     * close a forum
     */
    public function closeForum()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $close = forumsAPI::getInstance()->closeForum($_POST['id']);
            if (is_string($close) )
                echo json_encode(["done" => $close]);
            else
            {
                if (is_array($close))
                    echo json_encode(["error" => $close[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * open a forum
     */
    public function openForum()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $close = forumsAPI::getInstance()->openForum($_POST['id']);
            if (is_string($close) )
                echo json_encode(["done" => $close]);
            else
            {
                if (is_array($close))
                    echo json_encode(["error" => $close[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete a forum
     */
    public function deleteForum()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $delete = forumsAPI::getInstance()->deleteForum($_POST['id']);
            if (is_string($delete) )
                echo json_encode(["done" => $delete]);
            else
            {
                if (is_array($delete))
                    echo json_encode(["error" => $delete[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * close an user
     */
    public function closeUser()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $close = usersAPI::getInstance()->closeUser($_POST['id']);
            if (is_string($close))
                echo json_encode(["done" => $close]);
            else
            {
                if (is_array($close))
                    echo json_encode(["error" => $close[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * open an user
     */
    public function openUser()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $open = usersAPI::getInstance()->openUser($_POST['id']);
            if (is_string($open) )
                echo json_encode(["done" => $open]);
            else
            {
                if (is_array($open))
                    echo json_encode(["error" => $open[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete an user
     */
    public function deleteUser()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $delete = usersAPI::getInstance()->deleteUser($_POST['id']);
            if (is_string($delete) )
                echo json_encode(["done" => $delete]);
            else
            {
                if (is_array($delete))
                    echo json_encode(["error" => $delete[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * add a new role
     */
    public function addRole()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $createRole = accessAPI::getInstance()->addRole($_POST);
            if (is_string($createRole) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $createRole, 'reload' => true]);
            }else{
                if (is_array($createRole))
                    echo json_encode($createRole);
                else
                    echo json_encode(["displayError" => self::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete a role
     */
    public function deleteRole()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $delete = accessAPI::getInstance()->deleteRole($_POST['id']);
            if (is_string($delete) )
                echo json_encode(["done" => $delete]);
            else
            {
                if (is_array($delete))
                    echo json_encode(["error" => $delete[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * get a role in order to update it
     */
    public function getRole()
    {
        $getRole = accessAPI::getInstance()->getRoleById($_POST['id']);
        if (!empty($getRole))
            echo json_encode(['done' => $getRole[0]]);
        else
            echo json_encode(['error' => Controller::$language->invokeOutput('frequent/wrong')]);
    }

    /**
     * update a role
     */
    public function editRole()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $updateRole = accessAPI::getInstance()->updateRole($_POST);
            if (is_string($updateRole) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $updateRole, 'reload' => true]);
            }
            else
            {
                if (is_array($updateRole))
                    echo json_encode($updateRole);
                else
                    echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * follow an user
     */
    public function followUser()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $follow = followAPI::getInstance()->follow($_POST);
            if (is_string($follow) )
                echo json_encode(["done" => $follow]);
            else
            {
                if (is_array($follow))
                    echo json_encode(["error" => $follow[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * unfollow an user
     */
    public function unfollowUser()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $unfollow = followAPI::getInstance()->unfollow($_POST);
            if (is_string($unfollow) )
                echo json_encode(["done" => $unfollow]);
            else
            {
                if (is_array($unfollow))
                    echo json_encode(["error" => $unfollow[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }


    /**
     * report a post
     */
    public function report()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $report = reportAPI::getInstance()->addReport($_POST);
            if (is_string($report) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $report, 'reload' => true]);
            }else{
                if (is_array($report))
                    echo json_encode($report);
                else
                    echo json_encode(["displayError" => self::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * send a message
     */
    public function sendSupport()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $sendSupport = supportAPI::getInstance()->sendTicket($_POST);
            if (is_string($sendSupport) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $sendSupport, 'redirect' => 'home']);
            }else{
                if (is_array($sendSupport))
                    echo json_encode($sendSupport);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * delete ticket(s)
     */
    public function deleteTickets()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            if (!isset ($_POST['select']) )
                die(json_encode(['nothing' => true]));
            $errors = 0;
            foreach ($_POST['select'] as $ticket)
            {
                if (!supportAPI::getInstance()->deleteTicket($ticket))
                    $errors++;
            }
            if ($errors == 0)
            {
                echo json_encode(["done" => 'done']);
            }else{
                echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * response a support ticket
     */
    public function responseTicket()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $addResponse = supportAPI::getInstance()->responseTicket($_POST);
            if (is_string($addResponse) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $addResponse, 'reload' => true]);
            }else{
                if (is_array($addResponse))
                    echo json_encode($addResponse);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * approve or decline a username change request
     */
    public function approveDecline()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $approveDecline = usersAPI::getInstance()->handleUsernameRequest($_POST);
            if (is_string($approveDecline) )
                echo json_encode(["done" => $approveDecline]);
            else
            {
                if (is_array($approveDecline))
                    echo json_encode(["error" => $approveDecline[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * add a rule
     */
    public function addRule()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $addRule = forumsAPI::getInstance()->addRule($_POST);
            if (is_string($addRule) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $addRule, 'reload' => true]);
            }else{
                if (is_array($addRule))
                    echo json_encode($addRule);
                else
                    echo json_encode(['displayError' => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * get a given rule data
     */
    public function getRule()
    {
        $getRule = forumsAPI::getInstance()->getRuleById($_POST['id']);
        if (!empty($getRule))
            echo json_encode(['done' => $getRule[0]]);
        else
            echo json_encode(['error' => Controller::$language->invokeOutput('frequent/wrong')]);
    }

    /**
     * delete a forum rule
     */
    public function deleteRule()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => Controller::$language->invokeOutput('frequent/badRequest')]);
        }else{
            $delete = forumsAPI::getInstance()->deleteRule($_POST['id']);
            if (is_string($delete) )
                echo json_encode(["done" => $delete]);
            else
            {
                if (is_array($delete))
                    echo json_encode(["error" => $delete[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * update a forum rule
     */
    public function editRule()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $update = forumsAPI::getInstance()->updateRule($_POST);
            if (is_string($update) )
            {
                Token::destroyToken();
                echo json_encode(["done" => $update, 'reload' => true]);
            }
            else
            {
                if (is_array($update))
                    echo json_encode($update);
                else
                    echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * provide data for charts
     */
    public function getAdminCharts()
    {
        $data = [];
        #set browsers data
        $data['browsers'] = visitsAPI::getInstance()->getBrowsers();
        #last activities
        $data['activities'] = [];
        for ($x = 0; $x <= 6; $x++)
        {
            $date = date('Y-m-d', strtotime('-'.$x.' days'));
            $data['activities'][] = [date("d M", strtotime($date)), statisticAPI::getInstance()->getActivityInDate($date)];
        }
        //return the data
        echo json_encode($data);
    }

    /**
     * get a given user current role
     */
    public function getUserRole()
    {
        $getRole = usersAPI::getInstance()->getUserRole($_POST['id']);
        if (!empty($getRole))
            echo json_encode(['done' => true, 'id' => $_POST['id'], 'role' => $getRole[0]->id]);
        else
            echo json_encode(['error' => Controller::$language->invokeOutput('frequent/wrong')]);
    }

    /**
     * change an user role
     */
    public function changeRole()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["displayError" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $change = usersAPI::getInstance()->changeRole($_POST);
            if (is_string($change) )
                echo json_encode(["done" => $change, 'reload' => true]);
            else
            {
                if (is_array($change))
                    echo json_encode(["displayError" => $change[0]]);
                else
                    echo json_encode(["displayError" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * pin a thread
     */
    public function pinThread()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $pin = threadsAPI::getInstance()->pinUnpin($_POST['id']);
            if (is_string($pin) )
                echo json_encode(["done" => $pin]);
            else
            {
                if (is_array($pin))
                    echo json_encode(["error" => $pin[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     * unpin a thread
     */
    public function unpinThread()
    {
        //prevent CSRF
        if (!isset($_POST['token']) || !Token::check($_POST['token'], false))
        {
            echo json_encode(["error" => self::$language->invokeOutput('frequent/badRequest')]);
        }else{
            unset($_POST['token']);
            $unpin = threadsAPI::getInstance()->pinUnpin($_POST['id'], false);
            if (is_string($unpin) )
                echo json_encode(["done" => $unpin]);
            else
            {
                if (is_array($unpin))
                    echo json_encode(["error" => $unpin[0]]);
                else
                    echo json_encode(["error" => Controller::$language->invokeOutput('frequent/wrong')]);
            }
        }
    }

    /**
     *
     */
    public function loadFollowers()
    {
        Controller::$language->load('follow');
        $get = followAPI::getInstance()->loadFollowers($_POST);
        $get = $get->_data;
        if (empty($get))
        {
            echo '<div class="col-m col-12 follower-model no-more color-5">'.language::invokeOutput('no-more-data').'</div>';
        }else{
            echo '<div class="temp hidden-item">';
            foreach($get as $follower)
            {
                echo "
                <div class='col-m col-12 v-middle follower-model'>
                <div class='v-col'>
                    <img src='{$follower->profile_picture}' alt='user-pic' class='hide-sm x-50'>
                </div>
                <div class='v-col padding-h'>
                    <h3><a href='{follower->uID}'>{$follower->username}</a></h3>
                    <small>".language::invokeOutput('frequent / level')." {$follower->level}</small>
                </div>
            </div>";
            }
            echo '</div>';
        }
    }

    /**
     *
     */
    public function loadFollowings()
    {
        Controller::$language->load('follow');
        $get = followAPI::getInstance()->loadFollowings($_POST);
        $get = $get->_data;
        if (empty($get))
        {
            echo '<div class="col-m col-12 no-more follower-model color-5">'.language::invokeOutput('no-more-data').'</div>';
        }else{
            echo '<div class="temp hidden-item">';
            foreach($get as $following)
            {
                echo "
                <div class='col-m col-12 v-middle follower-model'>
                <div class='v-col'>
                    <img src='{$following->profile_picture}' alt='user-pic' class='hide-sm x-50'>
                </div>
                <div class='v-col padding-h'>
                    <h3><a href='{follower->uID}'>{$following->username}</a></h3>
                    <small>".language::invokeOutput('frequent / level')." {$following->level}</small>
                </div>
            </div>";
            }
            echo '</div>';
        }
    }
}