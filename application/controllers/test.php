<?php

class test extends Controller
{
    public function index()
    {
        if (isset($_GET['xp']))
            var_dump(usersAPI::getInstance()->addExperience(usersAPI::getLoggedId(), intval($_GET['xp'])));
        $getUser = usersAPI::getInstance()->getUserById(usersAPI::getLoggedId(), "id, username, profile_picture, status, role, level, xp");
        if (!empty($getUser))
        {
            $user = $getUser[0];
            header('Content-type: text/html; charset=utf-8');
            echo "hi {$user->username}, your id is {$user->id} <br>";
            echo "you are level {$user->level}, and have {$user->xp} experience <br>";
            echo "
                    <a href='?xp=25'>got 25 xp</a> -
                    <a href='?xp=50'>got 50 xp</a> -
                    <a href='?xp=75'>got 75 xp</a>
                    ";
        }
            $edec = [
                [
                    'title' => 'L.F en informatique',
                    'department' => 'isamm',
                    'years' => [2013, 2017]
                ],
                [
                    'title' => 'L.A en science',
                    'department' => 'isimm',
                    'years' => [2013, 2017],
                    'website' => 'http://isamm.com',
                ],
            ];

            $skills = [
                'label' => 'dev',
                'master' => 90,
                'certification' => 'http://isamm.com',
            ];

            $array = [];
            $string = "sdfdsf, sdfsdfsdf sdfsf ,,,,,,sdfsdfsdf,,sdfsdfdsf";
            $q = ['kill \'em all', 'xena'];
            //echo "<br>".json_encode($skills);
            $string =  preg_replace('/[\s]*,+[\s]*/u', ',', $string);
            //$op = explode(',',$string);
            echo "<br>";
            //array_push($array, $skills);
             //var_dump($string);
            $diff = date_diff(date_create('1996-01-22'),date_create('today'));
            $xp = ['xp', 25];
             $bad = 'عربي';
            //$v = preg_replace('/\p{Arabic}/u', '|', $bad);
            //$v = str_replace('عر', '|', $bad);
            //$v = mb_ereg_replace('[\x{0600}-\x{06FF}]+', '|', $bad);
            //var_dump($v);
            $dd = ['remove-replies', 'remove-threads'];
            echo json_encode($dd);
            //echo json_encode($xp);
            //notificationAPI::getInstance()->notifyFollowersThread(26, 36);
            // - !! - if no rows return it mean there's a logged non-existent user
            //usersAPI::clearLoggedTrace();
            //notificationAPI::getInstance()->addNotification(['receiver' => 1, 'action' => 2, 'action_id' => 3]);
            //var_dump(Controller::$db);
            //echo (Controller::$db->lastInsertId());
            var_dump($_SESSION);
            unset($_SESSION[SESSION_PREFIX.'BSCOSNR']);
            echo round( disk_free_space (__DIR__) / 8 / 1024 / 1024 / 1024, 2).'<br />';
            for ($x = 0; $x <= 6; $x++)
            {
                $date = date('Y-m-d', strtotime('-'.$x.' days'));
                echo date("d M", strtotime($date)).'<br />';
            }

            $yearsInArabic = '20042014';
            $delimiter = mb_strpos($yearsInArabic, 'UTF-8') ? ',' : '،';
            echo $delimiter;
            //$yearsInArabic = explode('،', preg_replace('/\s*/', '',$yearsInArabic));
            //var_dump($yearsInArabic);
            if (!preg_match('/^[0-9]{4}\s*[,،]\s*[0-9]{4}$/u', trim($yearsInArabic)))
                echo 'wrong';
            var_dump(parse_url(URL)['host']);
            $birthdat = '22/01/1996';
            //echo getRealDate($birthdat);
            $dates = ['22/02/1996', '02/22/1996', '1996/22/02', '1996/33/02', '1996/10/32', '1996/02/22', 'sdfsdf'];
            foreach ($dates as $key => $d)
                echo $dates[$key].' give as : '.getRealDate($d).'<br />';
            //$birthdat = date('Y-m-d', strtotime(str_replace('-', '/', $birthdat)));
            var_dump(usersAPI::getInstance()->updateUser(36, ['birthday' => getRealDate($dates[3])]));

    }

    public function test2()
    {
        echo 'sdf';
        $this->loadView('header');
    }
}
