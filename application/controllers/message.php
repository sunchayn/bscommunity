<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class message extends Controller
{
    /**
     *
     */
    public function index()
    {
        //redirect visitors
        if (!usersAPI::isLogged())
            header('Location: home');
        //get the passed params
        $params = func_get_args();
        //if isset a param => isset a forum ID
        if (isset($params[0])) {
            $getMsg = inboxAPI::getInstance()->getMessageById($params[0]);
            if (!empty($getMsg))
            {
                //get the logged id
                $id = self::$GLOBAL['logged']->id;
                //prepare the language
                self::$language->load('inbox');
                $data = [];
                $data['message'] = $getMsg[0];
                //make the message or the response seen
                if ($data['message']->sender == $id)
                {
                    if ($data['message']->is_sen_del != 0)
                        header('Location: ../error');
                    inboxAPI::getInstance()->seeResponse($params[0]);
                }
                else
                {
                    if ($data['message']->is_rec_del != 0)
                        header('Location: ../error');
                    inboxAPI::getInstance()->makeRead($params[0]);
                }
                //the title of the page on browser tab
                $data['title'] = $data['message']->title;
                //the title shown on the page wide header
                $data['page-title'] = self::$language->invokeOutput('page-title');
                $data['sub-inbox'] = inboxAPI::getInstance()->getSubMessages($params[0]);
                //get the current section
                if ($data['message']->receiver == $id || ($data['message']->sender == $id && !is_null($data['message']->last_response)))
                    $section = 'inbox';
                elseif($data['message']->sender == $id && $data['message']->has_response == 0)
                    $section = 'sent';
                else
                    $section = 'draft';
                $data['back'] = ($section == 'inbox') ? 'inbox' : 'inbox?section='.$section;
                //check the current link
                $data['selected'][$section] = "id='checked'";
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('message', $data);
                //load the footer view
                $this->loadView('footer', $data);
            } else {
                header('Location: ../error');
            }
        } else {
            header('Location: ../error');
        }
    }

}