<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */
class report extends Controller
{

    /**
     *
     */
    public function index()
    {
        if (!usersAPI::isLogged() || !accessAPI::getInstance()->checkAccess(self::$GLOBAL['logged']->id, 'report-center'))
            header('Location: home');
        //prepare the language
        self::$language->load('report');
        //set data
        $data = [];
        //the title of the page on browser tab
        $data['title'] = self::$language->invokeOutput('title');
        //the title shown on the page wide header
        $data['page-title'] = self::$language->invokeOutput('title');
        //the checked navbar link
        $data['menu-report'] = "class='checked'";
        //set the order preference
        if (isset($_GET['order']))
            Order::setOrder(null, 'BSCOSNR');
        //get the order type
        $gedOrderType = Order::getOrder(false, null, 'BSCOSNR');
        //check the order selected type's anchor
        $data[$gedOrderType] = "class='checked'";
        //get reports
        $paginator = reportAPI::getInstance()->getReportsToCenter();
        //if the current page is wrong re-direct the user
        if ($paginator->isBadPage())
            header('Location: error');
        //get the threads for the pagination result
        $data['reports'] = $paginator->_data;
        //get the pages list links form the pagination result
        $data['pages'] = $paginator->renderPages();
        //page url base
        $data['url'] = isset($_GET['page']) ? '?page='.$_GET['page'].'&' : '?';
        //load the header view
        $this->loadView('header', $data);
        //load this page view
        $this->loadView('report/home', $data);
        //load the footer view
        $this->loadView('footer', $data);
    }

    /**
     * view a single report
     */
    public function view(){
        $params = func_get_args();
        if (isset($params[0]))
        {
            $getReport = reportAPI::getInstance()->getReportById($params[0]);
            if (!empty($getReport))
            {
                $getReport = $getReport[0];
                if (!usersAPI::isLogged() || !accessAPI::getInstance()->checkAccess(self::$GLOBAL['logged']->id, 'report-center'))
                    header('Location: home');
                //make report seen
                reportAPI::getInstance()->seeReports($getReport->reported, $getReport->type);
                //prepare the language
                self::$language->load('report');
                //set data
                $data = [];
                //the title of the page on browser tab
                $data['title'] = self::$language->invokeOutput('view/title');
                //the title shown on the page wide header
                $data['page-title'] = self::$language->invokeOutput('view/title');
                //the checked navbar link
                $data['menu-report'] = "class='checked'";
                //get the reported post data
                $data['reported'] = reportAPI::getInstance()->getReportedPost($getReport->reported, $getReport->type);
                if (empty($data['reported']))
                    header('Location: report');
                $data['report'] = $getReport;
                $data['reported'] = $data['reported'][0];
                //get post reports
                $data['reports'] = reportAPI::getInstance()->getPostReports($getReport->reported, $getReport->type);
                //load the header view
                $this->loadView('header', $data);
                //load this page view
                $this->loadView('report/view', $data);
                //load the footer view
                $this->loadView('footer', $data);
            }else{
                header('Location: '. URL .'error');
            }
        }else{
            header('Location: ../report');
        }
    }
}