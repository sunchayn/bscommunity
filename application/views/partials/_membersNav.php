<div class="top-nav hide-sm">
    <div class="sub-wrapper input-to-toggle-wrapper">
        <div class="col-m col-12 input-to-toggle">
            <form action="search" action="GET">
                <input type="text" name="q" placeholder="<?=Language::invokeOutput('input-placeholder/search');?>">
            </form>
            <a class="icon-cancel toggle-back"></a>
        </div>
        <div class="col-m col-12">
            <span class="middle menu col-7">
                <img src="<?=URL;?>img/logo.png" alt="logo" height="50" width="50" class="middle">
                <nav>
                    <a href="home" <?=isset_get($data, 'menu-home', '');?>><?=Language::invokeOutput('menu/home');?></a>
                    <a href="feed" <?=isset_get($data, 'menu-feed', '');?>><?=Language::invokeOutput('menu/feed');?></a>
                    <a href="members" <?=isset_get($data, 'menu-members', '');?>><?=Language::invokeOutput('menu/members');?></a>
                    <a href="store" <?=isset_get($data, 'menu-store', '');?>><?=Language::invokeOutput('menu/store');?></a>
                    <?php
                        $unread = (reportAPI::getInstance()->issetUnread()) ? 'id="unread-report"' : '';
                        if (accessAPI::getInstance()->checkAccess($global['logged']->id, 'report-center'))
                            echo '<a href="report" '. isset_get($data, 'menu-report', ''). '  ' .$unread.'>'. Language::invokeOutput('menu/report') .'</a>';
                    ?>
                </nav>
            </span>
            <span class="col-5 second-panel a-right">
                <nav class="member-pref">
                    <a href="#" class="toggle-input"><?=Language::invokeOutput('menu/search');?></a>
                    <?php
                    if ($global['inboxCount'] <= 0)
                    {
                    ?>
                    <a href="#" class="icon-mail-alt dropdown-trigger" data-id="empty-inbox"></a>
                    <?php } else { ?>
                    <div class="label label-with-icon rad2 middle bg-color-5">
                        <a href="#" data-id="inbox-menu" class="icon-mail-alt dropdown-trigger"></a>
                        <span><?=$global['inboxCount'];?></span>
                    </div>
                    <ul id="inbox-menu" class="dropdown-menu max-width light-hover separate-menu">
                        <?php //inbox
                        foreach($global['logged']->inbox as $inbox)
                        {
                            ?>
                            <a class="menu-element" href="message/<?=$inbox->id;?>">
                                <h4><?=$inbox->title.' - '.$inbox->username;?></h4>
                                <p><?=$inbox->content;?></p>
                                <small><?=$inbox->date;?></small>
                            </a>
                        <?php } //end foreach ?>
                        <a class="menu-element menu-all" href="inbox"><?=Language::invokeOutput('messages/more');?></a>
                    </ul>
                    <?php } //notifications
                    if ($global['notificationsCount'] <= 0)
                    {
                    ?>
                        <a href="#" data-id="empty-notify" class="icon-bell-alt dropdown-trigger"></a>
                    <?php
                    }else{
                        ?>
                        <div class="label label-with-icon rad2 middle bg-color-5">
                            <a href="#notification" data-id="notify-menu" class="icon-bell-alt dropdown-trigger notifications"></a>
                            <span><?=$global['notificationsCount'];?></span>
                        </div>
                        <ul id="notify-menu" class="dropdown-menu max-width light-hover separate-menu">
                            <li class="menu-heading">
                                <?=Language::invokeOutput('notification/center');?>
                                <span class="f-right">
                                    <a href="settings/notifications"><?=Language::invokeOutput('frequent/settings');?></a>
                                </span>
                                <div class="clear"></div>
                            </li>
                            <?php
                            foreach($global['logged']->notifications as $notify)
                            {
                                ?>
                                <a class="menu-element" href="<?=$notify['url'];?>">
                                    <?=$notify['content'];?>
                                </a>
                            <?php } //end foreach ?>
                        </ul>
                    <?php } ?>
                    <ul id="empty-notify" class="dropdown-menu plain-html">
                        <p><?=Language::invokeOutput('notification/no-notify');?></p>
                    </ul>
                    <ul id="empty-inbox" class="dropdown-menu plain-html">
                        <?=Language::invokeOutput('messages/no-msg');?></p>
                    </ul>
                    <a href="#" data-id="user-menu" class="dropdown-trigger">
                        <img src="<?=$global['logged']->profile_picture;?>" alt="user picture" height="35" width="35" class="img-circel middle">
                    </a>
                    <ul id="user-menu" class="dropdown-menu">
                        <div class="menu-html">
                            <div>
                                <span><?=$global['logged']->username;?></span> <br />
                                <small><?=language::invokeOutput('frequent/level').' '.$global['logged']->level.' ('.$global['logged']->experience;?> )</small>
                            </div>
                            <div>
                                <small><?=language::invokeOutput('frequent/posts').' : '.$global['logged']->posts;?></small> - <small><?=language::invokeOutput('frequent/gold').' : '.$global['logged']->gold;?></small>
                            </div>
                        </div>
                        <a  class="menu-element" href="profile/<?=$global['logged']->id;?>"><?=Language::invokeOutput('user-panel/profile');?></a>
                        <?php
                            if (accessAPI::is_admin())
                                echo '<a class="menu-element" href="admin_cp">'. Language::invokeOutput('user-panel/admin_cp') .'</a>';
                        ?>
                        <a  class="menu-element" href="settings"><?=Language::invokeOutput('user-panel/settings');?></a>
                        <a  class="menu-element" href="inbox"><?=Language::invokeOutput('user-panel/inbox');?></a>
                        <a  class="menu-element" href="inventory"><?=Language::invokeOutput('user-panel/inventory');?></a>
                        <a  class="menu-element" href="support"><?=Language::invokeOutput('user-panel/support');?></a>
                        <a  class="menu-element" href="logout"><?=Language::invokeOutput('user-panel/logout');?></a>
                    </ul>
                </nav>
            </span>
        </div>
    </div>
