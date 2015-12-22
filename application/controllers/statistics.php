<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class statistics extends Controller
{
    /**
     *
     */
    public function index()
    {
        //prepare the language
        self::$language->load('statistics');
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('page-title');
        //get counts
            //get all categories
            $data['categories-count'] = statisticAPI::getInstance()->getCategoriesCount();
            //all threads count
            $data['threads-count'] = statisticAPI::getInstance()->getThreadsCount();
            //all forums count
            $data['forums-count'] = statisticAPI::getInstance()->getForumsCount();
            //all users count
            $data['users-count'] = statisticAPI::getInstance()->getUsersCount();
            //males count
                $data['males'] = statisticAPI::getInstance()->countGender(2);
                //females count
                $data['females'] = statisticAPI::getInstance()->countGender(1);
                //unset count
                $data['unset'] = $data['users-count'] - ($data['males'] + $data['females']);
                //percentage
                $data['males'] = ceil(( $data['males'] / $data['users-count'] ) * 100);
                $data['females'] = ceil(( $data['females'] / $data['users-count'] ) * 100);
                $data['unset'] = ceil(( $data['unset'] / $data['users-count'] ) * 100);

        //all replies count
            $data['replies-count'] = statisticAPI::getInstance()->getRepliesCount();
        //most stats
            //most active user
            $data['most-active'] = statisticAPI::getInstance()->getMostActiveUser();
            //most recent user
            $data['most-recent'] = statisticAPI::getInstance()->getLastJoinedUser();
            //oldest user
            $data['most-old'] = statisticAPI::getInstance()->getFirstJoinedUser();
        //users that have a birthday today
        $data['have-birthday'] = statisticAPI::getInstance()->haveBirthday();
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('statistics', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

    /**
     * provide data for charts
     */
    public function getData()
    {
        self::$language->load('statistics');
        $data = ['users' => []];
        //all users count
        $usersCount = statisticAPI::getInstance()->getUsersCount();
        //inactive users
        $data['users']['inactiveUsers'] = usersAPI::getInstance()->getUsers('count(*) as cnt', [['posts', '=', '0']])[0]->cnt;
        $data['users']['activeUsers'] = intval($usersCount - $data['users']['inactiveUsers']);
        //males count
        $data['users']['males'] = intval(statisticAPI::getInstance()->countGender(2));
        //females count
        $data['users']['females'] = intval(statisticAPI::getInstance()->countGender(1));
        //unset count
        $data['users']['unset'] = $usersCount - ($data['users']['males'] + $data['users']['females']);
        //get top countries
        $data['countries'] = statisticAPI::getInstance()->getTopCountries(5);
        //get top categories
        $data['categories'] = statisticAPI::getInstance()->getTopCategories();
        //get users by ages group
        $ages = [
            '13 - 17' => [13, 17],
            '18 - 24' => [18, 24],
            '25 - 34' => [25, 34],
            '35 - 44' => [35, 44],
            '+45' => [45, 170]
        ];
        $data['ages'] = statisticAPI::getInstance()->getUsersCountByAges($ages);
        $data['languages'] = [
            'male' => Language::invokeOutput('frequent/male'),
            'female' => Language::invokeOutput('frequent/female'),
            'unset' => Language::invokeOutput('frequent/unset'),
            'inactive' => Language::invokeOutput('inactive'),
            'active' => Language::invokeOutput('active'),
        ];
        //return the data
        echo json_encode($data);
    }

}