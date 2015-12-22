<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class Paginator extends databaseAPI{
    public static $per_page = 9;
    public $_limit = 4,
            $_table,
            $_page,
            $_pages,
            $_next,
            $_prev,
            $_url,
            $_data,
            $_param;
    private static $_instance = null;

    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new Paginator(Controller::$db);
        }
        return self::$_instance;
    }

    public function __construct($db)
    {
        $this->setDataBase($db);
    }

    /**
     * @param $table
     */
    public function setPagesLimit($table)
    {
        if (is_array($table))
            $table = $table[0];
        $table = (strstr($table, ' ', true)) ? strstr($table, ' ', true) : $table;
        switch ($table)
        {
            case 'replies':
                self::$per_page = intval(variablesAPI::getInstance()->getVariableValue('limit', 'replyPP'));
                break;
            case 'threads':
                self::$per_page = intval(variablesAPI::getInstance()->getVariableValue('limit', 'threadPP'));
                break;
            case 'inbox':
            case 'support':
                self::$per_page = intval(variablesAPI::getInstance()->getVariableValue('limit', 'msgPP'));
                break;
        }

        if (self::$per_page == 0) self::$per_page = 10;
    }

    /**
     * @param $table
     * @param $url
     * @param string $rows
     * @param null $where
     * @param string $order
     * @param string $param
     * @param null $groupBy
     * @return $this
     */
    public function getData($table, $url, $rows = "*", $where = null, $order = 'order by id desc', $param = '?', $groupBy = null)
    {
        $this->setPagesLimit($table);
        $this->_table = $table;
        $this->_url = $url;
        $this->_param = $param;
        $page = isset_get($_GET, 'page', 1);
        $this->_page = isset($page) ?((is_numeric($page)) ? $page : 0 ) : 1;
        if ($this->_page == 0) header('Location: error');
        $table = is_array($table) ? $table[0] : $table;
        $records = count(parent::selectData('*', $where, $table, $groupBy));
        $this->_pages = (int)ceil($records / self::$per_page);
        $this->_pages = ($this->_pages == 0) ? $this->_pages = 1 : $this->_pages;
        $start = ($this->_page - 1) * self::$per_page;
        $this->_data = parent::selectData($rows, $where, $this->_table, $order, "LIMIT {$start} , " . self::$per_page);
        return $this;
    }

    /**
     * @return bool
     */
    public function isBadPage()
    {
        return $this->_page > $this->_pages;
    }

    /**
     * @return string
     */
    public function renderPages()
    {
        $this->_next = $this->_page + 1;
        $this->_prev = $this->_page - 1;
        $reverse = (DIRECTION == 'left') ? 'right' : 'left';
        Controller::$language->load('paginator');
        // next and previous buttons holder
        $links = '<div class="col-m col-12 v-middle pagination box">
                    <div class="col-3 v-col hide-sm">
                        <i class="icon-'.$reverse.' middle"></i> ';
        if ( $this->_page == 1 || $this->isBadPage() )
            $links .= '<a href="#disabled" id="prev-page" class="disabled">'.language::invokeOutput('prev').'</a> - ';
        else
            $links .= "<a href='{$this->_url}{$this->_param}page={$this->_prev}' id='prev-page'>". language::invokeOutput('prev') ."</a> - ";

        //
        if ( $this->_page == $this->_pages || $this->isBadPage() )
            $links .= '<a href="#disabled" id="next-page" class="disabled">'.language::invokeOutput('next').'</a>';
        else
        {
            $links .= "<a href='{$this->_url}{$this->_param}page={$this->_next}' id='next-page'>". language::invokeOutput('next') ."</a>";
        }
        $links .= ' <i class="icon-'. DIRECTION .' middle"></i></div>';
        // end - next and previous buttons holder
        // ###
        // pages list
        $links .= "<div class='col-6 v-col a-center margin hide-sm'>";
        $links .= ($this->_page == 1) ? "<a href='{$this->_url}{$this->_param}page=". $this->_page ."' class='checked'>".language::invokeOutput('first')."</a> " : "<a href='{$this->_url}{$this->_param}page=1'>".language::invokeOutput('first')."</a> ";
        if ($this->_pages > 1) {
            //set the start page in the list
            if ($this->_page == 1)
                $start = 2;
            else
               $start = ($this->_page <= $this->_limit) ? 2 : $this->_page - 1;
            //--
            //if the current page exceed the limit add the ...
            $links .= ($this->_page - $this->_limit > 1) ? " ... " : "";
            //get all the pages in the limit
            for ($x = $start, $j = 0; $x < $this->_pages; $x++,$j++){
                if ($j >= $this->_limit)
                {
                    $links .= " ... ";
                    break;
                }
                if ($x == $this->_page)
                    $links .= "<a href='{$this->_url}{$this->_param}page={$x}' class='checked'>{$x}</a> ";
                else
                    $links .= "<a href='{$this->_url}{$this->_param}page={$x}'>{$x}</a> ";
            }
            $links .= ($this->_page == $this->_pages) ? "<a href='?page={$this->_pages}' class='checked'>".language::invokeOutput('last')."</a>" : "<a href='{$this->_url}{$this->_param}page={$this->_pages}'>".language::invokeOutput('last')."</a>";
        }
        $links .= "</div>";
        // end - pages list
        // ###
        // select page
        $links .= $this->getSelectLinks();
        return $links;
    }

    /**
     * @return string
     */
    public function getInboxPages()
    {
        Controller::$language->load('paginator');
        $links = '<small>'.language::invokeOutput('page').' '.$this->_page.language::invokeOutput('of').$this->_pages.'</small> ';
        //previous page
        if ( $this->_page == 1 || $this->isBadPage() )
            $links .= '<a href="#" id="prev-page" class="disabled">'.language::invokeOutput('prev').'</a> - ';
        else
        {
            $links .= '<a href="'.$this->_url.$this->_param.'page="';
            $links .= $this->_page - 1;
            $links .= '" id="previous-page">'.language::invokeOutput('prev').'</a> - ';
        }
        //next page
        if ( $this->_page == $this->_pages || $this->isBadPage() )
            $links .= '<a href="#" id="prev-page" class="disabled">'.language::invokeOutput('next').'</a>';
        else
        {
            $links .= '<a href="'.$this->_url.$this->_param.'page="';
            $links .= $this->_page + 1;
            $links .= '" id="next-page">'.language::invokeOutput('next').'</a> - ';
        }

        $links .= ' ' . $this->getInboxSelectPages();
        return $links;

    }

    /**
     * @return string
     */
    public function getSelectLinks()
    {
        Controller::$language->load('paginator');
        $links = "<div class='col-3 v-col a-right margin'>
                        <select class='page-swapper'>";
        $links .= "<option value=''>".language::invokeOutput('select')." {$this->_page} / {$this->_pages}</option>";
        for ($x = 1; $x <= $this->_pages; $x++){
            $links .= "<option value='{$this->_url}{$this->_param}page={$x}'>{$x} / {$this->_pages}</option>";
        }
        $links .= "</select></div></div>";
        return $links;
    }

    /**
     * @return string
     */
    public function getInboxSelectPages()
    {
        Controller::$language->load('paginator');
        $select ="<a href='#selectPage' class='dropdown-trigger' data-id='sel-pages'>".language::invokeOutput('select')." {$this->_page}</a><ul id='sel-pages' class='dropdown-menu light-hover' style='min-width: 100px;'><div>";
        for ($x = 1; $x <= $this->_pages; $x++)
            $select .= "<a class='menu-element' href='{$this->_url}{$this->_param}page={$x}'>".language::invokeOutput('page')." {$x}</a>";
        $select .= '</div></ul>';
        return $select;
    }
}