</div>
<!-- responsive purpose - will be displayed when screen is small -->
<div class="col-m col-12 show-sm res-nav">
    <div class="col-m col-12 a-center box user-panel">
        <img src="<?=$global['logo_url'];?>" alt="logo" height="50" width="50" class="middle">
        <a href="#panel" class="small-username trigger-sm-userpanel"><?=$global['logged']->username;?></a>
        <?php
        if ($global['inboxCount'] <= 0)
        {
            echo '<a href="inbox" class="icon-mail-alt"></a>';
        } else { ?>
        <div class="label label-with-icon rad2 middle bg-color-5">
            <a href="inbox" class="icon-mail-alt"></a>
            <span><?=$global['inboxCount'];?></span>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>
    <div class="field-with-icon rad2">
        <form action="search" method="get" class="clearfix">
            <span class="icon"><a href="" class="icon-search"></a></span>
            <span class="field">
                <input type="text" name="q" placeholder="<?=Language::invokeOutput('input-placeholder/search');?>">
            </span>
        </form>
    </div>
    <nav class="col-m col-12 res-menu">
        <a href="home" class="icon-home"></a>
        <a href="feed" class="icon-th"></a>
        <a href="members" class="icon-user"></a>
        <a href="store" class="icon-lock"></a>
        <?php
        $unread = (reportAPI::getInstance()->issetUnread()) ? 'id="unread-report"' : '';
        if (accessAPI::getInstance()->checkAccess($global['logged']->id, 'report-center'))
            echo '<a href="report" class="icon-bug"></a>';
        ?>
    </nav>
</div>
<!-- end responsive nav -->
</div>
<!-- end navbar -->
<div class="sm-userpanel">
    <a href="profile/<?=$global['logged']->id;?>"><?=Language::invokeOutput('user-panel/profile');?></a>
    <?php
    if (accessAPI::is_admin())
        echo '<a href="admin_cp">'. Language::invokeOutput('user-panel/admin_cp') .'</a>';
    ?>
    <a href="settings"><?=Language::invokeOutput('user-panel/settings');?></a>
    <a href="inbox"><?=Language::invokeOutput('user-panel/inbox');?></a>
    <a href="inventory"><?=Language::invokeOutput('user-panel/inventory');?></a>
    <a href="support"><?=Language::invokeOutput('user-panel/support');?></a>
    <a href="logout"><?=Language::invokeOutput('user-panel/logout');?></a>
</div>